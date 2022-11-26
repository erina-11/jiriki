<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link href="css/plan.css" rel="stylesheet">
  <title>イベントを企画するページ</title>
</head>

<body>
  <?php include('header.php'); ?>
  </header>
  <div class="header_space"></div>
  <div class="container">
    <h1>イベントを企画することができます</h1>

    <form action="plan_act.php" method="post">
      <div class="plan_card">
        <div class="plan_card_inner">

          <table class="table">
            <thead>
              <tr>
                <th></th>
                <th></th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <th scope="row"></th>
                <td><label for="plan_img">教材イメージ: </label></td>
                <td><input type="file" name="plan_img" id="plan_img" accept='image/*' onchange="previewImage(this);">
                  <br>プレビュー:<img id="preview" src="" style="max-width:200px;">
                </td>

              </tr>
              <tr>
                <th scope="row" 2</th>
                <td><label for="plan_name">イベント名: </label></td>
                <td><input type="text" name="plan_name" id="plan_name"></td>
              </tr>
              <tr>
                <th scope="row" 3</th>
                <td> <label for="plan_start_date">イベント開始日時:
                <td><input type="date" name="plan_start_date"></td>
              </tr>
              <tr>
                <th scope="row" 2</th>
                <td><label for="plan_end_date">イベント終了日時: </label></td>
                <td><input type="date" name="plan_end_date"></td>
              </tr>
              <tr>
                <th scope="row" 2</th>
                <td><label for="plan_range">学習範囲: </label></td>
                <td><input type="text" name="plan_range" id="plan_range"></td>
              </tr>
              <tr>
                <th scope="row" 2</th>
                <td><label for="plan_limit">人数制限: </label> </label></td>
                <td><input type="number" min="1" name="plan_limit" id="plan_limit"></td>
              </tr>
              <tr>
                <th scope="row" 2</th>
                <td><label for="plan_message">主催者から一言: </label></td>
                <td><textarea name="plan_message" id="" cols="30" rows="10"></textarea>
                  <button>募集する</button>
                </td>
              </tr>
              <tr>

                <a href="index.php">ホーム画面へ</a>
        </div>

      </div>
    </form>
  </div>
</body>

</html>

<script>
  function previewImage(obj) {
    var fileReader = new FileReader();
    fileReader.onload = (function() {
      document.getElementById('preview').src = fileReader.result;
    });
    fileReader.readAsDataURL(obj.files[0]);
  }
</script>