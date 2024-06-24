<?php
include('header.php');
include('../class/wishlist_class.php');

$wishlist = new Wishlist();

?>
    
<style>
    .head-title h3{
    margin: 99px 0px 0px 89px;
    position: absolute;
    top: 0;
  }
  .recipe-box {
    width: 313px;
    height: 59vh;
    margin: -92px 10px 10px 40px;
    background-color: #f5f5f5;
    border: 1px solid #f5f5f5;
    box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
    border-radius: 30px;
    display: inline-block;
}
</style>
<div class="container">
    <div class="box-main">
        <input type="hidden" name="user_id" id="user_id" value="<?php echo $_SESSION['id']; ?>">

        <div class="show">

        </div>

    </div>
</div>
<?php include('footer.php'); ?>
<script>
    $(document).ready(function(e) {
        function fetchWishlist() {
            var user_id = $('#user_id').val();
            console.log(user_id);
            $.ajax({
                url: 'checkWishlist.php',
                method: 'POST',
                data: {
                    user_id: user_id
                },
                success: function(response) {
                    $('.show').append(response);
                    console.log(response);
                },
                error: function(xhr, status, error) {
                    console.log('error:', error);
                }
            });
        }

        fetchWishlist();
    });
</script>