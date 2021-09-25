<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

        <!-- BootstrapのCSS読み込み -->
        <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- jQuery読み込み -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- BootstrapのJS読み込み -->
    <script src="js/bootstrap.min.js"></script>

</head>

<?php include('header.php'); ?>
        </header>
<div class="header_space"></div> 
    
<table class="table">
  <thead>
    <tr>
      <th>#</th>
      <th>質問</th>
      <th>解答</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="row"></th>
      <td>名前</td>
      <td><?php echo $_POST['name']; ?></td>
    </tr>
    <tr>
      <th scope="row"></th>
      <td>アドレス</td>
      <td><?php echo $_POST['email']; ?></td>
    </tr>
    <tr>
      <th scope="row"></th>
      <td>質問内容</td>
      <td><?php echo $_POST['QandA']; ?></td>
    </tr>
  </tbody>
</table>

<?php include('footer.php'); ?>