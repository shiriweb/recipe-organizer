<?php
include ('header.php');
include('sidebar.php');
include ('../class/aboutus_class.php');

$about = new About();
$error[] = "";

@session_start();
if (isset($_POST['submit'])) {
    $about->set('description', $_POST['description']);
    $about->set('short_detail', $_POST['short_detail']);
    $about->set('created_date', date('Y-m-d H:i:s'));

    if (isset($_FILES['image'])) {
        $file_name = $_FILES['image']['name'];
        $file_size = $_FILES['image']['size'];
        $file_tmp = $_FILES['image']['tmp_name'];
        $file_type = $_FILES['image']['type'];

        if (move_uploaded_file($file_tmp, "../images/" . $file_name)) {
            // echo "Successfully uploaded";
            $about->set('image1', $file_name);
        } else {
            echo "Error uploading files";

        }
    }

    $result = $about->save();
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
                <p>About Us</p>
            </div>
        </div>

        <div class="row">
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
                                    <label for="description">Description</label><br>
                                    <textarea name="description" id="description" class="form_input" cols="60" rows="30"
                                        required></textarea>
                                    <script>
                                        ClassicEditor
                                            .create(document.querySelector('#description'))
                                            .catch(error => {
                                                console.error(error);
                                            });
                                    </script>
                                </div>

                                <div class="form-grp">
                                    <label>Short Details</label><br>
                                    <textarea name="short_detail" id="short_detail" class="form_input" cols="60"
                                        rows="30" required></textarea>
                                    <script>
                                        ClassicEditor
                                            .create(document.querySelector('#short_detail'))
                                            .catch(error => {
                                                console.error(error);
                                            });
                                    </script>
                                </div>
                            </div>






                            <div class="form-grp">
                                <label> Image</label><br>
                                <input type="file" name="image" required>
                            </div>







                            <button type="submit" name="submit" value="submit" class="success"> Submit Button</button>
                            <button type="reset" class="danger"> Reset Button</button>
                        </div>
            </div>
            </fieldset>
            </form>
        </div>
    </div>
    </div>

</body>

</html>
</body>

</html>