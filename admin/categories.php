<?php
include('config.php');
include('checklogin.php');

if (isset($_POST['submit_category'])) {
    include('restrict.php');
    $category_name = mysqli_real_escape_string($conn, $_POST['category_name']);
    $cid = random_int(111111, 999999);
    $check_category_sql = "SELECT * FROM categories WHERE name='$category_name'";
    $category_result = $conn->query($check_category_sql);
    $category_error = '';
    $category_error_class = '';
    if ($category_result->num_rows > 0) {
        $category_error = 'Category already exists';
        $category_error_class = 'is-invalid';
    } else {
        $insert_category_sql = "INSERT INTO categories(cid, name) VALUE ('$cid', '$category_name')";
        $insert_category = $conn->query($insert_category_sql);
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Admin Panel - Online Tutorials</title>
    <link href="dist/css/styles.css" rel="stylesheet" />
    <link rel="stylesheet" href="css/admin.css">
    <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="/blog/index.php">Online Tutorials</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>


        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" style="cursor: pointer;" href="dashboard.php">Dashboard<span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" style="cursor: pointer;" href="new-post.php">New Post<span class="sr-only"></span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" style="cursor: pointer;" href="posts.php">Posts<span class="sr-only"></span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" style="cursor: pointer;" href="categories.php">Categories<span class="sr-only"></span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" style="cursor: pointer;" href="admins.php">Admins<span class="sr-only"></span></a>
                </li>
            </ul>
            <ul class="navbar-nav ml-auto ml-md-0">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="userDropdown" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-user-alt"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                        <a class="dropdown-item" href="profile.php">Profile</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="logout.php">Logout</a>
                    </div>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container my-4">
        <table class="table table-bordered table-hover text-center">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">Category ID</th>
                    <th scope="col">Category Name</th>
                    <th scope="col">Posts</th>
                    <th scope="col">Delete</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <?php
                    $sql = "SELECT * FROM categories";
                    $res = $conn->query($sql);

                    if ($res->num_rows > 0) {
                        while ($row = $res->fetch_assoc()) {
                    ?>
                            <th scope="row"><?php echo $row['cid'] ?></th>
                            <td><a href="/blog/tutorial.php?category=<?php echo $row['name'] ?>" target="_blank"><?php echo $row['name'] ?></a></td>
                            <td><?php echo $row['posts'] ?></td>
                            <td><a href="delete-category.php?cid=<?php echo $row['cid'] ?>" class="btn btn-danger">Delete</a></td>
                </tr>
        <?php
                        }
                    } else {
                        $html = '<td>No Categories Found</td>';
                        $html .= '<td>No Categories Found</td>';
                        $html .= '<td>No Categories Found</td>';
                        $html .= '<td>No Categories Found</td>';
                        echo $html;
                    }
        ?>
            </tbody>
        </table>
        <form method="POST" class="my-4 col-md-6 py-4">
            <div class="form-group">
                <label for="category_name">Enter Category Name</label>
                <input type="text" class="form-control <?php echo $category_error_class ?>" id="category_name" placeholder="Category Name" name="category_name">
                <span class="invalid-feedback"> <?php echo $category_error ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary py-2" value="Add Category" name="submit_category">
            </div>
        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>
</body>

</html>
