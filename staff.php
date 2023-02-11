<?php
session_start();
include('functions.php');
check_session_id();
if(!empty($_SESSION['id'])) {
    $user_id = $_SESSION['id'];
  }
$pdo = connect_to_db();
$sql = 'SELECT * FROM users_table';
$stmt = $pdo->prepare($sql);
$status = $stmt->execute();
$record = $stmt->fetch(PDO::FETCH_ASSOC);
?>
<title>スタッフページ</title>
<header>
<?php #include('header.php'); 
#require("header.php");
?>
</header>
<style>
.center{
    padding: 10px;
    margin-top:10px;
}
</style>
<form action="staff_userlist.php" method="POST">
<div align="center" class="center">
    <button><h4>User一覧</h4></button>
    <input type="hidden" name="0" value="0">
</div>
</form>
<form action="staff_stafflist.php" method="POST">
<div align="center" class="center">
    <button><h4>Staff一覧</h4></button>
    <input type="hidden" name="1" value="1">
</div>
</form>
<form action="staff_regist.php">
<div align="center" class="center">
    <button><h4>スタッフの登録</h4></button>
</div>
</form>
<form action="staff_del.php">
<div align="center" class="center">
    <button><h4>スタッフの登録解除</h4></button>
</div>
</form>
<footer>
<?php #include('footer.php'); 
#require("footer.php");
?>
</footer>