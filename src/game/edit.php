<?php require '../db-connect.php';?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../css/admin_style.css">
    <link rel="stylesheet" href="../css/admin-input.css">
    <title>管理者側ゲーム更新画面</title>
</head>
<body>
    <form action="../kanri_TOP.php" method="post" class="a">
        <div class="button">
            <input type="submit" value="TOPへ戻る">
        </div>
    </form>
    <h1>ゲーム更新</h1>

    <?php
    $pdo = new PDO($connect, USER, PASS);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // フォームが送信されたときの処理
        $game_id = $_POST['game_id'];
        $sql = $pdo->prepare('SELECT * FROM game WHERE game_id = ?');
        $sql->execute([$game_id]);

        foreach ($sql as $row) {
            echo '<form action="game_kousin-output.php" method="post" enctype="multipart/form-data">';
            echo '<div class="all">';
            echo '<div class="t">';
            echo 'ゲームID:<input type="number" name="id" value="', $row['game_id'], '">';
            echo '</div>';
            echo '<div class="t">';
            echo 'ゲーム名：<input type="text" name="name" value="', $row['game_name'], '">';
            echo '</div>';
            echo '<div class="t">';
            echo '画像パス：<input type="file" name="file"><br>';
            echo '</div>';
            echo '</div>';
            echo "\n";
        }
        echo '<input type="submit" value="更新">';
        echo '</form>';
    } else {
        echo 'ゲームIDが指定されていません。';
    }
    ?>
</body>
</html>