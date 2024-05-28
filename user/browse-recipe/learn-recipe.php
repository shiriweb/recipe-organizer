<?php
include ('header.php');
include('../../admin/class/recipe_class.php');

@session_start();
if (isset($_SESSION['message']) && $_SESSION['message'] !== "") {
    $message = $_SESSION['message'];
    $_SESSION['message'] = "";
}

$recipeObj = new Recipe();

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $recipeObj->set('id', $id);
    $datalist = $recipeObj->fetch();
    // echo $id;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../style/recipe.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <script src="../js/script.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.min.js"></script>

</head>

<body>
    <div class="recipe-details">
        <?php foreach ($datalist as $key => $recipe) { ?>

            <div class="learn-content">
              
                <div class="description">
                <div class="recipe-title">
                    <h1><?php echo $recipe['recipe_name']; ?></h1>
                </div>
                    <p><?php echo $recipe['description']; ?></p>
                </div>
                <div class="recipe-image">
                    <img src="../../admin/images/<?php echo $recipe['image']; ?>">
                </div>
            </div>
            <div class="learn-information">
                <div class="info-content">
                    <label> Preparation Time:</label>
                    <span><i class="fas fa-clock"> <?php echo $recipe['preparation_time']; ?></i></span>
                </div>
                <div class="info-content">
                    <label> Cooking Time:</label>
                    <span><i class="fas fa-clock"> <?php echo $recipe['cooking_time']; ?></i></span>
                </div>

                <div class="info-content">
                    <label> Serving:</label>
                    <span><i class="fas fa-utensils"> <?php echo $recipe['serving']; ?></i></span>
                </div>

                <div class="info-content">
                    <label> Cooking Level:</label>
                    <span><i class="fas fa-star"> <?php echo $recipe['cooking_level']; ?></i></span>
                </div>
            </div>

            <div class="learn-more">
                <h1>Ingredients</h1>
                <hr>
                <p><?php echo $recipe['ingredients']; ?></p>

                <br>
                <h1>Instructions</h1>
                <hr>
                <p><?php echo $recipe['instructions'] ?></p>

                <br>
                <h1>Nutritional Information</h1>
                <hr>
                <p><?php echo $recipe['nutritional_info']; ?></p>
            </div>
        <?php } ?>
    </div>
    <!-- <div class="comment-section">
        <div class="comments-gallery">
            <div class="comments">
                <div class="write-comment">
                    <form action="" id="comment-form">
                        <textarea placeholder="Leave a comment....." name="comment" id="comment_Text" cols="30" rows="10"></textarea>
                        <div class="submit-area">
                            <input type="hidden" name="id" id="recipe_id" value="<?php echo $id; ?>">
                            <input type="hidden" name="parent_id" id="parent_id" value="0">
                            <?//php if (isset($_SESSION['id'])) { ?>
                                <input type="hidden" name="user_id" id="user_id" value="<?php echo $_SESSION['id'];  ?>">
                            <?php// } ?>
                            <button type="submit" id="submit_comment_btn" class="submit-comment-btn">Comment</button>
                        </div>
                    </form>
                </div>
                <div class="comment">

                </div>
            </div>
        </div>
    </div> -->
    <!-- <script>
        $(document).ready(function() {
            //comment button
            $(document).on('focus', '.write-comment', function() {
                $('.submit-area').css('display', 'flex');
            })

            //comment reply
            $(document).on('click', '.reply', function() {
                var comment_id = $(this).attr("id");
                $('#comment_Text').empty();
                $('#parent_id').val(comment_id);
                $('#comment_Text').focus();
            });

            var user_ids = $('#user_id').val();
            // var cookie = $.cookie('uname');
            // console.log(cookie);

            var recipe_id = $('#recipe_id').val();
            $('#submit_comment_btn').click(function(e) {
                e.preventDefault();
                var ucomment = $('#comment_Text').val();
                var post_ids = $('#recipe_id').val();
                var parent_ids = $('#parent_id').val();
                var user_ids = $('#user_id').val();

                if(!user_ids){
                    alert("please login to comment");
                    return;
                }

                $.ajax({
                    url: "submitComment.php",
                    method: "POST",
                    data: {
                        parent_id: parent_ids,
                        recipe_id: post_ids,
                        user_id: user_ids,
                        commentText: ucomment
                    },
                    // data: form_data,
                    // dataType: "JSON",
                    success: function(response) {
                        getComment();
                        $('#comment-form')[0].reset();
                        $('#parent_id').val(0);
                        console.log(response);
                    },
                    error: function(xhr, status, error) {
                        var errorMessage = JSON.parse(xhr.responseText).message;
                        alert('Error: ' + errorMessage);
                    }
                });
            });

            //get comment
            function getComment() {
                $.ajax({
                    url: "getComment.php",
                    method: 'GET',
                    data: {
                        id: recipe_id
                    },
                    dataType: "JSON",
                    success: function(response) {
                        if (response.length > 0)
                            displayComment(response);
                        else {
                            $('.comment').append('<p class="default">Be the first to comment</p>');
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Error fetching comments:', error);
                    }
                });
            }
            getComment();

            //display comment
            function displayComment(comments) {
                // console.log(comments);
                var commentArea = $('.comment');
                if (comments != null)
                    commentArea.empty(); // Clear the comment area before adding new comments

                comments.forEach(comment => {
                    var commentHtml = generateComment(comment, blank = 0);
                    commentArea.append(commentHtml);

                    displayReplies(comment.replies, comment.username);
                });
            }

            // display reply
            function displayReplies(replies, p_username) {
                if (replies && replies.length > 0) {
                    replies.forEach(reply => {
                        // console.log(reply);
                        var replyHtml = generateComment(reply, p_username);
                        //this only works for reply to primary comment. not reply to reply
                        $('.comment').append(replyHtml);

                        displayReplies(reply.replies);
                    });
                }
            }

            function generateComment(comment, p_username) {
                var parent_username = comment.username;
                var commentHtml = '<div class="user-area ';
                if (comment.parent_id != 0) {
                    commentHtml += ' reply-area';
                }
                commentHtml += '">';
                commentHtml += '<div class="user">';
                commentHtml += '<img src="admin/images/65f32703c2ce6onepiece.jpg" alt="">';
                commentHtml += '<div class="user-detail">';
                if (comment.parent_id) {
                    commentHtml += '<div class = "user-name"> <span>' + comment.username + ' replied to ' + p_username +
                        '</span>';
                } else {
                    commentHtml += '<div class="user-name">' + '<span>' + comment.username + '</span> ';
                }
                commentHtml += ' <span class="cmt-time">' + comment.created + '</span>';
                commentHtml += '</div>'; // user-name
                commentHtml += '<div class="user-comment">';
                commentHtml += '<p>' + comment.comment + '</p>';
                commentHtml += '</div>'; // user-comment
                commentHtml += '</div>'; // user-detail
                commentHtml += '</div>'; // user
                commentHtml += '<div class="cmt-response">';
                commentHtml += '<div>';
                commentHtml += '<span id="like" class="thumb material-icons-outlined">thumb_up</span>';
                commentHtml += '</div>';
                commentHtml += '<div>';
                commentHtml += '<span id="dislike" class="thumb material-icons-outlined">thumb_down</span>';
                commentHtml += '</div>';
                commentHtml += '<div>';
                commentHtml += '<span id = "' + comment.id + '" class = "reply">Reply</span>';
                commentHtml += '</div>';
                commentHtml += '</div>'; // cmt-response
                commentHtml += '</div>'; // user-area
                return commentHtml;
            }

        });
    </script>
</body>

</html> -->