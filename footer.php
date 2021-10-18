<div class="footer">
    <div class="info ml">
        <h2>Online Tutorials</h2>
        <div class="text">
            <p>Online Tutorials assure its viewers, it lacks for nothing in the field of frontend coding. Online Tutorial is a web designing website, with effective video tutorial on frontend development languages such as HTML, CSS, JavaScript etc. Earning good reputation as a designer isn’t enough. Commitment & engaging with our viewers is what make Online Tutorial, a free web designing resource.</p>
        </div>
    </div>
    <div class="recent-posts ml">
        <h2>Recent Posts</h2>
        <div class="rposts">
            <?php

            $sql = "SELECT * FROM posts LIMIT 4";

            $res = $conn->query($sql);
            if($res->num_rows > 0){
            while ($row = $res->fetch_assoc()) {
            ?>
                <ul>
                    <i class="fa fa-angle-right"></i>
                    <li>
                        <a href="tutorial?pid=<?php echo $row['pid'] ?>"><?php echo $row['post_title'] ?></a>
                        <span class="date"><?php echo $row['post_date'] ?></span>
                    </li>
                </ul>

            <?php
            }
        }else{
            echo '<p>No Posts Found</p>';
        }
            ?>
        </div>
    </div>
    <div class="contact ml">
        <h2>Contacts</h2>
        <div class="contacts">
            <div class="mail">
                <i class="fa fa-envelope"></i> <a href="mailto:webmaster@localhost">webmaster@localhost</a>
            </div>
            <div class="location">
                <i class="fa fa-map-marker"></i> <a href="https://goo.gl/maps/hS9sgBEs1vQ4nYa17">India</a>
            </div>
            <div class="icons">
                <div class="bg-black">
                    <a href="#"> <i class="fa fa-facebook-square"></i></a>
                </div>
                <div class="bg-black">
                    <a href="#"> <i class="fa fa-youtube-play"></i></a>
                </div>
                <div class="bg-black">
                    <a href="#"><i class="fa fa-instagram"></i></a>
                </div>
                <div class="bg-black">
                    <a href="#"><i class="fa fa-twitter"></i></a>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="fbar">
    <div class="links">
        <ul>
            <li><a href="home">Home</a></li>
            <li><a href="terms">Terms & Conditions</a></li>
            <li><a href="about">About</a></li>
            <li><a href="contact">Contact</a></li>
        </ul>
    </div>

    <div class="copy">
        <p>Copyright © 2020 Online Tutorials. All Rights Reserved.</p>
    </div>
</div>
<script src="js/jquery-3.5.1.min.js"></script>
<script src="js/ajax.js"></script>
<script type="text/javascript">
    let menu = document.querySelector('.menu-icon');
    let navbar = document.querySelector('.navigation');
    menu.addEventListener('click', function() {
        navbar.classList.toggle('active');
    });
</script>
