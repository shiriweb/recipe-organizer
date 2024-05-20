<?php
include ('../../admin/class/slider_class.php');

@session_start();
$sliderObj = new ImageSLider();
$datalist = $sliderObj->retrieve();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../style/slider.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>

<body>
    <div class="main">
        <?php foreach ($datalist as $key => $slider) { ?>
            <img src="../../admin/images/<?php echo $slider['image']; ?>" alt="" class="slide" height="400px" width="550px">
        <?php } ?>
        <!-- <p class="slogan">"Join our cooking community and journey together"</p> -->

        <div class="arrow">
            <button onclick="goPrev()">
                <i class="slider-arrow fas fa-angle-left" id="left"></i>
            </button>
            <button onclick="goNext()">
                <i class="slider-arrow fas fa-angle-right" id="right"></i>
            </button>
        </div>
    </div>
    <script src="../js/slider.js"></script>
</body>

</html>