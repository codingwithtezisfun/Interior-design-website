$(document).ready(function() {
    // Function to fetch unread messages
    $('#btnUnreadMessages').on('click', function() {
        fetchMessages('fetch_unread_messages.php');
        $('#btnRefreshMessages').css('display', 'block'); // Show the refresh button
        $('#btnUnreadMessages').css('display', 'none'); // Hide the unread messages button
    });

    // Function to refresh messages
    $('#btnRefreshMessages').on('click', function() {
        fetchMessages('fetch_unread_messages.php');
    });

    // Function to fetch all messages (default)
    $('#btnAllMessages').on('click', function() {
        fetchMessages('fetch_all_messages.php');
    });

    // Function to handle message row click
    $(document).on('click', '.message-row', function(event) {
        event.preventDefault();
        const messageId = $(this).data('id');

        fetch('get_message.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: new URLSearchParams({
                message_id: messageId
            })
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            if (data.error) {
                alert(data.error);
            } else {
                $('#message-subject').text(data.subject);
                $('#message-from').text(data.email);
                $('#message-content').text(data.message);
                $(`[data-id=${messageId}]`).removeClass('unread');

                let unreadCount = $('#unread-count').text();
                unreadCount = parseInt(unreadCount) - 1;
                $('#unread-count').text(unreadCount > 0 ? unreadCount : '');

                const emailTo = encodeURIComponent(data.email);
                const subject = encodeURIComponent(data.subject);
                const gmailLink = `mailto:${emailTo}?subject=${subject}`;

                $('#gmail-link').attr('href', gmailLink);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Error fetching message details. Please try again later.');
        });
    });

    // Function to handle message deletion
    $('#btnDelete').on('click', function() {
        const subject = $('#message-subject').text().trim();
        const email = $('#message-from').text().trim();

        if (!subject || !email) {
            alert('Please select a message to delete.');
            return;
        }

        if (confirm('Are you sure you want to delete this message?')) {
            fetch('delete_message.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: new URLSearchParams({
                    subject: subject,
                    email: email
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Message deleted successfully.');
                    // Optionally, update UI to reflect deletion
                } else {
                    alert('Failed to delete message.');
                }
            })
            .catch(error => {
                console.error('Error deleting message:', error);
                alert('Error deleting message. Please try again later.');
            });
        }
    });

    // Function to fetch messages based on URL using Fetch API
    function fetchMessages(url) {
        fetch(url)
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(messages => {
                const messageList = document.getElementById('message-list');
                messageList.innerHTML = ''; // Clear previous messages

                let unreadCount = 0;

                messages.forEach(message => {
                    const unreadClass = message.received === 'false' ? 'unread' : '';

                    messageList.innerHTML += `
                        <a href='#' class='list-group-item list-group-item-action message-row ${unreadClass}' data-id='${message.message_id}'>
                            <span class="message-indicator">${unreadClass === 'unread' ? '<i class="fas fa-circle"></i>' : ''}</span>
                            ${message.subject} ${message.received === 'false' ? `(${unreadCount})` : ''}
                        </a>
                    `;

                    if (message.received === 'false') {
                        unreadCount++;
                    }
                });

                document.getElementById('unread-count').textContent = unreadCount > 0 ? unreadCount : '';
            })
            .catch(error => {
                console.error('Error fetching messages:', error);
                alert('Error fetching messages. Please try again later.');
            });
    }
});
