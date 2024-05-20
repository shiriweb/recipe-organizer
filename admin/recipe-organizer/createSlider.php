<?php
include ('header.php');
include ('../class/slider_class.php');

session_start();
$slider = new ImageSlider();

$error = [];
@session_start();
if (isset($_POST['submit'])) {
    $slider->set('uploaded_date', date('Y-m-d H:i:s'));

    if (isset($_FILES['image'])) {
        $file_name = $_FILES['image']['name'];
        $file_size = $_FILES['image']['size'];
        $file_tmp = $_FILES['image']['tmp_name'];
        $file_type = $_FILES['image']['type'];

        if (move_uploaded_file($file_tmp, "../images/" . $file_name)) {
            // echo "Successfully uploaded";
            $slider->set('image', $file_name);
        } else {
            echo "Error uploading files";

        }
    }

    $result = $slider->save();
    if (is_integer($result)) {
        $msg = "Data uploaded successfully with id" . $result;
    } else {
        $error['msg'] = "Error occurred";
    }
}
include ('sidebar.php');
?>


<div class="category">
    <div class="row">
        <div class="heading">
            <p>Upload Image</p>
        </div>
    </div>
    <div class="headings">
        <?php if (isset($error['msg']) && !empty($error['msg'])) { ?>
            <label class="error" style="color:red"><?php echo $error['msg']; ?></label>
        <?php } ?>
        <?php if (isset($msg) && !empty($msg)) { ?>
            <label style="color:orange"><?php echo $msg; ?></label>
        <?php } ?>
        <form method="post" enctype="multipart/form-data">
            <div class="form-grp">
                <label>Image</label><br>
                <input type="file" name="image" required>
                <br>
            </div>

            <button type="submit" name="submit" class="success">Submit Button</button>
            <button type="reset" class="danger">Reset Button</button>
            </fieldset>
        </form>
    </div>
</div>
</div>