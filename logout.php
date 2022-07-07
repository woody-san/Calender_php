<?php
session_start();
$_SESSION = array();//セッションの中身をすべて削除
session_destroy();//セッションを破壊
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
        <h1>Logged out.</h1>
        <p><a href="login_form.php" style="color:#20b2aa;">Login page</a></p>
        </div>
    </body>
</html>