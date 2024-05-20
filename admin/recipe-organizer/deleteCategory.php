<?php
include ('header.php');
include ('../class/category_class.php');
$category = new Category();

session_start();
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $category->set('id', $id);
    $result = $category->delete();

    // echo "<pre>";
    // print_r($resulst);
    // echo "</re>";

    if ($result == "success") {
        $msg = "Category deleted Successfully!";
        header('location:listCategory.php');
    } else {
        $error['msg'] = "Failed to delete the category";
        header('location:listCategory.php');
    }
}