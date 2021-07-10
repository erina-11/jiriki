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

<body>

    <header>
        <h1 align=center>ログイン</h1>
    </header>

　　ログインするには、メールアドレスとパスワードを入力してください。
    
    <div class="input-group">
        <input type="text" class="form-control" placeholder="メールアドレス" aria-label="" aria-describedby="basic-addon1">
    </div>

    <div>
        <input type="text" class="form-control" placeholder="パスワード" aria-label="" aria-describedby="basic-addon1">
    </div>

    <div class="input-group">
        <input class="form-control rounded-0" id="exampleFormControlTextarea2" rows="3"></textarea>
    </div>

    <button type="submit" class="btn btn-primary mb-2">ログインする</button>

    <div>

    </div>

    <footer>
        <p align=center>フッター</p>

    </footer>

</body>

</html>