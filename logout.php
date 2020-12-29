<?php
session_start();

$_SESSION = [];
session_unset();
session_destroy();

setcookie('id', '',time() - 60*60*24*30);
setcookie('key', '',time() - 60*60*24*30);

header ("Location: index.php");
exit;

?>