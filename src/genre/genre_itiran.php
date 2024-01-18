<?php require '../db-connect.php'; ?>
<!DOCTYPE html>
<html lang="ja">
	<head>
    <meta http-equiv="Cache-Control" content="no-cache">
		<meta charset="UTF-8">
        <link rel="stylesheet" href="../css/admin_style.css">
		<title>管理者側ジャンル一覧画面</title>
	</head>
	<body>
        <h1>ジャンル一覧</h1>
        <hr>
        <table>
    <tr><th>ジャンルID</th><th>ジャンル名</th><th>ジャンル名2</th><th>ジャンル名3</th></tr>
<?php
    $pdo=new PDO($connect, USER, PASS);
    foreach ($pdo->query('select * from genre order by genre_id desc') as $row) {
        echo '<tr>';
        echo '<td>', $row['genre_id'], '</td>';
        echo '<td>', $row['genre_name'], '</td>';
        echo '<td>', $row['genre_name2'], '</td>';
        echo '<td>', $row['genre_name3'], '</td>';
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