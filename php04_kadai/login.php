<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width">
    <link href="css/reset.css" rel="stylesheet">
<link href="css/style.css" rel="stylesheet">
    <style>
        div {
            padding: 10px;
            font-size: 16px;
        }
    </style>
    <title>ログイン</title>
</head>

<body>
<header>
        <nav>
            <div class="nav">
              <div class="menu">
                <div class="nav_list"><a class="nav_link" href="select_logout.php">ほしい本リスト</a></div> 
                <!-- <div class="nav_list"><a class="nav_link" href="index.php">本を探す・登録する</a></div>
                <div class="nav_list"><a class="nav_link" href="kanri.php">ユーザー登録</a></div>
                <div class="nav_list"><a class="nav_link" href="select_kanri.php">ユーザー一覧</a></div>  -->
              </div>
              <div class="login_menu">
                <!-- <div class="nav_list"><a class="nav_link" href="login.php">ログイン</a></div> -->
              </div>
            </div>
        </nav>
</header>
    <!-- lLOGINogin_act.php は認証処理用のPHPです。 -->
    <div class="login">
    <form name="form1" action="login_act.php" method="post">
        <input class="input" type="text" name="lid" placeholder="Id" required/><br>
        <input class="input" type="password" name="lpw" placeholder="password" required/><br>
        <input class="submit"type="submit" value="ログイン" />
    </form>
    </div>
    <!-- <div><a href="select_logout.php" class="link">ほしい本リスト</a></div> -->

</body>

</html>