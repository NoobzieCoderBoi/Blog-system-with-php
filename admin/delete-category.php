<?php
include('config.php');
include('checklogin.php');
include('restrict.php');
if(isset($_GET['cid'])){
    $category_id = mysqli_real_escape_string($conn,$_GET['cid']);
    $delete_category_sql = "DELETE FROM categories WHERE cid='$category_id'";
    $delete_category_res = $conn->query($delete_category_sql);
    header('Location: categories.php');
}
?>
