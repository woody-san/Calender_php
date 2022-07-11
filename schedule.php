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

            ?>
            <p><a href="calender.php" style="color:#20b2aa;">Calendar</a></p>           
        </div>
    </body>
</html>
<?php

//フォーム部分
echo '<div class="wrapper">';

echo '</div>';
echo '<form method="post" action="schedule_delete.php">';



/*
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    echo '<table>';
    echo '<tr>';
    if($row["is_reserve_app_schedule"]==false){
        echo '<td class="self"> '.$row["day"].' / '.$row["title"].'</td>
        <td>&nbsp;&nbsp;&nbsp;<input class="radius-percent-10" type="submit" name="delete['.$row["id"].']" value="DELETE"></td>';
    }else{
        echo '<td class="notself"> '.$row["day"].' / '.$row["title"].'</td>
        <td>&nbsp;&nbsp;&nbsp;<input class="radius-percent-10" type="submit" name="delete['.$row["id"].']" value="DELETE"></td>';
    }
    echo '</tr>';
    echo '</table></br>';
    $row_num = $row_num+1;
}

echo '<input type="hidden" name="day" value="'.$day.'">';
echo '</form>';
echo '<p><a href="calender.php" style="color:#20b2aa;">Calender</a></p>';
echo '</div>';
/*
$msg1 = null;
$link1 = null;
if(isset($_POST['delete'])){
    $button = key($_POST['delete']); //deleteが押された予定のid取得
    echo '消去されたのは'.$button.'<br />';
    $sql = "DELETE FROM schedule where day = :day AND user_id = :user_id AND id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':day', $day);
    $stmt->bindValue(':user_id', $user);
    $stmt->bindValue(':id', $button);
    $stmt->execute();
    $msg1 = '予定を削除しました';
    $link1 = '<a href="schedule.php">ログインページ</a>';
}
//$row_numは抽出された予定の個数

echo $row_num;*/

?>

