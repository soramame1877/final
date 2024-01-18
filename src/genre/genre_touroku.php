<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <link rel ="stylesheet" href = "../css/admin_style.css">
    <link rel="stylesheet" href="../css/admin-input.css">
    <title>管理者側ジャンル登録画面</title>
</head>
<body>
<form action="../kanri_TOP.php" method="post">
            <button type="submit">トップへ戻る</button></p> 
        </form>
    <h1>ジャンル登録</h1>
    <form action = "genre_touroku-output.php" method="post">

    <div class="all">
    <div class="t">
    ジャンルID：<input type="number" name="id"><br>
    </div>
    <div class="t">
    ジャンル名：<input type="text" name="name"><br>
    </div>
    <div class="t">
    ジャンル名2：<input type="text" name="name2"><br>
    </div>
    <div class="t">
    ジャンル名3：<input type="text" name="name3"><br>
    </div>
    <div class="t">
    <button type="submit">登録</button><br>
    </div>
    </div>
    </form>
</body>
</html>