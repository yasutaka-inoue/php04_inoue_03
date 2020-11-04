<?php
require_once("funcs.php");
//1. POSTデータ取得
$name= $_POST["name"];
$lid= $_POST["lid"];
$lpw= $_POST["lpw"];
$kanri_flg= $_POST["kanri_flg"];
$life_flg= $_POST["life_flg"];

//2. DB接続
$pdo= db_conn2();

//3.データ登録SQL作成
$stmt = $pdo->prepare("INSERT INTO gs_user_table(id, name, lid, lpw, kanri_flg, life_flg)VALUES(NULL, :name, :lid, :lpw, :kanri_flg, :life_flg)");
$stmt->bindValue(':name', h($name), PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':lid', h($lid), PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':lpw', h($lpw), PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':kanri_flg', h($kanri_flg), PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':life_flg', h($life_flg), PDO::PARAM_INT);;  //Integer（数値の場合 PDO::PARAM_INT)
$status = $stmt->execute();

//4.データ登録処理後
if($status==false){
  //SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
  sql_error($stmt);
}else{
  //５．成功の場合index.phpへリダイレクト=このページは表示されずに処理だけ実行
  redirect('select_kanri.php');
}
?>
