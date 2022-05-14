<?php

// 送信確認
// var_dump($_POST);
// exit();

session_start(); // セッションの開始
include('functions.php'); // 関数ファイル読み込み
check_session_id(); // idチェック関数の実行

// 項目入力のチェック
// 値が存在しないor空で送信されてきた場合はNGにする
if (
    !isset($_GET['id']) || $_GET['id'] == ''  
  
    ) 
{
    // 項目が入力されていない場合はここでエラーを出力し，以降の処理を中止する
    echo json_encode(["error_msg" => "no input"]);
    exit();
}
// var_dump($_POST);
// exit();

// 受け取ったデータを変数に入れる
$id = $_GET['id'];
// var_dump($plan_message);
// exit();
// DB接続
$pdo = connect_to_db();

$sql = 'SELECT * FROM plan_chat_table WHERE id=:id';


$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$status = $stmt->execute();


if ($user_id == $id ) {


// データ登録SQL作成
// `created_at`と`updated_at`には実行時の`sysdate()`関数を用いて実行時の日時を入力する
$sql = 'DELETE FROM `plan_chat_table` WHERE id=:id';

// SQL準備&実行
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
// var_dump($stmt);
// exit();

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
    header("Location:plan_talk.php?id=".$_GET['plan_id']);
    exit();
}
} else {
    header("Location:plan_talk_error.php?id=".$_GET['plan_id']);
    exit();
}
?>
