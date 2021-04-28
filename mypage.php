<?php
// var_dump($_GET);
// exit();
session_start();
include('functions.php');
check_session_id();

$id = $_SESSION['id'];
// var_dump($user_id);
// exit();
$pdo = connect_to_db();

$sql = 'SELECT * FROM users_table WHERE id=:id';
// var_dump($sql);
// exit();
$stmt = $pdo->prepare($sql);
// var_dump($stmt);
// exit();
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$status = $stmt->execute();

if ($status == false) {
    // SQL実行に失敗した場合はここでエラーを出力し，以降の処理を中止する
    $error = $stmt->errorInfo();
    echo json_encode(["error_msg" => "{$error[2]}"]);
    exit();
} else {
    // 正常にSQLが実行された場合は指定の11レコードを取得
    // fetch()関数でSQLで取得したレコードを取得できる
    $record = $stmt->fetch(PDO::FETCH_ASSOC);
}
// var_dump($record);
// exit();


?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>マイページ</title>
</head>

<body>
    <!-- <form action="profile_edit.php" method="get"> -->
    <header>
        <h1>マイページ</h1>
    </header>
    <div>
        <h2>ここは<?= $record['nickname'] ?>さんのマイページです</h2>
    </div>

    <div>
        <img class="icon" src="" alt="">
    </div>

    <div>
        <a href="profile_edit.php">プロフィール編集</a>
    </div>
    <div>
        <a href="follow_list.php">フォロー中の主催者一覧</a>
    </div>
    <div>
        <a href="plan_list.php">あなたが主催しているイベント一覧</a>
    </div>
    <div>
        <a href="">あなたが参加予定のイベント一覧</a>
    </div>
    <br>
    <div>
        <a href="index.php">ホーム画面へ</a>
    </div>
    <div>
        <a href="logout.php">ログアウト</a>
    </div>
    <!-- </ form> -->

</body>

</html>