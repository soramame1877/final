<?php require '../db-connect.php';?>
<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <link rel ="stylesheet" href = "../css/admin_style.css">
        <title>管理者側ゲーム会社登録画面</title>
    </head>
    <body>
    <form action="../kanri_TOP.php" method="post">
            <button type="submit">トップへ戻る</button></p> 
        </form>
<?php
    $pdo=new PDO($connect,USER,PASS);

    $productsql=$pdo->prepare('insert into company (company_no, company_name , game_id) values(?,?,?)');
    if(empty($_POST['no'])){
        echo '会社番号を入力して下さい。';
    }
    else if(empty($_POST['name'])){
        echo '会社名を入力して下さい。';
    }
    else if(empty($_POST['id'])){
        echo 'ゲームIDを入力して下さい。';
    }
    else if($productsql->execute([$_POST['no'],$_POST['name'],$_POST['id']])){
        echo '商品の追加に成功しました。';
    }
    else{
        echo '商品の追加に失敗しました。';
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