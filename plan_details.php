<?php
// var_dump($_GET);
// exit();
session_start();
include("functions.php");
check_session_id();

$p_id = $_GET['id'];
// var_dump($p_id);
// exit();


$pdo = connect_to_db();

$sql = 'SELECT * FROM plan_table WHERE id=:id';
// var_dump($sql);
// exit();

$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id', $p_id, PDO::PARAM_INT);
$status = $stmt->execute(); //実行
// var_dump($status);
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
    <title>イベント企画詳細</title>
</head>

<body>
    <header>
        <h1></h1>
    </header>

    <div class="plan_card">
        <div class="plan_card_inner">

            <h3 class="plan_title">タイトル:<?= $record["name"] ?></h3>
            <!--     -->
            <p name="" id="" cols="30" rows="10">主催者から一言</p>
            <p><?= $record["organizer_message"] ?></p>
            <p class="plan_starttime">開始日時:<?= $record["date_start"] ?></p>
            <p class="plan_endtime">終了日時:<?= $record["date_end"] ?></p>
            <p class="plan_range">範囲:<?= $record["range"] ?></p>
            <p>参加人数制限:<?= $record["upper_limit"] ?></p>
            <p class="plan_number_of_people">参加人数</p>
            <p>参加メンバー</p>

        </div>
        <div>
            <button>参加する/キャンセルする切替</button>
        </div>
    </div>

    <div class="memo">
        <div>
            <textarea name="learning_memo" id="" cols="30" rows="10">学習メモ</textarea>
            <button>保存する</button>
        </div>
        <div>
            <textarea name="summary_memo" id="" cols="30" rows="10">まとめメモ</textarea>
            <button>保存する</button>
        </div>
    </div>

    <div class="chat">

    </div>

</body>

</html>