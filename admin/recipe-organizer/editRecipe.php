<?php
include ('header.php');
include ('../class/category_class.php');
include ('../class/recipe_class.php');

$category = new Category();
$categoryList = $category->retrieve();
$error[] = "";

$recipe = new Recipe();

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $recipe->set('id', $id);
    $data = $recipe->fetchById();
    // echo "<pre>";
    // print_r($data->title);
    // echo "</pre>";

    if (isset($_POST['submit'])) {
        $recipe->set('recipe_name', $_POST['recipe_name']);
        $recipe->set('cooking_time', $_POST['cooking_time']);
        $recipe->set('cooking_level', $_POST['cooking_level']);
        $recipe->set('cooking_method', $_POST['cooking_method']);
        $recipe->set('serving', $_POST['serving']);
        $recipe->set('ingredients', $_POST['ingredients']);
        $recipe->set('instructions', $_POST['instructions']);
        $recipe->set('short_details', $_POST['short_details']);
        $recipe->set('nutritional_info', $_POST['nutritional_info']);
        $categories = implode(',', $_POST['category']);
        $recipe->set('category', $categories);
        $recipe->set('keywords', $_POST['keywords']);
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

        $result = $recipe->edit();

        if (is_integer($result)) {
            $msg = "Updated Successfully";
        } else {
            $error['msg'] = "Error occured!";
        }
    } else {
        $error['msg'] = "Please fill all the field";
    }
}


include ('sidebar.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="../../ckeditor/ckeditor.js"></script>
    <style>
        .ck-editor__editable {
            min-height: 150px;
            width: 492px;
            padding: 50px;
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
                <p>Edit Recipes</p>
            </div>
        </div>
        <div class="row">
            <div class="headings">
                <?php if (isset($msg)) { ?>
                    <div class="message1"><?php echo $msg; ?></div>
                <?php } ?>
                <?php if (isset($error['msg'])) { ?>
                    <div class="message2"><?php echo $error['msg']; ?></div>
                <?php } ?>

                <form action="" method="post" enctype="multipart/form-data" novalidate>
                    <fieldset>
                        <div class="form-grp">
                            <label>Recipe Name</label><br>
                            <input type="text" class="form_input" name="recipe_name" id="recipe_name"
                                value="<?php echo $data->recipe_name; ?>" required>
                        </div>

                        <div class="form-grp">
                            <label>Cooking Time</label><br>
                            <input type="text" class="form_input" name="cooking_time" id="cooking_time"
                                value="<?php echo $data->cooking_time; ?>" required>
                        </div>

                        <div class="form-grp">
                            <label>Cooking Level</label><br>
                            <input type="text" class="form_input" name="cooking_level" id="cooking_level"
                                value="<?php echo $data->cooking_level; ?>" required>
                        </div>

                        <div class="form-grp">
                            <label>Cooking Method</label><br>
                            <input type="text" class="form_input" name="cooking_method" id="cooking_method"
                                value="<?php echo $data->cooking_method; ?>" required>
                        </div>

                        <div class="form-grp">
                            <label>Serving</label><br>
                            <input type="number" class="form_input" name="serving" id="serving"
                                value="<?php echo $data->serving; ?>" required>
                        </div>

                        <div class="form-grp">
                            <label for="ingredients">Ingredients</label><br>
                            <textarea name="ingredients" id="ingredients" class="form_input" cols="60" rows="30"
                                value="<?php echo $data->ingredients; ?>" required></textarea>
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
                            <textarea id="instruction" name="instructions" class="form_input"
                                value="<?php echo $data->instructions; ?>" cols="60" rows="30" required></textarea>
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
                            <textarea name="short_details" class="form_input" id="short_details"
                                value="<?php echo $data->short_details; ?>" cols="6" rows="8" required></textarea>
                        </div>

                        <div class="form-grp">
                            <label>Nutritional Information</label><br>
                            <textarea name="nutritional_info" class="form_input"
                                value="<?php echo $data->nutritional_info; ?>" cols="6" rows="8" required></textarea>
                        </div>

                        <div class="form-grp" enctype="multipart/form-data">
                            <label> Image</label><br>
                            <input type="file" name="image" value="<?php echo $data->image; ?>" required>
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


                        <div class="form-grp">
                            <label>Keywords</label><br>
                            <textarea name="keywords" class="form_input" cols="6" rows="8"
                                value="<?php echo $data->keywords; ?>" required></textarea>
                        </div>


                        <button type="submit" name="submit" value="submit" class="success"> Submit Button</button>
                        <button type="reset" class="danger"> Reset Button</button>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>

</body>

</html>