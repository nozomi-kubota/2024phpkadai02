<?php
//1.  DB接続します
try {
  //ID:'root', Password: xamppは 空白 ''
  $pdo = new PDO('mysql:dbname=gs_db_class3;charset=utf8;host=localhost','root','');
} catch (PDOException $e) {
  exit('DBConnectError:'.$e->getMessage());
}
// //２．データ取得SQL作成
$stmt = $pdo->prepare("SELECT * FROM gs_bookmark_table");
$status = $stmt->execute();

// //３．データ表示
 if ($status==false) {
     //execute（SQL実行時にエラーがある場合）
  $error = $stmt->errorInfo();
  exit("ErrorQuery:".$error[2]);

}
?>


<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>レシピ本一覧表示</title>
  <link href="css/style.css" rel="stylesheet">
</head>

<body id="main">
  <header>
    <nav>
      <a href="index.php">データ登録画面へ</a>
    </nav>
  </header>

  <main>
    <div class="container">
      <h1>おすすめレシピ本一覧</h1>
      <div class="survey-list">
        <!-- PHP でデータを取得し、以下の形式で表示する -->
        <?php while ($result = $stmt->fetch(PDO::FETCH_ASSOC)): ?> 
          <p> 
            ❖<?= htmlspecialchars($result['book_name'], ENT_QUOTES, 'UTF-8') ?>❖
            <?= htmlspecialchars($result['date'], ENT_QUOTES, 'UTF-8') ?> :
            <?= htmlspecialchars($result['book_url'], ENT_QUOTES, 'UTF-8') ?><br>
            <?= htmlspecialchars($result['book_comment'], ENT_QUOTES, 'UTF-8') ?>
          </p> 
        <?php endwhile; ?>
              
        <div class="survey-card">
          <h2>❖書籍名❖ 登録日時</h2>
          <p class="date">yyyy-mm-dd 24:00:00</p>
          <p class="url">URL:https://www.amazon.co.jp</p>
          <p class="content">コメントがここに表示されます。</p>
        </div> 
      </div>
    </div>
  </main>

</body>

</html>