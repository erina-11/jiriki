<?php  
session_start(); // セッションの開始
include('functions.php'); // 関数ファイル読み込み
check_session_id(); // idチェック関数の実行

// 項目入力のチェック
// 値が存在しないor空で送信されてきた場合はNGにする
if (
    !isset($_GET['id']) || $_GET['id'] == ''  
  
    ) 
{
    // 項目が入力されていない場合はここでエラーを出力し，以降の処理を中止する
    echo json_encode(["error_msg" => "no input"]);
    exit();
}

$id = $_GET['id'];





?>
<h1>あなたには消す権利がありません</h1>

<form action="plan_talk.php?id=".$_GET['plan_id']. "&" .plan_id= $.GET['id'].   method="POST">
  <button>戻る</button>
</form>