<?php


session_start();
include('functions.php');
check_session_id();

if (
    !isset($_POST['nickname']) || $_POST['nickname'] == '' ||
    !isset($_POST['mail_address']) || $_POST['mail_address'] == '' ||
    !isset($_POST['password']) || $_POST['password'] == '' ||
    !isset($_POST['profile']) || $_POST['profile'] == ''
) {
    echo json_encode(["error_msg" => "no input"]);
    var_dump($_POST['nickname']);
    var_dump($_POST['mail_address']);
    var_dump($_POST['password']);
    var_dump($_POST['profile']);
    exit();
}

$plan_user_id = $_SESSION['id'];
$nickname = $_POST['nickname'];
$mail_address = $_POST['mail_address'];
$password = $_POST['password'];
$profile = $_POST['profile'];

$pdo = connect_to_db();

$sql = 'UPDATE users_table SET nickname=:nickname, mail_address= :mail_address,icon= :icon, password = :password, profile = :profile WHERE id=:id';

$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id', $plan_user_id, PDO::PARAM_INT);
$stmt->bindValue(':nickname', $nickname, PDO::PARAM_STR);
$stmt->bindValue(':mail_address', $mail_address, PDO::PARAM_STR);
$stmt->bindValue(':password', $password, PDO::PARAM_STR);
$stmt->bindValue(':profile', $profile, PDO::PARAM_STR);

var_dump($stmt);
exit();

$status = $stmt->execute();

if ($status == false) {
    $error = $stmt->errorInfo();
    echo json_encode(["error_msg" => "{$error[2]}"]);
    exit();
} else {
    header("Location:profile_edit.php");
    exit();
}
