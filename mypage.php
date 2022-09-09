<?php
// var_dump($_GET);
// exit();
session_start();
include('functions.php');
check_session_id();

$id = $_SESSION['id'];
// var_dump($user_id);
// exit();
$pdo = connect_to_db();

$sql = 'SELECT * FROM users_table WHERE id=:id';
// var_dump($sql);
// exit();
$stmt = $pdo->prepare($sql);
// var_dump($stmt);
// exit();
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$status = $stmt->execute();

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


<?php include('head_mypage.php'); ?>

<body>
    <?php include('header_common.php'); ?>
    <!-- <form action="profile_edit.php" method="get"> -->



    <div class="mypage-card">
        <h2><?= $record['nickname'] ?></h2>

        <div class="container">
            <div class="row">
                <div class="col-6">
                    <img width="250" height="100" src="img/staff/テストくん.jpg" alt="テストくんが出るはずです">
                </div>

                <div class="col-2">
                    <p>開催したイベント数　5</p>
                </div>

                <div class="col-2">
                    <p>フォロワー100</p>
                </div>
                <div class="col-2">
                    <p>フォロー中80</p>
                </div>
            </div>
        </div>

        <p>吾輩はSAKANAである。ちゃんとした名前はまだ無い。どこで生れたかとんと見当がつかぬ。
            何でも薄暗い漁船の上でピチピチ跳ねていた事だけは記憶している。
            吾輩はここで始めて人間というものを見た...</p>

    </div>


    <div>
        <img class="icon" src="" alt="">
    </div>

    <div>
        <a href="profile_edit.php">プロフィール編集</a>
    </div>

    <div>
        <a href="follow_list.php">フォロー中の主催者一覧</a>
    </div>

    <div>
        <a href="plan_list.php">あなたが主催しているイベント一覧</a>
    </div>

    <div>
        <a href="">あなたが参加予定のイベント一覧</a>
    </div>
    <?php
    //バグ発生
    if ($record == 1) {

        //echo "<pre>";
        //var_dump($record);
        //echo "</pre>";
        //exit();
        "<div>";
        "<i class=bi bi-key></i><svg xmlns=http://www.w3.org/2000/svg width=16 height=16 fill=currentColor class=bi bi-key viewBox=0 0 16 16></svg><a href=staff_login.php>スタッフページへ</a>";
        "</div>";
    }
    ?>
    <div>
        <a href=staff_login.php>スタッフページへ</a>
    </div>
    <br>

    <div>
        <a href="index.php">ホーム画面へ</a>
    </div>

    <div>
        <a href="logout.php">ログアウト</a>
    </div>

    <!-- </ form> -->

</body>

</html>