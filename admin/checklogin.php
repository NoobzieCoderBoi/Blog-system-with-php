<?php
session_start();
session_regenerate_id();
if(!$_SESSION['LOGGEDIN']){
    header('Location: index.php');
    die();
}
?>
