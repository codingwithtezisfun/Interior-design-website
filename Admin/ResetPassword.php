<?php
session_start();

require 'Connection.php';

// Check if username is stored in session from the previous step
if (!isset($_SESSION['username'])) {
    // If username is not set, redirect to the forgot password page
    header("Location: ForgotPassword.html");
    exit();
}

$username = $_SESSION['username'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $newPassword = $_POST['newPassword'];

    // Hash the new password
    $hashed_password = password_hash($newPassword, PASSWORD_DEFAULT);

    // Update the user's password in the database
    $stmt = $conn->prepare("UPDATE users SET password = ? WHERE username = ?");
    $stmt->bind_param("ss", $hashed_password, $username);
    $stmt->execute();

    // Check if password was updated successfully
    if ($stmt->affected_rows > 0) {
        // Password updated successfully
        unset($_SESSION['username']); // Unset username from session
        echo "<script>alert('Password reset successful. You can now login with your new password.');</script>";
        echo "<script>window.location.href = 'login.html';</script>";
        exit();
    } else {
        // Error updating password
        echo "<script>alert('Failed to reset password. Please try again later.');</script>";
        echo "<script>window.location.href = 'ResetPassword.php';</script>";
        exit();
    }

    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .form-container {
            max-width: 400px;
            margin: 50px auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #f9f9f9;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="form-container">
            <h2 class="text-center mb-4">Reset Password</h2>
            <form action="ResetPassword.php" method="post">
                <div class="form-group">
                    <label for="newPassword">New Password:</label>
                    <input type="password" class="form-control" id="newPassword" name="newPassword" required>
                </div>
                <button type="submit" class="btn btn-primary btn-block">Reset Password</button>
            </form>
        </div>
    </div>
</body>
</html>
