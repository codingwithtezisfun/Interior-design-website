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

// Function to fetch terms from database based on category using MySQLi
function getTerms($conn, $category) {
    $sql = "SELECT description FROM terms_conditions WHERE category = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $category);
    $stmt->execute();
    $stmt->bind_result($description);
    $stmt->fetch();
    return $description;
}

// Initialize variables to store fetched terms
$generalTerms = "";
$paymentTerms = "";
$privacyTerms = "";

// Fetch terms for each category
$generalTerms = getTerms($conn, 'General Terms');
$paymentTerms = getTerms($conn, 'Payment and Billing Terms');
$privacyTerms = getTerms($conn,  'Privacy and Data Protection Terms');

// Close connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Terms and Conditions Editor</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-4">
                <div class="jumbotron">
                    <div class="container">
                        <form method="post" action="Update_terms.php">
                            <h3>General Terms</h3>
                            <textarea class="form-control" name="terms_text" rows="5" required><?php echo htmlspecialchars($generalTerms); ?></textarea>
                            <input type="hidden" name="category" value="General Terms">
                            <button type="submit" class="btn btn-primary">Update General Terms</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="jumbotron">
                    <div class="container">
                        <form method="post" action="Update_terms.php">
                            <h3>Payment Terms</h3>
                            <textarea class="form-control" name="terms_text" rows="5" required><?php echo htmlspecialchars($paymentTerms); ?></textarea>
                            <input type="hidden" name="category" value="Payment and Billing Terms">
                            <button type="submit" class="btn btn-primary">Update Payment Terms</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="jumbotron">
                    <div class="container">
                        <form method="post" action="Update_terms.php">
                            <h3>Privacy Terms</h3>
                            <textarea class="form-control" name="terms_text" rows="5" required><?php echo htmlspecialchars($privacyTerms); ?></textarea>
                            <input type="hidden" name="category" value="Privacy and Data Protection Terms">
                            <button type="submit" class="btn btn-primary">Update Privacy Terms</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
