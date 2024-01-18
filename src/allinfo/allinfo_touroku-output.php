<?php require '../db-connect.php';?>

<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="../css/admin_style.css">
        <title>管理者側紐づけID登録画面</title>
    </head>
    <body>
        <form action="../kanri_TOP.php" method="post">
            <button type="submit">トップへ戻る</button>
        </form>

        <?php
            $pdo = new PDO($connect, USER, PASS);

            $productsql = $pdo->prepare('INSERT INTO gameall (all_id, game_id, genre_id, company_no, chara_id) VALUES (?, ?, ?, ?, ?)');

            if (empty($_POST['all']) || empty($_POST['game']) || empty($_POST['genre']) || empty($_POST['company']) || empty($_POST['chara'])) {
                echo 'すべての情報を入力してください。';
            } else {
                $all_id = $_POST['all'];
                $game_id = $_POST['game'];
                $genre_id = $_POST['genre'];
                $company_no = $_POST['company'];
                $chara_id = $_POST['chara'];

                if ($productsql->execute([$all_id, $game_id, $genre_id, $company_no, $chara_id])) {
                    echo '商品の追加に成功しました。';
                } else {
                    echo '商品の追加に失敗しました。';
                }
            }

            echo '<br><hr><br>';
            echo '<table>';
            echo '<tr><th>情報ID</th><th>ゲームID</th><th>ジャンルID</th><th>会社番号</th><th>キャラクターID</th></tr>';

            $sql = $pdo->prepare('select * from gameall where all_id=?');
            foreach ($pdo->query('select * from gameall order by all_id desc') as $row) {
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
