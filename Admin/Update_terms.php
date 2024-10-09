<?php
// Database credentials
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "Vintex_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Function to update terms in the database
function updateTerms($conn, $category, $description) {
    // Prepare SQL statement
    $sql = "UPDATE terms_conditions SET description = ? WHERE category = ?";
    $stmt = $conn->prepare($sql);

    // Bind parameters
    $stmt->bind_param('ss', $description, $category);

    // Execute statement
    if ($stmt->execute()) {
        echo "Terms updated successfully for category: " . $category;
    } else {
        echo "Error updating terms: " . $stmt->error;
    }

    // Close statement
    $stmt->close();
}

// Check if form is submitted and process updates
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Extract form data
    $category = $_POST['category'];
    $terms_text = $_POST['terms_text'];

    // Update terms based on category
    updateTerms($conn, $category, $terms_text);
}

// Close connection
$conn->close();
?>
