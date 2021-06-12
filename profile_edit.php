<?php
// var_dump($_GET);
// exit();
session_start(); // セッションの開始
include('functions.php'); // 関数ファイル読み込み
check_session_id(); // idチェック関数の実行

$id = $_SESSION['id'];
// var_dump($id);
// exit();

$pdo = connect_to_db();
// var_dump($pdo);
// exit();
$sql = 'SELECT * FROM users_table WHERE id=:id';
// var_dump($sql);
// exit();
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$status = $stmt->execute();
// var_dump($stmt);
// exit();

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

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>会員情報変更</title>

</head>

<body>
    <header>
        <!-- <?php include('header.html'); ?> -->
        <script src="header.js"></script>
    </header>
    <form action="profile_edit.php" method="post">
        <fieldset>
            <h1>会員情報変更</h1>
            <div>
                <div>
                    <label for="icon">アイコン: </label>
                    <input type="file" name="icon" value="<?= $record["icon"] ?>">
                </div>
                <div>
                    <label for="nickname">ニックネーム: </label>
                    <input type="text" name="nickname" value="<?= $record["nickname"] ?>">
                </div>
                <div>
                    <label for="email">メールアドレス: </label>
                    <input type="email" name="email" value="<?= $record["mail_address"] ?>">
                </div>
                <div>
                    <label for="password">パスワード: </label>
                    <input type="password" name="password" value="<?= $record["password"] ?>">
                </div>
            </div>
            <div>
                <button>変更する</button>
            </div>
        </fieldset>
    </form>

    <div>
        <a href="index.php">HOME</a>
    </div>
</body>

</html>