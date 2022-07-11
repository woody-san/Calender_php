<!doctype html>
<html lang="'ja">
    <head>
        <meta charset="UTF-8">
        <title>Calendar_Login</title>
        <meta name="description" content="カレンダーアプリ">
        <link rel="stylesheet" href="login_form.css">

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Arima:wght@300;700&display=swap" rel="stylesheet">
    </head>

    <body>
    <div class="wrapper">
        <h1>Calendar</h1>
        <form action="login.php" method="post">
        <div class="inputWithIcon">
            <input type="text" placeholder="User email" name="email" required>
            <i class="fa fa-user fa-lg fa-fw" aria-hidden="true"></i>
        </div>
        <div class="inputWithIcon">
            <input type="password" placeholder="Password" name="password" required>
            <i class="fa fa-user fa-lg fa-fw" aria-hidden="true"></i>
        </div>
        </br>
        <p><input class="radius-percent-10" type="submit" value="LOGIN"></p>

        </form>
        <p>click <a href="signup.php" style="color:#20b2aa;">here</a> to register as a member</p>

    </div>
    </body>
</html>

