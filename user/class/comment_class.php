<?php

class Comment
{
    private $conn;

    public function __construct()
    {
        $this->conn = mysqli_connect('localhost', 'root', '', 'sem_project');
        if ($this->conn->connect_error) {
            die('Connection Failed!! ' . $this->conn->connect_error);
        }
    }

    public function submitComment($userId, $recipeId, $comment, $parentCommentId = 0)
    {
        // Prepare the SQL statement with placeholders for values
        $sql = "INSERT INTO comment (recipe_id, user_id, parent_id, comment, created) VALUES (?, ?, ?, ?, NOW())";
        $stmt = $this->conn->prepare($sql);

        // Bind the parameters to the prepared statement
        $stmt->bind_param('iiis', $recipeId, $userId, $parentCommentId, $comment);

        // Execute the prepared statement
        $success = $stmt->execute();

        // Close the statement and database connection
        $stmt->close();
        $this->conn->close();

        return $success;
    }



    public function getComment($recipeId, $parentCommentId = 0)
    {
        $sql = "SELECT c.*, u.username FROM comment c JOIN user u ON c.user_id = u.user_id WHERE recipe_id = ? AND parent_id = ? ORDER BY id DESC;";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('ii', $recipeId, $parentCommentId);
        $stmt->execute();
        $result = $stmt->get_result();

        $comments = array();
        while ($row = $result->fetch_assoc()) {
            $row['replies'] = $this->getComment($recipeId, $row['id']); // Recursive call to fetch replies
            $comments[] = $row; // Append each comment to the $comments array
        }
        if($comments){
            return $comments;
        }else{
            return false;
        }
    }
}
