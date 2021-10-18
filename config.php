<?php
define('DB_HOST', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'db_blog');

$conn = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);

if($conn->connect_error){
    die("Cann't connect to database <br>". $conn->connect_error);
};

?>
