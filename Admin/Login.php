<?php
session_start(); // Start session for storing user authentication status

require 'Connection.php';

if (isset($_POST['username']) && isset($_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // SQL query to fetch hashed password based on username
    $stmt = $conn->prepare("SELECT id, username, password FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        // Bind result variables
        $stmt->bind_result($user_id, $username, $hashed_password);
        $stmt->fetch();

        // Verify hashed password with plain-text password entered by user
        if (password_verify($password, $hashed_password)) {
            // If valid credentials, set session variables
            $_SESSION['user_id'] = $user_id;
            $_SESSION['username'] = $username;

            // Redirect to dashboard or authenticated page
            header("Location: AdminDashboard.php");
            exit();
        } else {
            // Invalid credentials
            echo "<script>alert('Invalid username or password');</script>";
            echo "<script>window.location.href = 'login.html';</script>";
        }
    } else {
        // User not found
        echo "<script>alert('Invalid username or password');</script>";
        echo "<script>window.location.href = 'login.html';</script>";
    }
} else {
    // Redirect back to login.php if username or password is not set
    header("Location: login.html");
    exit();
}

$stmt->close();
$conn->close();
?>
