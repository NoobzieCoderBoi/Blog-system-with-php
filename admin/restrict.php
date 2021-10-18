<?php
$username = $_SESSION['USERNAME'];
$restrict_user_query = "SELECT * FROM admins WHERE username='$username'";
$user_details = $conn->query($restrict_user_query);
$details = $user_details->fetch_assoc();
$role = $details['role'];

if($role != 'admin'){
    die('Permision denied for this user');
    exit;
}
?>
