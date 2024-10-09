<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>eCommerce Dashboard</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
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
                        <span class="navbar-text mr-3">Welcome, </span> <!-- Welcome message on the right -->
                    </li>
                </ul>
            </div>
        </nav>

        <div class="container mt-4">
            <div class="row">
                <div class="col">
                    <div class="top-panel">
                        <!-- Slider with product images (Dummy data example) -->
                        <div id="imageSlider" class="carousel slide" data-ride="carousel">
                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                    <img src="https://via.placeholder.com/600x300?text=Product+1" class="d-block w-100" alt="Product 1">
                                </div>
                                <div class="carousel-item">
                                    <img src="https://via.placeholder.com/600x300?text=Product+2" class="d-block w-100" alt="Product 2">
                                </div>
                                <div class="carousel-item">
                                    <img src="https://via.placeholder.com/600x300?text=Product+3" class="d-block w-100" alt="Product 3">
                                </div>
                            </div>
                            <a class="carousel-control-prev" href="#imageSlider" role="button" data-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#imageSlider" role="button" data-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-4">
                <!-- Product grid (Dummy data example) -->
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <img src="https://via.placeholder.com/300x200?text=Product+1" class="card-img-top" alt="Product 1">
                        <div class="card-body">
                            <h5 class="card-title">Product 1</h5>
                            <p class="card-text">Description of Product 1.</p>
                            <p class="card-text">$19.99</p>
                            <button class="btn btn-primary add-to-cart-btn" data-product-id="1">Add to Cart</button>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <img src="https://via.placeholder.com/300x200?text=Product+2" class="card-img-top" alt="Product 2">
                        <div class="card-body">
                            <h5 class="card-title">Product 2</h5>
                            <p class="card-text">Description of Product 2.</p>
                            <p class="card-text">$24.99</p>
                            <button class="btn btn-primary add-to-cart-btn" data-product-id="2">Add to Cart</button>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <img src="https://via.placeholder.com/300x200?text=Product+3" class="card-img-top" alt="Product 3">
                        <div class="card-body">
                            <h5 class="card-title">Product 3</h5>
                            <p class="card-text">Description of Product 3.</p>
                            <p class="card-text">$14.99</p>
                            <button class="btn btn-primary add-to-cart-btn" data-product-id="3">Add to Cart</button>
                        </div>
                    </div>
                </div>
                <!-- Additional Products -->
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <img src="https://via.placeholder.com/300x200?text=Product+4" class="card-img-top" alt="Product 4">
                        <div class="card-body">
                            <h5 class="card-title">Product 4</h5>
                            <p class="card-text">Description of Product 4.</p>
                            <p class="card-text">$29.99</p>
                            <button class="btn btn-primary add-to-cart-btn" data-product-id="4">Add to Cart</button>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <img src="https://via.placeholder.com/300x200?text=Product+5" class="card-img-top" alt="Product 5">
                        <div class="card-body">
                            <h5 class="card-title">Product 5</h5>
                            <p class="card-text">Description of Product 5.</p>
                            <p class="card-text">$34.99</p>
                            <button class="btn btn-primary add-to-cart-btn" data-product-id="5">Add to Cart</button>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <img src="https://via.placeholder.com/300x200?text=Product+6" class="card-img-top" alt="Product 6">
                        <div class="card-body">
                            <h5 class="card-title">Product 6</h5>
                            <p class="card-text">Description of Product 6.</p>
                            <p class="card-text">$39.99</p>
                            <button class="btn btn-primary add-to-cart-btn" data-product-id="6">Add to Cart</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript libraries and scripts -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        document.getElementById('sidebarToggle').addEventListener('click', function() {
            document.querySelector('.sidebar').classList.toggle('collapsed');
            document.querySelector('.content').classList.toggle('collapsed');
        });

        document.getElementById('sidebarToggleSmall').addEventListener('click', function() {
            document.querySelector('.sidebar').classList.toggle('expanded');
            document.querySelector('.content').classList.toggle('expanded');
        });
    </script>
</body>
</html>
