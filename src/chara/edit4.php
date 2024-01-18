<?php require '../db-connect.php';?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../css/admin_style.css">
    <link rel="stylesheet" href="../css/admin-input.css">
    <title>管理者側キャラクター更新画面</title>
</head>
<body>
    <form action="../kanri_TOP.php" method="post" class="a">
        <div class="button">
            <input type="submit" value="TOPへ戻る">
        </div>
    </form>
    <h1>キャラクター更新</h1>

    <?php
    $pdo = new PDO($connect, USER, PASS);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // フォームが送信されたときの処理
        $chara_id = $_POST['chara_id'];
        $sql = $pdo->prepare('SELECT * FROM chara WHERE chara_id = ?');
        $sql->execute([$chara_id]);

        foreach ($sql as $row) {
            echo '<form action="chara_kousin-output.php" method="post" enctype="multipart/form-data">';
            echo '<div class="all">';
            echo '<div class="t">';
            echo 'ゲームID:<input type="number" name="id" value="', $row['chara_id'], '">';
            echo '</div>';
            echo '<div class="t">';
            echo 'ゲーム名：<input type="text" name="name" value="', $row['chara_name'], '">';
            echo '</div>';
            echo '<div class="t">';
            echo 'ゲームID:<input type="number" name="game" value="', $row['game_id'], '">';
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
    <h1>ゲームのゲームIDは以下の通りです</h1>
    <hr>
            <table>
        <tr><th>ゲームID</th><th>ゲーム名</th><th>画像パス</th></tr>
    <?php
        $pdo=new PDO($connect, USER, PASS);
        foreach ($pdo->query('select * from game order by game_id desc') as $row) {
            echo '<tr>';
            echo '<td>', $row['game_id'], '</td>';
            echo '<td>', $row['game_name'], '</td>';
            echo '<td>','<img src="../img/',$row['image_pass'],'" height="130">', '</td>';
            echo '</tr>';
            echo "\n";
        }
    ?>
    </table>
</body>
</html>