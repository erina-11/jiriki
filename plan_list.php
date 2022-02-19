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
$sql = "SELECT * FROM `plan_table` WHERE user_id = :user_id";
// var_dump($sql);
// exit();
// SQL準備&実行
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':user_id', $user_id, PDO::PARAM_STR);
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
      <a href='plan_details.php?id={$record["id"]}'>
        <div class='action_expansion'>
          <div class='card mb-3 bg-info text-white' style='max-width: 540px;'> 
            <div class='row g-0'>
              <div class='col-md-4'>
                <img src='img/{$record["img"]}' alt='ここには写真が出ます' width='150' height='100'>
              </div>
              <div class='col-md-8'>
                <div class='card-body'>
                  <h5 class='card-title'>{$record["name"]}</h5>
                  <p class='card-text'>{$record["organizer_message"]}'</p>
                </div>
              </div>
            </div>
            <div class='row g-0'>
                <div class='card-body'>
              <p class='card-text text-white'>
                主催者からのひとこと
              </p>
                </div>
            </div>
          </div>
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



<?php include('header.php'); ?>
</header>

<!-- <button>ホーム</button> -->

</div>
</div>

<!-- ここに<tr><td>deadline</td><td>todo</td><tr>の形でデータが入る -->
<?= $output ?>

<?php include('footer.php'); ?>


</body>

</html>