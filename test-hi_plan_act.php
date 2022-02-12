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
    !isset($_POST['nickname']) || $_POST['nickname'] == '' ||
    !isset($_POST['profeil']) || $_POST['profeil'] == '' ||
    !isset($_POST['password']) || $_POST['password'] == '' 
) {
 // 項目が入力されていない場合はここでエラーを出力し，以降の処理を中止する

    echo json_encode(["error_msg" => "no input"]);
    exit();
}
// var_dump($_POST);
// exit();

// 受け取ったデータを変数に入れる
$nickname = $_POST['nickname'];
$profeil = $_POST['profeil'];
$password = $_POST['password'];
// var_dump($password);
// exit();
// DB接続
$pdo = connect_to_db();

// データ登録SQL作成
$sql = 'INSERT INTO test_hi_user_table (nickname, profeil, password) VALUES (:nickname, :profeil, :password )';

// SQL準備&実行 
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':nickname', $nickname, PDO::PARAM_STR);
$stmt->bindValue(':profeil', $profeil, PDO::PARAM_STR);
$stmt->bindValue(':password', $password, PDO::PARAM_STR);
 //var_dump($stmt);
 //exit();

$status = $stmt->execute();
 //var_dump($status);
 //exit();
// データ登録処理後
if ($status == false) {
    // SQL実行に失敗した場合はここでエラーを出力し，以降の処理を中止する
    $error = $stmt->errorInfo();
    echo json_encode(["error_msg" => "{$error[2]}"]);
    exit();
} else {
    // 正常にSQLが実行された場合は入力ページファイルに移動し，入力ページの処理を実行する
    header("Location:test-hi.php");
    exit();
}

