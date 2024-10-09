<?php
require 'Connection.php';

// Fetch unread messages
$sql = "SELECT message_id, email, subject, message FROM messages WHERE received = 'false'";
$result = $conn->query($sql);

$messages = array();

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $messages[] = array(
            'message_id' => $row['message_id'],
            'email' => $row['email'],
            'subject' => $row['subject'],
            'message' => $row['message']
        );
    }
}

echo json_encode($messages);

$conn->close();
?>
