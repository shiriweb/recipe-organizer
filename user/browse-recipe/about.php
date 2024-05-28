<?php
include ('../../admin/class/aboutus_class.php');
$about = new About();
$datalist = $about->retrieve();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../style/aboutus.css">
</head>

<body>
    <div class="aboutus">
        <?php foreach ($datalist as $key => $about_us) { ?>

            <div class="about">
                <div class="featured-image">
                    <div class="image1">
                        <img src="../../admin/images/<?php echo $about_us['image1']; ?>">
                    </div>
                </div>
                <div class="aboutus-details">
                    <div class="aboutus-heading">
                        <h1>About <small class="about-text">Us</small></h1>
                    </div>
                    <p> <?php echo $about_us['short_detail']; ?></p>

                </div>

            </div>
        <?php } ?>
    </div>

</body>

</html>