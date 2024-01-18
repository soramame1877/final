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
    $sql=$pdo->prepare('delete from game where game_id=?');
    if($sql->execute([$_POST['game_id']])){
        echo '商品削除に成功しました。';
    }else{
        echo '削除に失敗しました。';
    }
    echo '<br><hr><br>';
    echo '<table>';
    echo '<tr><th>ゲームID</th><th>ゲーム名</th><th>画像パス</th></tr>';

    $sql=$pdo->prepare('select * from game where game_id=?');
    foreach($pdo->query('select * from game order by game_id desc') as $row){
        echo '<tr>';
        echo '<td>', $row['game_id'], '</td>';
        echo '<td>', $row['game_name'], '</td>';
        echo '<td>', '<img src="../img/',$row['image_pass'],'" height="130">', '</td>';
        echo '</tr>';
        echo "\n";
    }
?>
</table>
    </body>
</html>