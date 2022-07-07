<!doctype html>
<html lang="'ja">
    <head>
        <meta charset="UTF-8">
        <title>Calender_Registration_process</title>
        <meta name="description" content="会員登録">
    </head>

    <body>
        <h1>会員登録結果</h1>
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

            //input_post.phpの値を取得
            $user_id = $_POST['user_id'];
            $password = $_POST['password'];
            $mail = $_POST['mail'];

            $sql = "INSERT INTO users (id, user_id, password, mail) VALUES (NULL, :user_id, :password, :mail)"; // INSERT文を変数に格納。:nameや:categoryはプレースホルダという、値を入れるための単なる空箱
            $stmt = $pdo->prepare($sql); //挿入する値は空のまま、SQL実行の準備をする
            $params = array(':user_id' => $user_id, ':password' => $password, ':mail' => $mail); // 挿入する値を配列に格納する
            $stmt->execute($params); //挿入する値が入った変数をexecuteにセットしてSQLを実行

            echo "<p>ユーザID: ".$user_id."</p>";
            echo "<p>パスワード: ".$password."</p>";
            echo "<p>メールアドレス: ".$mail."</p>";
            echo '<p>で登録しました。</p>'; // 登録完了のメッセージ

        } catch (PDOException $e) {
            exit('データベースに接続できませんでした。' . $e->getMessage());
        }
        ?>
        <a href="login.php">ログインページ</a>へ
    </body>
</html>