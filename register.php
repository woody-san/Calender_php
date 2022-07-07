<!doctype html>
<html lang="'ja">
    <head>
        <meta charset="UTF-8">
        <title>Calender_Login</title>
        <meta name="description" content="カレンダーアプリ">
        <link rel="stylesheet" href="register.css">

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Arima:wght@300;700&display=swap" rel="stylesheet">
        <link href="http:/locahost:8090/signup">
    </head>

    <body>
    <div class="wrapper">
        <?php
        //フォームからの値をそれぞれ変数に代入
        $username = $_POST['username'];
        $email = $_POST['email'];
        //$password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $password = $_POST['password'];

        $data = array('username'=>$username,'password'=>$password,'email'=>$email);
        $data_json = json_encode($data);
        //echo $data_json;

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_json);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_URL, 'http:/localhost:8090/signup');
        $result=curl_exec($ch);
        $res_json = json_decode($result , true );
        /*
        echo $res_json;
        if(isset($res_json)){
            echo 'a';
            echo $res_json['email'];
        }
        echo gettype($res_json);
        echo 'RETURN:'.$result.'/n';
        curl_close($ch);*/
        

        if(isset($res_json['message'])){
            $msg = '<h1>'.$res_json['message'].'</h1>';
            $link = '<a href="signup.php" style="color:#20b2aa;">Back</a>';
        }else {
            $msg = 'Member registration is complete.';
            $link = '<a href="login_form.php" style="color:#20b2aa;">Login page</a>';
        }
        echo '<h1>'.$msg.'</h1>';
        echo '<h1>'.$link.'</h1>';

        ?>

</div>
    </body>
</html>