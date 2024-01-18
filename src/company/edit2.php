<?php require '../db-connect.php';?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../css/admin_style.css">
    <link rel="stylesheet" href="../css/admin-input.css">
    <title>管理者側ゲーム会社更新画面</title>
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
        $company_no = $_POST['company_no'];
        $sql = $pdo->prepare('SELECT * FROM company WHERE company_no = ?');
        $sql->execute([$company_no]);

        foreach ($sql as $row) {
            echo '<form action="company_kousin-output.php" method="post">';
            echo '<div class="all">';
            echo '<div class="t">';
            echo '会社番号:<input type="number" name="no" value="', $row['company_no'], '">';
            echo '</div>';
            echo '<div class="t">';
            echo '会社名：<input type="text" name="name" value="', $row['company_name'], '">';
            echo '</div>';
            echo '<div class="t">';
            echo 'ゲームID：<input type="text" name="id" value="', $row['game_id'], '">';
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