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
    $categori = explode(",", $data->category);
    // echo "<pre>";
    // print_r($data);
    // print_r($categori);
    // print_r($categoryList);
    // echo "</pre>";

    if (isset($_POST['submit'])) {
        $recipe->set('recipe_name', $_POST['recipe_name']);
        $recipe->set('total_time', $_POST['total_time']);
        $recipe->set('preparation_time', $_POST['preparation_time']);
        $recipe->set('cooking_time', $_POST['cooking_time']);
        $recipe->set('cooking_level', $_POST['cooking_level']);
        $recipe->set('serving', $_POST['serving']);
        $recipe->set('ingredients', $_POST['ingredients']);
        $recipe->set('instructions', $_POST['instructions']);
        $recipe->set('short_details', $_POST['short_details']);
        $recipe->set('description', $_POST['description']);
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
        // $error['msg'] = "Please fill all the field";
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
                                <label>Total Time</label><br>
                                <input type="text" class="form_input" name="cooking_time" id="cooking_time" value="<?php echo $data->total_time; ?>" required>
                            </div>

                            <div class="form-grp">
                                <label>Preparation Time</label><br>
                                <input type="text" class="form_input" name="cooking_time" id="cooking_time" value="<?php echo $data->preparation_time; ?>" required>
                            </div>

                            <div class="form-grp">
                                <label>Cooking Time</label><br>
                                <input type="text" class="form_input" name="cooking_time" id="cooking_time" value="<?php echo $data->cooking_time; ?>" required>
                            </div>

                        <div class="form-grp">
                            <label>Cooking Level</label><br>
                            <input type="text" class="form_input" name="cooking_level" id="cooking_level"
                                value="<?php echo $data->cooking_level; ?>" required>
                        </div>



                        <div class="form-grp">
                            <label>Serving</label><br>
                            <input type="number" class="form_input" name="serving" id="serving"
                                value="<?php echo $data->serving; ?>" required>
                        </div>

                        <div class="form-grp">
                            <label for="ingredients">Ingredients</label><br>
                            <textarea name="ingredients" id="ingredients" class="form_input" cols="60" rows="30"
                                required>  <?php echo $data->ingredients; ?></textarea>
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
                                required>  <?php echo $data->instructions; ?></textarea>
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
                                required><?php echo $data->short_details; ?></textarea>
                        </div>

                        <div class="form-grp">
                            <label>Description</label><br>
                            <textarea name="description" class="form_input" id="details" cols="6" rows="8"
                                required><?php echo $data->description; ?></textarea>
                        </div>

                        <div class="form-grp">
                            <label>Nutritional Information</label><br>
                            <textarea name="nutritional_info" id="nutritional_info" class="form_input" cols="6" rows="8"
                                required><?php echo $data->nutritional_info; ?></textarea>
                            <script>
                                ClassicEditor
                                    .create(document.querySelector('#nutritional_info'))
                                    .catch(error => {
                                        console.error(error);
                                    });
                            </script>
                        </div>

                        <div class="form-grp" enctype="multipart/form-data">
                            <label> Image</label><br>
                            <input type="file" name="image" value="<?php echo $data->image; ?>" required>
                        </div>

                        <div class="form-grp">
                            <label>Category</label>
                            <br>
                            <!-- <?php print_r($categori); ?> -->
                            <?php foreach ($categoryList as $category => $value) { ?>
                                <!-- <?php echo $value['id']; ?> -->
                                <input type="checkbox" id="category_<?php echo $value['id']; ?>" name="category[]"
                                    value="<?php echo $value['id']; ?>" <?php if (in_array($value['id'], $categori))
                                           echo 'checked';
                                       ?>required>
                                <label><?php echo $value['name']; ?></label><br>
                            <?php } ?>
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