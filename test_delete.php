<?php

session_start();
include('functions.php');
check_session_id();

if (
    !isset($_GET['id']) || $_GET['id'] == ''
) {
    echo json_encode(["error_msg" => "no input"]);
    exit();
}

$id = $_GET['id'];
$pdo = connect_to_db();

$sql = "DELETE FROM `test_users_table` WHERE id = :id";

$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id', $id, PDO::PARAM_STR);
$status = $stmt->execute();

if ($status == false) {
    $error = $stmt->errorInfo();
    echo json_encode(["error_msg" => "{$error[2]}"]);
    exit();
} else {
    header("Location:test.php");
    exit();
}
