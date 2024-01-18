<?php require '../db-connect.php';?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <link rel ="stylesheet" href = "../css/admin_style.css">
    <link rel="stylesheet" href="../css/admin-input.css">
    <title>管理者側紐づけID登録画面</title>
</head>
<body>
<form action="../kanri_TOP.php" method="post">
            <button type="submit">トップへ戻る</button></p> 
        </form>
    <h1>紐づけID登録</h1>
    <form action = "allinfo_touroku-output.php" method="post">

    <div class="all">
    <div class="t">
    情報ID：<input type="number" name="all"><br>
    </div>
    <div class="t">
    ゲームID：<input type="number" name="game"><br>
    </div>
    <div class="t">
    ジャンルID：<input type="number" name="genre"><br>
    </div>
    <div class="t">
    会社番号：<input type="number" name="company"><br>
    </div>
    <div class="t">
    キャラクターID：<input type="number" name="chara"><br>
    </div>
    <div class="t">
    <button type="submit">登録</button><br>
    </div>
    </div>
    </form>
    <hr>
    <h1>ゲーム一覧</h1>
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