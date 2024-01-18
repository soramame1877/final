<?php require '../db-connect.php';?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <link rel ="stylesheet" href = "../css/admin_style.css">
    <link rel="stylesheet" href="../css/admin-input.css">
    <title>管理者側キャラクター登録画面</title>
</head>
<body>
    <form action="../kanri_TOP.php" method="post">
            <button type="submit">トップへ戻る</button></p> 
    </form>
    <h1>キャラクター登録</h1>
    <form action = "chara_touroku-output.php" method="post" enctype="multipart/form-data">

    <div class="all">
    <div class="t">
    キャラクターID：<input type="number" name="id"><br>
    </div>
    <div class="t">
    キャラクター名：<input type="text" name="name"><br>
    </div>
    <div class="t">
    ゲームID：<input type="text" name="game"><br>
    </div>
    <div class="t">
    キャラクター画像パス：<input type="file" name="file"><br>
    </div>
    <div class="t">
    <button type="submit">登録</button><br>
    </div>
    </div>
    </form>
    <hr>
    <h1>ゲームIDは以下の通りです</h1>
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