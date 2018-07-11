<?php



  // データベースに接続する
  $dsn = 'mysql:dbname=oneline_bbs;host=localhost';
  $user ='root';
  $passward='';
  $dbh = new PDO($dsn, $user, $passward);
  $dbh->query('SET NAMES utf8');

  // POSTでデータが送信された時のみSQLを実行する
  if (!empty($_POST)) {


          // ここにDBに登録する処理を記述する
      $nickname = htmlspecialchars($_POST['nickname']);
      $comment = htmlspecialchars($_POST['comment']);


      if (!empty($nickname || $comment)) {

      // SOL文を実行する
      $sql = 'INSERT INTO `posts`(`nickname`, `comment`, `created`) VALUES (?,?,?)';

      // インジェクション

      $data[] = $nickname;
      $data[] = $comment;
      $data[] = date("Y-m-d H:i:s");


      $stmt = $dbh->prepare($sql);
      $stmt->execute($data);
      }

  }

        $sql = 'SELECT * FROM `posts` ORDER BY created DESC';
        $stmt = $dbh->prepare($sql);
        $stmt->execute();

            while (1) {
                        $rec = $stmt->fetch(PDO::FETCH_ASSOC);
                        if ($rec == false) {
                            break;
                        }
                        echo $rec['nickname'] . '<br>';
                        echo $rec['comment'] . '<br>';
                        echo $rec['created'] . '<br>';
                        echo '<br>';
            }


  // データベースを切断する
  $dbh = null
?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>セブ掲示版</title>
</head>
<body>
    <form method="post" action="">
      <p><input type="text" name="nickname" placeholder="nickname"></p>
      <p><textarea type="text" name="comment" placeholder="comment"></textarea></p>
      <p><button type="submit" >つぶやく</button></p>
    </form>
    <!-- ここにニックネーム、つぶやいた内容、日付を表示する -->
</body>
</html>