<?php
include('config.php');
include('checklogin.php');
include('restrict.php');

$class_name = 'd-none';
$error = '';

if (isset($_POST['submit'])) {
    include('restrict.php');
    if ($_FILES['post_banner']['name'] !== '') {
        $image_type = $_FILES['post_banner']['type'];
        $image = $_FILES['post_banner']['tmp_name'];
        $image_type = explode('/', $image_type);
        $image_extension = $image_type['1'];
        $post_banner = explode('/', $_FILES['post_banner']['type']);
        $valid_extensions = array('png', 'jpg', 'jpeg');
        $post_title = mysqli_real_escape_string($conn, $_POST['post_title']);
        $post_content = mysqli_real_escape_string($conn, $_POST['post_content']);
        $post_category = mysqli_real_escape_string($conn, $_POST['post_category']);
        if (trim($post_title) && trim($post_content) && trim($post_category) !== '') {
            if ($_FILES['post_banner']['size'] <= 5000000) {
                if (in_array($image_extension, $valid_extensions)) {
                    $pid = random_int(111111, 999999);
                    $post_date = date('d M, Y');
                    $image_name = random_int(111111, 999999) . '.' . $post_banner['1'];
                    move_uploaded_file($image, "uploads/$image_name");
                    $sql = "INSERT INTO posts(pid, post_title, post_content, post_category, post_date, post_banner) VALUES('$pid', '$post_title', '$post_content', '$post_category', '$post_date', '$image_name')";

                    $res = $conn->query($sql);

                    header("Location: /blog/tutorial?pid=$pid");
                } else {
                    $error = 'Choose an jpg, jpeg or png format image !';
                    $class_name = 'd-block';
                }
            } else {
                $error = 'Image size must not be greater than 5MB !';
                $class_name = 'd-block';
            }
        } else {
            $error = 'Please check the values !';
            $class_name = 'd-block';
        }
    } else {
        $error = 'Please choose the image !';
        $class_name = 'd-block';
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
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
</head>

<body class="sb-nav-fixed">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="/blog/index">Online Tutorials</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" style="cursor: pointer;" href="dashboard">Dashboard<span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" style="cursor: pointer;" href="new-post">New Post<span class="sr-only"></span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" style="cursor: pointer;" href="posts">Posts<span class="sr-only"></span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" style="cursor: pointer;" href="categories">Categories<span class="sr-only"></span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" style="cursor: pointer;" href="admins">Admins<span class="sr-only"></span></a>
                </li>
            </ul>
            <ul class="navbar-nav ml-auto ml-md-0">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="userDropdown" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-user"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                        <a class="dropdown-item" href="profile">Profile</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="logout">Logout</a>
                    </div>
                </li>
            </ul>
        </div>
    </nav>
    <div class="container-fluid col-md-6 my-5 mx-auto">
        <div class="alert alert-danger alert-dismissible fade show <?php echo $class_name ?>" role="alert">
            <?php echo $error ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="post_title">Enter Post Title</label>
                <input type="text" class="form-control py-2" id="post_title" placeholder="Post Title" name="post_title">
            </div>
            <div class="form-group">
                <label for="post_content">Enter Post Content</label>
                <textarea class="form-control py-2" id="post_content" rows="7" placeholder="Post Content" name="post_content"></textarea>
            </div>
            <div class="form-group">
                <label for="post_banner">Choose Post Banner Image (jpg, png, jpeg, Max file size 5MB)</label>
                <input type="file" class="form-control-file" id="post_banner" name="post_banner">
            </div>
            <div class="form-group">
                <label for="categories">Choose post category</label>
                <select class="form-control py-2" id="categories" name="post_category">
                    <?php
                    $sql = "SELECT * FROM categories";
                    $res = $conn->query($sql);
                    if ($res->num_rows > 0) {
                        while ($row = $res->fetch_assoc()) {
                    ?>
                            <option value="<?php echo $row['cid'] ?>"><?php echo $row['name'] ?></option>

                    <?php
                        }
                    }
                    echo '<option value="0">uncategorized</option>';
                    ?>
                </select>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-block btn-danger py-2" value="Publish" name="submit">
            </div>
        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>
</body>

</html>
