<?php
session_start();
require('dbconnect.php');

if (isset($_SESSION['id']) && $_SESSION['time'] + 3600 > time()) {
    $_SESSION['time'] = time();

    $members=$db->prepare('SELECT * FROM members WHERE id=?');
    $members->execute(array($_SESSION['id']));
    $member=$members->fetch();
  } else {
    header('Location: update_do_my.php');
    exit();
  }

//投稿を取得する
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
<h1>投稿内容を編集する</h1>

<?php
if (isset($_REQUEST['id']) && is_numeric($_REQUEST['id'])) {
    $id = $_REQUEST['id'];
    $edit = $db -> prepare('SELECT * FROM posts WHERE id=?');
    $edit ->execute(array($id));
    $result = $edit ->fetch();
 }
?>

<section class="toukou1">
    <form action="update_do_my.php" method="post">
    <input type="hidden" name="id" value="<?php echo($id); ?>">
        <div class="edit">
        <textarea name="post" cols='50' rows='5'><?php if (!empty($result['post'])) echo(htmlspecialchars($result['post'], ENT_QUOTES)); ?>
        </textarea>
        </div>
       <input type="submit" value="変更する" class="button02">
</form>
</section>

</body>
</html>
