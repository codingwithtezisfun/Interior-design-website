<?php
require 'Connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $username = $_POST["username"];
    $password = $_POST["password"];
    $securityQuestion = $_POST["securityQuestion"];
    $securityAnswer = $_POST["securityAnswer"];

    // Hash the password for security
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Hash the security answer
    $hashed_security_answer = password_hash($securityAnswer, PASSWORD_DEFAULT);

    // Insert data into users table
    $stmt = $conn->prepare("INSERT INTO users (email, username, password, security_question, security_answer) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $email, $username, $hashed_password, $securityQuestion, $hashed_security_answer);

    if ($stmt->execute()) {
        echo "<script>alert('Registration successful!');</script>";
        echo "<script>window.location.href = 'RegisterUser.html';</script>";
        exit();
    } else {
        echo "<script>alert('Registratio failed');</script>";
        echo "<script>window.location.href = 'RegisterUser.html';</script>";
    }

    $stmt->close();
}

$conn->close();
?>
