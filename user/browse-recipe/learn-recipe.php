<?php
include ('header.php');
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
    <link rel="stylesheet" href="../style/style.css">
</head>
<body>

<div class="recipe-details">
    <?php foreach ($datalist as $key =>$recipe) { ?>
        <div class="recipe-image">
            <img src="../../admin/images/<?php echo $recipe['image']; ?>">
        </div>
        <div class="recipe-title">
            <h1><?php echo $recipe['recipe_name']; ?></h1>
        </div>
        <div class="information">
            <span><i class="fas fa-clock"><?php echo $recipe['cooking_time']; ?></i></span>
            <span><i class="fas fa-clock"><?php echo $recipe['preparation_time']; ?></i></span>
            <span><i class="fas fa-serve"><?php echo $recipe['serving']; ?></i></span>
            <span><i class="fas fa-level"><?php echo $recipe['cooking_level']; ?></i></span>
        </div>
        <div class="description">
            <p><?php echo $recipe['description']; ?></p>
        </div>
        <div class="ingredients">
            <p><?php echo $recipe['ingredients']; ?></p>
        </div>
        <div class="nutritional_info">
            <p><?php echo $recipe['description']; ?></p>
        </div>

    <?php } ?>
</div>
</body>
</html>