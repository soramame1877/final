<?php require '../db-connect.php';?>

<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="../css/admin_style.css">
        <title>管理者側ゲーム登録画面</title>
    </head>
    <body>
        <form action="../kanri_TOP.php" method="post">
            <button type="submit">トップへ戻る</button></p> 
        </form>

        <?php
            $pdo = new PDO($connect, USER, PASS);

            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                // フォームが送信されたときの処理
                if (empty($_POST['name'])) {
                    echo 'ゲーム名を入力してください。';
                } else if (empty($_FILES['file']['name'])) {
                    echo '画像ファイルを選択してください。';
                } else {
                    // 画像のアップロード処理
                    $targetDir = "../img/";
                    $fileName = basename($_FILES["file"]["name"]);
                    $targetFilePath = $targetDir . $fileName;
                    $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

                    if (move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath)) {
                        // データベースに画像情報を保存
                        $productSql = $pdo->prepare('INSERT INTO game (game_id, game_name, image_pass) VALUES (?, ?, ?)');
                        if ($productSql->execute([$_POST['id'], $_POST['name'], $fileName])) {
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
