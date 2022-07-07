<!doctype html>
<html lang="'ja">
    <head>
        <meta charset="UTF-8">
        <title>Calender_Login</title>
        <meta name="description" content="カレンダーアプリ">
        <link rel="stylesheet" href="signup.css">

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Arima:wght@300;700&display=swap" rel="stylesheet">
    </head>

    <body>
    <div class="wrapper">

        <h1>Member Registration</h1>
        
        <form action="register.php" method="post">
        <div class="inputWithIcon">
            <!--<label class="input_form">ユーザID：<label>-->
            <input type="text" placeholder="User Name" name="username" required>
            <i class="fa fa-user fa-lg fa-fw" aria-hidden="true"></i>
        </div>
        <div class="inputWithIcon">
            <input type="text" placeholder="Mail Address" name="email" required>
            <i class="fa fa-user fa-lg fa-fw" aria-hidden="true"></i>
        </div>
        <div class="inputWithIcon">
            <input type="password" placeholder="Password" name="password" required>
            <i class="fa fa-user fa-lg fa-fw" aria-hidden="true"></i>
        </div>
        <!--<input type="submit" value="ログイン">-->
        <!--<input type="submit" name="Submit" value="Submit">-->
        </br>

        <p><input class="radius-percent-10" type="submit" value="Submit"></p>

    

        </form>
        <p>Log in <a href="login_form.php" style="color:#20b2aa;">here</a> if you already registered.</p>
        
    </div>
    </body>
</html>