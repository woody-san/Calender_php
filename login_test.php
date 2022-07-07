<!doctype html>
<html lang="'ja">
    <head>
        <meta charset="UTF-8">
        <title>Calendar_Login</title>
        <meta name="description" content="カレンダーアプリ">
        <link rel="stylesheet" href="login_form3.css">

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Arima:wght@300;700&display=swap" rel="stylesheet">
    </head>

    <body>
    <div class="wrapper">
        <h1>Calendar</h1>
        <form action="login.php" method="post">
        <div class="inputWithIcon">
            <!--<label class="input_form">ユーザID：<label>-->
            <input type="text" placeholder="User email" name="user_email" required>
            <i class="fa fa-user fa-lg fa-fw" aria-hidden="true"></i>
        </div>
        <div class="inputWithIcon">
            <input type="password" placeholder="Password" name="password" required>
            <i class="fa fa-user fa-lg fa-fw" aria-hidden="true"></i>
        </div>
        <!--<input type="submit" value="ログイン">-->
        <!--<input type="submit" name="LOGIN" value="LOGIN">-->
        </br>
        <p><input class="radius-percent-10" type="submit" value="LOGIN"></p>

        </form>
        <p>click <a href="signup.php" style="color:#20b2aa;">here</a> to register as a member</p>
        <!--<img src="image/green_flower.jpg" alt="green_flower">-->

    </div>

    <?php
        try {
            //DB名、ユーザー名、パスワード
            $username = "example_user";
            $password_db = "example_pass";
            $hostname = "db";
            $db = "example_db";
            // データベース接続
            $pdo = new PDO("mysql:host={$hostname};dbname={$db};charset=utf8", $username, $password_db);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); //PDOのエラーレポートを表示
            echo "接続できました";
        
        } catch (PDOException $e) {
            exit('データベースに接続できませんでした。' . $e->getMessage());
        }

        // SQLを実行して結果を画面に表示
        $sql = "SELECT * FROM examples";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo "id: {$row["id"]}, name: {$row["name"]}<br/>\n";
        }
        $member = $stmt->fetch();
        if($member == NULL){
            $member_email = null;
            //登録されていなければinsert 
            //$sql = "INSERT INTO users(id, user_id, mail, password) VALUES (NULL, :user_id, :mail, :password)";
            echo "誰もいません";
        }else{
            //$member_email = $member["email"];
            $msg = 'This user ID is not available.';
            $link = '<a href="signup.php" style="color:#20b2aa;">Back</a>';
        }


    ?>
    </body>
</html>

