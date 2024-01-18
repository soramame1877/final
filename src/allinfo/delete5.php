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
    $sql=$pdo->prepare('delete from gameall where all_id=?');
    if($sql->execute([$_POST['all_id']])){
        echo '商品削除に成功しました。';
    }else{
        echo '削除に失敗しました。';
    }
    echo '<br><hr><br>';
    echo '<table>';
    echo '<tr><th>情報ID</th><th>ゲームID</th><th>ジャンルID</th><th>会社番号</th><th>キャラクターID</th></tr>';

    $sql=$pdo->prepare('select * from gameall where all_id=?');
    foreach($pdo->query('select * from gameall order by all_id desc') as $row){
        echo '<tr>';
        echo '<td>', $row['all_id'], '</td>';
        echo '<td>', $row['game_id'], '</td>';
        echo '<td>', $row['genre_id'], '</td>';
        echo '<td>', $row['company_no'], '</td>';
        echo '<td>', $row['chara_id'], '</td>';
        echo '</tr>';
        echo "\n";
    }
?>
</table>
    </body>
</html>