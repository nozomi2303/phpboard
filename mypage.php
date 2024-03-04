<?php
session_start();
require('dbconnect.php');

if (isset($_SESSION['id']) && $_SESSION['time'] + 3600 > time()) {
    $_SESSION['time'] = time();

    $members=$db->prepare('SELECT * FROM members WHERE id=?');
    $members->execute(array($_SESSION['id']));
    $member=$members->fetch();
} else {
//ログインしていない場合はトップページへ帰す
    header('Location: index.php');
    exit();
  }

//投稿を記録する
if (!empty($_POST)) {
     if ($_POST['post'] !=''){
           $post = $db -> prepare('INSERT INTO posts SET created_by=?, post=?, created=NOW()');
           $post ->execute (array(
            $member['id'],
            $_POST['post']
           ));
         //重複投稿を防ぐ
          header('Location:post.php');
          exit();
    }
}


//membersテーブルとpostテーブルから情報を取得して$posts変数に代入する
//ORDERBYで並べ換えて、DESCで降順に並べる
$posts = $db->query('SELECT m.name, p.* FROM members m, posts p WHERE m.id=p.created_by ORDER BY p.created DESC');

?>

<!DOCTYPE html>
<html lang= "ja">
<head>
<meta charset="UTF-8">
<title>みんなの晩ごはん</title>
<link rel="stylesheet" type="text/css" href="board.css">
</head>

<body>
<h1>マイページ/みんなの晩ごはん</h1>

<br>

<section class="toukou1">
    <form action="" method="post">
    <input type="hidden" name="token" value="<?=$token?>">
        <div class="edit">
        <p class="myname">
          <?php echo htmlspecialchars($member['name'], ENT_QUOTES); ?>さんのマイページです。
	</p>

         <p><a href="post.php">投稿画面へ戻る</a></p>

          <span class="logout"><a href="logout.php">ログアウト</a></span>
        </div>
</form>
</section>
<br>

<section class="toukou2">
     <h2>マイ投稿一覧</h2>

          <?php 
            foreach($posts as $post){
               if ($_SESSION['id'] !== $post['created_by']){
		       continue; 
                  }
                 echo htmlspecialchars($post['post'], ENT_QUOTES);

                 echo "<br>";
		 echo "【";
		 echo htmlspecialchars($member['name'], ENT_QUOTES);
		 echo "】　";
		 echo htmlspecialchars($post['created'], ENT_QUOTES);
	       

		 echo "【";
		 echo " <a href="."update_my.php?id=";
		 echo htmlspecialchars($post['id'], ENT_QUOTES);
		 echo ">編集</a> ";
                 echo "】";


		 echo "【";
		 echo "<a href="."delete_my.php?id=";
		 echo htmlspecialchars($post['id'], ENT_QUOTES);
		 echo "> 削除 </a>";
		 echo "】";

              echo "<br>";
              echo "<hr>";
}

?>


</section>

</body>
</html>
