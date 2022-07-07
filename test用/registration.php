<!doctype html>
<html lang="'ja">
    <head>
        <meta charset="UTF-8">
        <title>Calender_Registration</title>
        <meta name="description" content="会員登録">
    </head>

    <body>
        <h1>Calenderアプリ会員登録</h1>
        <p>ユーザ情報を設定してください</p>
        <div id="post_page">
            <form method="post" action="process_post.php">
                <div>ユーザID <input type="text" name="user_id" size="30"></div>
                <div>パスワード <input type="text" name="password" size="30"></div>
                <div>メールアドレス <input type="text" name="mail" size="50"></div>
                <div><input type="submit" name="submit" value="会員登録" class="button"></div>
            </form>
        </div>
    </body>
</html>