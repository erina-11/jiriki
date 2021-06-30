<?php

function connect_to_db()
{
    // DB接続の設定

    $dbn = 'mysql:dbname=431da1f01d40c3767220ea9ff3c3ebc6;charset=utf8;port=3306;host=mysql-2.mc.lolipop.lan';
    $user = '431da1f01d40c3767220ea9ff3c3ebc6';
    $pwd = '1111aaaaAAAA';


    // $dbn = 'mysql:dbname=jiriki;charset=utf8;port=3306;host=localhost';
    // $user = 'root';
    // $pwd = '';
    try {
        // ここでDB接続処理を実行する(うまくいった場合)
        return new PDO($dbn, $user, $pwd);
    } catch (PDOException $e) {
        // DB接続に失敗した場合はここでエラーを出力し，以降の処理を中止する
        echo json_encode(["db error" => "{$e->getMessage()}"]);
        exit();
    }
}

// ログイン状態のチェック関数

// ログインしているかどうかのチェック→毎回id再生成
function check_session_id()
{
    // 失敗時はログイン画面に戻る
    if (
        !isset($_SESSION['session_id']) || // session_idがない
        $_SESSION['session_id'] != session_id() // idが一致しない
    ) {
        header('Location: login.php'); // ログイン画面へ移動
    } else {
        session_regenerate_id(true); // セッションidの再生成
        $_SESSION['session_id'] = session_id(); // セッション変数上書き
    }
}
