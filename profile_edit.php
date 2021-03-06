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
$stmt->bindValue(':id', $id, PDO::PARAM_INT); // PDO::PARAM_INTでint型を指定
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
  $record = $stmt->fetch(PDO::FETCH_ASSOC); // データを取得する際のデータの形を指定できる。参考：https://blog.senseshare.jp/fetch-mode.html
}
//var_dump($record);
// exit();

include('header.php'); ?>
</header>
<div class="header_space"></div>

<body>

  <form action="profile_edit_act.php" method="post"  enctype="multipart/form-data">

    <table class="table">

      <tbody>
        <tr>
          <td>アイコン</td>
          <td><input type="file" name="icon" class="form-control-file" id="exampleFormControlFile1" accept='image/*' onchange="previewImage(this);">
              プレビュー:<br>
              <img id="preview" src="" style="max-width:200px;">
          </td>
        </tr>

        <tr>
          <td>ニックネーム</td>
          <td><input type="text" name="nickname" value="<?= $record['nickname'] ?>" class="form-control" aria-label="Text input with radio button"></td>
        </tr>

        <tr>
          <td>メールアドレス</td>
          <td><input type="text" name="mail_address" value="<?= $record['mail_address'] ?>" class="form-control" aria-label="Text input with radio button"></td>
        </tr>

        <tr>
          <td>パスワード</td>
          <td><input type="text" name="password" value="<?= $record['password'] ?>" class="form-control" aria-label="Text input with radio button"></td>
        </tr>

        <tr>
          <td>プロフィール</td>
          <td><input type="text" name="profile" value="<?= $record['profile'] ?>" class="form-control" aria-label="Text input with radio button"></td>
        </tr>


      </tbody>

    </table>

    <input type="submit" value="送信">
  </form>

  <div>
    <a href="index.php">HOME</a>
  </div>

</body>

</html>
<?php include('footer.php'); ?>

<script>
  function previewImage(obj) {
    var fileReader = new FileReader();
    fileReader.onload = (function() {
      document.getElementById('preview').src = fileReader.result;
    });
    fileReader.readAsDataURL(obj.files[0]);
  }
</script>