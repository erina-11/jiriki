<?php

session_start();
include('functions.php');
$pdo = connect_to_db();

if (
    !isset($_GET['id']) || $_GET['id'] == ''
) {
    echo json_encode(["error_msg" => "no input"]);
    exit();
}

$id = $_GET['id'];

// データ取得SQL作成
$sql = "SELECT * FROM `test_users_table` WHERE id = :id ";
// var_dump($sql);
// exit();
// SQL準備&実行
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id', $id, PDO::PARAM_STR);
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
    $id = $record['id'];
    $nickname = $record['nickname'];
    $profile = $record['profile'];
    $password = $record['password'];
}

include('header.php');

?>

</header>

<main>

    <?= $output ?>

    <form action="test_edit_act.php" method="post">

        <div class="form-group">

            <label for="formGroupExampleInput">id</label>
            <input type="text" value="<?= $id ?>" name="id" class="form-control">

            <label for="formGroupExampleInput">nickname</label>
            <input type="text" value="<?= $nickname ?>" name="nickname" class="form-control">

            <label for="formGroupExampleInput">profile</label>
            <input type="text" value="<?= $profile ?>" name="profile" class="form-control">

            <label for="formGroupExampleInput">password</label>
            <input type="text" value="<?= $password ?>" name="password" class="form-control">

            <input type="submit">

        </div>

    </form>

</main>

<?php include('footer.php'); ?>