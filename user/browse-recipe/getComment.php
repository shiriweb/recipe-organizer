<?php

include('../class/comment_class.php');

// Check if the 'id' parameter is set in the URL
if (isset($_GET['id'])) {
    // Get the post ID from the URL parameter
    $post_id = $_GET['id'];

    // Create a new instance of the Comment class
    $comment = new Comment();

    // Fetch comments for the specified post ID
    $result = $comment->getComment($post_id);

    // Output the result as JSON
    header('Content-type: application/json');
    echo json_encode($result);
} else {
    // If 'id' parameter is not set, return an error message
    echo json_encode(array('error' => 'Post ID not provided'));
}
