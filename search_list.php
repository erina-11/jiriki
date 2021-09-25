<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>検索一覧</title>
</head>

<?php include('header.php'); ?>
        </header>
<div class="header_space"></div> 

    <div>
        <select class="select">
            <option value="cat1">過去</option>
            <option value="cat2">開催予定</option>
        </select>
        <input type="search" name="search" placeholder="キーワードを入力">
        <input type="submit" name="submit" value="検索">
    </div>

    <div class="search_list">
        <div class="plan_card">
            <div class="plan_card_inner">
                <h3 class="plan_title">
                    <a href="plan_details.php">タイトル</a>
                </h3>

                <img class="plan_image" src="" alt="">
                <div>
                    <p class="plan_starttime">開始日時</p>
                    <p class="plan_range">範囲</p>
                    <p class="plan_number_of_people">参加人数</p>
                </div>
            </div>
        </div>
    </div>
    <!-- "plan_card"以下を6つ作る -->
    <div class="list-btn">
        <button>もっと見る</button>
    </div>
    <?php include('footer.php'); ?>
    
</body>

</html>