 <!-- Messages will be inserted here by PHP -->
 <?php
                        require 'Connection.php';

                        // Fetch messages (all messages by default)
                        $sql = "SELECT message_id, email, subject, message, received FROM messages";
                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                            while($row = $result->fetch_assoc()) {
                                $unreadClass = $row['received'] == 'false' ? 'unread' : '';
                                echo "<a href='#' class='list-group-item list-group-item-action message-row $unreadClass' data-id='{$row['message_id']}'>
                                        {$row['subject']}
                                      </a>";
                            }
                        } else {
                            echo "<p>No messages found.</p>";
                        }

                        $conn->close();
                        ?>