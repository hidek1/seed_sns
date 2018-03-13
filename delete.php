<?php

session_start();
require('dbconnect.php');

// var_dump($_GET);


$delete_tweet_id = $_GET['tweet_id'];
  $sql = 'UPDATE `tweets` SET `delete_flag`=1 WHERE `tweet_id`=?';
  $data = array($delete_tweet_id);
  $stmt = $dbh->prepare($sql);
  $stmt->execute($data);
  header("Location: index.php");
  exit();
?>