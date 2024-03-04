<?php
session_start();
require('dbconnect.php');

if (!isset($_SESSION['join'])) {
    header('Location: register.php');
    exit();
}

$hash = password_hash($_SESSION['join']['password'], PASSWORD_BCRYPT);

if(!empty($_POST)){
     $statement = $db->prepare('INSERT INTO members SET name=?, email=?, password=?, created=NOW()');
     $statement->execute(array(
         $_SESSION['join']['name'],
         $_SESSION['join']['email'],
         $hash));
     unset($_SESSION['join']);
     header('Location: thanks.php');
     exit();
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <title>ユーザ登録確認画面/みんなの晩ごはん</title>
<link rel="stylesheet" type="text/css" href="board.css">

</head>
<body>
  <h1>ユーザ登録確認画面</h1>

<section class="toukou2">

  <form action="" method="post">
     <input type="hidden" name="action" value="submit">
     <p>
     お名前
     <span class="check"><?php echo htmlspecialchars($_SESSION['join']['name'], ENT_QUOTES); ?></span>
     </p>
     <p>
     E-mail
     <span class="check"><?php echo htmlspecialchars($_SESSION['join']['email'], ENT_QUOTES); ?></span>
     </p>
     <p>
     パスワード
     <span class="check">[セキュリティ保護のため表示されません]</span>
     </p>
     <input type="button" onclick="event.preventDefault(); location.href='register.php?action=rewrite'" value="修正する" name="rewrite" class="button02">
     <input type="submit" value="登録する" class="button">
   </form>
</section>
</body>
</html>

