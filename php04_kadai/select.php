<?php
// 0. SESSION開始！！
session_start();
//XSS対応（ echoする場所で使用！それ以外はNG ）
require_once("funcs.php");
// ログインチェック処理！（ログインした人にしか見せたくないページには入れる）
sessionCheck();
// 管理者区分をチェック
if ($_SESSION['kanri_flg'] =="1"){
        $nav_view .='<div class="nav_list"><a class="nav_link" href="kanri.php">ユーザー登録</a></div>';
        $nav_view .='<div class="nav_list"><a class="nav_link" href="select_kanri.php">ユーザー一覧</a></div>';
        $kanri ='（管理者）';
    }
//1.  DB接続します
$pdo= db_conn();

//２．データ取得SQL作成
$stmt = $pdo->prepare("SELECT * FROM gs_bm_table");
$status = $stmt->execute();

//３．データ表示
$view="";
if ($status==false) {
    //execute（SQL実行時にエラーがある場合）
  $error = $stmt->errorInfo();
  exit("ErrorQuery:".$error[2]);

}else{
  //Selectデータの数だけ自動でループしてくれる
  //FETCH_ASSOC=http://php.net/manual/ja/pdostatement.fetch.php
  while( $result = $stmt->fetch(PDO::FETCH_ASSOC)){
    // どっとをつけないと、上書きされる。ドットをつけると、追加になる。
    $view .= '<div class="block">';
    $view .= '<div class="block_content">';
    $view .= '<div class="img_card">';
    $view .= '<img src="'.$result['img'].'"></div>';
    $view .= '<ul class="info_list"><li class="label">タイトル:</li><li class="title">';
    $view .= $result['title'];
    $view .= '</li><li class="label">著者:</li><li class="author">';
    $view .= $result['author'];
    $view .= '</li><li class="label">コメント:</li><li class="other">';
    $view .= $result['comment'];
    $view .= '</li><li><a class="update_delete" href="bm_update_view.php?id='.$result['id'].'">コメント修正</a></li>';
    $view .= '<li class="date">';
    $view .= $result['date'];
    $view .= '</li><li class="page">';
    $view .= '<a class="detail" href="'.$result['url'].'">詳しく見る (Google books)</a>';
    $view .= '</li><li><a class="update_delete" href="delete.php?id='.$result['id'].'">削除する</a></li></ul></div></div>';
  }
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Wish List</title>
<link href="css/reset.css" rel="stylesheet">
<link href="css/style.css" rel="stylesheet">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<style>div{padding: 10px;font-size:16px;}</style>
</head>
<body id="main">
<header>
        <nav>
            <div class="nav">
              <div class="menu">
                <div class="nav_list"><a class="nav_link" href="select.php">ほしい本リスト</a></div>
                <div class="nav_list"><a class="nav_link" href="index.php">本を探す・登録する</a></div>
                <?= $nav_view ?>
                <!-- <div class="nav_list"><a class="nav_link" href="kanri.php">ユーザー登録</a></div>
                <div class="nav_list"><a class="nav_link" href="select_kanri.php">ユーザー一覧</a></div> -->
              </div>
              <div class="login_menu">
              <div class="nav_list"><a class="nav_link" href="logout.php">ログアウト<?=$kanri?></a></div>
              </div>
            </div>
        </nav>
</header>
<h1>ほしい本リスト</h1>
<!-- Main[Start] -->
  <div class="result"><?= $view ?></div>
<!-- Main[End] -->
  <!-- <div><a href="index.php" class="link">本を探す</a></div> -->

</body>
</html>
