<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Contact Form</title>
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <style>
    /* Custom CSS */
    .custom-container {
      max-width: 900px; /* Fixed width for large screens */
      margin: auto; /* Center the container */
      max-height: 100%; /* Maximum height for the container */
      overflow-y: auto; /* Enable scrolling if content exceeds max height */
      padding: 20px; /* Add padding inside the container */
      border: 1px solid #ccc; /* Optional: Add a border for clarity */
    }
  </style>
</head>
<body>
  <div class="container-fluid">
    <div class="row justify-content-center">
      <div class="col-lg-8 col-md-10">
        <div class="custom-container">
          <h4 class="text-center">Inquiries or Queries</h4>
          <p class="text-center">Leave a message and we will contact you.</p>
          
          <?php
          if ($_SERVER["REQUEST_METHOD"] == "POST") {
              $email = $_POST['email'];
              $subject = $_POST['subject'];
              $message = $_POST['message'];
             
               require 'Connection.php';

              $sql = "INSERT INTO messages (email, subject, message, received) VALUES ('$email', '$subject', '$message', 'false')";

              if ($conn->query($sql) === TRUE) {
                  echo "<div class='alert alert-success' role='alert'>Message sent successfully we will contact you as soon as possible!</div>";
              } else {
                  echo "<div class='alert alert-danger' role='alert'>Error: " . $sql . "<br>" . $conn->error . "</div>";
              }

              $conn->close();
          }
          ?>
          
          <!-- Contact Form -->
          <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            <div class="form-group">
              <label for="inputEmail">Email</label>
              <input type="email" class="form-control" id="inputEmail" name="email" placeholder="Enter your email" required>
            </div>
            <div class="form-group">
              <label for="inputSubject">Subject</label>
              <input type="text" class="form-control" id="inputSubject" name="subject" placeholder="Enter the subject" required>
            </div>
            <div class="form-group">
              <label for="inputMessage">Message</label>
              <textarea class="form-control" id="inputMessage" name="message" rows="3" placeholder="Enter your message" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary btn-block">Submit</button>
          </form>
          
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap JS and dependencies (optional for functionality like dropdowns) -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
