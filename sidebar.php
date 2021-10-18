<div class="sidebar">
    <div class="search">
        <div class="label">
            <h2>Search Posts</h2>
        </div>
        <form action="search" method="GET">
            <div class="input">
                <input type="text" class="form-control" placeholder="Search ..." name="search">
            </div>

            <div class="submit">
                <input type="submit" value="Search" class="btn-submit mb-10">
            </div>
        </form>
    </div>
    <div class="social">
        <div class="label">
            <h2>Let’s Connect</h2>
        </div>
        <div class="icons">
            <a href="#"><i class="fa fa-facebook-square"></i></a>
            <a href="#"><i class="fa fa-twitter"></i></a>
            <a href="#"><i class="fa fa-instagram"></i></a>
            <a href="#"><i class="fa fa-youtube-play"></i></a>
        </div>
    </div>
    <div class="category">
        <div class="label">
            <h2>Category</h2>
        </div>
        <div class="text">
            <span>Categories</span>
        </div>
        <div class="categories">
            <ul>
            <?php
                $sql = "SELECT * FROM categories";
                $res = $conn->query($sql);
                if ($res->num_rows > 0){
                while($row = $res->fetch_assoc()){
            ?>
                <li><a href="tutorial?category=<?php echo $row['name'] ?>&start=1"><?php echo $row['name'] ?></a></li>

            <?php
                }
            }else{
                    echo '<div><p>No categoires found</p></div>';
                }
            ?>
            </ul>
        </div>
    </div>
</div>
