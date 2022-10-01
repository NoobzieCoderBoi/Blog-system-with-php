<?php
include('config.php');
include('checklogin.php');
include('restrict.php');
if(isset($_GET['pid'])){
    $post_id = mysqli_real_escape_string($conn,$_GET['pid']);
    $delete_post_sql = "DELETE FROM posts WHERE pid='$post_id'";
    $post_image = "SELECT * FROM posts WHERE pid='$post_id'";
    $result = $conn->query($post_image);
    $row = $result->fetch_assoc();
    $row['post_banner'];
    unlink("uploads/".$row['post_banner']);
    $delete_post_res = $conn->query($delete_post_sql);
    header('Location: posts');
}else{
    header('Location: posts');
}
