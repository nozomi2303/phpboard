<?php
try {
	$db = new PDO ('mysql:dbname=  ;host=  ; charset=utf8', 'admin', '   ');
} catch(PDOException $e) {
	echo 'DB接続エラー' . $e->getMessage();
}
?>
