<?php require '../db-connect.php';?>

<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="../css/admin_style.css">
        <title>ゲーム更新結果</title>
    </head>
    <body>
        <form action="../kanri_TOP.php" method="post">
            <button type="submit">トップへ戻る</button></p> 
        </form>
        <h1>ゲーム更新結果</h1>

        <?php
            $pdo = new PDO($connect, USER, PASS);

            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $game_id = $_POST['id'];
                $game_name = $_POST['name'];

                // 画像のアップロード処理
                $targetDir = "../img/";
                $fileName = basename($_FILES["file"]["name"]);
                $targetFilePath = $targetDir . $fileName;

                if (!empty($_FILES["file"]["name"])) {
                    if (move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath)) {
                        // 画像がアップロードされた場合の処理
                        $updateSql = $pdo->prepare('UPDATE game SET game_id=?, game_name=?, image_pass=? WHERE game_id=?');
                        $result = $updateSql->execute([$game_id, $game_name, $fileName, $game_id]);
                    } else {
                        echo 'ファイルのアップロードに失敗しました。';
                    }
                } else {
                    // 画像がアップロードされなかった場合の処理
                    $updateSql = $pdo->prepare('UPDATE game SET game_id=?, game_name=? WHERE game_id=?');
                    $result = $updateSql->execute([$game_name, $game_id]);
                }

                if ($result) {
                    echo 'ゲームの更新に成功しました。';
                } else {
                    echo 'データベースの更新に失敗しました。';
                }
            } else {
                echo '不正なアクセスです。';
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
