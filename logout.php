<?php

session_start();
$_SESSION['UserId'] = NULL;
header('Location: index.php');

?>