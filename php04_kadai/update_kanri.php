<?php
require_once("funcs.php");

//1. POSTデータ取得
$name   = $_POST["name"];
$lid  = $_POST["lid"];
$lpw = $_POST["lpw"];
$kanri_flg = $_POST["kanri_flg"]; 
$life_flg = $_POST["life_flg"]; 
$id= $_POST['id'];

//2. DB接続します
$pdo= db_conn2();

//３．データ登録SQL作成
$stmt = $pdo->prepare("UPDATE gs_user_table SET name=:name, lid=:lid, lpw=:lpw, kanri_flg=:kanri_flg, life_flg=:life_flg WHERE id =:id;");
$stmt->bindValue(':name', h($name), PDO::PARAM_STR);      //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':lid', h($lid), PDO::PARAM_STR);    //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':lpw', h($lpw), PDO::PARAM_STR);        //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':kanri_flg', h($kanri_flg), PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':life_flg', h($life_flg), PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':id', h($id), PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$status = $stmt->execute(); //実行


//４．データ登録処理後
if($status==false){
    sql_error($stmt);
}else{
    redirect('select_kanri.php');
}