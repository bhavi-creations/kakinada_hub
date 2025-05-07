<?php
include 'header.php'; // or include '../config.php' if header.php doesn't contain DB connection

$uploadDir = '../uploads/events/';

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die('Invalid event ID.');
}

$event_id = intval($_GET['id']);

// Get image filenames from DB
$stmt = $conn->prepare("SELECT main_image, occasion_images FROM events WHERE id = ?");
$stmt->bind_param("i", $event_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows != 1) {
    die('Event not found.');
}

$row = $result->fetch_assoc();
$main_image = $row['main_image'];
$occasion_images = explode(',', $row['occasion_images']);

// Delete main image
if (!empty($main_image) && file_exists($uploadDir . $main_image)) {
    unlink($uploadDir . $main_image);
}

// Delete occasion images
foreach ($occasion_images as $img) {
    $img = trim($img);
    if (!empty($img) && file_exists($uploadDir . $img)) {
        unlink($uploadDir . $img);
    }
}

// Delete the event record from the database
$stmt = $conn->prepare("DELETE FROM events WHERE id = ?");
$stmt->bind_param("i", $event_id);

if ($stmt->execute()) {
    header("Location: events.php?deleted=1");
    exit();
} else {
    echo "Error deleting event: " . $stmt->error;
}
?>
