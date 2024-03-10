<?php
session_start();
require('dbconnect.php');


if (!empty($_POST) ){
     if ($_POST['name'] =='') {
         $error['name'] ='blank';
      }
     if ($_POST['email'] =='') {
         $error['email'] ='blank';
   } 
      if ($_POST['password'] == ''){
          $error['password'] = 'blank';
      }
      if ($_POST['password2'] == ''){
          $error['password2'] = 'blank';
      }
      if (strlen($_POST['password'])< 6) {
         $error['password'] = 'length';
      }
      if ($_POST['password'] !=$_POST['password2']) {
         $error['password2'] = 'difference';
      }


       //重複アカウントのチェック
        if (empty($error)) {
             $member = $db ->prepare('SELECT COUNT(*) AS cnt FROM members WHERE email=?');
             $member ->execute(array($_POST['email']));
             $record =$member ->fetch();
             if ($record['cnt'] > 0) {
                     $error['email'] = 'duplicate';
           }
       }


      if (empty($error)){
           $_SESSION['join'] = $_POST;
           header('Location: confirm.php');
          exit();
      }
}

      //書き直し機能
        if (isset($_REQUEST['action']) && ($_REQUEST['action'] == 'rewrite')){
	    $_POST = $_SESSION['join'];
	    $error['rewrite'] = true; 
}

?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <title>会員登録をする/みんなの晩ごはん</title>
 <link rel="stylesheet" type="text/css" href="board.css">

</head>
<body>
   <h1>会員登録をする</h1>

<section class="toukou2">

   <form action="" method="post" class="registrationform">

     <label>
       <span class="label-text">お名前</span>
       <input type="text" name="name" style="width:150px" value="<?php if (isset ($_POST['name'])) {echo htmlspecialchars($_POST['name'], ENT_QUOTES); } ?>" >
	<div class="error-box">
         <?php if (isset($error['name']) && ($error['name'] =='blank')): ?>
	<div class="blankbox"></div>
        <p class="error">お名前を入力してください</p>
	 <?php endif; ?>
        </div>
     </label>

<br>
    
    <label>
         <span class="label-text">E-mail</span>
	<input type="email" name="email" style="width:150px" value="<?php if (isset ($_POST['email'])) {echo htmlspecialchars($_POST['email'], ENT_QUOTES); } ?>" >
	  <div class="error-box">
           <?php if (isset($error['email']) && ($error['email'] == 'blank')): ?>
	  <div class="blankbox"></div>
          <p class ="error">E-mailを入力してください</p>
	  <?php endif; ?>
          </div>
          <div class="error-box">
	  <?php if (isset($error['email']) && ($error['email'] == 'duplicate')): ?>
	  <div class="blankbox"></div>
          <p class="error">指定されたメールアドレスは既に使用されています</p>
	  <?php endif; ?>
          </div>
     </label>

<br>

     <label>
       <span class="label-text">パスワード</span>
	<input type="password" name="password" style="width:150px" value="<?php if (isset ($_POST['password'])) {echo htmlspecialchars($_POST['password'], ENT_QUOTES); }?>" >
	  <div class="error-box"> 
          <?php if (isset($error ['password']) && ($error['password'] == 'blank')): ?>
	  <div class="blankbox"></div> 
           <p class="error">パスワードを入力してください</p>
	  <?php endif; ?>
          </div>
          <div class="error-box">
          <?php if (isset($error['password']) && ($error['password'] == 'length')): ?>
	  <div class="blankbox"></div>
          <p class="error">6文字以上で入力してください</p>
	  <?php endif; ?>
          </div>
     </label>

<br>

     <label>
        <span class="label-text">パスワード再入力</span><font color="red">*</font>
     <input type="password" name="password2" style="width:150px" value="<?php if (isset ($_POST['password2'])) {echo htmlspecialchars($_POST['password2'], ENT_QUOTES); }?>" >
          <div class="error-box">
          <?php if (isset($error['passwor2']) && ($error['password2'] == 'blank')): ?>
	  <div class="blankbox"></div>
          <p class="error">パスワードを入力してください</p>
	  <?php endif; ?>
	  </div>
          <div class="error-box">
          <?php if (isset($error['password2']) && ($error['password2'] == 'difference')): ?>
	  <div class="blankbox"></div>
          <p class="error">パスワードが上記と異なります</p>
	  <?php endif; ?>
          </div>
     </label>

<br>
      <input type="submit" value="確認する" class="button">

    </form>

<br>

     <a href="index.php">ログイン画面に戻る</a>

</section>

<br>

</body>
</html>
