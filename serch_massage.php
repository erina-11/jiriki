<?php
// var_dump($_GET);
// exit();
session_start();
include('functions.php');
check_session_id();

$id = $_SESSION['id'];
// var_dump($user_id);
// exit();
$pdo = connect_to_db();

$sql = 'SELECT * FROM users_table WHERE id=:id';
// var_dump($sql);
// exit();
$stmt = $pdo->prepare($sql);
// var_dump($stmt);
// exit();
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$status = $stmt->execute();

if ($status == false) {
    // SQL実行に失敗した場合はここでエラーを出力し，以降の処理を中止する
    $error = $stmt->errorInfo();
    echo json_encode(["error_msg" => "{$error[2]}"]);
    exit();
} else {
    // 正常にSQLが実行された場合は指定の11レコードを取得
    // fetch()関数でSQLで取得したレコードを取得できる
    $record = $stmt->fetch(PDO::FETCH_ASSOC);
}
//var_dump($record);
//exit();
$sql = 'SELECT COUNT(*) FROM room WHERE user1_id=:user1_id OR user2_id=:user2_id';
// SQL準備&実行
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':user1_id', $id, PDO::PARAM_STR);
$stmt->bindValue(':user2_id', $id, PDO::PARAM_STR);
$status = $stmt->execute(); 
$count = $stmt->fetchColumn();

$result = $stmt->fetchAll(PDO::FETCH_ASSOC);  // データの出力用変数（初期値は空文字）を設定
$output = "";

echo "<pre>";
var_dump($result);
echo "</pre>";
exit();
?>
<?php include('head_mypage.php'); ?>

<body>
    <?php include('header_common.php'); ?>