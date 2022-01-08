<?php

session_start();
include('functions.php');
check_session_id();

if (
    !isset($_POST['id']) || $_POST['id'] == '' ||
    !isset($_POST['nickname']) || $_POST['nickname'] == '' ||
    !isset($_POST['profile']) || $_POST['profile'] == '' ||
    !isset($_POST['password']) || $_POST['password'] == ''
) {
    echo json_encode(["error_msg" => "no input"]);
    exit();
}

$id = $_POST['id'];
$nickname = $_POST['nickname'];
$profile = $_POST['profile'];
$password = $_POST['password'];

$pdo = connect_to_db();

$sql = 'INSERT INTO test_users_table (id, nickname, password, profile)
VALUES (:id, :nickname, :password, :profile)';

$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id', $id, PDO::PARAM_STR);
$stmt->bindValue(':nickname', $nickname, PDO::PARAM_STR);
$stmt->bindValue(':password', $password, PDO::PARAM_STR);
$stmt->bindValue(':profile', $profile, PDO::PARAM_STR);
$status = $stmt->execute();

if ($status == false) {
    $error = $stmt->errorInfo();
    echo json_encode(["error_msg" => "{$error[2]}"]);
    exit();
} else {
    header("Location:test.php");
    exit();
}
