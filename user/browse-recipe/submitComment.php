 <?php
    include('../class/comment_class.php');

    $comment = new Comment();

    if (isset($_POST["recipe_id"])) {
        $user_id = filter_input(INPUT_POST, "user_id", FILTER_SANITIZE_NUMBER_INT);
        $recipe_id = filter_input(INPUT_POST, "recipe_id", FILTER_SANITIZE_NUMBER_INT);
        $parent_id = filter_input(INPUT_POST, "parent_id", FILTER_SANITIZE_NUMBER_INT);
        $commentText = filter_input(INPUT_POST, "commentText");

        if (!$user_id) {
            header("HTTP/1.0 400 Bad Request");
            echo json_encode(["status" => "error", "message" => "Log in to comment"]);
            exit;
        } else {
            if (!$commentText) {
                header("HTTP/1.0 400 Bad Request");
                echo json_encode(["status" => "error", "message" => "Empty comment!!"]);
                exit;
            }
        }

        $data = [
            "successMsg" => 'comment Successful'
        ];
        $result = $comment->submitComment($user_id, $recipe_id, $commentText, $parent_id);
        if ($result) {
            header('Content-Type: application/json; charset=UTF-8');
            echo json_encode($data);
        }
        exit;
    }

    header("HTTP/1.0 400 Bad Request");
    echo json_encode(["status" => "error", "message" => "recipe_id is missing"]);
    exit;

    ?>