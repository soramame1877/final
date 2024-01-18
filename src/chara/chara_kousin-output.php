<?php require '../db-connect.php';?>

<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="../css/admin_style.css">
        <title>キャラクター更新結果</title>
    </head>
    <body>
        <form action="../kanri_TOP.php" method="post">
            <button type="submit">トップへ戻る</button></p> 
        </form>
        <h1>キャラクター更新結果</h1>

        <?php
            $pdo = new PDO($connect, USER, PASS);

            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $chara_id = $_POST['id'];
                $chara_name = $_POST['name'];
                $game_id = $_POST['game'];

                // 画像のアップロード処理
                $targetDir = "../chara_img/";
                $fileName = basename($_FILES["file"]["name"]);
                $targetFilePath = $targetDir . $fileName;

                if (!empty($_FILES["file"]["name"])) {
                    if (move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath)) {
                        // 画像がアップロードされた場合の処理
                        $updateSql = $pdo->prepare('UPDATE chara SET chara_id=?, chara_name=?, game_id=?, imagepass=? WHERE chara_id=?');
                        $result = $updateSql->execute([$chara_id, $chara_name, $game_id, $fileName, $chara_id]);
                    } else {
                        echo 'ファイルのアップロードに失敗しました。';
                    }
                } else {
                    // 画像がアップロードされなかった場合の処理
                    $updateSql = $pdo->prepare('UPDATE chara SET chara_id=?, chara_name=?, game_id=? WHERE chara_id=?');  // プレースホルダーを3つに修正
                    $result = $updateSql->execute([$chara_id, $chara_name, $game_id, $chara_id]);
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
            echo '<tr><th>キャラクターID</th><th>キャラクター名</th><th>ゲームID</th><th>キャラクター画像パス</th></tr>';

            $sql=$pdo->prepare('select * from chara where chara_id=?');
            foreach ($pdo->query('select * from chara order by chara_id desc') as $row) {
                echo '<tr>';
                echo '<td>', $row['chara_id'], '</td>';
                echo '<td>', $row['chara_name'], '</td>';
                echo '<td>', $row['game_id'], '</td>';
                echo '<td>','<img src="../chara_img/',$row['imagepass'],'" height="130">', '</td>';
                echo '</tr>';
                echo "\n";
            }
        ?>
        </table>
    </body>
</html>
