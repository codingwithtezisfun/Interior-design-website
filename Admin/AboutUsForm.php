<?php
// Load existing about us content
require_once 'Connection.php'; // Adjust this according to your actual connection script

// Initialize variables
$aboutUsText = '';

// Fetch existing about us content from database
$sql = "SELECT * FROM about_us WHERE id = 1";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $aboutUsText = $row['text'];
}

// Close database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us Form</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center mb-4">Edit About Us Information</h2>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <form action="AboutUs.php" method="POST">
                    <div class="form-group">
                        <label for="aboutUsText">About Us Text</label>
                        <textarea class="form-control" id="aboutUsText" name="about_us_text" rows="5" required><?php echo $aboutUsText; ?></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Bootstrap and JavaScript libraries -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
