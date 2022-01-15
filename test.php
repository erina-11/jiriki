<?php include('header.php');

include('functions.php');
$pdo = connect_to_db();

// データ取得SQL作成
$sql = 'SELECT * FROM test_users_table';
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

    // <tr><td>deadline</td><td>todo</td><tr>の形になるようにforeachで順番に$outputへデータを追加
    // `.=`は後ろに文字列を追加する，の意味
}

$output = "";
foreach ($result as $record) {
    $output .= implode($record) .
        "<a href='test_edit.php'>編集</a>" .
        "<a href='test_delete.php'>削除</a>" .
        "<br>";
}

?>

</header>

<main>

    <?= $output ?>

    <form action="test_act.php" method="post">
        <div class="form-group">
            <label for="formGroupExampleInput">id</label>
            <input type="text" name="id" class="form-control">

            <label for="formGroupExampleInput">nickname</label>
            <input type="text" name="nickname" class="form-control">

            <label for="formGroupExampleInput">profile</label>
            <input type="text" name="profile" class="form-control">

            <label for="formGroupExampleInput">password</label>
            <input type="text" name="password" class="form-control">

            <input type="submit">

        </div>

    </form>

</main>

<?php include('footer.php'); ?>