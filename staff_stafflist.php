<?php
session_start();
include('functions.php');
check_session_id();
if (!empty($_SESSION['id'])) {
    $user_id = $_SESSION['id'];
}
  if (
    !isset($_POST['1']) || $_POST['1'] == ''  
    ) 
{
    // 項目が入力されていない場合はここでエラーを出力し，以降の処理を中止する
    echo json_encode(["error_msg" => "no input"]);
    exit();
}
$u1 = $_POST['1'];
$pdo = connect_to_db();
$sql = 'SELECT * FROM users_table WHERE attribute=:attribute';
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':attribute', $u1, PDO::PARAM_INT);
$status = $stmt->execute();
$count = $stmt->fetchColumn();
$result = $stmt->fetchAll(PDO::FETCH_ASSOC); 
$output = "";
echo "<pre>";
var_dump($result);
echo "</pre>";
//exit();
//foreach ($result as $count) {
//    $output .= $result['0']['id'];
//    $output .= "<br>";
//}
?>
<title>スタッフユーザー一覧</title>
<a href="staff.php">戻る</a>