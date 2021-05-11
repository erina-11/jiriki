<?php
// var_dump($_POST);
// exit();
session_start();
include("functions.php");
check_session_id();

$id = $_SESSION['id']; //ユーザid
$memo = $_POST['memo']; //メモのまとめ
$plan_id = $_POST['plan_id']; //企画のid
// var_dump($plan_id);
// exit();
// var_dump($memo);
// exit();
$pdo = connect_to_db(); //DB接続

$pu_sql = 'SELECT COUNT(*) FROM plan_mypage_table
WHERE user_id=:id
AND plan_id=:plan_id'; //user_idとplan_idの両方が一致するものをカウント

$pu_stmt = $pdo->prepare($pu_sql);
$pu_stmt->bindValue(':id', $id, PDO::PARAM_INT);
$pu_stmt->bindValue(':plan_id', $plan_id, PDO::PARAM_INT);
$pu_status = $pu_stmt->execute();
// var_dump($pu_status);
// exit(); //true返ってきてる
if ($pu_status == false) {
    // SQL実行に失敗した場合はここでエラーを出力し，以降の処理を中止する
    $error = $pu_stmt->errorInfo();
    echo json_encode(["error_msg" => "{$error[2]}"]);
    exit();
}
// var_dump($memo);
// var_dump($id);
// var_dump($plan_id);
// exit();


if ($pu_stmt->fetchColumn() > 0) { //カウントがあればUPDATE
    $update_sql = "UPDATE plan_mypage_table SET memo=:memo, updated_at=sysdate() WHERE plan_id=:plan_id";

    $update_stmt = $pdo->prepare($update_sql);
    $update_stmt->bindValue(':memo', $memo, PDO::PARAM_STR);
    // $update_stmt->bindValue(':id', $id, PDO::PARAM_INT);
    $update_stmt->bindValue(':plan_id', $plan_id, PDO::PARAM_INT);
    $update_status = $update_stmt->execute();
    // var_dump($update_status);
    // exit();

    // データ登録処理後
    if ($update_status == false) {
        // SQL実行に失敗した場合はここでエラーを出力し，以降の処理を中止する
        $error = $update_stmt->errorInfo();
        echo json_encode(["error_msg" => "{$error[2]}"]);
        exit();
    } else {
        // 正常にSQLが実行された場合は一覧ページファイルに移動し，一覧ページの処理を実行する
        header("Location:plan_details.php?id=" . $plan_id);
        exit();
    }
} else { //カウントがなければ、INSERT
    $sql = 'INSERT INTO plan_mypage_table(id, plan_id, user_id, memo, created_at)
VALUES(NULL, :plan_id, :id, :memo, sysdate())';

    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':plan_id', $plan_id, PDO::PARAM_INT);
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);
    $stmt->bindValue(':memo', $memo, PDO::PARAM_STR);
    $status = $stmt->execute();
    // var_dump($status);
    // exit(); //bool(true)

    if ($status == false) {
        // SQL実行に失敗した場合はここでエラーを出力し，以降の処理を中止する
        $error = $stmt->errorInfo();
        echo json_encode(["error_msg" => "{$error[2]}"]);
        exit();
    } else {
        header("Location:plan_details.php?id=" . $plan_id);
        exit();
    }
    // $select_sql = 'SELECT * FROM plan_mypage_table WHERE id=:id';

    // $select_stmt = $pdo->prepare($select_sql); //ユーザidのSQL準備
    // $select_stmt->bindValue(':id', $id, PDO::PARAM_INT);
    // $select_status = $select_stmt->execute(); //ユーザidのSQL実行

    // if ($select_status == false) {
    //     // SQL実行に失敗した場合はここでエラーを出力し，以降の処理を中止する
    //     $error = $select_stmt->errorInfo();
    //     echo json_encode(["error_msg" => "{$error[2]}"]);
    //     exit();
    // } else {
    //     // fetch()関数でSQLで取得したレコードを取得できる
    //     $select_record = $select_stmt->fetch(PDO::FETCH_ASSOC);
    //     // $select_result = $select_stmt->fetchAll(PDO::FETCH_ASSOC);  // データの出力用変数（初期値は空文字）を設定
    //     // $select_output = "";
    //     ("Location:plan_details.php?id=" . $plan_id);
    //     exit();
    // }
}
