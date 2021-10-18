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
    <link rel="stylesheet" href="css/search.css">
    <link rel="icon" href="images/4-removebg-preview-150x150.png" sizes="32x32" />
    <link rel="icon" href="images/4-removebg-preview.png" sizes="192x192" />
</head>

<body>
    <?php
    include('header.php');
    ?>
    <?php
    if (!isset($_GET['search'])) {
    ?>
        <div class="search-container">
            <form method="GET" class="form-group">
                <div class="form-control">
                    <input type="text" name="search" placeholder="Search ...">
                </div>
                <input type="submit" class="btn-submit" value="Search">
            </form>
        </div>

    <?php
    } else {
        $search_term = $_GET['search'];
    ?>
        <div class="heading">
            <h2>Search results for: <?php echo $search_term ?></h2>
        </div>
        <div style="display: flex; justify-content:center; align-items: center; margin-bottom: 20px;"><a href="search.php">Search again?</a></div>
        <div class="posts" style="margin: auto !important;">
            <?php
            if(isset($_GET['start'])){
                $current_page = 1;
            }else{
                $current_page = $_GET['start'];
            }
            $slimit = 1;
            $offset = ($current_page - 1) * $slimit;
            $sql = "SELECT posts.pid, posts.post_title, posts.post_content, categories.name, posts.post_date, posts.post_banner FROM posts INNER JOIN categories ON posts.post_category = categories.cid WHERE posts.post_title LIKE '%$search_term%' LIMIT $offset,$slimit";
            $res = mysqli_query($conn, $sql);
            if (mysqli_num_rows($res) > 0) {
                while ($row = mysqli_fetch_assoc($res)) {
            ?>
                    <div class="post">
                        <img src="admin/uploads/<?php echo $row['post_banner']; ?>">
                        <div class="p-text">
                            <div class="link">
                                <a href="#"><?php echo $row['name']; ?></a>
                                <span class="time-stamp"><?php echo $row['post_date']; ?></span>
                            </div>

                            <div class="p-title">
                                <a href="tutorial.php?pid=<?php echo $row['pid']; ?>">
                                    <h2><?php echo $row['post_title']; ?></h2>
                                </a>
                            </div>
                        </div>
                    </div>
            <?php
                }
            } else {
                echo '<div class="heading"><h1>No results found.</h1></div>';
            }
            ?>
        </div>
    <?php
    }
    ?>
        <?php
        if(isset($_GET['search'])){
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
