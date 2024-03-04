<?php
session_start();

//セッション変数を解除する
$_SESSION = array();

//セッションを切断するにはセッションクッキーも削除する
//セッション情報だけでなくセッションを破壊destroyする
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
     $params["path"], $params["domain"],
     $params["secure"], $params["httponly"]
    );
}
session_destroy();

//cookie情報も削除
//有効期限を一時間前-3600に設定する
setcookie('email', '', time()-3600);
setcookie('password', '', time()-3600);

header('Location: index.php');
exit();
?>

