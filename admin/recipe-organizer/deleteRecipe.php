<?php
include ('header.php');
include ('../class/recipe_class.php');
$recipe = new Recipe();

session_start();
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $recipe->set('id', $id);
    $result = $recipe->delete();

    if ($result == 'success') {
        $msg = "Successfully deleted";
        header('location:listRecipe.php');
    } else {
        $error['msg'] = "Failed to delete the recipe";
        header('location:listRecipe.php');
    }
}
