<?php
include ('header.php');
include ('../class/category_class.php');

session_start();
$category = new Category();

$error = [];

if (isset($_POST['submit'])) {
    if (isset($_POST['name']) && !empty($_POST['name'])) {
        $category->set('name', $_POST['name']);
        $category->set('status', $_POST['status']);
        $category->set('created_date', date('Y-m-d H:i:s'));
        $result = $category->save();

        if ($result) {
            $msg = "Category inserted successfully with id" . $result;
        } else {
            $error['msg'] = "Failed to insert the data";
        }
    } else {
        $error['msg'] = "Category already taken";
    }
}
include ('sidebar.php');
?>


<div class="category">
    <div class="row">
        <div class="heading">
            <p>Create Category</p>
            <a href="listCategory.php" class="create-button"><i class="fas fa-list-ul"></i> List Category</a>

        </div>
    </div>
    <div class="row">
        <div class="headings">
            <?php if (isset($error['msg']) && !empty($error['msg'])) { ?>
                <label class="error" style="color:red"><?php echo $error['msg']; ?></label>
            <?php } ?>
            <?php if (isset($msg) && !empty($msg)) { ?>
                <label style="color:orange"><?php echo $msg; ?></label>
            <?php } ?>

            <form action="" method="post" novalidate>
                <fieldset>
                    <div class="form-grp">
                        <label>Name</label><br>
                        <input type="text" class="form_input" name="name" required>
                        <br>
                        <!-- <span id="categoryError" style="color:red"></span> -->
                    </div>

                    <button type="submit" name="submit" class="success">Submit Button</button>
                    <button type="reset" class="danger">Reset Button</button>
                </fieldset>
            </form>
        </div>
    </div>
</div>