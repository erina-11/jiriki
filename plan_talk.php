<?php 

session_start();
include('functions.php');
$plan_id = $_GET['id'];

if(!empty($_SESSION['id'])) {
  $user_id = $_SESSION['id'];
}

// var_dump($user_id);
// exit();
$pdo = connect_to_db();

// データ取得SQL作成
$sql = 'SELECT * FROM plan_chat_table WHERE plan_id=:plan_id';
// var_dump($sql);
// exit();
// SQL準備&実行
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':plan_id', $plan_id, PDO::PARAM_INT);
$status = $stmt->execute();

// データ登録処理後
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
  // var_dump($result);
  // exit();
  foreach ($result as $record) {
    $output .= "Chat:";
    $output .= $record['chat'];   
    $output .= "User_ID:";
    $output .= $record['user_id'];
    $output .= "Created_at:";
    $output .= $record['created_at'];
   $output .= "<br>";
   $rid = $record['id'];
    $output .=/* implode(',',$record) .*/
        "<button><a href='plan_talk_edit.php?id=$rid&plan_id=$plan_id'>編集</a></button>" .
        "<button><a href='plan_talk_delete.php?id=$rid&plan_id=$plan_id' >削除</a></button>" .
        "<br>";
    }
  ?>
<form action="plan_talk_act.php" method="POST">
<div>
<?= $output ?>
<textarea name="example" rows="10" placeholder="自分の考えを共有しよう"></textarea>
<input type="hidden" name="plan_id" value="<?= $plan_id?>">
<input type="hidden" name="update_at" value="<?= $update_at?>">
<button type="submit">投稿</button>
</div>
</form>
 