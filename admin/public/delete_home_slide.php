<?php
include '../../db.connection/db_connection.php';

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = intval($_GET['id']);
    $sql = "DELETE FROM orange_slides WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        header("Location: home_orange_slides.php?deleted=true");
    } else {
        echo "Error deleting record: " . $conn->error;
    }
} else {
    echo "Invalid ID.";
}

$conn->close();
?>
