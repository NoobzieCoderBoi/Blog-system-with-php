<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Tutorials</title>
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/footer.css">
    <link rel="stylesheet" href="css/sidebar.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="icon" href="images/4-removebg-preview-150x150.png" sizes="32x32" />
    <link rel="icon" href="images/4-removebg-preview.png" sizes="192x192" />
</head>

<body>
    <?php
    include('header.php');
    ?>


    <div class="heading">
        <h1>Tutorial</h1>
    </div>

    <div class="m-container">
        <?php
        if (isset($_GET['pid'])) {
            $post = $_GET['pid'];
            $sql2 = "SELECT * FROM posts WHERE pid='$post'";
            $result = $conn->query($sql2);
            if ($result->num_rows > 0) {
                while ($content = $result->fetch_assoc()) {
        ?>
                    <div class="post-content">
                        <div class="banner">
                            <img src="admin/uploads/<?php echo $content['post_banner'] ?>">
                        </div>
                        <div class="content">
                            <?php
                            echo $content['post_content'];
                            ?>
                        </div>
                    </div>
            <?php
                }
            } else {
                echo '<div class="heading" style="margin: auto;"><h1>No Posts Found.</h1></div>';
            }
            ?>

        <?php
        } else {
        ?>

            <div class="posts">
                <?php
                if (isset($_GET['start'])) {
                    $current_page = $_GET['start'];
                } else {
                    $current_page = 1;
                }

                $slimit = 4;

                $offset = ($current_page - 1) * $slimit;

                if (isset($_GET['category'])) {
                    $category = $_GET['category'];
                    $sql = "SELECT * FROM posts WHERE post_category='$category' LIMIT $offset, $slimit";
                } else {
                    $sql = "SELECT posts.pid, posts.post_title, posts.post_content, categories.name, posts.post_date, posts.post_banner FROM posts INNER JOIN categories ON posts.post_category = categories.cid LIMIT $offset, $slimit";
                }

                $res = $conn->query($sql);
                if($res->num_rows > 0){
                while ($row = $res->fetch_assoc()) {
                ?>
                    <div class="post">
                        <a href="tutorial?pid=<?php echo $row['pid']; ?>">
                            <img src="admin/uploads/<?php echo $row['post_banner']; ?>">
                        </a>
                            <div class="p-text">
                                <div class="link">
                                    <a href="#"><?php echo $row['name']; ?></a>
                                    <span class="time-stamp"><?php echo $row['post_date']; ?></span>
                                </div>

                                <div class="p-title">
                                    <a href="tutorial?pid=<?php echo $row['pid']; ?>">
                                        <h2><?php echo $row['post_title']; ?></h2>
                                    </a>
                                </div>
                            </div>
                    </div>
                <?php
                }
            }else{
                echo '<div class="heading"><h1>No Posts Found</h1></div>';
            }
                ?>
            </div>

        <?php
        }
        ?>
        <?php
        include('sidebar.php');
        ?>
    </div>

    <?php
    if (!isset($_GET['pid'])) {
    ?>
        <?php
        $posts = "SELECT * FROM posts";
        $query = $conn->query($posts);

        if ($query->num_rows > 0) {
            $total_records = $query->num_rows;
            $total_pages = ceil($total_records / $slimit);
            $next = $current_page + 1;
            $prev = $current_page - 1;
            echo "<div class='pagination'>";
            for ($i = 1; $i <= $total_pages; $i++) {
                $class = '';
                if ($i == $current_page) {
                    $html = "<div class='btn active'>";
                    $html .= "<div><a href='javascript:void(0)' style='cursor:default'>$i</a></div>";
                    $html .= "</div>";
                    echo $html;
                } else {
                    $html = "<div class='btn'>";
                    $html .= "<div><a href='?start=$i'>$i</a></div>";
                    $html .= "</div>";
                    echo $html;
                }
            }
            echo "</div>";
        }
        ?>

    <?php
    }
    ?>
    <?php
    include('footer.php');
    ?>

</body>

</html>
