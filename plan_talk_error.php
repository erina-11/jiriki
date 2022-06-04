<?php  
session_start(); // セッションの開始
include('functions.php'); // 関数ファイル読み込み
check_session_id(); // idチェック関数の実行

// 項目入力のチェック
// 値が存在しないor空で送信されてきた場合はNGにする
if (
  !isset($_GET['id']) || $_GET['id'] == '' ||
  !isset($_GET['plan_id']) || $_GET['plan_id'] == ''  
  
    ) 
{
    // 項目が入力されていない場合はここでエラーを出力し，以降の処理を中止する
    echo json_encode(["error_msg" => "no input"]);
    exit();
}

$id = $_GET['id'];
$plan_id = $_GET['plan_id'];





?>
<h1>日本語：</h1>
<h2>😊あなたには消す権限がありません😊</h2>
<h3>いぇｙ。残念でした。!(^^)!</h3><br>
 
<h1>English: </h1>
<h2>😊 You don't have permission to erase 😊</h2>
<h3>yey. It was too bad.! (^^)!</h3><br>

<h1>中文:</h1>
<h2>😊 你无权抹去😊</h2>
<h3>是的。 太糟糕了！ (^^)!</h3><br>

<h1>한국어:</h1>
<h2>😊 지울 수 있는 권한이 없습니다 😊.</h2>
<h3>저런. 너무 나빴습니다.!(^^)!</h3><br>
<form action="plan_talk.php?id=<?=$_GET['plan_id']?>&plan_id=<?= $_GET['id'] ?>"   method="POST">
  <button>戻る</button>
</form>