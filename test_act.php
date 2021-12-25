<?php

session_start();
include('functions.php');
check_session_id();

if (
    !isset($_POST['id']) || $_POST['id'] == '' ||
    !isset($_POST['nickname']) || $_POST['nickname'] == '' ||
    !isset($_POST['profeil']) || $_POST['profeil'] == '' ||
    !isset($_POST['password']) || $_POST['password'] == ''

) {
    echo json_encode(["error_msg" => "no input"]);
    exit();
}

$id = $_POST['id'];
$nickname = $_POST['nickname'];
$profeil = $_POST['profeil'];
$password = $_POST['password'];

$pdo = connect_to_db();

$sql = 'INSERT INTO plan_table(id, user_id, name, img, date_start, date_end, `range`, upper_limit, organizer_message, created_at)
VALUES (NULL, :plan_user_id, :plan_name, :plan_img, :plan_start_date , :plan_end_date, :plan_range, :plan_limit, :plan_message, sysdate())';

$stmt = $pdo->prepare($sql);
$stmt->bindValue(':plan_user_id', $plan_user_id, PDO::PARAM_INT);
$stmt->bindValue(':plan_name', $plan_name, PDO::PARAM_STR);
$stmt->bindValue(':plan_img', $plan_img, PDO::PARAM_STR);
$stmt->bindValue(':plan_start_date', $plan_start_date, PDO::PARAM_STR);
$stmt->bindValue(':plan_end_date', $plan_end_date, PDO::PARAM_STR);
$stmt->bindValue(':plan_range', $plan_range, PDO::PARAM_STR);
$stmt->bindValue(':plan_limit', $plan_limit, PDO::PARAM_INT);
$stmt->bindValue(':plan_message', $plan_message, PDO::PARAM_STR);

$status = $stmt->execute();

if ($status == false) {
    $error = $stmt->errorInfo();
    echo json_encode(["error_msg" => "{$error[2]}"]);
    exit();
} else {
    header("Location:plan.php");
    exit();
}
