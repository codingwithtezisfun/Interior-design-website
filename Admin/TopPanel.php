<?php
session_start();
require 'Connection.php';

// Example counts for demonstration
$count_customers = 10; // Replace with your actual count query
$count_messages = 5; // Replace with your actual count query
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        .panel {
            min-height: 130px;
            min-width: 150px;
        }
        .panel .panel-heading {
            padding: 50px;
        }
        .panel .panel-footer {
            background-color: #f5f5f5;
            height: 50px;
        }
        .panel-container {
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
        }
        .panel-item {
            flex: 0 0 calc(50% - 100px);
            margin: 0 25px;
            border-radius: 10px;
        }
        .panel-item i {
            color: white;
        }
        .panel-item .huge {
            font-weight: bold;
            color: red;
            font-size: 30px;
        }
        .panel-item .description {
            margin-left: 20px;
            margin-right: 20px;
        }
        .panel-footer .pull-left, .panel-footer .pull-right {
            margin-left: 30px;
        }
        @media (max-width: 768px) {
            .panel-item {
                flex: 0 0 100%;
                margin-bottom: 20px;
            }
        }
    </style>
</head>
<body>

    <div class="container mt-4">
        <div class="panel-container">
            <div class="panel-item" style="background-color:#ffcc99;"><!-- panel-item Starts -->
                <div class="panel panel-green"><!-- panel panel-green Starts -->
                    <div class="panel-heading"><!-- panel-heading Starts -->
                        <div class="row"><!-- panel-heading row Starts -->
                            <div class="col-xs-3"><!-- col-xs-3 Starts -->
                                <i class="fa fa-comments fa-5x"> </i>
                            </div><!-- col-xs-3 Ends -->
                            <div class="col-xs-9 text-right"><!-- col-xs-9 text-right Starts -->
                                <div class="huge"><?php echo $count_customers; ?></div>
                                <div class="description"><h3>Customers</h3></div>
                            </div><!-- col-xs-9 text-right Ends -->
                        </div><!-- panel-heading row Ends -->
                    </div><!-- panel-heading Ends -->
                    <a href="index.php?view_customers">
                        <div class="panel-footer"><!-- panel-footer Starts -->
                            <span class="pull-left">View Details</span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                            <div class="clearfix"></div>
                        </div><!-- panel-footer Ends -->
                    </a>
                </div><!-- panel panel-green Ends -->
            </div><!-- panel-item Ends -->

            <div class="panel-item" style="background-color:#76ff7a;"><!-- panel-item Starts -->
                <div class="panel panel-green"><!-- panel panel-green Starts -->
                    <div class="panel-heading"><!-- panel-heading Starts -->
                        <div class="row"><!-- panel-heading row Starts -->
                            <div class="col-xs-3"><!-- col-xs-3 Starts -->
                                <i class="fa fa-envelope fa-5x"> </i>
                            </div><!-- col-xs-3 Ends -->
                            <div class="col-xs-9 text-right"><!-- col-xs-9 text-right Starts -->
                                <div class="huge"><?php echo $count_messages; ?></div>
                                <div class="description"><h3>Messages</h3></div>
                            </div><!-- col-xs-9 text-right Ends -->
                        </div><!-- panel-heading row Ends -->
                    </div><!-- panel-heading Ends -->
                    <a href="index.php?view_messages">
                        <div class="panel-footer"><!-- panel-footer Starts -->
                            <span class="pull-left">View Details</span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                            <div class="clearfix"></div>
                        </div><!-- panel-footer Ends -->
                    </a>
                </div><!-- panel panel-green Ends -->
            </div><!-- panel-item Ends -->
        </div><!-- panel-container Ends -->
    </div><!-- container Ends -->

    <!-- Bootstrap and Font Awesome JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js"></script>
</body>
</html>
