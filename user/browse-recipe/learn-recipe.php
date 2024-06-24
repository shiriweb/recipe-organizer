<?php
include('header.php');
include('../../admin/class/recipe_class.php');
include('../class/wishlist_class.php');

@session_start();
if (isset($_SESSION['message']) && $_SESSION['message'] !== "") {
    $message = $_SESSION['message'];
    $_SESSION['message'] = "";
}
$wishlist = new Wishlist();

$recipeObj = new Recipe();

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $recipeObj->set('id', $id);
    $datalist = $recipeObj->fetch();
    // echo $id;
}

$check = 0;
if (isset($_SESSION['id'])) {
    $wishlist->recipe_id = $_GET['id'];
    $wishlist->user_id = $_SESSION['id'];
    $check = $wishlist->checkWishlist();
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
    <script src="../js/script.js"></script>
    
    <!-- material icon  -->
    <link href="https://fonts.googleapis.com/css2?family=Material+Icons+Outlined" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.min.js"></script>

</head>

<body>
    <div class="recipe-details">
        <?php foreach ($datalist as $key => $recipe) { ?>

            <div class="learn-content">

                <div class="description">
                    <div class="recipe-title">
                        <h1><?php echo $recipe['recipe_name']; ?></h1>
                    </div>
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
                <div class="line ">
                    <?php if ($check == 1) { ?>
                    <button id="wishlist"><a href="javascript:void(0)" class="btn"><span id="favorite"
                                class="material-icons-outlined">favorite</span>Wishlist</a></button>
                    <?php } else { ?>
                    <button id="wishlist"><a href="javascript:void(0)" class="btn"><span id="favorite"
                                class="material-icons-outlined">favorite_border</span>Wishlist</a></button>
                    <?php } ?>
                </div>
            </div>

            <div class="learn-more">
                <h1>Ingredients</h1>
                <hr>
                <p><?php echo $recipe['ingredients']; ?></p>

                <br>
                <h1>Instructions</h1>
                <hr>
                <p><?php echo $recipe['instructions'] ?></p>

                <br>
                <h1>Nutritional Information</h1>
                <hr>
                <p><?php echo $recipe['nutritional_info']; ?></p>
            </div>
        <?php } ?>
    </div>
    <div class="submit-area">
        <input type="hidden" name="id" id="recipe_id" value="<?php echo $_GET['id']; ?>">
        <?php if (isset($_SESSION['id'])) { ?>
            <input type="hidden" name="user_id" id="user_id" value="<?php echo $_SESSION['id'];  ?>">
        <?php } ?>
    </div>
    <script>
        $(document).ready(function(){
            var recipe_id = $('#recipe_id').val();
            var user_ids = $('#user_id').val();


            $('#wishlist').click(function(e) {
        e.preventDefault();
        console.log('user Id: ', user_ids);
        if (!user_ids) {
            alert('Please log in to add to wishlist');
            return;
        } else {
            if ($('#favorite').text() === 'favorite') {
                var status = 'delete';
                $('#favorite').html('favorite_border');
            } else {
                var status = 'insert';
                $('#favorite').html('favorite');
            }
            $.ajax({
                url: 'checkWishlist.php',
                method: 'POST',
                data: {
                    status: status,
                    recipe_id: recipe_id,
                    user_id: user_ids
                },
                success: function(response) {
                    var result = JSON.parse(response);
                    console.log(result.message)
                    alert(result.message);
                },
                error: function(xhr, status, error) {
                    console.log('error: ', error);
                    // console.log(xhr.responseText)
                }
            })
        }
    });
        })
    </script>

</body>

</html>