<?php
session_start();
require 'Connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $customer_name = $_POST['customer_name'];
    $email = $_POST['email'];
    $phone_number = $_POST['phone_number'];
    $address = $_POST['address'];
    $business_description = $_POST['business_description'];

    $stmt = $conn->prepare("INSERT INTO customers (customer_name, email, phone_number, address, business_description) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $customer_name, $email, $phone_number, $address, $business_description);

    if ($stmt->execute()) {
        echo "<script>alert('You have been registered successfully');</script>";
        echo "<script>window.location.href = 'AdminDashboard.php';</script>";
    } else {
        echo "<script>alert('Error registering ');</script>";
        echo "<script>window.location.href = 'RegisterCustomer.html';</script>";
    }

    $stmt->close();
}

$conn->close();
?>
