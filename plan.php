<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <title>イベントを企画するページ</title>
</head>

<body>
    <header>
        <!-- <?php include('header.html'); ?> -->
        <script src="header.js"></script>
       <img src="img/logo.png" alt="logo.png">
        <h1>イベントを企画することができます</h1>
    </header>

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
      <td><input type="file" name="plan_img" id="plan_img"></td>
    </tr>
    <tr>
      <th scope="row"2</th>
      <td><label for="plan_name">イベント名: </label></td>
      <td><input type="text" name="plan_name" id="plan_name"></td>
    </tr>
    <tr>
    <th scope="row"3</th>
     <td> <label for="plan_start_date">イベント開始日時: 
     <td><input type="date" name="plan_start_date"></td>
     </tr>
     <tr>
<th scope="row"2</th>
 <td><label for="plan_end_date">イベント終了日時: </label></td>
 <td><input type="date" name="plan_end_date"></td>
 </tr>
 <tr>
<th scope="row"2</th>
 <td><label for="plan_range">学習範囲: </label></td>
 <td><input type="text" name="plan_range" id="plan_range"></td>
 </tr>
 <tr>
<th scope="row"2</th>
 <td><label for="plan_limit">人数制限: </label> </label></td>
 <td><input type="number" min="1" name="plan_limit" id="plan_limit"></td>
 </tr>
 <tr>
<th scope="row"2</th>
 <td><label for="plan_message">主催者から一言: </label></td>
 <td><textarea name="plan_message" id="" cols="30" rows="10"></textarea>
 <button>募集する</button></td>
 </tr>
 <tr>

                <a href="index.php">ホーム画面へ</a>
            </div>

        </div>
    </form>
</body>

</html>