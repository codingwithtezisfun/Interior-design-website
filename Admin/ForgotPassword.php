<?php
session_start(); 

require 'Connection.php'; 

session_start(); 

require 'Connection.php'; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $securityQuestion = $_POST['securityQuestion'];
    $securityAnswer = $_POST['securityAnswer'];

    // Fetch hashed security answer from the database based on username and security question
    $stmt = $conn->prepare("SELECT password, security_answer FROM users WHERE username = ? AND security_question = ?");
    $stmt->bind_param("ss", $username, $securityQuestion);
    $stmt->execute();
    $stmt->bind_result($hashed_password, $stored_hashed_answer);
    $stmt->fetch();
    $stmt->close();

    // Verify the provided security answer against the stored hashed answer
    if (password_verify($securityAnswer, $stored_hashed_answer)) {
        // Security question answered correctly, allow password reset
        $_SESSION['username'] = $username; // Store username in session for reset process
        header("Location: ResetPassword.php"); // Redirect to password reset form
        exit();
    } else {
        // Invalid security answer
        echo "<script>alert('Invalid username, security question, or security answer');</script>";
        echo "<script>window.location.href = 'ForgotPassword.html';</script>";
    }
} else {
    // Redirect back to forgot_password.php if form not submitted
    header("Location:ForgotPassword.php");
    exit();
}

$conn->close();

?>
