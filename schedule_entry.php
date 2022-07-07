<?php
    session_start();
    $user_email = $_SESSION['email'];
    if (isset($_SESSION['email'])) {//ログインしているとき
        $msg = 'Hello, ' . htmlspecialchars($user_email, \ENT_QUOTES, 'UTF-8') .  ' &emsp;<a href="logout.php" class="btn">LOGOUT</a>';
        //$link = '<a href="logout.php">ログアウト</a>';
    } else {//ログインしていない時
        $msg = 'You have not logged in. &emsp;<a href="login_form.php" class="btn">LOGIN</a>';
    }
?>
<h2><?php echo $msg; ?></h2>

<!doctype html>
<html lang="'ja">
    <head>
        <meta charset="UTF-8">
        <title>Calender_Login</title>
        <meta name="description" content="カレンダーアプリ">
        <link rel="stylesheet" href="schedule_entry2.css">

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Arima:wght@300;700&display=swap" rel="stylesheet">
    </head>

    <body>
    <div class="wrapper">
    <h1>Schedule Register</h1>
    <form action="schedule_register.php" method="post">

    <div class="inputWithIcon">
            <!--<label style="color:#800000;display:block;float:left;width:1300px;">title：</label></br>-->
            <h2>Title：</h2>
            <input type="text" name="title" required>
            <i class="fa fa-user fa-lg fa-fw" aria-hidden="true"></i>
        </div>
        <div class="inputWithIcon">
            <!--<label style="color:#800000;" font-size="2rem;" font size="7">Date：</label></br>-->
            <h2>Date：</h2>
            <input type="date" name="day" required>
            <i class="fa fa-user fa-lg fa-fw" aria-hidden="true"></i>
        </div>
        </br>

        <p><input class="radius-percent-10" type="submit" value="Submit"></p>
        <p><a href="calender.php" style="color:#20b2aa;">Calender</a></p>

    </form>
    </div>
    </body>
</html>