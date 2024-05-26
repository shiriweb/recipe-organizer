<nav?php session_start(); ?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
        <link rel="stylesheet" href="../style/style.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    </head>

    <body>

    </body>

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
                <input type="text" placeholder="Search Here">
                <div class="search-result">

                </div>
            </div>

            <?php if (isset($_SESSION['username'])) { ?>

            <div class="signup">
                <a href="wishlist" class=""><i class="fas fa-heart wishlist"></i></a>
                <a href="logout.php" class="nav" id="log-in">Log Out</a>
            </div>
            <?php } else{ ?>
            <div class="signup">
                <a href="signin.php" class="nav" id="log-in">Sign Up</a>
            </div>
            <?php }?>


        </div>

    </div>
    </body>

    </html>