<?php
define('DB_HOST', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'db_blog');

define('PASSWORD_SALT', '$2a$09$anefkbglvssgnggwarghhp$');

$conn = mysqli_connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);

if(!$conn){
    die("Cann't connect to database <br>".mysqli_connect_error($conn));
};

?>
