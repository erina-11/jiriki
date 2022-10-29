<?php

// 送信確認
 //var_dump($plan_id);
 //exit();

session_start(); // セッションの開始
include('functions.php'); // 関数ファイル読み込み
check_session_id(); // idチェック関数の実行

// 項目入力のチェック
// 値が存在しないor空で送信されてきた場合はNGにする
if (
   !isset($_POST['room_id']) || $_POST['room_id'] == ''  ||
   !isset($_POST['user1_id']) || $_POST['user1_id'] == ''  ||
   !isset($_POST['example']) || $_POST['example'] == '' 
) {
 // 項目が入力されていない場合はここでエラーを出力し，以降の処理を中止する
    echo json_encode(["error_msg" => "no input"]);
    exit();
}
 //var_dump($_POST);
 //exit();

// 受け取ったデータを変数に入れる
$user_id = $_POST["user1_id"];
$example = $_POST['example'];
// var_dump($password);
// exit();
// DB接続
$pdo = connect_to_db();

// データ登録SQL作成
$sql = "INSERT INTO `direct_messege`(`room_id`, `user1_id`, `chat`) VALUES (:room_id,:user1_id,:chat)";
 
// SQL準備&実行 
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':user1_id', $_SESSION['id'], PDO::PARAM_INT);
$stmt->bindValue(':room_id', $_POST['room_id'], PDO::PARAM_INT);
$stmt->bindValue(':chat', $example, PDO::PARAM_STR);
 //var_dump($stmt);
 //exit();

 $status = $stmt->execute();
 //var_dump($status);
 //exit();
// データ登録処理後


//var_dump($_POST['plan_id']);
//exit();
if ($status == false) {
    // SQL実行に失敗した場合はここでエラーを出力し，以降の処理を中止する
    $error = $stmt->errorInfo();
    echo json_encode(["error_msg" => "{$error[2]}"]);
    exit();
} else {
    // 正常にSQLが実行された場合は入力ページファイルに移動し，入力ページの処理を実行する
    header("Location:direct_messege.php?room_id=".$_POST['room_id']."&user_id=".$_POST['user_id']);
    exit();
}

?>