<?php
session_start();
require('dbconnect.php');

if (isset($_SESSION['id']) && $_SESSION['time'] + 3600 > time()) {
    $_SESSION['time'] = time();

    $members=$db->prepare('SELECT * FROM members WHERE id=?');
    $members->execute(array($_SESSION['id']));
    $member=$members->fetch();
  } else {
    header('Location: mypage.php');
    exit();
  }

?>

<!DOCTYPE html>
<html lang= "ja">
<head>
<meta charset="UTF-8">
<title>みんなの晩ごはん</title>
<link rel="stylesheet" type="text/css" href="board.css">
</head>

<body>
<h1>編集を完了しました</h1>

<br>

<section class="toukou1">

<?php
  if (isset($_POST['post'],$_POST['id']))
   {
    $result = $db ->prepare ('UPDATE posts SET post=? WHERE id=?');
    $result ->execute(array($_POST['post'],$_POST['id']));
    echo "投稿内容を編集しました。";
  }
?>

<br>

  <p><a href="mypage.php">マイページへ戻る</a></p>

</section>

</body>
</html>
