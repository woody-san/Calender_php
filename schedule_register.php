<?php
    session_start();
    $user_email = $_SESSION['email'];
    if (isset($_SESSION['email'])) {//ログインしているとき
        $msg = 'Hello, ' . htmlspecialchars($user_email, \ENT_QUOTES, 'UTF-8') .  ' &emsp;<a href="logout.php" class="btn">LOGOUT</a>';
    } else {//ログインしていないとき
        $msg = 'You have not logged in. &emsp;<a href="login_form.php" class="btn">LOGIN</a>';
    }
    
?>
<h2><?php echo $msg; ?></h2>

<?php
    $title = $_POST['title'];
    $day = $_POST['day'];
?>
<!doctype html>
<html lang="'ja">
    <head>
        <meta charset="UTF-8">
        <title>Calendar_Registration</title>
        <meta name="description" content="Schedule">
        <link rel="stylesheet" href="schedule_entry.css">

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Arima:wght@300;700&display=swap" rel="stylesheet">
    </head>
    <body>
        <div class="wrapper">
            <?php
            $data = array('title'=>$title,'day'=>$day,'user_email'=>$user_email);
            $data_json = json_encode($data);
           
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data_json);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_URL, 'http:/localhost:8090/register_schedules');
            $result=curl_exec($ch);
            $res_json = json_decode($result , true );
            curl_close($ch);

            $msg = 'Schedule has been registered.';
            ?>
            <h1><?php echo $msg; ?></h1><!--メッセージの出力-->
            <p><a href="calender.php" style="color:#20b2aa;">Calendar</a></p>
            
        </div>
    </body>
</html>