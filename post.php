<?php
session_start();
require('dbconnect.php');

if (isset($_SESSION['id']) && $_SESSION['time'] + 3600 > time()) {
    //ログインしている場合、今の時間で上書きして60分間ログインが有効     
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
           $post = $db ->prepare('INSERT INTO posts SET created_by=?, post=?, created=NOW()');
           $post ->execute (array(
            $member['id'],
            $_POST['post']
       ));
     //重複投稿を防ぐ
       header('Location:post.php');
       exit();
    }
   }

//投稿を取得する・ページング設置
//posts変数に2つのテーブルから取り出した名前とポストの内容を代入する
if (isset($_REQUEST['page']) && is_numeric($_REQUEST['page'])) {
    $page = $_REQUEST['page'];
   } else {
    $page = 1;
}

$start = 5 * ($page - 1);
$posts = $db->prepare('SELECT m.name, p.* FROM members m, posts p WHERE m.id=p.created_by ORDER BY p.created DESC LIMIT ?, 5');
$posts ->bindParam(1, $start, PDO::PARAM_INT);
$posts ->execute();

?>

<!DOCTYPE html>
<html lang= "ja">
<head>
<meta charset="UTF-8">
<title>みんなの晩ごはん</title>
<link rel="stylesheet" type="text/css" href="board.css">
</head>

<body>
<h1>みんなの晩ごはん投稿画面</h1>

<br>
<section class="toukou1">
    <form action="" method="post">
    <input type="hidden" name="token" value="<?=$token?>">
        <div class="edit">
        <p class="myname">
          <?php echo htmlspecialchars($member['name'], ENT_QUOTES); ?>さん、ようこそ
	</p>
	<p>
          <a href="mypage.php">マイページはこちら</a>
        </p>
        <p>
          <span class="logout"><a href="logout.php">ログアウト</a></span>
        </p>
	  <textarea name="post" cols='50' rows='5'></textarea>
        </div>
       <input type="submit" value="投稿する" class="button02">
</form>
</section>

<br>

<section class="toukou2">
     <h2>投稿一覧</h2>

       <?php foreach($posts as $post): ?>

	   <div class="post">
              <p><?php echo htmlspecialchars($post['post'], ENT_QUOTES); ?></p>
              <p class="day">
              【<span class="name"><?php echo htmlspecialchars($post['name'], ENT_QUOTES); ?>】
	      </span>
	       <?php echo htmlspecialchars($post['created'], ENT_QUOTES); ?>
               <?php if($_SESSION['id'] == $post['created_by']): ?>
               【<a href="update.php?id=<?php echo htmlspecialchars(trim($post['id'], ENT_QUOTES)); ?>">編集</a>】
               <?php endif; ?>
	       <?php if($_SESSION['id'] == $post['created_by']): ?>
               【<a href="delete.php?id=<?php echo htmlspecialchars($post['id'], ENT_QUOTES); ?>">削除</a>】
	       <?php endif; ?>
             </p>
	   </div>
      <hr>
<?php endforeach; ?>

<?php if ($page >=2): ?>
<a href="post.php?page=<?php print($page-1); ?>"><?php print($page-1); ?>ページ目へ</a>
<?php endif; ?>

｜

<?php
$counts = $db->query('SELECT COUNT(*) AS cnt FROM posts');
$count = $counts->fetch();
$max_page = ceil($count['cnt'] / 5);
if($page < $max_page):
?>
<a href="post.php?page=<?php print($page+1); ?>"><?php print($page+1); ?>ページ目へ</a>
<?php endif; ?>

</section>

</body>
</html>
