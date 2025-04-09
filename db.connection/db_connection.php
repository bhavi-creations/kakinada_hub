<?php
// Database connection details
$servername = "localhost";
// Determine if the server is localhost
if ($_SERVER['SERVER_NAME'] == 'localhost') {
    $username = "root";
    $password = "";
    $dbname = "kakinadahub";
} else {
    $username = "kakinadahub";
    $password = "2LxzQAMBBt6PnPF";
    $dbname = "kakinadahub";
 
}

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
