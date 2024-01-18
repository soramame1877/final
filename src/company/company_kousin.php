<?php require '../db-connect.php'; ?>
<!DOCTYPE html>
<html lang="ja">
	<head>
    <meta http-equiv="Cache-Control" content="no-cache">
		<meta charset="UTF-8">
        <link rel="stylesheet" href="../css/admin_style.css">
		<title>管理者側ゲーム会社更新画面</title>
	</head>
	<body>
        <h1>商品一覧</h1>
        <hr>
        <table>
    <tr><th>会社番号</th><th>会社名</th><th>ゲームID</th><th>更新</th></tr>
<?php
    $pdo=new PDO($connect, USER, PASS);
    foreach ($pdo->query('select * from company order by company_no desc') as $row) {
        echo '<tr>';
        echo '<td>', $row['company_no'], '</td>';
        echo '<td>', $row['company_name'], '</td>';
        echo '<td>', $row['game_id'] , '</td>';
		echo '<td>';
		echo '<form action="edit2.php" method="post">';
        echo '<input type="hidden" name="company_no" value="',$row['company_no'],'">';
        echo '<button type="submit">更新</button>';
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