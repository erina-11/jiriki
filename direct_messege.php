<?php 

session_start();
include('functions.php');
$talk_id = $_GET['talk_id'];
$user2_id = $_GET['user_id'];
if(!empty($_SESSION['id'])) {
  $user1_id = $_SESSION['id'];
}

#var_dump($_SESSION);
#exit();
$pdo = connect_to_db();

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
 //print $count;
 //exit();

        #echo "<pre>";
         # var_dump($room);
          #  echo "</pre>";
           #   exit();

// データ取得SQL作成
$sql = "SELECT * FROM direct_messege WHERE talk_id=:talk_id";
// var_dump($sql);
// exit();
// SQL準備&実行
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':talk_id', $talk_id, PDO::PARAM_INT);
$status = $stmt->execute();
// データ登録処理後

  //usernameをとってくるところ
  #$sql = "SELECT * FROM users_table WHERE id=:id" ;
  //var_dump($record);
  //exit();
 // SQL準備&実行
 #$stmt = $pdo->prepare($sql);
 #$stmt->bindValue(':id', $user1_id, PDO::PARAM_STR);
 #$status = $stmt->execute();

 #$user_info = $stmt->fetchAll(PDO::FETCH_ASSOC);
 #if ($user2_id == $record['user_id'] ){
 #  $output .= "user1_id:";
 #$output .= $record['user_id'];
#"<br>";
  // echo "<pre>";
 //var_dump($record);
 //echo "</pre>";
 //exit();
 #foreach ($user_info as $user_infomation){
   #$user_infomation = $user_info["0"]["nickname"];
  

   #$output .= "<a href='user.php?id=".$user_info["0"]["id"]."'>User Name:</a>";
   #$output .= "<a href='user.php?id=".$user_info["0"]["id"]."'>".$user_info["0"]["nickname"]."</a>";
   
   //echo "<pre>";
   //var_dump($user_info);
   //echo "</pre>";
   //exit();
   
 #} 
 //おわり
#}
  if ($status == false) {
    // SQL実行に失敗した場合はここでエラーを出力し，以降の処理を中止する
    $error = $stmt->errorInfo();
    echo json_encode(["error_msg" => "{$error[2]}"]);
    exit();
  } else {
      // 正常にSQLが実行された場合は入力ページファイルに移動し，入力ページの処理を実行する
      // fetchAll()関数でSQLで取得したレコードを配列で取得できる
      $result = $stmt->fetchAll(PDO::FETCH_ASSOC);  // データの出力用変数（初期値は空文字）を設定
      $output = "";
    
      // <tr><td>deadline</td><td>todo</td><tr>の形になるようにforeachで順番に$outputへデータを追加
      // `.=`は後ろに文字列を追加する，の意味
    }
    #echo "<pre>";
    #var_dump($result);
    #exit();
    #echo "</pre>";
     
    foreach ($result as $record) {
      
  
       
      if ($user1_id == $record['user_id'] ){}
  
      $output .= "Created_at:";
      $output .= $record['created_at'];
      $output .= "<br>";
      $output .= "Chat:";
      $output .= $record['chat'];   
     $rid = $record['id'];
      /*$output .=/* implode(',',$record) .*/
      if ($user1_id == $record['user_id'] ) {
        $output .=  "<button><a href='direct_messege_edit.php?id=".$rid."&talk_id=".$talk_id."&user_id=".$user2_id."'>編集</a></button>" ;
        $output .=  "<button><a href='direct_messege_del.php?id=".$rid."&talk_id=".$talk_id."&user_id=".$user2_id."'>削除</a></button>" ;
       }
       $output .= "<br>";
    }
 

  ?>
<form action="direct_message_act.php" method="POST">
<div>
<?= $output ?>
<textarea name="example" rows="10" placeholder="相手にメッセージを送る"></textarea>
<input type="hidden" name="talk_id" value="<?= $talk_id?>">
<input type="hidden" name="user_id" value="<?= $user2_id?>">
<input type="hidden" name="update_at" value="<?= $update_at?>">
<input type="hidden" name="user1_id" value="<?= $user1_id?>">
<button type="submit">投稿</button>
</div>
</form>
<form action="index.php" method="POST">
  <button>戻る</button>
</form>