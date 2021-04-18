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
    !isset($_POST['plan_img']) || $_POST['plan_img'] == '' ||
    !isset($_POST['plan_name']) || $_POST['plan_name'] == '' ||
    !isset($_POST['plan_start_date']) || $_POST['plan_start_date'] == '' ||
    !isset($_POST['plan_end_date']) || $_POST['plan_end_date'] == '' ||
    !isset($_POST['plan_range']) || $_POST['plan_range'] == '' ||
    !isset($_POST['plan_limit']) || $_POST['plan_limit'] == '' ||
    !isset($_POST['plan_message']) || $_POST['plan_message'] == ''

) {
    // 項目が入力されていない場合はここでエラーを出力し，以降の処理を中止する
    echo json_encode(["error_msg" => "no input"]);
    exit();
}
// var_dump($_POST);
// exit();

// 受け取ったデータを変数に入れる
$plan_img = $_POST['plan_img'];
$plan_name = $_POST['plan_name'];
$plan_start_date = $_POST['plan_start_date'];
$plan_end_date = $_POST['plan_end_date'];
$plan_range = $_POST['plan_range'];
$plan_limit = $_POST['plan_limit'];
$plan_message = $_POST['plan_message'];
// var_dump($plan_message);
// exit();
// DB接続
$pdo = connect_to_db();

// データ登録SQL作成
// `created_at`と`updated_at`には実行時の`sysdate()`関数を用いて実行時の日時を入力する
$sql = 'INSERT INTO plan_table(id, name, img, date_start, date_end, `range`, upper_limit, organizer_message, created_at)
VALUES (NULL, :plan_name, :plan_img, :plan_start_date , :plan_end_date, :plan_range, :plan_limit, :plan_message, sysdate())';
// $sql = "INSERT INTO `plan_table` (
//   `id`,
//   `user_id`,
//   `name`,
//   `img`,
//   `date_start`,
//   `date_end`,
//   `range`,
//   `upper_limit`,
//   `organizer_message`,
//   `hashtag`,
//   `canceled_at`,
//   `created_at`,
//   `updated_at`,
//   `deleted_at`
// )VALUES(
//     `NULL`,
//     ``
// )";
// var_dump($sql);
// exit();
// SQL準備&実行
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':plan_name', $plan_name, PDO::PARAM_STR);
$stmt->bindValue(':plan_img', $plan_img, PDO::PARAM_STR);
$stmt->bindValue(':plan_start_date', $plan_start_date, PDO::PARAM_STR);
$stmt->bindValue(':plan_end_date', $plan_end_date, PDO::PARAM_STR);
$stmt->bindValue(':plan_range', $plan_range, PDO::PARAM_STR);
$stmt->bindValue(':plan_limit', $plan_limit, PDO::PARAM_INT);
$stmt->bindValue(':plan_message', $plan_message, PDO::PARAM_STR);
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
    header("Location:plan.php");
    exit();
}
