<?php
$username = "example_user";
$password = "example_pass";
$hostname = "db";
$db = "example_db";
// データベース接続
$pdo = new PDO("mysql:host={$hostname};dbname={$db};charset=utf8", $username, $password);

// SQLを実行して結果を画面に表示
$sql = "SELECT * FROM examples";
$stmt = $pdo->prepare($sql);
$stmt->execute();
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
  echo "id: {$row["id"]}, name: {$row["name"]}<br/>\n";
}