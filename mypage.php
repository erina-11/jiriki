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
$info = $stmt->fetch(PDO::FETCH_ASSOC);

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
//var_dump($record);
//exit();
//フォロー
$sql = 'SELECT COUNT(*) FROM follow_table WHERE follower_user_id=:follower_user_id';
// SQL準備&実行
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':follower_user_id', $id, PDO::PARAM_STR);
$status = $stmt->execute(); 
$count = $stmt->fetchColumn();
$followinfo = $stmt->fetchAll(PDO::FETCH_ASSOC);

//フォロー中
$sql = 'SELECT COUNT(*) FROM follow_table WHERE follow_user_id=:follow_user_id';
// SQL準備&実行
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':follow_user_id', $id, PDO::PARAM_STR);
$status = $stmt->execute(); 
$count2 = $stmt->fetchColumn();
$followinfo2 = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>


<?php include('head_mypage.php'); ?>

<body>
    <?php include('header_common.php'); ?>
    <!-- <form action="profile_edit.php" method="get"> -->



    <div class="mypage-card">
        <h2><?= $info['nickname'] ?></h2>

        <div class="container">
            <div class="row">
                <div class="col-6">
                    <img width="250" height="100" src="Ueno_icon.png" alt="変更しました">
                </div>
                <div class="col-2">
                    <p>開催したイベント数　5</p>
                </div>

                <div class="col-2">
                <p>フォロワー数:
                <?php echo $count; ?>
                    </p>
                </div>
                <div class="col-2">
                    <p>フォロー中:
                        <?php echo $count2; ?>
                    </p>
                </div>
            </div>
        </div>
        <br>
        <p>プロフィール：<?php echo $info['profile'];?></p>

        <!-- ここから変更しました -->

        <br>

        <img width="250" height="100" src="Ueno_icon.png" alt="変更しました">
        <label for="date">誕生日:</label>
        <input type="date" id="date" name="誕生日" value="" />

        <br>

        <br>

        <img width="250" height="100" src="Ueno_icon.png" alt="変更しました">
        <label for="date">編集日:</label>
        <input type="date" id="date" name="編集日" value="" />

        <!-- ここまでです -->

    </div>



    <div>
        <i class="bi bi-heart-fill heart1"></i>
        <img class="icon" src="" alt="">
    </div>

    <div>
        <i class="bi bi-chat-quote-fill"></i>
        <a href="profile_edit.php">プロフィール編集</a>
    </div>

    <div>
        <i class="bi bi-chat-square-heart-fill"></i>
        <a href="follow_list.php">フォロー中の主催者一覧</a>
    </div>

    <div>
        <i class="bi bi-caret-right-square-fill"></i>
        <a href="plan_list.php">あなたが主催しているイベント一覧</a>
    </div>

    <div>
        <i class="bi bi-check2-circle"></i>
        <a href="">あなたが参加予定のイベント一覧</a>
    </div>

    <div>
        <a href="serch_massage.php">あなたが連絡した人のあるリスト</a>
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
        <i class="bi bi-emoji-heart-eyes-fill"></i>
        <a href=staff_login.php>スタッフページへ</a>
    </div>
    <br>

    <div>
        <i class="bi bi-house-door-fill"></i>
        <a href="index.php">ホーム画面へ</a>
    </div>

    <div>
        <i class="bi bi-journal-arrow-up"></i>
        <a href="logout.php">ログアウト</a>
    </div>

    <!-- </ form> -->

</body>

</html>