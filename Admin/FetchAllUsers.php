<?php
// Database connection parameters
$servername = "localhost";
$username = "username";
$password = "password";
$dbname = "your_database";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle delete action
if (isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['id'])) {
    $user_id = $_GET['id'];
    
    // Perform delete operation
    $delete_stmt = $conn->prepare("DELETE FROM users WHERE id = ?");
    $delete_stmt->bind_param("i", $user_id);
    
    if ($delete_stmt->execute()) {
        echo "<script>alert('User deleted successfully');</script>";
    } else {
        echo "<script>alert('Error deleting user');</script>";
    }
}

// Query to fetch all users
$sql = "SELECT id, username, email FROM users";
$result = $conn->query($sql);

// HTML table to display users
if ($result->num_rows > 0) {
    echo '<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Users List</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
        <style>
            .container {
                margin-top: 50px;
            }
            th, td {
                text-align: center;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <h2 class="text-center mb-4">Users List</h2>
            <table class="table table-bordered">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">Username</th>
                        <th scope="col">Email</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>';
    // Output data of each row
    while ($row = $result->fetch_assoc()) {
        echo '<tr>
                <td>' . htmlspecialchars($row["username"]) . '</td>
                <td>' . htmlspecialchars($row["email"]) . '</td>
                <td>
                    <a href="delete_user.php?id=' . $row["id"] . '" class="text-danger delete-user" onclick="return confirm(\'Are you sure you want to delete this user?\');"><i class="fas fa-trash"></i></a>
                </td>
              </tr>';
    }
    echo '</tbody>
            </table>
        </div>
    </body>
    </html>';
} else {
    echo "0 results";
}

// Close connection
$conn->close();
?>
