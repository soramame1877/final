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
    $sql=$pdo->prepare('delete from company where company_no=?');
    if($sql->execute([$_POST['company_no']])){
        echo '商品削除に成功しました。';
    }else{
        echo '削除に失敗しました。';
    }
    echo '<br><hr><br>';
    echo '<table>';
    echo '<tr><th>会社番号</th><th>会社名</th><th>ゲームID</th></tr>';

    $sql=$pdo->prepare('select * from company where company_no=?');
    foreach($pdo->query('select * from company order by company_no desc') as $row){
        echo '<tr>';
        echo '<td>', $row['company_no'], '</td>';
        echo '<td>', $row['company_name'], '</td>';
        echo '<td>', $row['game_id'], '</td>';
        echo '</tr>';
        echo "\n";
    }
?>
</table>
    </body>
</html>