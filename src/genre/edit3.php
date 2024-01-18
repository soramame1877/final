<?php require '../db-connect.php';?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../css/admin_style.css">
    <link rel="stylesheet" href="../css/admin-input.css">
    <title>管理者側ジャンル更新画面</title>
</head>
<body>
    <form action="../kanri_TOP.php" method="post" class="a">
        <div class="button">
            <input type="submit" value="TOPへ戻る">
        </div>
    </form>
    <h1>ジャンル更新</h1>

    <?php
    $pdo = new PDO($connect, USER, PASS);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // フォームが送信されたときの処理
        $genre_id = $_POST['genre_id'];
        $sql = $pdo->prepare('SELECT * FROM genre WHERE genre_id = ?');
        $sql->execute([$genre_id]);

        foreach ($sql as $row) {
            echo '<form action="genre_kousin-output.php" method="post">';
            echo '<div class="all">';
            echo '<div class="t">';
            echo 'ジャンルID:<input type="number" name="id" value="', $row['genre_id'], '">';
            echo '</div>';
            echo '<div class="t">';
            echo 'ジャンル名：<input type="text" name="name" value="', $row['genre_name'], '">';
            echo '</div>';
            echo '<div class="t">';
            echo 'ジャンル名2：<input type="text" name="name2" value="', $row['genre_name2'], '">';
            echo '</div>';
            echo '<div class="t">';
            echo 'ジャンル名3：<input type="text" name="name3" value="', $row['genre_name3'], '">';
            echo '</div>';
            echo '</div>';
            echo "\n";
        }
        echo '<input type="submit" value="更新">';
        echo '</form>';
    }
    ?>
</body>
</html>