<?php
include ('header.php');
include ('../class/category_class.php');

$category = new Category();

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $category->set('id', $id);
    $data = $category->fetchById();

    if (isset($_POST['submit'])) {
        if (isset($_POST['name']) && !empty($_POST['name'])) {
            $category->set('name', $_POST['name']);
            $category->set('status', $_POST['status']);
            $category->set('modified_date', date('Y-m-d H:i:s'));
            $result = $category->edit();

            if (is_integer($result)) {
                $msg = "Category Updated Successfully";
            } else {
                $error['msg'] = "Category cannot be updated";
            }
        } else {
            $error['msg'] = "Category name cannot be empty";
        }
    }
}


include ('sidebar.php');
?>


<div class="category">
    <div class="row">
        <div class="heading">
            <p>Edit Category</p>
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
                        <input type="text" class="form_input" name="name" value="<?php echo $data->name; ?>" required>
                        <input type="hidden" name="CategoryEntry" id="CategoryEntry">
                        <br>
                    </div>

                    <button type="submit" name="submit" value="submit" class="success">Submit Button</button>
                    <button type="reset" class="danger">Reset Button</button>
                </fieldset>
            </form>
        </div>
    </div>
</div>