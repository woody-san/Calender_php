<?php
session_start();
$user_email = $_SESSION['email'];
if (isset($_SESSION['email'])) {//ログインしているとき
    $msg = 'Hello, ' . htmlspecialchars($user_email, \ENT_QUOTES, 'UTF-8') .  ' &emsp;<a href="logout.php" class="btn">LOGOUT</a>';
    //$link = '<a href="logout.php">ログアウト</a>';
} else {//ログインしていない時
    $msg = 'You have not logged in. &emsp;<a href="login_form.php" class="btn">LOGIN</a>';
}
echo '<h2>'.$msg.'</h2>'; 
$day = $_POST['day'];

//APIのアドレス
$end_point = 'http://localhost:8090/????';
//jsonファイルの内容
$id = $_POST['id'];//schedule.phpからpost
$is_reserve_app_schedule = $_POST['is_reserve_app_schedule'];//schedule.phpからpost
$parameters = [
    'id'=>$id,
    'is_reserve_app_schedule'=>$is_reserve_app_schedule,
];
//jsonファイル作成
$options = [
    'http' => [
        'header'  => 'Content-type: application/json',
        'method'  => 'POST',
        'content' => json_encode($parameters),
    ],
];
$context  = stream_context_create($options);
$response = @file_get_contents($end_point, false, $context);

if($response==200){
    $msg = 'The shedule has been deleted.';
    $link = '<a href="calender.php">カレンダーへ</a>';
}else if($response==400){
    $msg = 'Please try again.';
    $link = '<a href="calender.php">カレンダーへ</a>';
}
echo '<h1>'.$msg.'</h1>';
echo '<h1>'.$link.'</h1>';

try {
    //DB名、ユーザー名、パスワード
    $username = "example_user";
    $password_db = "example_pass";
    $hostname = "db";
    $db = "example_db";
    // データベース接続
    $pdo = new PDO("mysql:host={$hostname};dbname={$db};charset=utf8", $username, $password_db);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); //PDOのエラーレポートを表示

} catch (PDOException $e) {
    exit('データベースに接続できませんでした。' . $e->getMessage());
}

if(isset($_POST['delete'])){
    $button = key($_POST['delete']); //deleteが押された予定のid取得
    //echo $day.'の予定を削除しました。<br />';
    $sql = "DELETE FROM schedule where day = :day AND user_email = :user_email AND id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':day', $day);
    $stmt->bindValue(':user_email', $user_email);
    $stmt->bindValue(':id', $button);
    $stmt->execute();
    //$msg1 = '予定を削除しました';
    $link1 = '<a href="calender.php">カレンダーページ</a>へ';
}
?>

<!doctype html>
<html lang="'ja">
    <head>
        <meta charset="UTF-8">
        <title>Calendar_Registration</title>
        <meta name="description" content="Schedule">
        <link rel="stylesheet" href="schedule.css">

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Arima:wght@300;700&display=swap" rel="stylesheet">
    </head>
    <body>

        <div class="wrapper">
            <h1>Schedule</h1>
            <p><?php echo $day; ?></p>
            <?php

            $sql = "SELECT * FROM schedule where day = :day AND user_email = :user_email";
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(':day', $day);
            $stmt->bindValue(':user_email', $user_email);
            $stmt->execute();
            $row_num = 0;
            //フォーム部分

            echo '<form method="post" action="schedule.php">';
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo '<table>';
                echo '<tr>';
                if($row["is_reserve_app_schedule"]==false){
                    echo '<td class="self"> '.$row["day"].' / '.$row["title"].'</td>
                    <td>&nbsp;&nbsp;&nbsp;<input class="radius-percent-10" type="submit" name="delete['.$row["id"].']" value="DELETE"></td>';
                }else{
                    echo '<td class="notself"> '.$row["day"].' / '.$row["title"].'</td>
                    <td>&nbsp;&nbsp;&nbsp;<input class="radius-percent-10" type="submit" name="delete['.$row["id"].']" value="DELETE"></td>';
                }
                echo '</tr>';
                echo '</table></br>';
                $row_num = $row_num+1;
            }
            echo '<input type="hidden" name="day" value="'.$day.'">';
            echo '</form>';
            echo '<p><a href="calender.php" style="color:#20b2aa;">Calendar</a></p>';


            ?>

            
        </div>
    </body>
</html>






