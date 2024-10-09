<?php
require 'Connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $subject = $_POST['subject'];
    $email = $_POST['email'];

    // Delete the message from the database based on subject and email
    $sql = "DELETE FROM messages WHERE subject = '$subject' AND email = '$email'";
    if ($conn->query($sql) === TRUE) {
        echo json_encode(array('success' => true));
    } else {
        echo json_encode(array('error' => 'Error deleting message'));
    }
} else {
    echo json_encode(array('error' => 'Invalid request method'));
}

$conn->close();
?>
