<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>

<body>
    <!-- first layout -->
    <div class="banner">
        <?php
        include ('header.php');
        ?>
        <?php
        include ('content.php');
        ?>
    </div>
    <!-- second layout -->
    <div class="aboutus">
        <?php
        include ('about_us.php');
        ?>
        <!-- <div class="about-learn">
            <a href="aboutLearn.php">Learn More</a>
        </div> -->
    </div>
    <!-- third layout -->
    <div class="recent-recipe">
        <?php
        include ('recentlyAdded.php');
        ?>
    </div>
</body>

</html>