<?php
include ('../../admin/class/recipe_class.php');
// include('header.php');
// include('recipe.php');

$recipeObj = new Recipe();
$datalist = $recipeObj->recentlyAdded();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../style/recentadded.css">
    <link rel="stylesheet" href="../style/style.css">
</head>

<body>
    <div class="recipe-container">
        <h1>Recently <small>Added</small> Recipes</h1>
        <hr>

    </div>
    <div class="recipes">
        <?php foreach ($datalist as $key => $recipe) { ?>
            <div class="recipe-box" id="recipe<?php echo $recipe['id']; ?>">

                <div class="recipe-image">
                    <img class="image_recipe" src="../../admin/images/<?php echo $recipe['image']; ?>">
                </div>
                <div class="recipe-title">
                    <h1><?php echo $recipe['recipe_name']; ?></h1>
                </div>
                <div class="short_details">
                    <?php echo $recipe['short_details']; ?>
                </div>
                <div class="learn">
                    <a href="learn-recipe.php?id=<?php echo $recipe['id'] ?>" target="_blank">Learn More <i
                            class="fas fa-arrow-right"></i>
                    </a>
                </div>
            </div>
        <?php } ?>
    </div>
    </div>

    <div class="about-learn">
        <a href="all.php">Explore Recipes</a>
    </div>
</body>

</html>