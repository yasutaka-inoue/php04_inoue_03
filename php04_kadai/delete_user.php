<?php

require_once("funcs.php");

$id= $_GET['id'];

//2. DB接続します
$pdo= db_conn2();

//３．データ登録SQL作成
$stmt = $pdo->prepare("DELETE FROM gs_user_table WHERE id=:id");
$stmt->bindValue(':id', h($id), PDO::PARAM_INT); 
$status = $stmt->execute(); //実行


//４．データ登録処理後
if($status==false){
    sql_error($stmt);
}else{
    redirect('select_kanri.php');
}
