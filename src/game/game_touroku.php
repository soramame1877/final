<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <link rel ="stylesheet" href = "../css/admin_style.css">
    <link rel="stylesheet" href="../css/admin-input.css">
    <title>管理者側ゲーム登録画面</title>
</head>
<body>
<form action="../kanri_TOP.php" method="post">
            <button type="submit">トップへ戻る</button></p> 
        </form>
    <h1>ゲーム登録</h1>
    <form action = "game_touroku-output.php" method="post" enctype="multipart/form-data">

    <div class="all">
    <div class="t">
    ゲームID：<input type="number" name="id"><br>
    </div>
    <div class="t">
    ゲーム名：<input type="text" name="name"><br>
    </div>
    <div class="t">
    画像パス：<input type="file" name="file"><br>
    </div>
    <div class="t">
    <button type="submit">登録</button><br>
    </div>
    </div>
    </form>
</body>
</html>