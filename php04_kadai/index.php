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
?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>Book search and Wish list</title>
  <link href="css/reset.css" rel="stylesheet">
  <link href="css/style.css" rel="stylesheet">
  <style>div{padding: 10px;font-size:16px;}</style>
</head>
<body>
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
<!-- Main[Start] -->

<div class="search_area">
<label><input type="text" name="key" id="key" placeholder="ほしい本を検索してください" class="key"></label><span id="search" class="search">検索</span>
</div>

<div id="result" class="result"></div>


<form method="post" action="insert.php">
  <div class="wanted" id="wanted">
   <fieldset>
     <label>タイトル：<br><input type="text" name="title" id="form_title" readonly></label><br>
     <label>著者：<br><input type="text" name="author" id="form_author" readonly></label><br>
     <input type="hidden" name="url" id="form_page">
     <input type="hidden" name="img" id="form_img">
     <label>コメント：<br><textArea name="comment" rows="4" cols="40" id="comment" placeholder="コメントを書く"></textArea></label><br>
     <input type="submit" value="リストに追加" class="button" id="add">
    </fieldset>
  </div>
</form>

<!-- <div><a href="select.php" class="link">ほしい本リスト</a></div> -->
<!-- Main[End] -->

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script>
// // ボタンクリックイベント
$("#search").on("click", function(){
  localStorage.clear();
  const key = $("#key").val();
  //Ajax（非同期通信）
  axios.get("https://www.googleapis.com/books/v1/volumes?q=" + key).then(function (response) {
  //データ受信成功！！showData関数にデータを渡す
  showData(response.data);
  }).catch(function (error) {
  console.log(error);//通信Error
  alert("検索条件にマッチする本がありません");
  });
  });

// keydownによるイベント(enter)
$("#key").on("keydown", function(e){
  localStorage.clear();
    // console.log(e);
    if(e.keyCode == 13){
      $("#result").empty();
      const key = $("#key").val();
      //Ajax（非同期通信）
      axios.get("https://www.googleapis.com/books/v1/volumes?q=" + key).then(function (response) {
      //データ受信成功！！showData関数にデータを渡す
      showData(response.data);
      }).catch(function (error) {
      console.log(error);//通信Error
      alert("検索条件にマッチする本がありません");
      });
    }
});

// googlebooksapiで受け取ったデータの処理を書く
function showData(data){
  console.log(data.items);
  const len  = data.items.length; //データ数を取得
  console.log(len);
  for( let i=0; i<len; i++){
    // // データをとって、表示させる
    $("#result").append('<div class="block"><div class="block_content"><div class="img_card"><img src='+ data.items[i].volumeInfo.imageLinks.thumbnail +'/></div><ul class="info_list"><li class="label">タイトル:</li><li class="title">'+ data.items[i].volumeInfo.title + '</li><li class="label">著者:</li><li class="author">'+ data.items[i].volumeInfo.authors + '</li><li class="page"><a class="detail" href="'+ data.items[i].volumeInfo.previewLink + '">詳しく見る (Google books)</a></li><li><button class="getinfo" onclick="'+ i +'">ほしい本リストに追加する</button></li></ul></div></div>');
    // localstorageに入れる
    let key = "result" + i;
    let value ={
        "img": data.items[i].volumeInfo.imageLinks.thumbnail,
        "title": data.items[i].volumeInfo.title,
        "author": data.items[i].volumeInfo.authors,
        "page": data.items[i].volumeInfo.previewLink,
      }
    let json = JSON.stringify(value);
    localStorage.setItem(key, json);
  };
  // 「この本が欲しい」を押したら、テーブルが閉じて、フォームに情報が入る
  $(".getinfo").on("click", function(){
    // クリックされた本のonclick番号＝localstorageのkeyを取得
    let onclick =$(this).attr("onclick");
    console.log(onclick);
    let n = "result" + onclick;
    console.log(n);
    // keyに対応するvalue=json形式も取得
    let json = localStorage.getItem(n);
    // jsonを解凍
    let value = JSON.parse(json);
    console.log(value);
    let img = value.img;
    let title = value.title;
    let author = value.author;
    let page = value.page;
    $("#form_title").val(title);
    $("#form_author").val(author);
    $("#form_page").val(page);
    $("#form_img").val(img);
    $("#result").empty();
    $("#wanted").css("display", "block");
    localStorage.clear();
  });
}
// validation
$("#add").on("click", function(){
  const comment= $("#comment").val();
  if (comment=="") {
    $("#comment").val("なし");
    }
});

</script>

</body>
</html>
