<?php
include_once('../class/user_class.php');
$post = new User();

$searchItem = $_POST['searchData'];

$post->set('searchData', $searchItem);
$res = $post->search();

?>
<?php
if (gettype($res) == 'array') {
    foreach ($res as $key => $value) {
?>
<div>
    <a href="post.php?id=<?php echo $value['id'] ?>" class="search-data">
        <div class="search-data-image">
            <img src="../../admin/images/<?php echo $value['image'] ?>" class="search-img" alt="" srcset="">
        </div>
        <div class="search-data-title">
            <h3><?php echo $value['recipe_name']; ?></h3>
            <h5 class="sub-text"><?php echo $value['cooking_level'] ?></h5>
        </div>
    </a>
</div>

<?php }
} else { ?>
<span class="search-data">No search result found </span>
<?php } ?>