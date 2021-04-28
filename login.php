<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ログイン</title>
</head>

<body>
    <header>
        <h1>サービス名</h1>
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
            <legend>初めての方はこちら</legend>

            <div>
                <label for="nickname">ニックネーム: </label>
                <input type="text" name="nickname" id="nickname">
            </div>
            <div>
                <label for="email">メールアドレス: </label>
                <input type="email" name="email" id="email">
            </div>
            <div>
                <label for="password">パスワード: </label>
                <input type="password" name="password" id="password">
            </div>
            <div>
                <button>新規会員登録</button>
            </div>
        </fieldset>
    </form>



</body>

</html>