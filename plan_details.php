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
$p_stmt = $pdo->prepare($p_sql); //pのSQLを準備
$p_stmt->bindValue(':id', $p_id, PDO::PARAM_INT);
$p_status = $p_stmt->execute(); //pのSQL実行
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
//var_dump($p_record);
// exit();

$sql = 'SELECT * FROM users_table WHERE id=:id'; //ログインユーザーのidを参照
$stmt = $pdo->prepare($sql); //ユーザidのSQL準備
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$status = $stmt->execute(); //ユーザidのSQL実行
if ($status == false) {
    // SQL実行に失敗した場合はここでエラーを出力し，以降の処理を中止する
    $error = $stmt->errorInfo();
    echo json_encode(["error_msg" => "{$error[2]}"]);
    exit();
} else {
    // 正常にSQLが実行された場合は指定の11レコードを取得
    // fetch()関数でSQLで取得したレコードを取得できる
    $record = $stmt->fetch(PDO::FETCH_ASSOC);
    // var_dump($record);
}
// var_dump($record);
// exit();


$pu_sql = 'SELECT memo FROM plan_mypage_table WHERE plan_id=:p_id AND user_id=:id';

$pu_stmt = $pdo->prepare($pu_sql);
$pu_stmt->bindValue(':p_id', $p_id, PDO::PARAM_INT);
$pu_stmt->bindValue(':id', $id, PDO::PARAM_INT);
$pu_status = $pu_stmt->execute();

if ($pu_status == false) {
    // SQL実行に失敗した場合はここでエラーを出力し，以降の処理を中止する
    $error = $pu_stmt->errorInfo();
    echo json_encode(["error_msg" => "{$error[2]}"]);
    exit();
} else {
    // 正常にSQLが実行された場合は指定の11レコードを取得
    // fetch()関数でSQLで取得したレコードを取得できる
    // var_dump($pu_stmt);
    // var_dump($pu_record);
    $pu_record = $pu_stmt->fetchAll(PDO::FETCH_ASSOC);

    if (!$pu_record) {
        $ppp = "";
    } else {
        // $ppp = $pu_record["memo"];
        foreach ($pu_record as $result) {
            $ppp = $result["memo"];
        }
        unset($pu_record);
    }
}
// var_dump($pu_record);
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
        <!-- <?php include('header.html'); ?> -->
        <script src="header.js"></script>
        <h1>イベント企画詳細</h1>
    </header>

    <div class="plan_card">
        <div class="plan_card_inner">

            <h3 class="plan_title">タイトル:<?= $p_record["name"] ?></h3>
           
            <p class="plan_starttime">開始日時:<?php date("Y/M/D", strtotime($p_record["date_start"])); ?></p>
            
            <p class="plan_endtime">終了日時:<?php date('Y年m月d日', strtotime($p_record["date_end"])); ?></p>
            
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

        <div>学習メモ<textarea name="memo" cols="30" rows="10"><?= $ppp ?></textarea></div>
        <div><input type="submit" name="submit" value="保存" class="button"></div>
        <input type="hidden" name="plan_id" value="<?= $p_record["id"] ?>">

    </form>

    <!-- <form method="post" action="plan_details_act.php">

        <div>まとめメモ<textarea name="memo" cols="30" rows="10"></textarea></div>
        <div><input type="submit" name="submit" value="保存" class="button"></div>
    </form>
    <form action="plan_details_act.php" method="get">

    </form> -->
</body>

</html>