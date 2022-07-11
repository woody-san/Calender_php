<?php
    session_start();
    $email = $_POST['email'];
    $password = $_POST['password'];
?>

<!doctype html>
<html lang="'ja">
    <head>
        <meta charset="UTF-8">
        <title>Calendar_Registration</title>
        <meta name="description" content="Schedule">
        <link rel="stylesheet" href="signup.css">

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Arima:wght@300;700&display=swap" rel="stylesheet">
    </head>
    <body>
        <div class="wrapper">
            <?php
            $data = array('email'=>$email,'password'=>$password);
            $data_json = json_encode($data);

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data_json);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_URL, 'http:/localhost:8090/login');
            $result=curl_exec($ch);
            $res_json = json_decode($result , true );
            curl_close($ch);

            if(isset($res_json['message'])){
                $msg = '<h1>'.$res_json['message'].'</h1>';
                $link = '<p><a href="login_form.php" style="color:#20b2aa;">Back</a></p>';
            }else {
                //ログインユーザのemailをセッションに保存
                $_SESSION['email'] = $email;
                $msg = '<h1>Logged in.</h1>';
                $link = '<p><a href="calender.php" style="color:#20b2aa;">Calendar</a></p>';            
            }
            echo '<h1>'.$msg.'</h1>';
            echo '<h1>'.$link.'</h1>';
            ?>
        </div>
    </body>
</html>

