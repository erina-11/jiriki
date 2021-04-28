<?php
// var_dump($_POST);
// exit();


?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>参加予定のイベント一覧</title>
</head>

<body>
    <header>
        <h1>あなたが参加する予定のイベント一覧です</h1>
    </header>
    <div class="plan_list">
        <div class="plan_card">
            <div class="plan_card_inner">
                <div>
                    <h3 class="plan_title">タイトル</h3>
                    <img class="plan_image" src="" alt="">
                </div>
                <p class="plan_starttime">開始日時</p>
                <p class="plan_endtime">終了日時</p>
                <p class="plan_range">範囲</p>
                <p class="plan_number_of_people">参加人数</p>
            </div>
            <div>
                <button>キャンセルする</button>

            </div>
        </div>
    </div>

</body>

</html>