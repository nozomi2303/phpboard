<?php
session_start();
require('dbconnect.php');

if (!empty($_POST)){
    if (($_POST['email'] !='') && ($_POST['password'] !='')) {
	 $login = $db->prepare('SELECT * FROM members WHERE email=?');
	 $login->execute(array($_POST['email']));
	 $member=$login->fetch();
    if ($member != false && password_verify($_POST['password'],$member['password'])) {
	$_SESSION['id'] = $member['id'];
	$_SESSION['time'] =time();
	header('Location: post.php');
	exit();
    } else{
	$error['login']='failed';
    } 
    } else{
	$error['login'] ='blank';
    }
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

<h1>みんなの晩ごはん</h1>

<p class="intro">
<br>
今日の晩ごはんどうしようかな？<br>
そんな悩みから解放されましょう！<br>
みんなで今日の晩御飯をつぶやいてお互いの参考にしたり<br>
先週何食べたかな？とマイページから確認も出来ます！<br>
みんなで今日の晩ごはんを呟く気軽な掲示板です。
<br>
<br>
</p>

<br>

<section class="toukou2">

<h2>会員の方はこちらから</h2>

<br>

<form action="" method="post">

<label>
    <span class="label-text">E-mail</span>
      <input type="email" name="email" style="width:150px"
       value="<?php echo htmlspecialchars($_POST['email']??"", ENT_QUOTES); ?>">
      <div class="error-box">
       <?php if (isset($error['login']) && ($error['login'] =='blank')): ?>
      <div class="blankbox"></div>
      <p class="error">メールアドレスを入力してください</p>
      <?php endif;?>
      </div>
      <div class="error-box">
      <?php if (isset($error['login']) && $error['login'] =='failed'): ?>
      <div class="blankbox"></div>
      <p class="error">メールアドレスかパスワードが間違っています</p>
      <?php endif; ?>
      </div>
</label>

<br>

<label>
    <span class="label-text">パスワード</span>
      <input type="password" name="password" style="width:150px"
       value="<?php echo htmlspecialchars($_POST['password']??"", ENT_QUOTES); ?>">
      <div class="error-box">
      <?php if (isset($error['login']) && ($error['login'] =='blank')): ?>
      <div class="blankbox"></div>
      <p class="error">パスワードを入力してください</p>
      <?php endif;?>
      </div>
      <div class="error-box">
      <?php if (isset($error['login']) && $error['login'] =='failed'): ?>
     <div class="blankbox"></div>
       <p class="error">メールアドレスかパスワードが間違っています</p>
      <?php endif; ?>
      </div>
</label>
<br>

<div class="login2">
       <input type="submit" value="ログインする" class="button">
</div>

</form>

<br>

<h2>はじめましての方はこちらから</h2>

<br>

       <a href="register.php" class="join">新規会員登録する</a>

</section>

</body>
</html>

