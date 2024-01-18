<?php require '../db-connect.php'; ?>
<!DOCTYPE html>
<html lang="ja">
	<head>
    <meta http-equiv="Cache-Control" content="no-cache">
		<meta charset="UTF-8">
        <link rel="stylesheet" href="../css/admin_style.css">
		<title>管理者側キャラクター削除画面</title>
	</head>
	<body>
        <h1>キャラクター一覧</h1>
        <hr>
        <table>
    <tr><th>キャラクターID</th><th>キャラクター名</th><th>ゲームID</th><th>キャラクター画像パス</th><th>削除</th></tr>
<?php
    $pdo=new PDO($connect, USER, PASS);
    foreach ($pdo->query('select * from chara order by chara_id desc') as $row) {
        echo '<tr>';
        echo '<td>', $row['chara_id'], '</td>';
        echo '<td>', $row['chara_name'], '</td>';
        echo '<td>', $row['game_id'], '</td>';
        echo '<td>','<img src="../chara_img/',$row['imagepass'],'" height="130">', '</td>';
		echo '<td>';
		echo '<form action="delete4.php" method="post">';
        echo '<input type="hidden" name="chara_id" value="',$row['chara_id'],'">';
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