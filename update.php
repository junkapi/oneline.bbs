<?php

// 削除する処理

    $dsn = 'mysql:dbname=oneline_bbs;host=localhost';
    $user = 'root';
    $password = '';
    $dbh = new PDO($dsn, $user, $password);
    $dbh->query('SET NAMES utf8');

    $id = $_POST['id'];
    $nickname = $_POST['nickname'];
    $comment = $_POST['comment'];

    // $sql = 'UPDATE `posts` SET `nickname` = :nickname, `comment` = :comment WHERE id = :id';
    $sql = 'UPDATE `posts` SET `nickname` = :nickname, comment = :comment WHERE id = :id';
    $stmt = $dbh->prepare($sql);
    $stmt->bindValue(':nickname', $nickname, PDO::PARAM_STR);
    $stmt->bindValue(':comment', $comment, PDO::PARAM_STR);
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);
    $stmt->execute();

    $dbh = null;


// リダイレクト
    header("Location: bbs.php");
    exit();
