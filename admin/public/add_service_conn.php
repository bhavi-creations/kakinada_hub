<?php
include '../../db.connection/db_connection.php';
session_start(); // Start session to store messages

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $slug = strtolower(str_replace(' ', '-', $name)); // Convert name to URL-friendly slug

    // Define the page names based on service categories
    $servicePages = [
        "Movies" => "movies.php",
        "Restaurants" => "restaurants.php",
        "Properties" => "properties.php",
        "Salons & Spa" => "salons.php",
        "Gifts & Jewellery" => "gifts.php",
        "Fashion" => "fashion.php",
        "Hospitals" => "hospitals.php",
        "Sports & Gym" => "sports.php",
        "Kids & Babies" => "kids.php",
        "Jobs" => "jobs.php",
        "Events" => "events.php",
        "Travel" => "travel.php"
    ];

    // Assign the correct page name or default to a generic page
    $page_name = isset($servicePages[$name]) ? $servicePages[$name] : "service_details.php";

    // Insert data into the database with page_name
    $query = "INSERT INTO services (name, slug, page_name) VALUES ('$name', '$slug', '$page_name')";
    if (mysqli_query($conn, $query)) {
        $_SESSION['success'] = "Service added successfully!";
    } else {
        $_SESSION['error'] = "Error adding service. Please try again.";
    }

    header("Location: add_service.php"); // Redirect to prevent form resubmission
    exit();
}
?>
