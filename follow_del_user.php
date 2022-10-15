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
  $zero = $_POST['0'];
  $one = $_POST['1'];
 //var_dump($_SESSION['id']);
 //exit();
$pdo = connect_to_db();

$sql = 'SELECT * FROM follow_table WHERE follow_user_id=:follow_user_id ';
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':follow_user_id', $_SESSION['id'], PDO::PARAM_INT);
$status = $stmt->execute();
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);


//$sql = 'UPDATE follow_table SET follow_user_id=:zero; follower_user_id=:zero WHERE follow_user_id=:follow_user_id AND follower_user_id=:follower_user_id';
// SQL準備&実行 
//$stmt = $pdo->prepare($sql);
//$stmt->bindValue(':zero', $zero, PDO::PARAM_INT);
//$stmt->bindValue(':follow_user_id', $_SESSION['id'], PDO::PARAM_INT);
//$stmt->bindValue(':follower_user_id', $user2_id, PDO::PARAM_INT);
// var_dump($stmt);
// exit();
//$stmt->bindValue(':id', $id, PDO::PARAM_INT);
//$status = $stmt->execute();

$sql = 'DELETE FROM follow_table WHERE follow_user_id=:follow_user_id AND follower_user_id=:follower_user_id'; 
// SQL準備&実行 
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':follow_user_id', $_SESSION['id'], PDO::PARAM_INT);
$stmt->bindValue(':follower_user_id', $user2_id, PDO::PARAM_INT);
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