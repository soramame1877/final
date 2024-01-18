<?php require '../db-connect.php';?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../css/admin_style.css">
    <title>管理者側ゲーム会社更新画面</title>
</head>
<body>
    <form action="../kanri_TOP.php" method="post" class="a">
        <div class="button">
            <input type="submit" value="TOPへ戻る">
        </div>
    </form>

    <?php
    $pdo = new PDO($connect, USER, PASS);

    $sql = $pdo->prepare('UPDATE company SET company_no=?, company_name=?, game_id=? WHERE company_no=?');
    if (!preg_match('/[0-9]+/', $_POST['no'])) {
        echo '会社番号を整数で入力してください。';
    } else if (empty($_POST['name'])) {
        echo '会社名を入力してください。';
    } else if (!preg_match('/[0-9]+/', $_POST['id'])) {
        echo 'ゲームIDを整数で入力してください。';
    } else if ($sql->execute([$_POST['no'], $_POST['name'], $_POST['id'], $_POST['no']])) {
        echo '<font color="red">更新に成功しました</font>';
    } else {
        echo '<font color="red">更新に失敗しました</font>';
    }
    ?>

    <hr>
    <table>
        <tr><th>会社番号</th><th>会社名</th><th>ゲームID</th></tr>

        <?php
            foreach ($pdo->query('SELECT * FROM company order by company_no desc') as $row) {
                echo '<tr>';
                echo '<td>', $row['company_no'], '</td>';
                echo '<td>', $row['company_name'], '</td>';
                echo '<td>', $row['game_id'], '</td>';
                echo '</tr>';
                echo "\n";
            }
        ?>
    </table>
</body>
</html>
