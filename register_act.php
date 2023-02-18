<?php
// var_dump($_POST);
// exit();
include('functions.php');

$nickname = $_POST["nickname"];
$email = $_POST["email"];
$password = $_POST["password"];
$profile = $_POST["profile"];

$pdo = connect_to_db();

// ユーザ存在有無確認
$sql =
    'SELECT COUNT(*) FROM users_table
WHERE nickname=:nickname
AND mail_address=:email	
    AND password=:password';
// var_dump($sql);
// exit();

$stmt = $pdo->prepare($sql);
// var_dump($stmt);
// exit();
$stmt->bindValue(':nickname', $nickname, PDO::PARAM_STR);
$stmt->bindValue(':email', $email, PDO::PARAM_STR);
$stmt->bindValue(':password', $password, PDO::PARAM_STR);
$status = $stmt->execute();
// var_dump($status);
// exit();

if ($status == false) {
    // SQL実行に失敗した場合はここでエラーを出力し，以降の処理を中止する
    $error = $stmt->errorInfo();
    echo json_encode(["error_msg" => "{$error[2]}"]);
    exit();
}

if ($stmt->fetchColumn() > 0) {
    // usernameが1件以上該当した場合はエラーを表示して元のページに戻る
    // $count = $stmt->fetchColumn();
    echo "<p>すでに登録されているユーザです．</p>";
    echo '<a href="login.php">ログイン</a>';
    exit();
}

// ユーザ登録SQL作成
// `created_at`と`updated_at`には実行時の`sysdate()`関数を用いて実行時の日時を入力する
$sql = 'INSERT INTO users_table(id, nickname, mail_address, password, created_at, updated_at, profile)
VALUES(NULL, :nickname, :email, :password, sysdate(), sysdate(), profile)';
// var_dump($sql);
// exit();
// SQL準備&実行
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':nickname', $nickname, PDO::PARAM_STR);
$stmt->bindValue(':email', $email, PDO::PARAM_STR);
$stmt->bindValue(':password', $password, PDO::PARAM_STR);
$stmt->bindValue(':profile', $profile, PDO::PARAM_STR);
$status = $stmt->execute();
// var_dump($status);
// exit();

// データ登録処理後
if ($status == false) {
    // SQL実行に失敗した場合はここでエラーを出力し，以降の処理を中止する
    $error = $stmt->errorInfo();
    echo json_encode(["error_msg" => "{$error[2]}"]);
    exit();
} else {
    // 正常にSQLが実行された場合は入力ページファイルに移動し，入力ページの処理を実行する
    header("Location:registered.php");
    exit();
}
