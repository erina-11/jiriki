<?php
// var_dump($_GET);
// exit();
session_start();
include('functions.php');
check_session_id();

if(!empty($_SESSION['id'])) {
    $user_id = $_SESSION['id'];
  }
  $user2_id = $_GET['id'];
$id = $_GET['id'];
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
// var_dump($record);
// exit();


   # echo "<pre>";
    #var_dump($record);
  #  echo "</pre>";
   # exit();


?>



<!DOCTYPE html>
<html lang="en">

<head>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>マイページ</title>
</head>

<body>
   
<!-- <form action="profile_edit.php" method="get"> -->
    
 <h2><?= $record["nickname"] ?></h2>
        
    <div class="container">
        <div class="row">
            <div class="col-6">
            <img width="250" height="100" src=<?= $record["icon"] ?> alt="ここにはアイコンが表示されます" >
            </div>
            
            <div class="col-2">
            <p>開催したイベント数　500000</p>
            </div>
            
            <div class="col-2">
            <p>フォロワー0</p>
            </div>
            <div class="col-2">
            <p>フォロー中500</p>
            </div>
        </div>
    </div>

    <h2><?= $record['profile'] ?></h2>

    <div>
        <img class="icon" src="" alt="">
    </div>
    <?php 
$sql = 'SELECT COUNT(*) FROM follow_table WHERE follow_user_id=:follow_user_id AND follower_user_id = :follower_user_id';
// SQL準備&実行
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':follow_user_id', $user_id, PDO::PARAM_STR);
$stmt->bindValue(':follower_user_id', $user2_id, PDO::PARAM_STR);
$status = $stmt->execute(); 
$count = $stmt->fetchColumn();
$follow = $stmt->fetchAll(PDO::FETCH_ASSOC);
$output = "";

$sql = 'SELECT * FROM follow_table WHERE follow_user_id=:follow_user_id AND follower_user_id = :follower_user_id';
// SQL準備&実行
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':follow_user_id', $user_id, PDO::PARAM_STR);
$stmt->bindValue(':follower_user_id', $user2_id, PDO::PARAM_STR);
$status = $stmt->execute(); 
$followinfo = $stmt->fetchAll(PDO::FETCH_ASSOC);
if($count == 0) {
    //var_dump($count);
    //exit();
    $output .=     "<form action=follow_user.php method=post>";
    $output .=     "<input type=hidden name=user2_id value=$user2_id>";
    $output .=     "<div>";
    $output .=     "<button>フォローする</button>";
    $output .=     "</div>";
    $output .=     "</form>";
} else{
echo('フォロー中');
}
?>
   <!-- 
    <form action="follow_user.php" method="post">
    <input type="hidden" name="user2_id" value="<?= $user2_id?>">
    <div><button>フォローする</button></div></form>
    -->
    <div>
        <a href="profile_edit.php">プロフィール編集</a>
    </div>
    
    <div>
        <a href="follow_list.php">フォロー中の主催者一覧</a>
    </div>
    
    <div>
        <a href="plan_list.php">あなたが主催しているイベント一覧</a>
    </div>
    
    <div>
        <a href="">あなたが参加予定のイベント一覧</a>
    </div>
<?php


if(!empty($_SESSION['id'])) {
  $user1_id = $_SESSION['id'];
}

$sql = 'SELECT COUNT(*) FROM room WHERE user1_id=:user1_id AND user2_id = :user2_id';
// var_dump($sql);
// exit();
// SQL準備&実行
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':user1_id', $user1_id, PDO::PARAM_STR);
    $stmt->bindValue(':user2_id', $user2_id, PDO::PARAM_STR);
    $status = $stmt->execute(); 
    $count = $stmt->fetchColumn();
    $room = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $output = "";
 //var_dump($record);
 //exit();
 $sql = 'SELECT * FROM room WHERE user1_id=:user1_id AND user2_id = :user2_id';
// var_dump($sql);
// exit();
// SQL準備&実行
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':user1_id', $user1_id, PDO::PARAM_STR);
    $stmt->bindValue(':user2_id', $user2_id, PDO::PARAM_STR);
    $status = $stmt->execute(); 
    $roominfo = $stmt->fetchAll(PDO::FETCH_ASSOC);
//var_dump($roominfo);
//exit();
    if($count == 1) {
        //var_dump($count);
        //exit();
        $output .=     "<div>";
        $output .=     "<a href=direct_messege.php?talk_id=".$roominfo['0']['talk_id']."&user_id=".$record['id'].">ダイレクトメッセージを開始する</a>";
        $output .=     "</div>";
    } else{
    $sql = 'INSERT INTO `room`(`user1_id`, `user2_id`) VALUES (:user1_id,:user2_id)';
     //var_dump($id);
     //exit();
    // SQL準備&実行
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':user1_id', $user1_id, PDO::PARAM_STR);
    $stmt->bindValue(':user2_id', $user2_id, PDO::PARAM_STR);
    $status = $stmt->execute();
    echo "ページをリロードしてください。";
    exit();
    }
    ?>
    <?= $output ?>
    <br>
    
    <div>
        <a href="index.php">ホーム画面へ</a>
    </div>
    
    <div>
        <a href="logout.php">ログアウト</a>
    </div>
    
    <!-- </ form> -->

</body>

</html>