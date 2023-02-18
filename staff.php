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
</form>
<form action="ban.php">
<div align="center" class="center">
    <button><h4>ユーザー一覧</h4></button>
</div>
</form>
<form action="staff_list.php">
<div align="center" class="center">
    <button><h4>スタッフ一覧</h4></button>
</div>
</form>

<footer>
<?php #include('footer.php'); 
#require("footer.php");
?>
</footer>
<a href="index.php">ログアウト</a>
<br>
