<?php
session_start();
include('functions.php');
check_session_id();
if (!empty($_SESSION['id'])) {
    $user_id = $_SESSION['id'];
}
  if (
    !isset($_POST['0']) || $_POST['0'] == ''  
    ) 
{
    // 項目が入力されていない場合はここでエラーを出力し，以降の処理を中止する
    echo json_encode(["error_msg" => "no input"]);
    exit();
}
$u0 = $_POST['0'];
$pdo = connect_to_db();
$sql = 'SELECT * FROM users_table WHERE attribute=:attribute';
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':attribute', $u0, PDO::PARAM_INT);
$status = $stmt->execute();
$count = $stmt->fetchColumn();
$result = $stmt->fetchAll(PDO::FETCH_ASSOC); 
//$output = "";
//echo "<pre>";
//var_dump($result);
//echo "</pre>";
//exit();
foreach ($result as $count) {
    print $result;
    print "<br>";
}
?>
<title>一般ユーザー一覧</title>
<a href="staff.php">戻る</a>