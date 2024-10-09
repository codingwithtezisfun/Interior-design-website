<?php
session_start(); 

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    
    <style>
        body {
            display: flex;
        }
        .sidebar {
            height: 100vh;
            width: 250px;
            position: fixed;
            top: 0;
            left: 0;
            background-color: #343a40;
            color: white;
            transition: width 0.3s;
            padding-bottom: 50px;
        }
        .sidebar.collapsed {
            width: 0;
            overflow: hidden;
        }
        .sidebar .nav-link {
            color: white;
        }
        .sidebar .nav-link i {
            margin-right: 10px; /* Add space between icon and label */
        }
        .sidebar .nav-link:hover {
            background-color: #495057;
        }
        .sidebar .nav {
            height: calc(100% - 56px);
            display: flex;
            flex-direction: column;
        }
        .sidebar .nav-link {
            flex: 1;
            display: flex;
            align-items: center;
        }
        .content {
            margin-left: 250px;
            padding: 2px;
            width: 100%;
            transition: margin-left 0.3s;
        }
        .content.collapsed {
            margin-left: 0;
        }
        @media (max-width: 768px) {
            .sidebar {
                display: none;
            }
            .sidebar.expanded {
                display: block;
                width: 250px;
            }
            .content {
                margin-left: 0;
            }
            .content.expanded {
                margin-left: 250px;
            }
            #sidebarToggleSmall {
                display: block;
            }
        }
        @media (min-width: 769px) {
            #sidebarToggleSmall {
                display: none;
            }
        }
        .navbar {
            background-color: #343a40; /* Dark background color */
            color: #ffffff; /* Light text color */
            padding: 10px 15px; /* Padding inside the navbar */
        }
        .navbar-brand {
            color: #ffffff; /* Light text color for brand/logo */
            font-weight: bold; /* Bold font weight */
            font-size: 1.5rem; /* Larger font size */
        }
        .navbar-text {
            color: #ffffff; /* Light text color for text */
            font-size: 1.2rem; /* Font size */
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <div class="d-flex align-items-center justify-content-between p-3">
           <h2 class="mb-0">DASHBOARD</h2>
        </div>
        <nav class="nav flex-column">
            <a id="home-link" class="nav-link" href="#"><i class="fas fa-home"></i> Home</a>
            <a id="mailbox-link" class="nav-link" href="#"><i class="fas fa-inbox"></i> Mailbox</a>
            <a id="about-us-link" class="nav-link" href="#"><i class="fas fa-info-circle"></i> About Us</a>
            <a id="contact-us-link" class="nav-link" href="#"><i class="fas fa-address-book"></i> Contact Us</a>
            <a id="user-link" class="nav-link" href="#"><i class="fas fa-users"></i> User</a>
            <a id="add-user-link" class="nav-link" href="#"><i class="fas fa-user-plus"></i> Add User</a>
            <a id="fetch-users-link" class="nav-link" href="#"><i class="fas fa-list"></i> Fetch All Users</a>
            <a id="customers-link" class="nav-link" href="#"><i class="fas fa-user-friends"></i> Customers</a>
            <a id="logout-link" class="nav-link mt-auto" href="#"><i class="fas fa-sign-out-alt"></i> Log Out</a>
        </nav>

    </div>
    <button id="sidebarToggleSmall" class="btn btn-light d-md-none">
        <i class="fas fa-bars"></i>
    </button>
    <div class="content">
    <nav class="navbar navbar-expand-md">
        <button id="sidebarToggle" class="btn btn-primary mr-3 d-none d-md-block"><i class="fas fa-bars"></i></button> <!-- Sidebar toggle button on the left -->
        <div class="navbar-collapse justify-content-end">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <span class="navbar-text mr-3">Welcome, <?php echo $_SESSION['username']; ?>!</span> <!-- Welcome message on the right -->
                </li>
            </ul>
        </div>
    </nav>
    <div>
    <div id="ElementsContainer">
   </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="Mail.js"></script>
    <script src="FetchScripts.js"></script>
    <script>
        document.getElementById('sidebarToggle').addEventListener('click', function() {
            document.querySelector('.sidebar').classList.toggle('collapsed');
            document.querySelector('.content').classList.toggle('collapsed');
        });

        document.getElementById('sidebarToggleSmall').addEventListener('click', function() {
            document.querySelector('.sidebar').classList.toggle('expanded');
            document.querySelector('.content').classList.toggle('expanded');
        });

        // Add event listeners to all sidebar links to close the sidebar on small screens
        document.querySelectorAll('.sidebar .nav-link').forEach(function(link) {
            link.addEventListener('click', function() {
                if (window.innerWidth <= 768) {
                    document.querySelector('.sidebar').classList.remove('expanded');
                    document.querySelector('.content').classList.remove('expanded');
                }
            });
        });

         // Function to fetch and load external HTML content
    function fetchAndLoadContent(containerId, url) {
      fetch(url)
        .then(response => response.text())
        .then(html => {
          document.getElementById(containerId).innerHTML = html;
        })
        .catch(error => console.error('Error loading content:', error));
    }

      // Event listener for Mailbox link
      document.getElementById('mailbox-link').addEventListener('click', function(event) {
            event.preventDefault(); // Prevent default link behavior
            loadMail();
        });
        document.getElementById('mailbox-link').addEventListener('click', function(event) {
            event.preventDefault(); // Prevent default link behavior
            fetchAndLoadContent(containerId, url);
        });
        document.getElementById('mailbox-link').addEventListener('click', function(event) {
            event.preventDefault(); // Prevent default link behavior
            fetchAndLoadContent(containerId, url);
        });
        document.getElementById('mailbox-link').addEventListener('click', function(event) {
            event.preventDefault(); // Prevent default link behavior
            fetchAndLoadContent(containerId, url);
        });
        document.getElementById('mailbox-link').addEventListener('click', function(event) {
            event.preventDefault(); // Prevent default link behavior
            fetchAndLoadContent(containerId, url);
        });

        // Initial load (optional)
        //fetchAndLoadContent('MailContainer', 'Mail.php');

                //Display the course management container in the main page
                function loadMail() {
                    loadHTML('Mail.php', 'ElementsContainer', reloadMailJs);
                }
                // Function to load HTML content
                function loadHTML(url, targetId, callback) {
                    fetch(url)
                        .then(response => response.text())
                        .then(html => {
                            document.getElementById(targetId).innerHTML = html;
                            if (callback && typeof callback === 'function') {
                                callback(); // Call the callback function after inserting HTML
                            }
                        })
                        .catch(error => {
                            console.error('There was a problem with the fetch operation:', error);
                        });
                }

    </script>
</body>
</html>

