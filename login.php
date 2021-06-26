<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ログイン</title>
</head>

<body>
    <header>
        <!-- <h1>サービス名</h1> -->
    </header>
    <form action="login_act.php" method="POST">
        <fieldset>
            <legend>ログインするには、登録したメールアドレスとパスワードを入力してください</legend>
            <div>
                <label for="email">メールアドレス: </label>
                <input type="email" name="email" id="email">
            </div>
            <div>
                <label for="password">パスワード: </label>
                <input type="password" name="password" id="password">
            </div>
            <div>
                <button>ログイン</button>
            </div>
        </fieldset>
    </form>

    <form action="register_act.php" method="POST">

        <fieldset>

</body>

</html>