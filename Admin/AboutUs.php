<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Include your database connection file
    require_once 'Connection.php'; // Adjust this according to your actual connection script

    // Validate and sanitize the input
    $aboutUsText = filter_var($_POST['about_us_text'], FILTER_SANITIZE_STRING);

    // Prepare the SQL statement to update about us
    $sql = "UPDATE about_us SET text = ? WHERE id = 1";
    $stmt = $conn->prepare($sql);
    
    if ($stmt) {
        // Bind the parameter and execute the statement
        $stmt->bind_param("s", $aboutUsText);
        if ($stmt->execute()) {
            echo "<script>alert('You have been registered successfully');</script>";
            echo "<script>window.location.href = 'AdminDashboard.php';</script>";
            exit();
        } else {
            // Handle SQL execution error
            echo "Error: " . $stmt->error;
        }
        $stmt->close();
    } else {
        // Handle SQL statement preparation error
        echo "Error: " . $conn->error;
    }

    // Close the database connection
    $conn->close();
}
?>
