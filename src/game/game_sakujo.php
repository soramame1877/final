<?php require '../db-connect.php'; ?>
<!DOCTYPE html>
<html lang="ja">
	<head>
    <meta http-equiv="Cache-Control" content="no-cache">
		<meta charset="UTF-8">
        <link rel="stylesheet" href="../css/admin_style.css">
		<title>管理者側ゲーム削除画面</title>
	</head>
	<body>
        <h1>ゲーム一覧</h1>
        <hr>
        <table>
    <tr><th>ゲームID</th><th>ゲーム名</th><th>画像パス</th><th>削除</th></tr>
<?php
    $pdo=new PDO($connect, USER, PASS);
    foreach ($pdo->query('select * from game order by game_id desc') as $row) {
        echo '<tr>';
        echo '<td>', $row['game_id'], '</td>';
        echo '<td>', $row['game_name'], '</td>';
        echo '<td>','<img src="../img/',$row['image_pass'],'" height="130">', '</td>';
		echo '<td>';
		echo '<form action="delete.php" method="post">';
        echo '<input type="hidden" name="game_id" value="',$row['game_id'],'">';
        echo '<button type="submit">削除</button>';
        echo '</form>';
		echo '</td>';
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