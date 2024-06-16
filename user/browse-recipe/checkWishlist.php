<?php
include('../class/wishlist_class.php');
include('../../admin/class/recipe_class.php');

$wishlist = new Wishlist();
if (isset($_POST['user_id'])) {
    if (gettype($_POST['user_id']) === 'string') {
        $wishlist->user_id = $_POST['user_id'];
        if (isset($_POST['status'])) {
            $wishlist->recipe_id = filter_input(INPUT_POST, "recipe_id", FILTER_SANITIZE_NUMBER_INT);
            $status = $_POST['status'];
            switch ($status) {
                case 'insert':
                    $result = $wishlist->save();
                    if ($result == 1) {
                        $response = ['status' => 'success', 'message' => 'Added to wishlist'];
                    } else {
                        $response = ['status' => 'failed', 'message' => 'Please try again!!'];
                    }
                    break;
                case 'delete':
                    $result = $wishlist->delete();
                    if ($result == 1) {
                        $response = ['status' => 'success', 'message' => 'Removed from wishlist'];
                    } else {
                        $response = ['status' => 'failed', 'message' => 'Please try again!!'];
                    }
                    break;
            }
            echo json_encode($response);
            return;
        }

        $res = $wishlist->fetchById();
        if (is_array($res)) {
            $result = 1;
        }
        $recipe_id = $wishlist->getrecipeId();
        // echo $recipe_id;
    }
} else {
    header('HTTP/1.0 400 Bad Request');
    echo json_encode(["status" => "error", "message" => "Log in to use wishlist"]);
    exit;
}

?>
<div id="wishlist" class="section">
    <?php if (isset($result)) { ?>
        <div class="head-title">
            <h3>My Wishlist</h3>
        </div>
        <div class="recipes">
            <?php foreach ($res as $key => $recipe) { ?>
                <div class="recipe-box" id="recipe_<?php echo $recipe['id']; ?>">

                    <div class="recipe-image">
                        <img src="../../admin/images/<?php echo $recipe['image']; ?>">
                    </div>

                    <div class="recipe-title">
                        <h1><?php echo $recipe['recipe_name']; ?></h1>
                    </div>
                    <div class="short_details">
                        <?php echo $recipe['short_details']; ?>
                    </div>
                    <div class="learn">
                        <a href="learn-recipe.php?id=<?php echo $recipe['id']; ?>" target="_blank">Learn More<i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
            <?php } ?>

        </div>
    <?php } else { ?>
        <div class="collection">
            <h2 style="color: #c5afaf;">No items in your Wishlist.</h2>
        </div>
    <?php } ?>
</div>