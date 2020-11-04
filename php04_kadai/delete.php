<?php

require_once("funcs.php");

//1. GETデータ取得
$id= $_GET["id"];


//2. DB接続します
$pdo= db_conn();

$stmt =$pdo->prepare("DELETE FROM gs_bm_table WHERE id=$id");
$stmt->bindValue(':id', h($id), PDO::PARAM_INT); 
$status = $stmt->execute(); //実行


//４．データ登録処理後
if($status==false){
    sql_error($stmt);
    //*** function化する！*****************
    // $error = $stmt->errorInfo();
    // exit("SQLError:".$error[2]);
}else{
    redirect('select.php');
    //*** function化する！*****************
    // header("Location: index.php");
    // exit();
}