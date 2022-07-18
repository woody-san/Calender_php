<?php
    session_start();
    $user_email = $_SESSION['email'];
    if (isset($_SESSION['email'])) {//ログインしているとき
        $msg = 'Hello, ' . htmlspecialchars($user_email, \ENT_QUOTES, 'UTF-8') .  ' &emsp;<a href="logout.php" class="btn">LOGOUT</a>';
    } else {//ログインしていないとき
        $msg = 'You have not logged in. &emsp;<a href="login_form.php" class="btn">LOGIN</a>';
    }
    $day = $_POST['day'];
?>
<h2><?php echo $msg; ?></h2>
        
<!doctype html>
<html lang="'ja">
    <head>
        <meta charset="UTF-8">
        <title>Calendar_Registration</title>
        <meta name="description" content="Schedule">
        <link rel="stylesheet" href="schedule.css">

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Arima:wght@300;700&display=swap" rel="stylesheet">
    </head>
    <body>

        <div class="wrapper">
            <h1>Schedule</h1>
            <p><?php echo $day; ?></p>
            <?php
            //id と is_reserve_app_scheduleをschedule_deleteに渡す

            $data = array('day'=>$day,'user_email'=>$user_email);
            $data_json = json_encode($data);

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data_json);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_URL, 'http:/localhost:8090/day_calender');
            $result=curl_exec($ch);
            $res_json = json_decode($result , true );
            curl_close($ch);

            echo '<form method="post" action="schedule_delete.php">';

            for($i=0; $i<count($res_json) ; $i++){
                if($res_json[$i]['reserve_id']=="xx"){               
                    echo '<table>';
                    echo '<tr>';
                    echo '<td class="self"> '.$res_json[$i]["day"].' / '.$res_json[$i]["title"].'</td>
                    <td>&nbsp;&nbsp;&nbsp;<input class="radius-percent-10" type="submit" name="delete['.$res_json[$i]["schedule_id"].']" value="DELETE"></td>';
                    echo '</tr>';
                    echo '</table></br>';
                }else{
                    echo '<table>';
                    echo '<tr>';
                    echo '<td class="notself"> '.$res_json[$i]["day"].' / '.$res_json[$i]["title"].'</td>
                    <td>&nbsp;&nbsp;&nbsp;<input class="radius-percent-10" type="submit" name="delete['.$res_json[$i]["schedule_id"].']" value="DELETE"></td>';
                    echo '</tr>';
                    echo '</table></br>';
                }                
            }
            echo '<input type="hidden" name="day" value="'.$day.'">';
            echo '</form>';         

            ?>
            <p><a href="calender.php" style="color:#20b2aa;">Calendar</a></p>           
        </div>
    </body>
</html>