<?php
session_start();
session_regenerate_id();
unset($_SESSION['LOGGEDIN']);
unset($_SESSION['USERNAME']);
header('Location: index.php');
die();
?>
