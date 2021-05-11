<!-- <?php
        // var_dump($_POST);
        // exit();

        session_start(); // セッションの開始
        include('functions.php'); // 関数ファイル読み込み
        check_session_id(); // idチェック関数の実行

        $participate_plan_id = $_POST['participate_plan_id']; //
        $participate_user_id = $_POST['participate_user_id'];

        $pdo = connect_to_db();

        $sql = 'SELECT COUNT(*) FROM participant_table   
WHERE plan_id=:participate_user_id';

        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':participate_user_id', $participate_user_id, PDO::PARAM_INT);
        $status = $stmt->execute();

        if ($status == false) {
            // SQL実行に失敗した場合はここでエラーを出力し，以降の処理を中止する
            $error = $stmt->errorInfo();
            echo json_encode(["error_msg" => "{$error[2]}"]);
            exit();
        }

        if ($stmt->fetchColumn() > 0) {
            header("Location:plan_details.php?id=" . $participate_user_id);
            exit();
        } else {
            $sql = 'INSERT INTO  participant_table(id, user_id, plan_id, created_at)
VALUES(NULL, :participate_user_id, :participate_plan_id, sysdate())';
        }

        // $sql = 'INSERT INTO  participant_table(id, user_id, plan_id, created_at)
        // VALUES(NULL, :participate_user_id, :participate_plan_id, sysdate())';

        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':participate_user_id', $participate_user_id, PDO::PARAM_INT);
        $stmt->bindValue(':participate_plan_id', $participate_plan_id, PDO::PARAM_INT);
        $status = $stmt->execute();

        if ($status == false) {
            // SQL実行に失敗した場合はここでエラーを出力し，以降の処理を中止する
            $error = $stmt->errorInfo();
            echo json_encode(["error_msg" => "{$error[2]}"]);
            exit();
        } else {
            // 正常にSQLが実行された場合は入力ページファイルに移動し，入力ページの処理を実行する
            header("Location:plan_details.php?id=" . $participate_user_id);
            exit();
        }
        ?> -->