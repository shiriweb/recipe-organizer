<?php
// include ('header.php');
include ('sidebar.php');
include ('../class/category_class.php');
include ('../class/recipe_class.php');

$category = new Category();
$categoryList = $category->retrieve();

$recipe = new Recipe();

@session_start();
if (isset($_POST['submit'])) {
    $recipe->set('recipe_name', $_POST['recipe_name']);
    $recipe->set('total_time', $_POST['cooking_time']);
    $recipe->set('preparation_time', $_POST['cooking_time']);
    $recipe->set('cooking_time', $_POST['cooking_time']);
    $recipe->set('cooking_level', $_POST['cooking_level']);
    $recipe->set('serving', $_POST['serving']);
    $recipe->set('ingredients', $_POST['ingredients']);
    $recipe->set('instructions', $_POST['instructions']);
    $recipe->set('short_details', $_POST['short_details']);
    $recipe->set('description', $_POST['details']);
    $recipe->set('nutritional_info', $_POST['nutritional_info']);
    $categories = implode(',', $_POST['category']);
    $recipe->set('category', $categories);
    $recipe->set('created_date', date('Y-m-d H:i:s'));

    if (isset($_FILES['image'])) {
        $file_name = $_FILES['image']['name'];
        $file_size = $_FILES['image']['size'];
        $file_tmp = $_FILES['image']['tmp_name'];
        $file_type = $_FILES['image']['type'];

        if (move_uploaded_file($file_tmp, "../images/" . $file_name)) {
            // echo "Successfully uploaded";
            $recipe->set('image', $file_name);
        } else {
            echo "Error uploading files";

        }
    }

    $result = $recipe->save();
    if (is_integer($result)) {
        $msg = "Recipe inserted successfully with id" . $result;
    } else {
        $msg = "Please fill";
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="../../ckeditor/ckeditor.js"></script>
    <style>
        .ck.ck-editor__editable {
            min-height: 150px;
            width: 492px;
            padding-left: 20px;
            /* padding: 10px 30px 0px 50px; */
        }

        .ck.ck-toolbar {
            width: 512px;
            /* padding: 30px; */
        }
    </style>
</head>

<body>
    <div class="recipe">
        <div class="row">
            <div class="heading">
                <p>Create Recipes</p>
                <a href="listRecipe.php" class="create-button"><i class="fas fa-list-ul"></i>List Recipe</a>
            </div>
        </div>

        <div class="headings">
            <!-- error msg -->
            <?php if (isset($msg)) { ?>
                <div class="message1"><?php echo $msg; ?></div>
            <?php } ?>
            <?php if (isset($ErrMsg)) { ?>
                <div class="message2"><?php echo $ErrMsg; ?></div>
            <?php } ?>

            <form action="" method="post" enctype="multipart/form-data" novalidate>
                <fieldset>
                    <div class="recipe-content">
                        <div class="content">

                            <div class="form-grp">
                                <label>Recipe Name</label><br>
                                <input type="text" class="form_input" name="recipe_name" id="recipe_name" required>
                            </div>

                            <div class="form-grp">
                                <label>Total Time</label><br>
                                <input type="text" class="form_input" name="cooking_time" id="cooking_time" required>
                            </div>

                            <div class="form-grp">
                                <label>Preparation Time</label><br>
                                <input type="text" class="form_input" name="cooking_time" id="cooking_time" required>
                            </div>

                            <div class="form-grp">
                                <label>Cooking Time</label><br>
                                <input type="text" class="form_input" name="cooking_time" id="cooking_time" required>
                            </div>

                            <div class="form-grp">
                                <label>Cooking Level</label><br>
                                <input type="text" class="form_input" name="cooking_level" id="cooking_level" required>
                            </div>

                            <div class="form-grp">
                                <label>Serving</label><br>
                                <input type="number" class="form_input" name="serving" id="serving" required>
                            </div>



                            <div class="form-grp">
                                <label for="ingredients">Ingredients</label><br>
                                <textarea name="ingredients" id="ingredients" class="form_input" cols="60" rows="30"
                                    required></textarea>
                                <script>
                                    ClassicEditor
                                        .create(document.querySelector('#ingredients'))
                                        .catch(error => {
                                            console.error(error);
                                        });
                                </script>
                            </div>



                            <div class="form-grp">
                                <label for="detail">Preparation Instruction</label><br>
                                <textarea id="instruction" name="instructions" class="form_input" cols="60" rows="30"
                                    required></textarea>

                                <script>
                                    ClassicEditor
                                        .create(document.querySelector('#instruction'))
                                        .catch(error => {
                                            console.error(error);
                                        });
                                </script>
                            </div>
                            <div class="form-grp">
                                <label>Short Details</label><br>
                                <textarea name="short_details" class="form_input" id="short_details" cols="6" rows="8"
                                    required></textarea>
                            </div>

                            <div class="form-grp">
                                <label>Description</label><br>
                                <textarea name="details" class="form_input" id="details" cols="6" rows="8"
                                    required></textarea>
                            </div>

                            <div class="form-grp">
                                <label>Nutritional Information</label><br>
                                <textarea name="nutritional_info" id="nutritional_info" class="form_input" cols="6"
                                    rows="8" required></textarea>
                                <script>
                                    ClassicEditor
                                        .create(document.querySelector('#nutritional_info'))
                                        .catch(error => {
                                            console.error(error);
                                        });
                                </script>
                            </div>
                        </div>

                        <div class="form-grp" enctype="multipart/form-data">
                            <label> Image</label><br>
                            <input type="file" name="image" required>
                        </div>

                        <div class="form-grp">
                            <label for="category">Category</label><br>
                            <?php foreach ($categoryList as $category): ?>
                                <input type="checkbox" id="category_<?php echo $category['id']; ?>" name="category[]"
                                    value="<?php echo $category['id']; ?>" required>
                                <label
                                    for="category_<?php echo $category['id']; ?>"><?php echo $category['name']; ?></label><br>
                            <?php endforeach; ?>
                        </div>


                        <button type="submit" name="submit" value="submit" class="success"> Submit Button</button>
                        <button type="reset" class="danger"> Reset Button</button>
                    </div>
        </div>
        </fieldset>
        </form>
    </div>
    <script>
        function ckeditor(class) {

            ClassicEditor
                .create(document.querySelector('class'))
                .catch(error => {
                    console.error(error);
                });
        }
    </script>
</body>

</html>