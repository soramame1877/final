<?php require '../db-connect.php';?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../css/admin_style.css">
    <title>管理者側ジャンル更新画面</title>
</head>
<body>
    <form action="../kanri_TOP.php" method="post" class="a">
        <div class="button">
            <input type="submit" value="TOPへ戻る">
        </div>
    </form>

    <?php
    $pdo = new PDO($connect, USER, PASS);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $genre_id = $_POST['id'];
        $genre_name = $_POST['name'];
        $genre_name2 = $_POST['name2'];
        $genre_name3 = $_POST['name3'];

        if (!empty($_POST['name3'])) {
            $productsql = $pdo->prepare('UPDATE genre SET genre_id=?, genre_name=?, genre_name2=?, genre_name3=? WHERE genre_id=?');
            $result = $productsql->execute([$genre_id, $genre_name, $genre_name2, $genre_name3, $genre_id]);
        } else if (!empty($_POST['name2'])) {
            $productsql = $pdo->prepare('UPDATE genre SET genre_id=?, genre_name=?, genre_name2=? WHERE genre_id=?');
            $result = $productsql->execute([$genre_id, $genre_name, $genre_name2, $genre_id]);
        } else {
            $productsql = $pdo->prepare('UPDATE genre SET genre_id=?, genre_name=? WHERE genre_id=?');
            $result = $productsql->execute([$genre_id, $genre_name, $genre_id]);
            
            if (empty($_POST['id'])) {
                echo 'ジャンルIDを入力して下さい。';
            } else if (empty($_POST['name'])) {
                echo 'ジャンル名を入力して下さい。';
            }
            
            if ($result) {
                echo '商品の追加に成功しました。';
            } else {
                echo '商品の追加に失敗しました。';
            }
        }
    } else {
        echo '不正なアクセスです。';
    }
    ?>

    <hr>
    <table>
        <tr><th>ジャンルID</th><th>ジャンル名</th><th>ジャンル名2</th><th>ジャンル名3</th></tr>

        <?php
            foreach ($pdo->query('SELECT * FROM genre order by genre_id desc') as $row) {
                echo '<tr>';
                echo '<td>', $row['genre_id'], '</td>';
                echo '<td>', $row['genre_name'], '</td>';
                echo '<td>', $row['genre_name2'], '</td>';
                echo '<td>', $row['genre_name3'], '</td>';
                echo '</tr>';
                echo "\n";
            }
        ?>
    </table>
</body>
</html>
