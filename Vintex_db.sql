CREATE DATABASE Vintex_db;

USE Vintex_db;

CREATE TABLE messages (
    message_id INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(255) NOT NULL,
    subject VARCHAR(255) NOT NULL,
    message TEXT NOT NULL,
    received ENUM('true', 'false') DEFAULT 'false'
);

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(255) NOT NULL,
    username VARCHAR(100) NOT NULL,
    password VARCHAR(255) NOT NULL,
    security_question ENUM('fav_food', 'dream_car', 'pets_name', 'nick_name', 'fav_person') NOT NULL,
    security_answer VARCHAR(255) NOT NULL
);

CREATE TABLE customers (
    id INT AUTO_INCREMENT PRIMARY KEY,
    customer_name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    phone_number VARCHAR(20) NOT NULL,
    address TEXT NOT NULL,
    business_description TEXT NOT NULL
);
CREATE TABLE about_us (
    id INT AUTO_INCREMENT PRIMARY KEY,
    text TEXT
);

INSERT INTO about_us (id, text) VALUES (1, 'Initial about us content');

CREATE TABLE terms_conditions (
    id INT PRIMARY KEY AUTO_INCREMENT,
    category VARCHAR(50) NOT NULL,
    description TEXT NOT NULL
);
INSERT INTO terms_conditions (category, description)
VALUES
    ('General Terms', 'These are the general rules and guidelines that apply to all users of our services. ...'),
    ('Payment and Billing Terms', 'This section covers the financial aspects of using our services, including pricing, payment methods, refunds, and fees.'),
    ('Privacy and Data Protection Terms', 'We are committed to protecting your privacy and handling your personal data responsibly. This section outlines our data practices, user rights, and measures taken to safeguard your information.');
