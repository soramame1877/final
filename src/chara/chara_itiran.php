<?php require '../db-connect.php'; ?>
<!DOCTYPE html>
<html lang="ja">
	<head>
    <meta http-equiv="Cache-Control" content="no-cache">
		<meta charset="UTF-8">
        <link rel="stylesheet" href="../css/admin_style.css">
		<title>管理者側キャラクター一覧画面</title>
	</head>
	<body>
        <h1>キャラクター一覧</h1>
        <hr>
        <table>
    <tr><th>キャラクターID</th><th>キャラクター名</th><th>ゲームID</th><th>キャラクター画像パス</th></tr>
<?php
    $pdo=new PDO($connect, USER, PASS);
    foreach ($pdo->query('select * from chara order by chara_id desc') as $row) {
        echo '<tr>';
        echo '<td>', $row['chara_id'], '</td>';
        echo '<td>', $row['chara_name'], '</td>';
        echo '<td>', $row['game_id'], '</td>';
        echo '<td>','<img src="../chara_img/',$row['imagepass'],'" height="130">', '</td>';
        echo '</tr>';
        echo "\n";
    }
?>
    <form action="../kanri_TOP.php" method="post" class="a">
        <div class="button">
            <input type="submit" value="TOPへ戻る">
        </div>
    </form>
    </table>
    </body>
</html>