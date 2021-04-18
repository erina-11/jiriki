<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>イベントを企画するページ</title>
</head>

<body>
    <header>
        <h1>イベントを企画することができます</h1>
    </header>

    <form action="plan_act.php" method="post">
        <div class="plan_card">
            <div class="plan_card_inner">
                <div>
                    <label for="plan_img">教材イメージ: </label>
                    <input type="file" name="plan_img" id="plan_img">
                </div>
                <div>
                    <label for="plan_name">イベント名: </label>
                    <input type="text" name="plan_name" id="plan_name">
                </div>
                <div>
                    <label for="plan_start_date">イベント開始日時: </label>
                    <input type="datetime" name="plan_start_date" id="plan_start_date">
                </div>
                <div>
                    <label for="plan_end_date">イベント終了日時: </label>
                    <input type="datetime" name="plan_end_date" id="plan_end_date">
                </div>
                <div>
                    <label for="plan_range">学習範囲: </label>
                    <input type="text" name="plan_range" id="plan_range">
                </div>
                <div>
                    <label for="plan_limit">人数制限: </label>
                    <input type="number" name="plan_limit" id="plan_limit">
                </div>
                <div>
                    <label for="plan_message">主催者から一言: </label>
                    <textarea name="plan_message" id="" cols="30" rows="10"></textarea>
                </div>

                <p>参加メンバー</p>

            </div>
            <div>
                <button>募集する</button>
            </div>
        </div>
    </form>
</body>

</html>