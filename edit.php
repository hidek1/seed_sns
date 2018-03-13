<?php

session_start();
require('dbconnect.php');

// var_dump($_GET);


if (!empty($_GET) ) {
$sql_select='SELECT * FROM ｀tweets｀ WHERE ｀tweet_id｀=?';
$data_select=array($_GET['tweet_id']);
$stmt_select=$dbh->prepare($sql_select);
$stmt_select->execute($data_select);
$update=$stmt_select->fetch(PDO::FETCH_ASSOC);
}

// var_dump($update);



if (!empty($_POST) && isset($_POST)) {
  if ($_POST['tweet'] == '') {
      $error['tweet'] = 'blank';
    }else{
$sql_update='UPDATE ｀tweets｀ SET ｀tweet｀=? , ｀modified｀=NOW() WHERE ｀tweet_id｀=?';
$data_update=array($_POST['tweet'],$update['tweet_id']);
$stmt_update=$dbh->prepare($sql_update);
$stmt_update->execute($data_update);


header('Location: index.php');
exit;
}
}


?>


<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>SeedSNS</title>

    <!-- Bootstrap -->
    <link href="assets/css/bootstrap.css" rel="stylesheet">
    <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="assets/css/form.css" rel="stylesheet">
    <link href="assets/css/timeline.css" rel="stylesheet">
    <link href="assets/css/main.css" rel="stylesheet">

  </head>
  <body>
  <nav class="navbar navbar-default navbar-fixed-top">
      <div class="container">
          <!-- Brand and toggle get grouped for better mobile display -->
          <div class="navbar-header page-scroll">
              <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                  <span class="sr-only">Toggle navigation</span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
              </button>
              <a class="navbar-brand" href="index.html"><span class="strong-title"><i class="fa fa-twitter-square"></i> Seed SNS</span></a>
          </div>
          <!-- Collect the nav links, forms, and other content for toggling -->
          <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
              <ul class="nav navbar-nav navbar-right">
                <li><a href="logout.php">ログアウト</a></li>
              </ul>
          </div>
          <!-- /.navbar-collapse -->
      </div>
      <!-- /.container-fluid -->
  </nav>

  <div class="container">
    <div class="row">
      <div class="col-md-6 col-md-offset-3 content-margin-top">
        <h4>つぶやき編集</h4>
        <div class="msg">
          <form action="" method="POST">
      <input type="text" name="tweet" value="<?php echo $update['tweet']; ?>">
      <input type="submit" name="" value="更新">
    </form>
        </div>
        <a href="index.php">&laquo;&nbsp;一覧へ戻る</a>
      </div>
    </div>
  </div>
  <?php if(isset($error['tweet']) && $error['tweet'] == 'failed') { ?>
            <p class="error">* tweetねえよ</p>
          <?php } ?>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="assets/js/jquery-3.1.1.js"></script>
    <script src="assets/js/jquery-migrate-1.4.1.js"></script>
    <script src="assets/js/bootstrap.js"></script>
  </body>
</html>