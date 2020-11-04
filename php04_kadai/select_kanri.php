<?php
// 0. SESSION開始！！
session_start();
//XSS対応（ echoする場所で使用！それ以外はNG ）
require_once("funcs.php");
// ログインチェック処理！（ログインした人にしか見せたくないページには入れる）
sessionCheck();

$pdo = db_conn2();


//２．データ登録SQL作成
$stmt = $pdo->prepare("SELECT * FROM gs_user_table");
$status = $stmt->execute();


//３．データ表示
$view = "";
if ($status == false) {
    sql_error($status);
} else {
    while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
        //GETデータ送信リンク作成
        $view .= '<tr>';
        $view .= '<td>'.$result["name"].'</td>';
        $view .= '<td>'.$result["lid"].'</td>';
        $view .= '<td class="update_td">';
        $view .= '<a class="btn" href="userdetail.php?id='. $result["id"]. '">';
        $view .= '修正';
        $view .= '</a>';
        $view .= '</td>';
        $view .= '<td class="delete_td">';
        $view .= '<a class="btn" href="delete_user.php?id='. $result["id"]. '">';
        $view .= '削除';
        $view .= '</a>';
        $view .= '</td>';
    }
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ユーザー一覧</title>
    <link href="css/reset.css" rel="stylesheet">
    <link href="css/style_kanri.css" rel="stylesheet">
    <style>div{padding: 10px;font-size:16px;}</style>
</head>
<body>
<header>
        <nav>
            <div class="nav">
              <div class="menu">
                <div class="nav_list"><a class="nav_link" href="select.php">ほしい本リスト</a></div>
                <div class="nav_list"><a class="nav_link" href="index.php">本を探す・登録する</a></div>
                <div class="nav_list"><a class="nav_link" href="kanri.php">ユーザー登録</a></div>
                <div class="nav_list"><a class="nav_link" href="select_kanri.php">ユーザー一覧</a></div>
              </div>
              <div class="login_menu">
                <div class="nav_list"><a class="nav_link" href="logout.php">ログアウト（管理者）</a></div>
              </div>
            </div>
        </nav>
</header>
    <h1>ユーザー一覧</h1>
    <div class="user_list">
    <table>
    <tr>
        <th>名前</th>
        <th>id</th>
        <th colspan="2">操作</th>
    </tr>
        <?= $view ?>
    </table>
    </div>

    <!-- <div><a href="kanri.php" class="link">ユーザー登録</a></div> -->
</body>
</html>