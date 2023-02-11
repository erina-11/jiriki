<?php

// 送信確認 
// var_dump($_POST);
// exit();

session_start(); // セッションの開始
include('functions.php'); // 関数ファイル読み込み
check_session_id(); // idチェック関数の実行

// 項目入力のチェック
// 値が存在しないor空で送信されてきた場合はNGにする
// var_dump($_POST);
// exit();

// 受け取ったデータを変数に入れる
$email = $_POST["email"];
// var_dump($chat);
// exit();
// DB接続
$pdo = connect_to_db();

$sql = 'SELECT * FROM users_table WHERE mail_address=:email';
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':email', $email, PDO::PARAM_STR);
$status = $stmt->execute();
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

 //var_dump($result);
 //exit();
// データ登録SQL作成
// `created_at`と`updated_at`には実行時の`sysdate()`関数を用いて実行時の日時を入力する
$sql = 'DELETE FROM users_table WHERE mail_address=:email';
// print_r($sql);
// exit();
// SQL準備&実行
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':email', $email, PDO::PARAM_STR);
// var_dump($stmt);
// exit();
 
$status = $stmt->execute();
//var_dump($_POST);
//exit();
// データ登録処理後
if ($status == false) {
    // SQL実行に失敗した場合はここでエラーを出力し，以降の処理を中止する
    $error = $stmt->errorInfo();
    echo json_encode(["error_msg" => "{$error[2]}"]);
    exit();
} else {
    // 正常にSQLが実行された場合は入力ページファイルに移動し，入力ページの処理を実行する
    header("Location:staff.php");
    exit();
}
?>