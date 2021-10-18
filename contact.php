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
        <h1>Contact</h1>
    </div>

    <div class="contact-form">
        <div class="form">
            <div class="title">
                <h2>Get in Touch with Us</h2>
            </div>
            <form method="POST" class="form-group" id="contact-form" action="<?php echo $_SERVER['PHP_SELF'] ?>">
                <div class="form-control">
                    <label for="name">Your name *</label>
                    <input type="text" placeholder="Nice to meet" id="name" autocomplete="off" spellcheck="off" name="name" autofocus required>
                </div>
                <div class="form-control">
                    <label for="email">Email *</label>
                    <input type="email" placeholder="W'll reply to you" id="email" autocomplete="off" name="email" spellcheck="off" required>
                </div>
                <div class="form-control">
                    <label for="subject">Subject *</label>
                    <input type="text" name="subject" placeholder="Subject" id="subject" autocomplete="off" spellcheck="off" required>
                </div>
                <div class="form-control">
                    <label for="message">Message *</label>
                    <textarea id="message" name="message" rows="10" placeholder="Write something" autocomplete="off" spellcheck="off" required></textarea>
                </div>
                <div class="button">
                    <input type="submit" value="Send Message" name="send" id="send">
                </div>
            </form>
        </div>
        <?php
        include('sidebar.php');
        ?>
    </div>

    <?php
    include('footer.php');
    ?>

</body>

</html>
