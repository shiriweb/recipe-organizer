<?php
session_start();
if (isset($_SESSION['username']) && isset($_COOKIE['username'])) {
    $username = $_SESSION['username'];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- <script src="jquery-3.7.1.min.js"></script> -->
    <link rel="stylesheet" href="../style/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

</head>

<body>


</html>
<div class="header">
    <div class="logo">
        <span class="first-title"><a href="index.php">The</span></a>
        <span class="second-title"><a href="index.php">Taste</span></a>
        <p class="third-title">The Nepali Culinary Art Repository</p>
    </div>
    <div class="navigation">
        <div class="navv">
            <nav>
                <a href="index.php" class="nav">Home</a>
                <a href="all.php" class="nav">Recipes</a>
                <a href="aboutLearn.php" class="nav">About </a>
            </nav>
        </div>
        <div class="search-bar">
            <input id="search" class="search" type="text" placeholder="Search Here">
            <div class="search-result">
               
            </div>
        </div>

        <?php if (!empty($_SESSION['username'])) { ?>

            <div class="signup">
                <a href="#" class=""><i class="fas fa-heart wishlist"></i></a>
                <a href="logout.php" class="nav" id="log-in">Log Out</a>
            </div>
        <?php } else { ?>
            <div class="signup">
                <a href="signin.php" class="nav" id="log-in">Sign Up</a>
            </div>
        <?php } ?>
    </div>

</div>
<!-- <script>
    $(document).ready(function() {

        $('#search').keyup(function(event) {
            var val = $('#search').val().trim();
            $.ajax({
                url: 'search.php',
                method: 'post',
                data: {
                    searchData: val
                },
                success: function(response) {
                    // displaySearch(response);
                    $('.search-result').empty();
                    if (response.length > 0) {
                        $('.search-result').append(response);
                        $('.search-result').css('display','block');
                    }
                },
                error: function(xhr, status, error) {
                    console.log('error:', error);
                }
            });
            console.log(val);
        });
        var search = document.querySelector('.search-bar');
        var searchData = document.querySelector('.search-result');
        toggleDisplay(search, searchData);
        // $('.search-result').css({
        //     'display': 'block'
        // });

        function toggleDisplay(className, subClassName) {
            document.addEventListener('click', (event) => {
                if (!className.contains(event.target)) {
                    subClassName.style.display = 'none';
                    document.getElementById('search').value = "";
                }

            });
        }
    });
</script> -->
</body>

</html>