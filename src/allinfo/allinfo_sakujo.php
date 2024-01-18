<?php require '../db-connect.php'; ?>
<!DOCTYPE html>
<html lang="ja">
	<head>
    <meta http-equiv="Cache-Control" content="no-cache">
		<meta charset="UTF-8">
        <link rel="stylesheet" href="../css/admin_style.css">
		<title>管理者側紐づけID更新画面</title>
	</head>
	<body>
        <h1>ID一覧</h1>
        <hr>
        <table>
    <tr><th>情報ID</th><th>ゲームID</th><th>ジャンルID</th><th>会社番号</th><th>キャラクターID</th><th>削除</th></tr>
<?php
    $pdo=new PDO($connect, USER, PASS);
    foreach ($pdo->query('select * from gameall order by all_id desc') as $row) {
        echo '<tr>';
        echo '<td>', $row['all_id'], '</td>';
        echo '<td>', $row['game_id'], '</td>';
        echo '<td>', $row['genre_id'], '</td>';
        echo '<td>', $row['company_no'], '</td>';
        echo '<td>', $row['chara_id'], '</td>';
		echo '<td>';
		echo '<form action="delete5.php" method="post">';
        echo '<input type="hidden" name="all_id" value="',$row['all_id'],'">';
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