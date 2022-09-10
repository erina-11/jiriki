<?php
// var_dump($_GET);
// exit();
session_start();
include('functions.php');
check_session_id();

if(!empty($_SESSION['id'])) {
    $user_id = $_SESSION['id'];
  }
  $user2_id = $_POST['user2_id'];
 //var_dump($user2_id);
 //exit();
$pdo = connect_to_db();

$sql = "INSERT INTO `follow_table`(`follow_user_id`, `follower_user_id`) VALUES (:follow_user_id,:follower_user_id)";
 
// SQL準備&実行 
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':follow_user_id', $_SESSION['id'], PDO::PARAM_INT);
$stmt->bindValue(':follower_user_id', $_POST['user2_id'], PDO::PARAM_INT);
// var_dump($stmt);
// exit();
//$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$status = $stmt->execute();

if ($status == false) {
    // SQL実行に失敗した場合はここでエラーを出力し，以降の処理を中止する
    $error = $stmt->errorInfo();
    echo json_encode(["error_msg" => "{$error[2]}"]);
    exit();
} else {
// 正常にSQLが実行された場合は入力ページファイルに移動し，入力ページの処理を実行する
header("Location:user.php?id=".$user2_id);
exit();
}