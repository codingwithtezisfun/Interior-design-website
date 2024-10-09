<?php
require 'Connection.php';

header('Content-Type: application/json');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $message_id = intval($_POST['message_id']);

    // Check if message_id is valid
    if ($message_id <= 0) {
        echo json_encode(["error" => "Invalid message ID"]);
        exit;
    }

    // Prepare and execute the query
    $sql = "SELECT email, subject, message FROM messages WHERE message_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $message_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $message = $result->fetch_assoc();
        echo json_encode($message);

        // Mark the message as read
        $update_sql = "UPDATE messages SET received = 'true' WHERE message_id = ?";
        $update_stmt = $conn->prepare($update_sql);
        $update_stmt->bind_param("i", $message_id);
        $update_stmt->execute();
    } else {
        echo json_encode(["error" => "Message not found"]);
    }

    $stmt->close();
    $conn->close();
} else {
    echo json_encode(["error" => "Invalid request method"]);
}
?>
