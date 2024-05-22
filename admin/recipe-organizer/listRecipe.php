<?php
include ('header.php');
include ('../class/recipe_class.php');
include ('../class/category_class.php');

@session_start();
if (isset($_SESSION['message']) && $_SESSION['message'] != "") {
    $message = $_SESSION['message'];
    $_SESSION['message'] = "";
}

$category = new Category();
$categoryList = $category->retrieve();

$recipeObj = new Recipe();
$datalist = $recipeObj->retrieve();


include ('sidebar.php');
?>


<div class="recipe">
    <div class="row">
        <div class="heading">
            <p>List Recipe</p>
            <a href="createRecipe.php" class="create-button"><i class="fas fa-plus-circle"></i>  Create Recipe</a>

        </div>
    </div>
    <?php
    if (isset($message)) {
        echo '<div class="alert alert-success">' . $message . '</div>';
    }
    ?>
    <div class="row">
        <div class="headings">

            <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> -->
            <script type="text/javascript" src="jquery/jquery.js"></script>
            <script type="text/javascript">

                $(document).ready(function () {
                    function loadTable(page) {
                        $.ajax({
                            url: "pagination.php",
                            type: "POST",
                            data: { page_no: page },
                            success: function (data) {
                                $("#headings").html(data);
                            }
                        });
                    }
                    loadTable();

                    $(document).on("click", "#pagination a", function (event) {
                        event.preventDefault();
                        var page_id = $(this).attr("id");
                        loadTable(page_id);
                    })
                });
            </script>