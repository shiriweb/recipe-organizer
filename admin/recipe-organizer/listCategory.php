<?php
include ('header.php');
include ('../class/category_class.php');
@session_start();
if (isset($_SESSION['message']) && $_SESSION['message'] != "") {
    $message = $_SESSION['message'];
    $_SESSION['message'] = "";
}

$categoryObj = new Category();
$datalist = $categoryObj->retrieve();

include ('sidebar.php');
?>

<div class="category">
    <div class="row">
        <div class="heading">
            <p>List Category</p>
        </div>
    </div>

    <?php
    if (isset($message)) {
        echo '<div class="alert alert-success">' . $message . '</div>';
    }
    ?>

    <div class="row">
        <div class="headings">
            <table id="categorytable">

                <thead>
                    <tr>
                        <th>S.No</th>
                        <th>Name</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($datalist as $key => $category) { ?>
                        <tr class="">
                            <td><?php echo $key + 1; ?></td>
                            <td><?php echo $category['name']; ?></td>

                            <td class="action">
                                <a class="edit" href="editCategory.php ? id=<?php echo $category['id']; ?>">
                                    <i class="fas fa-edit"></i> Edit</a>
                                <a class="delete" href="deleteCategory.php ? id=<?php echo $category['id']; ?>">
                                    <i class="fas fa-trash"></i> Delete</a>
                            </td>
                        </tr>

                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>