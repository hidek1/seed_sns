<?php

session_start();
require('dbconnect.php');

// var_dump($_GET);


if (!empty($_GET) && $_GET['action']=='update') {
$sql_select='SELECT * FROM ｀tweets｀ WHERE ｀tweet_id｀=?';
$data_select=array($_GET['tweet_id']);
$stmt_select=$dbh->prepare($sql_select);
$stmt_select->execute($data_select);
$update=$stmt_select->fetch(PDO::FETCH_ASSOC);
}

// var_dump($update);


if (!empty($_POST) && isset($_POST)) {
$sql_update='UPDATE ｀tweets｀ SET `delete_flag`=1';
$data_update=array($_POST['tweet'],$update['tweet_id']);
$stmt_update=$dbh->prepare($sql_update);
$stmt_update->execute($data_update);

header('Location: index.php');
exit;
}
?>