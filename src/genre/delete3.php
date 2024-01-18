<?php require '../db-connect.php'; ?>
<!DOCTYPE html>
<html lang="ja">
	<head>
		<meta charset="UTF-8">
        <link rel="stylesheet" href="../css/admin_style.css">
		<title>削除画面</title>
	</head>
	<body>
    <form action="../kanri_TOP.php" method="post" class="a">
        <div class="button">
            <input type="submit" value="TOPへ戻る">
        </div>
    </form>
<?php
    $pdo=new PDO($connect, USER, PASS);
    $sql=$pdo->prepare('delete from genre where genre_id=?');
    if($sql->execute([$_POST['genre_id']])){
        echo '商品削除に成功しました。';
    }else{
        echo '削除に失敗しました。';
    }
    echo '<br><hr><br>';
    echo '<table>';
    echo '<tr><th>ジャンルID</th><th>ジャンル名</th><th>ジャンル名2</th><th>ジャンル名3</th></tr>';

    $sql=$pdo->prepare('select * from genre where genre_id=?');
    foreach($pdo->query('select * from genre order by genre_id desc') as $row){
        echo '<tr>';
        echo '<td>', $row['genre_id'], '</td>';
        echo '<td>', $row['genre_name'], '</td>';
        echo '<td>', $row['genre_name2'], '</td>';
        echo '<td>', $row['genre_name3'], '</td>';
        echo '</tr>';
        echo "\n";
    }
?>
</table>
    </body>
</html>