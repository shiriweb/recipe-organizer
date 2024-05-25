<?php
include ('../../admin/class/recipe_class.php');
include ('recipe.php');

@session_start();
if (isset($_SESSION['message']) && $_SESSION['message'] = !"") {
    $message = $_SESSION['message'];
    $_SESSION['message'] = "";
}

$recipeObj = new Recipe();
$datalist = $recipeObj->dinner();
// print_r($datalist);

?>

<div class="recipes">
    <?php foreach ($datalist as $key => $recipe) { ?>
        <div class="recipe-box" id="recipe_<?php echo $recipe['id']; ?>">

            <div class="recipe-image">
                <img src="../../admin/images/<?php echo $recipe['image']; ?>">
            </div>
            <!-- <div class="information">
                <span><i class="fas fa-clock"><?php echo $recipe['cooking_time']; ?></i><span>
            </div> -->
            <div class="recipe-title">
                <h1><?php echo $recipe['recipe_name']; ?></h1>
            </div>
            <div class="short_details">
                <?php echo $recipe['short_details']; ?>
            </div>
            <div class="learn">
                <a href="learn-recipe.php?id=<?php echo $recipe['id'];?>" target="_blank">Learn More<i class="fas fa-arrow-right"></i>
                </a>
            </div>
        </div>
    <?php } ?>
</div>
</div>