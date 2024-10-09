<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mail Dashboard</title>
    <!-- Bootstrap CDN -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Font Awesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <style>
        .container {
            background-color: #696969;
            color: white;
            padding: 20px;
            border-radius: 8px;
        }
        .message-list-container {
            background-color: #73c2fb;
            color: white;
            padding: 10px;
            border-radius: 8px;
            max-height: 450px;
        }
        .message-enclose-container {
            max-height: 300px;
            overflow-y: auto;
            background-color: #ffffff;
        }
        .message-content-container {
            background-color: #bcd4e6;
            color: black;
            padding: 20px;
            border-radius: 8px; 
            min-height: 450px;
            max-height:500px;
        }
        .message-content {
            background-color: #fdfff5;
            color: black;
            height: 270px;
            border-radius: 10px;
            padding: 25px;
            overflow-y: auto;
        }
        .reply-delete-buttons {
            text-align: center;
            margin-top: 20px;
        }
        .list-group-item {
            color: black;
            background-color: #ffffff;
            border: none;
        }
        .list-group-item .message-indicator {
            display: inline-block;
            width: 15px;
            height: 15px;
            border-radius: 50%;
            background-color: blue;
            color: white;
            text-align: center;
            line-height: 15px;
        }
        .list-group-item.unread {
            font-weight: bold;
        }
        .indicator {
            color: blue; 
        }
        .buttons {
    margin-top: 5px;
    margin-bottom: 10px;
    white-space: nowrap; /* Prevent line breaks */
    }

    .buttons button {
        height: 40px;
        margin-right: 5px; /* Adjust spacing between buttons */
        display: inline-block; /* Use inline-block for inline display */
        font-size: 15px;
        font-weight:bold;
        vertical-align: middle; /* Align buttons vertically */
    }
        #btnRefreshMessages{
          display: none;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-4 message-list-container">
                <h3>Inbox <i class="fas fa-envelope"></i> <span id="unread-count" class="badge badge-danger"></span></h3>
                <div class="message-enclose-container">
                    <div class="list-group mt-4" id="message-list">
                        <!-- Messages will be inserted here by PHP -->
                        <?php
                        require 'Connection.php';

                        // Fetch messages (all messages by default)
                        $sql = "SELECT message_id, email, subject, message, received FROM messages";
                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                            $unreadCount = 0;
                            while($row = $result->fetch_assoc()) {
                                $unreadClass = $row['received'] == 'false' ? 'unread' : '';
                        
                                // Add circle indicator only for unread messages
                                $circleIndicator = $row['received'] == 'false' ? "<span class='indicator'><i class='fas fa-circle'></i></span>" : "";
                        
                                echo "<a href='#' class='list-group-item list-group-item-action message-row $unreadClass' data-id='{$row['message_id']}'>
                                        {$row['subject']}
                                        $circleIndicator
                                      </a>";
                                if ($row['received'] == 'false') {
                                    $unreadCount++;
                                }
                            }
                            echo "<script>document.getElementById('unread-count').textContent = $unreadCount > 0 ? $unreadCount : '';</script>";
                        } else {
                            echo "<p>No messages found.</p>";
                        }

                        $conn->close();
                        ?>
                    </div>
                    
                </div>
                <div class="buttons mt-3">
                    <button class="btn btn-danger" id="btnUnreadMessages">Unread messages</button>
                    <button class="btn btn-warning" id="btnRefreshMessages"> <i class="fas fa-redo-alt">  Refresh</i></button>
                </div>
            </div>
            <div class="col-md-8">
                <div class="message-content-container">
                    <div>
                        <label style="font-size: 16px; font-weight: bold; color:blue;" for="message-subject">Subject:</label>
                        <span id="message-subject"></span>
                    </div>
                    <div>
                        <label for="message-from" style="font-size: 16px; font-weight: bold; color:blue;">From:</label>
                        <span id="message-from"></span>
                    </div>
                    <div class="message-content mt-3">
                        <p id="message-content"></p>
                    </div>
                    <div class="reply-delete-buttons">
                        <button class="btn btn-danger" id="btnDelete">Delete</button>
                        <a id="gmail-link" class="btn btn-info" href="#" target="_blank">Reply in Gmail</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap and jQuery scripts -->
  
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>

    <script src="Mail.js">
       
    </script>
</body>
</html>
