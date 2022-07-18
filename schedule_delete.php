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

            if(isset($_POST['delete'])){
                $button = key($_POST['delete']); //deleteが押された予定のid取得
                //echo '消去されたのは'.$button.'<br />';

                $data = array('schedule_id'=>$button);
                $data_json = json_encode($data);

                $ch = curl_init();
                curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
                curl_setopt($ch, CURLOPT_POSTFIELDS, $data_json);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_URL, 'http:/localhost:8090/delete_schedule');
                $result = curl_exec($ch);
                $res_json = json_decode($result , true );
                curl_close($ch);
                //echo $res_json;

                if(isset($res_json['message'])){
                    $msg = '<h1>Not exit schedule.</h1>';
                    $link = '<p><a href="schedule.php" style="color:#20b2aa;">Back</a></p>';
                }else {
                    $msg = '<h1>Schedule deleted.</h1>';
                    $link = '<p><a href="calender.php" style="color:#20b2aa;">Calendar</a></p>';            
                }
                echo '<h1>'.$msg.'</h1>';
                echo '<h1>'.$link.'</h1>';
            }
            ?>

            
        </div>
    </body>
</html>






