<?php
include ('header.php');
include ('sidebar.php');
include ('../class/recipe_class.php');
include ('../class/category_class.php');

@session_start();
if (isset($_SESSION['message']) && $_SESSION['message'] != "") {
    $message = $_SESSION['message'];
    $_SESSION['message'] = "";
}

$category = new Category();
$categoryList = $category->retrieve();

$recipeObj = new Recipe();
$datalist = $recipeObj->retrieve();


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .action{
            display: flex;
        }
    </style>
</head>
<body>
<div class="recipe">
    <div class="row">
        <div class="heading">
            <p>List Recipe</p>
            <a href="createRecipe.php" class="create-button"><i class="fas fa-plus-circle"></i> Create Recipe</a>

        </div>
    </div>
    <?php
    if (isset($message)) {
        echo '<div class="alert alert-success">' . $message . '</div>';
    }
    ?>
    <div class="row">
        <div class="headings">
            <table width="200%" id="recipetable">
                <thead>
                    <tr>
                        <th>S.No</th>
                        <th>Recipe Name</th>
                        <th>Total Time</th>
                        <th>Preparation Time</th>
                        <th>Cooking Time</th>
                        <th>Cooking Level</th>
                        <th>Servings</th>
                        <th>Image</th>
                        <th>Category</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <div class="list">
                        <?php foreach ($datalist as $key => $recipe) { ?>
                            <tr class="">
                                <td><?php echo $key + 1; ?></td>
                                <td><?php echo $recipe['recipe_name']; ?></td>
                                <td><?php echo $recipe['total_time']; ?></td>
                                <td><?php echo $recipe['preparation_time']; ?></td>
                                <td><?php echo $recipe['cooking_time']; ?></td>
                                <td><?php echo $recipe['cooking_level']; ?></td>
                                <td><?php echo $recipe['serving']; ?></td>
                                <td><img height='100' width='100' src="../images/<?php echo $recipe['image']; ?>" alt=""
                                        srcset=""></td>
                                <td><?php echo $recipe['category']; ?></td>

                                <td class="action">
                                    <div>
                                        <a class="edit" href="editRecipe.php ? id=<?php echo $recipe['id']; ?>"> <i
                                                class="fas fa-edit"></i></a>
                                    </div>
                                    <div>
                                        <a class="delete" href="deleteRecipe.php ? id=<?php echo $recipe['id']; ?>"> <i
                                                class="fas fa-trash"></i></a>
                                    </div>
                                </td>
                            </tr>
                        <?php } ?>
                    </div>
                </tbody>
            </table>
        </div>
    </div>
</div>

</body>
</html>
