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
    !isset($_POST['chat']) || $_POST['chat'] == ''  ||
    !isset($_POST['id']) || $_POST['id'] == ''  ||
    !isset($_POST['user_id']) || $_POST['user_id'] == ''  ||
    !isset($_POST['talk_id']) || $_POST['talk_id'] == ''  
  
    ) 
{
    // 項目が入力されていない場合はここでエラーを出力し，以降の処理を中止する
    echo json_encode(["error_msg" => "no input"]);
    exit();
}
// var_dump($_POST);
// exit();

// 受け取ったデータを変数に入れる
$user_id = $_POST["user_id"];
$id = $_POST['id'];
$chat = $_POST['chat'];
$talk_id = $_POST['talk_id'];
// var_dump($chat);
// exit();
// DB接続
$pdo = connect_to_db();

// データ登録SQL作成
// `created_at`と`updated_at`には実行時の`sysdate()`関数を用いて実行時の日時を入力する
$sql = 'UPDATE `direct_messege` SET chat=:chat WHERE id=:id';
// print_r($sql);
// exit();
// SQL準備&実行
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':chat', $chat, PDO::PARAM_STR);
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
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
    header("Location:direct_messege.php?talk_id=".$_POST['talk_id']."&user_id=".$_POST['talk_id']);
    exit();
}
?>