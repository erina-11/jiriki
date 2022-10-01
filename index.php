<?php

session_start();
include('functions.php');

if (!empty($_SESSION['id'])) {
  $user_id = $_SESSION['id'];
}

// var_dump($user_id);
// exit();
$pdo = connect_to_db();

// データ取得SQL作成
$sql = 'SELECT * FROM plan_table';
// var_dump($sql);
// exit();
// SQL準備&実行
$stmt = $pdo->prepare($sql);
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

$output .= "<div class='d-flex flex-wrap'>";

foreach ($result as $record) {

  $output .= "
      <a href='plan_details.php?plan_id={$record["id"]}'>
        <div class='ueno'> 
            <img src='img/{$record["img"]}' alt='ここには写真が出ます' width='150' height='100'>
            <h5 class='addition2'>{$record["name"]}</h5>
            <p class='card-text'>{$record["organizer_message"]}'</p>
            <p>
            
            <a class='addition1'> 主催者からのひとこと 
            </p>
        </div>
     </a>
    ";

  /*
        $output .= "<tr>";
        $output .= "<td><a href=''plan_details.php?id={$record["id"]}''plan_details.php?id={$record["id"]}''plan_details.php?id={$record["id"]}''plan_details.php?id={$record["id"]}''plan_details.php?id={$record["id"]}''>{$record["name"]}</a></td>";
        $output .= "<td>" . date("Y/n/j", strtotime($record["date_start"])) . "</td>";
        $output .= "<td>" . date("Y/n/j", strtotime($record["date_end"])) . "</td>";
        $output .= "<td>{$record["range"]}</td>";
        $output .= "<td>{$record["upper_limit"]}</td>";
        $output .= "<td>{$record["organizer_message"]}</td>";
        // edit deleteリンクを追加
        // $output .= "<td><a href='todo_edit.php?id={$record["id"]}'>edit</a></td>";
        // $output .= "<td><a href='todo_delete.php?id={$record["id"]}'>delete</a></td>";
        $output .= "</tr>";
*/
  // $valueの参照を解除する．解除しないと，再度foreachした場合に最初からループしない
  // 今回は以降foreachしないので影響なし
  unset($value);
}
$output .= "</div>";

?>


<?php include('head_top.php'); ?>

<body>
  <?php include('header_common.php'); ?>

  <fieldset>
    <legend>イベント一覧（一覧画面）</legend>
    <a href="plan.php">イベントを企画する</a>
    <a href="logout.php">ログアウト</a>

  </fieldset>
  <div class="header">
    <div class="header_left">
      <a href="">HOME</a>
      <form action="search_list.php">
        <select class="select">
          <option value="cat1">過去</option>
          <option value="cat2">開催予定</option>
        </select>
        <input type="search" name="search" placeholder="キーワードを入力">
        <input type="submit" name="submit" value="検索">
      </form>
      <!-- <button>ホーム</button> -->


      <div class="header_right">
        <a href="login.php">ログイン</a>
        <a href="register.html">新規会員登録</a>
        <a href="profile_edit.php">会員情報変更</a>
        <a href="staff_page.php">スタッフ一覧</a>
        <a href="qanda.html">お問い合わせ</a>
        <a href="test.php">テスト（関係者以外立入禁止）</a>

      </div>
    </div>
  </div>

  <!-- ここに<tr><td>deadline</td><td>todo</td><tr>の形でデータが入る -->
  <?= $output ?>

  <?php include('footer.php'); ?>


</body>

</html>