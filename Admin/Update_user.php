<?php
// Establish database connection (example)
$servername = "localhost";
$username = "username";
$password = "password";
$dbname = "your_database";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Process form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $oldUsername = $_POST["oldUsername"];
    $newUsername = $_POST["newUsername"];
    $oldPassword = $_POST["oldPassword"];
    $newPassword = $_POST["newPassword"];
    $securityQuestion = $_POST["securityQuestion"];
    $securityAnswer = $_POST["securityAnswer"];

    // Validate inputs (you can add more validation as needed)

    // Check if the old username and password match in the database
    $stmt = $conn->prepare("SELECT id, password FROM users WHERE username = ?");
    $stmt->bind_param("s", $oldUsername);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $user_id = $row["id"];
        $hashed_password = $row["password"];

        // Verify old password
        if (password_verify($oldPassword, $hashed_password)) {
            // Update user information
            $hashed_new_password = password_hash($newPassword, PASSWORD_DEFAULT);

            $update_stmt = $conn->prepare("UPDATE users SET email = ?, username = ?, password = ?, security_question = ?, security_answer = ? WHERE id = ?");
            $update_stmt->bind_param("sssssi", $email, $newUsername, $hashed_new_password, $securityQuestion, $securityAnswer, $user_id);

            if ($update_stmt->execute()) {
                echo "User information updated successfully!";
            } else {
                echo "Error updating user information: " . $update_stmt->error;
            }
        } else {
            echo "Incorrect old password.";
        }
    } else {
        echo "User not found or multiple users found with the same username.";
    }

    $stmt->close();
    $update_stmt->close();
}

$conn->close();
?>
