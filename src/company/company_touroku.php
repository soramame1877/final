<?php require '../db-connect.php'; ?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <link rel ="stylesheet" href = "../css/admin_style.css">
    <link rel="stylesheet" href="../css/admin-input.css">
    <title>管理者側ゲーム会社登録画面</title>
</head>
<body>
<form action="../kanri_TOP.php" method="post">
            <button type="submit">トップへ戻る</button></p> 
        </form>
    <h1>ゲーム登録</h1>
    <form action = "company_touroku-output.php" method="post">

    <div class="all">
    <div class="t">
    会社番号：<input type="number" name="no"><br>
    </div>
    <div class="t">
    会社名：<input type="text" name="name"><br>
    </div>
    <div class="t">
    ゲームID：<input type="number" name="id"><br>
    </div>
    <div class="t">
    <button type="submit">登録</button><br>
    </div>
    </div>
    </form>
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
</body>
</html>