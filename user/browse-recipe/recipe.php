<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- <link rel="stylesheet" href="../style/style.css"> -->
    <link rel="stylesheet" href="../style/recipe.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>

<body>
    <div class="recipe-container">
        <?php
        include ('header.php');
        ?>
        <h1>Delve into <small>Flavor</small> and explore Our <small>recipe</small> Library</h1>
        <div class="category">
            <a href="all.php"><button id="allButton">All</button></a>
            <a href="breakfast.php"><button id="breakfastButton">Breakfast</button></a>
            <a href="lunch.php"><button id="lunchButton">Lunch</button></a>
            <a href="snacks.php"><button id="snacksButton">Snacks</button></a>
            <a href="dinner.php"><button id="dinnerButton">Dinner</button></a>
            <a href="desert.php"><button id="desertButton">Dessert</button></a>
        </div>
    </div>
</body>

</html>