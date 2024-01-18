<?php require '../db-connect.php';?>

<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="../css/admin_style.css">
        <title>管理者側キャラクター登録画面</title>
    </head>
    <body>
        <form action="../kanri_TOP.php" method="post">
            <button type="submit">トップへ戻る</button></p> 
        </form>

        <?php
            $pdo = new PDO($connect, USER, PASS);

            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                // フォームが送信されたときの処理
                if (empty($_POST['id'])) {
                    echo 'キャラクターIDを入力してください。';
                }else if (empty($_POST['name'])) {
                    echo 'キャラクター名を入力してください。';
                }else if (empty($_POST['game'])){
                    echo 'ゲームIDを入力してください。';
                } else if (empty($_FILES['file']['name'])) {
                    echo '画像ファイルを選択してください。';
                } else {
                    // 画像のアップロード処理
                    $targetDir = "../chara_img/";
                    $fileName = basename($_FILES["file"]["name"]);
                    $targetFilePath = $targetDir . $fileName;
                    $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

                    if (move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath)) {
                        // データベースに画像情報を保存
                        $productSql = $pdo->prepare('INSERT INTO chara (chara_id, chara_name, game_id, imagepass) VALUES (?, ?, ?, ?)');  // プレースホルダーを4つに修正
                        if ($productSql->execute([$_POST['id'], $_POST['name'], $_POST['game'], $fileName])) {
                            echo 'ゲームの追加に成功しました。';
                        } else {
                            echo 'データベースへの登録に失敗しました。';
                        }
                    } else {
                        echo 'ファイルのアップロードに失敗しました。';
                    }
                }
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
