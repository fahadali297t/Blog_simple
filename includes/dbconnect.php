<?php
$servername = "127.0.0.1";  // localhost address
$username = "root";  // MySQL username by default its root
$password = "Asd@00714";  // MySQL password
$database = "blog";  // database name

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
