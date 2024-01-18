<?php require '../db-connect.php';?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../css/admin_style.css">
    <link rel="stylesheet" href="../css/admin-input.css">
    <title>管理者側紐づけID更新画面</title>
</head>
<body>
    <form action="../kanri_TOP.php" method="post" class="a">
        <div class="button">
            <input type="submit" value="TOPへ戻る">
        </div>
    </form>
    <h1>ゲーム会社更新</h1>

    <?php
    $pdo = new PDO($connect, USER, PASS);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // フォームが送信されたときの処理
        $game_id = $_POST['all_id'];
        $sql = $pdo->prepare('SELECT * FROM gameall WHERE all_id = ?');
        $sql->execute([$game_id]);

        foreach ($sql as $row) {
            echo '<form action="allinfo_kousin-output.php" method="post">';
            echo '<div class="all">';
            echo '<div class="t">';
            echo '情報ID:<input type="number" name="all" value="', $row['all_id'], '">';
            echo '</div>';
            echo '<div class="t">';
            echo 'ゲームID:<input type="number" name="game" value="', $row['game_id'], '">';
            echo '</div>';
            echo '<div class="t">';
            echo 'ジャンルID：<input type="text" name="genre" value="', $row['genre_id'], '"><br>';
            echo '</div>';
            echo '<div class="t">';
            echo '会社.NO：<input type="number" name="company" value="', $row['company_no'], '"><br>';
            echo '</div>';
            echo '<div class="t">';
            echo 'キャラクターID：<input type="number" name="chara" value="', $row['chara_id'], '"><br>';
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