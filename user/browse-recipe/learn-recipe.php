<?php
// include ('header.php');
include ('../../admin/class/recipe_class.php');

@session_start();
if (isset($_SESSION['message']) && $_SESSION['message'] !== "") {
    $message = $_SESSION['message'];
    $_SESSION['message'] = "";
}

$recipeObj = new Recipe();

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $recipeObj->set('id', $id);
    $datalist = $recipeObj->fetch();
    // echo $id;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../style/recipe.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

</head>

<body>
    <div class="recipe-details">
        <?php foreach ($datalist as $key => $recipe) { ?>

            <div class="learn-content">
                <div class="recipe-title">
                    <h1><?php echo $recipe['recipe_name']; ?></h1>
                </div>
                <div class="description">
                    <p><?php echo $recipe['description']; ?></p>
                </div>
                <div class="recipe-image">
                    <img src="../../admin/images/<?php echo $recipe['image']; ?>">
                </div>
            </div>
            <div class="learn-information">
                <div class="info-content">
                    <label> Preparation Time:</label>
                    <span><i class="fas fa-clock"> <?php echo $recipe['preparation_time']; ?></i></span>
                </div>
                <div class="info-content">
                    <label> Cooking Time:</label>
                    <span><i class="fas fa-clock"> <?php echo $recipe['cooking_time']; ?></i></span>
                </div>

                <div class="info-content">
                    <label> Serving:</label>
                    <span><i class="fas fa-utensils"> <?php echo $recipe['serving']; ?></i></span>
                </div>

                <div class="info-content">
                    <label> Cooking Level:</label>
                    <span><i class="fas fa-star"> <?php echo $recipe['cooking_level']; ?></i></span>
                </div>
            </div>

            <div class="learn-more">
                    <h1>Ingredients</h1><hr>
                    <p><?php echo $recipe['ingredients']; ?></p>
                
                <br>
                <h1>Instructions</h1><hr>
                    <p><?php echo $recipe['instructions'] ?></p>
                
                <br>
            <h1>Nutritional Information</h1><hr>
                <p><?php echo $recipe['nutritional_info']; ?></p>
            </div>
            </div>

        <?php } ?>
    </div>
    </div>
</body>

</html>