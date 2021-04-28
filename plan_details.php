<?php
// var_dump($_GET);
// exit();
// var_dump($_POST);
// exit();
session_start();
include("functions.php");

check_session_id();

$p_id = $_GET['id']; //planのid indexから届いてる
// var_dump($p_id);
// exit();

$id = $_SESSION['id']; //ユーザのid
// var_dump($id);
// exit();

$pdo = connect_to_db();

$p_sql = 'SELECT * FROM plan_table WHERE id=:id'; //このplanの情報を参照
$sql = 'SELECT * FROM users_table WHERE id=:id'; //ログインユーザーのidを参照
$pu_sql = 'SELECT * FROM plan_mypage_table WHERE plan_id=:plan_id AND user_id=:user_id';
// $par_p_sql = 'SELECT COUNT(*) FROM participant_table WHERE plan_id=:p_id';
// var_dump($p_sql);
// exit();

$p_stmt = $pdo->prepare($p_sql); //pのSQLを準備
$p_stmt->bindValue(':id', $p_id, PDO::PARAM_INT);
$p_status = $p_stmt->execute(); //pのSQL実行
// var_dump($stmt);
// exit();
$stmt = $pdo->prepare($sql); //ユーザidのSQL準備
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$status = $stmt->execute(); //ユーザidのSQL実行

$pu_stmt = $pdo->prepare($pu_sql);
$pu_stmt->bindValue(':plan_id', $p_id, PDO::PARAM_INT);
$pu_stmt->bindValue(':user_id', $id, PDO::PARAM_INT);
$pu_status = $pu_stmt->execute();

// $par_p_stmt = $pdo->prepare($par_p_sql);
// $par_p_stmt->bindValue(':p_id', $p_id, PDO::PARAM_INT);
// $par_p_status = $par_p_stmt->execute();

if ($p_status == false) {
    // SQL実行に失敗した場合はここでエラーを出力し，以降の処理を中止する
    $error = $p_stmt->errorInfo();
    echo json_encode(["error_msg" => "{$error[2]}"]);
    exit();
    // var_dump($error);
    // exit();
} else {
    // 正常にSQLが実行された場合は指定の11レコードを取得
    // fetch()関数でSQLで取得したレコードを取得できる
    $p_record = $p_stmt->fetch(PDO::FETCH_ASSOC);
    // $p_result = $p_stmt->fetchAll(PDO::FETCH_ASSOC);  // データの出力用変数（初期値は空文字）を設定
    // $p_output = "";
}
// var_dump($record);
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

if ($pu_status == false) {
    // SQL実行に失敗した場合はここでエラーを出力し，以降の処理を中止する
    $error = $pu_stmt->errorInfo();
    echo json_encode(["error_msg" => "{$error[2]}"]);
    exit();
} else {
    // 正常にSQLが実行された場合は指定の11レコードを取得
    // fetch()関数でSQLで取得したレコードを取得できる
    $pu_record = $pu_stmt->fetch(PDO::FETCH_ASSOC);
}
// var_dump($pu_record);
// exit();
// if ($par_p_status == false) {
//     // SQL実行に失敗した場合はここでエラーを出力し，以降の処理を中止する
//     $error = $par_p_stmt->errorInfo();
//     echo json_encode(["error_msg" => "{$error[2]}"]);
//     exit();
// } else {
//     $par_p_result = $par_p_stmt->fetchAll(PDO::FETCH_ASSOC);  // データの出力用変数（初期値は空文字）を設定
//     $par_p_output = "";

//     foreach ($par_p_result as $par_p_record) {
//         $par_p_output .= "<tr>";
//         $par_p_output .= "<td>{$par_p_record["plan_id"]}</a></td>";
//         // $par_p_output .= "<td>{$par_p_record["date_start"]}</td>";
//         // $par_p_output .= "<td>{$par_p_record["date_end"]}</td>";
//         // $par_p_par_p_output .= "<td>{$par_p_record["range"]}</td>";
//         // $par_p_output .= "<td>{$par_p_record["upper_limit"]}</td>";
//         // $par_p_output .= "<td>{$par_p_record["organizer_message"]}</td>";
//         // edit deleteリンクを追加
//         // $output .= "<td><a href='todo_edit.php?id={$record["id"]}'>edit</a></td>";
//         // $output .= "<td><a href='todo_delete.php?id={$record["id"]}'>delete</a></td>";
//         $par_p_output .= "</tr>";
//     }
//     // $valueの参照を解除する．解除しないと，再度foreachした場合に最初からループしない
//     // 今回は以降foreachしないので影響なし
//     unset($par_p_value);
// }


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
        <h1>イベント企画詳細</h1>
    </header>

    <div class="plan_card">
        <div class="plan_card_inner">

            <h3 class="plan_title">タイトル:<?= $p_record["name"] ?></h3>
            <p class="plan_starttime">開始日時:<?= $p_record["date_start"] ?></p>
            <p class="plan_endtime">終了日時:<?= $p_record["date_end"] ?></p>
            <p class="plan_range">範囲:<?= $p_record["range"] ?></p>
            <p>参加人数制限:<?= $p_record["upper_limit"] ?></p>
            <p class="plan_number_of_people">参加人数</p>
            <p>主催者:<?= $_SESSION["nickname"] ?></p>
            <p name="" id="" cols="30" rows="10">主催者から一言</p>
            <p><?= $p_record["organizer_message"] ?></p>

            <br>
            <p>参加メンバー</p>
            <!-- <?= $plan_p_record["plan_id"] ?> -->

        </div>
        <form method="post" action="participate_act.php">
            <button>参加する</button>
            <input type="hidden" name="participate_plan_id" value="<?= $p_id ?>">
            <input type="hidden" name="participate_user_id" value="<?= $id ?>">
        </form>
    </div>

    <form method="post" action="plan_details_act.php">

        <div>学習メモ<textarea name="memo" cols="30" rows="10"><?= $pu_record["memo"] ?></textarea></div>
        <div><input type="submit" name="submit" value="保存" class="button"></div>
        <input type="hidden" name="plan_id" value="<?= $p_record["id"] ?>">
    </form>

    <form method="post" action="plan_details_act.php">

        <div>まとめメモ<textarea name="memo" cols="30" rows="10"></textarea></div>
        <div><input type="submit" name="submit" value="保存" class="button"></div>
    </form>
    <form action="plan_details_act.php" method="get">

    </form>







</body>

</html>