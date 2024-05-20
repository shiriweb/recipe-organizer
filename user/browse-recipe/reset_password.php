<?php

class User
{
    public $user_id, $username, $email, $password, $con_password, $created_date, $token, $expiretoken;

    public function set($property, $value)
    {
        $this->$property = $value;
    }

    // Method to generate a random token
    private function generateToken()
    {
        return bin2hex(random_bytes(32));
    }

    // Method to send email with password reset link
    private function sendResetEmail($email, $token)
    {
        // Send an email to $email with a link like:
        // example.com/reset_password.php?token=$token
        // You need to implement this function
    }

    // Method to request password reset
    public function forgotPassword()
    {
        $conn = mysqli_connect('localhost', 'root', '', 'sem_project');

        // Generate a random token
        $token = $this->generateToken();

        // Set expiration time (e.g., 1 hour from now)
        $expiration = date('Y-m-d H:i:s', strtotime('+1 hour'));

        // Update user's token and expire token in the database
        $sql = "UPDATE user SET token = '$token', expiretoken = '$expiration' WHERE email = '$this->email'";
        mysqli_query($conn, $sql);

        // Send reset password email
        $this->sendResetEmail($this->email, $token);
    }

    // Method to verify token and reset password
    public function resetPassword($newPassword, $token)
    {
        $conn = mysqli_connect('localhost', 'root', '', 'sem_project');

        // Verify token and check expiration
        $current_time = date('Y-m-d H:i:s');
        $sql = "SELECT * FROM user WHERE token = '$token' AND expiretoken > '$current_time'";
        $result = mysqli_query($conn, $sql);

        if ($result->num_rows > 0) {
            // Token is valid, update password
            $encryptedPassword = md5($newPassword);
            $sqlUpdate = "UPDATE user SET password = '$encryptedPassword', token = NULL, expiretoken = NULL WHERE token = '$token'";
            mysqli_query($conn, $sqlUpdate);
            return "Password updated successfully.";
        } else {
            // Token is invalid or expired
            return "Invalid or expired token.";
        }
    }
}

// Example usage:
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Handle form submission for forgot password
    $user = new User();
    $user->set('email', $_POST['email']);
    $user->forgotPassword();
}

// Example usage:
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['token'])) {
    // Handle password reset based on token
    $user = new User();
    $newPassword = $_POST['new_password'];
    $token = $_GET['token'];
    $message = $user->resetPassword($newPassword, $token);
}

?>

<!DOCTYPE html>
<html>

<head>
    <title>Forgot Password</title>
</head>

<body>
    <h2>Forgot Password</h2>
    <?php if (isset($message)) { ?>
        <p><?php echo $message; ?></p>
    <?php } ?>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label>Email:</label>
        <input type="text" name="email" required><br><br>
        <input type="submit" value="Reset Password">
    </form>
</body>

</html>