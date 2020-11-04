<?php
require_once("funcs.php");

//1. POSTデータ取得
$title= $_POST["title"];
$author= $_POST["author"];
$url= $_POST["url"];
$img= $_POST["img"];
$comment= $_POST["comment"];
$id= $_POST['id'];

//2. DB接続します
$pdo= db_conn();

//３．データ登録SQL作成
$stmt = $pdo->prepare("UPDATE gs_bm_table SET id=:id, title=:title, author=:author, url=:url, img=:img, comment=:comment, date=sysdate() WHERE id=:id;");
$stmt->bindValue(':id', $id, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':title', $title, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':author', $author, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':url', $url, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':img', $img, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':comment', h($comment), PDO::PARAM_STR);;  //Integer（数値の場合 PDO::PARAM_INT)
$status = $stmt->execute();

//４．データ登録処理後
if($status==false){
    sql_error($stmt);

}else{
    redirect('select.php');
}