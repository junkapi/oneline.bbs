<?php

// 削除する処理

    $dsn = 'mysql:dbname=oneline_bbs;host=localhost';
    $user = 'root';
    $password = '';
    $dbh = new PDO($dsn, $user, $password);
    $dbh->query('SET NAMES utf8');


// なぜ$id,$nickname,$commentなのか
//    →edit.phpのinputのnameがそれぞれの名前だから
    $id = htmlspecialchars($_POST['id']);
    $nickname = htmlspecialchars($_POST['nickname']);
    $comment = htmlspecialchars($_POST['comment']);


// 方法①
    // $sql = 'UPDATE `posts` SET `nickname` = :nickname, `comment` = :comment WHERE id = :id';
    $sql = 'UPDATE `posts` SET `nickname` = :nickname, comment = :comment WHERE id = :id';
    $stmt = $dbh->prepare($sql);
    $stmt->bindValue(':nickname', $nickname, PDO::PARAM_STR);
    $stmt->bindValue(':comment', $comment, PDO::PARAM_STR);
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);
    $stmt->execute();


// // 方法②

//     $sql = 'UPDATE `posts` SET `nickname` = ?, `comment` = ? WHERE `id` = ?';


//     $date = [$nickname, $comment, $id];
        // 配列に値を追加して入れている

    // $date[] = $nickname;
        // 配列に値を入れている

//     $stmt = $dbh->prepare($sql);
//     $stmt->execute($date);

    $dbh = null;


// リダイレクト
    header("Location: bbs.php");
    exit();



      // $hoge = [1,2,3,4,5];

      // 配列に値を追加
      // $hoge[] = 6;

      // 配列の値を上書き
      // $hoge['0'] = 10;