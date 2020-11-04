<?php
require_once("funcs.php");
//1. POSTデータ取得
//$name = filter_input( INPUT_GET, ","name" ); //こういうのもあるよ
//$email = filter_input( INPUT_POST, "email" ); //こういうのもあるよ
$title= $_POST["title"];
$author= $_POST["author"];
$url= $_POST["url"];
$img= $_POST["img"];
$comment= $_POST["comment"];


//2. DB接続します
$pdo= db_conn();

//３．データ登録SQL作成
$stmt = $pdo->prepare("INSERT INTO gs_bm_table(id, title, author, url, img, comment, date)VALUES(NULL, :title, :author, :url, :img, :comment, sysdate())");
$stmt->bindValue(':title', h($title), PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':author', h($author), PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':url', h($url), PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':img', h($img), PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':comment', h($comment), PDO::PARAM_STR);;  //Integer（数値の場合 PDO::PARAM_INT)
$status = $stmt->execute();

//４．データ登録処理後
if($status==false){
  //SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
  sql_error($stmt);
}else{
  //５．成功の場合index.phpへリダイレクト=このページは表示されずに処理だけ実行
  redirect('select.php');
}
?>
