<?php require '../db-connect.php';?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../css/admin_style.css">
    <title>管理者側紐づけID更新画面</title>
</head>
<body>
    <form action="../kanri_TOP.php" method="post" class="a">
        <div class="button">
            <input type="submit" value="TOPへ戻る">
        </div>
    </form>

    <?php
    try {
        $pdo = new PDO($connect, USER, PASS);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // 一時的に外部キー制約を無効化
        $pdo->exec("SET foreign_key_checks = 0");

        $sql = $pdo->prepare('UPDATE gameall SET all_id=?, game_id=?, genre_id=?, company_no=?, chara_id=? WHERE all_id=?');
        if (empty($_POST['all'])) {
            echo '情報IDを入力してください。';
        } else if (empty($_POST['game'])) {
            echo 'ゲームIDを入力してください。';
        } else if (empty($_POST['genre'])) {
            echo 'ジャンルIDを入力してください。';
        } else if (!preg_match('/[0-9]+/', $_POST['company'])) {
            echo '会社番号を整数で入力してください。';
        } else if (!preg_match('/[0-9]+/', $_POST['chara'])) {
            echo 'キャラクターIDを整数で入力してください。';
        } else if ($sql->execute([$_POST['all'], $_POST['game'], $_POST['genre'], $_POST['company'], $_POST['chara'], $_POST['all']])) {
            echo '<font color="red">更新に成功しました</font>';
        } else {
            echo '<font color="red">更新に失敗しました</font>';
        }

        // 外部キー制約を再度有効化
        $pdo->exec("SET foreign_key_checks = 1");
    } catch (PDOException $e) {
        echo 'エラーが発生しました：' . $e->getMessage();
    }
    ?>

    <hr>
    <table>
    <tr><th>情報ID</th><th>ゲームID</th><th>ジャンルID</th><th>会社番号</th><th>キャラクターID</th></tr>
        <?php
        try {
            foreach ($pdo->query('select * from gameall order by all_id desc') as $row) {
                echo '<tr>';
        echo '<td>', $row['all_id'], '</td>';
        echo '<td>', $row['game_id'], '</td>';
        echo '<td>', $row['genre_id'], '</td>';
        echo '<td>', $row['company_no'], '</td>';
        echo '<td>', $row['chara_id'], '</td>';
        echo '</tr>';
                echo "\n";
            }
        } catch (PDOException $e) {
            echo 'エラーが発生しました：' . $e->getMessage();
        }
        ?>
    </table>
</body>
</html>
