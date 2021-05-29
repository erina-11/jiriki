<?php

session_start();
include('functions.php');
check_session_id();

$user_id = $_SESSION['id'];
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
    foreach ($result as $record) {
        $output .= "<tr>";
        $output .= "<td><a href='plan_details.php?id={$record["id"]}'>{$record["name"]}</a></td>";
        $output .= "<td>{$record["date_start"]}</td>";
        $output .= "<td>{$record["date_end"]}</td>";
        $output .= "<td>{$record["range"]}</td>";
        $output .= "<td>{$record["upper_limit"]}</td>";
        $output .= "<td>{$record["organizer_message"]}</td>";
        // edit deleteリンクを追加
        // $output .= "<td><a href='todo_edit.php?id={$record["id"]}'>edit</a></td>";
        // $output .= "<td><a href='todo_delete.php?id={$record["id"]}'>delete</a></td>";
        $output .= "</tr>";
    }
    // $valueの参照を解除する．解除しないと，再度foreachした場合に最初からループしない
    // 今回は以降foreachしないので影響なし
    unset($value);
}

?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>トップページ</title>
</head>

<body>
    <header>
        <h1>サービス名 </h1>
    </header>

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
        </div>
        <div class="header_right">
            <a href="login.php">ログイン</a>
            <a href="login.php">新規会員登録</a>
            <a href="profile_edit.php">会員情報変更</a>
            <a href="staff_page.html">スタッフ一覧</a>
            <a href="qanda.html">お問い合わせ</a>
        </div>
    </div>
    </div>
    <fieldset>
        <legend>イベント一覧（一覧画面）</legend>
        <a href="plan.php">イベントを企画する</a>
        <a href="logout.php">ログアウト</a>
        <table>
            <thead>
                <tr>
                    <th>イベント名</th>
                    <th>開催日時</th>
                    <th>終了日時</th>
                    <th>範囲</th>
                    <th>参加人数の上限</th>
                    <th>主催者から一言</th>

                    <th></th>
                </tr>
            </thead>
            <tbody>
                <!-- ここに<tr><td>deadline</td><td>todo</td><tr>の形でデータが入る -->
                <?= $output ?>

            </tbody>
        </table>
    </fieldset>
    <!-- <div class="plan">
        <div class="container">
            <h2>イベント一覧</h2>
            <div class="plan_card_wrapper">
                <div class="plan_card">
                    <div class="plan_card_inner">
                        <h3 class="plan_title">タイトル</h3>
                        <img class="plan_image" src="" alt="">
                        <div>
                            <p class="plan_starttime">開始日時</p>
                            <p class="plan_range">範囲</p>
                            <p class="plan_number_of_people">参加人数</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> -->

    <!-- "plan_card"クラスから下を9個作る予定 -->

</body>

</html>