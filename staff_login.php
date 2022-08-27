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
    <h1 align=center>ログイン</h1>
<h2 style="text-align:center">スタッフページに入るには、メールアドレスとパスワードを入力してください。</h2>

<main>
    <form action="staff_login_act.php" method="post">
        <div class="input-group">
            <input style="text-align:center" type="text" name="email" class="form-control" placeholder="メールアドレス" aria-label="" aria-describedby="basic-addon1">
        </div>

        <div>
            <input style="text-align:center" type="text" name="password" class="form-control" placeholder="パスワード" aria-label="" aria-describedby="basic-addon1">
        </div>
        <button style="text-align:center" type="submit" class="btn btn-primary mb-2">ログインする</button>
    </form>
</main>

<?php include('footer.php'); ?>