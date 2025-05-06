<?php
// delete_restaurant.php
include '../../db.connection/db_connection.php';

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = intval($_GET['id']);

    // Function to delete restaurant.
    function deleteRestaurant($conn, $id) {
        $stmt = $conn->prepare("DELETE FROM restaurants WHERE id = ?");
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
    if (deleteRestaurant($conn, $id)) {
        echo "<div class='alert alert-success'>Restaurant deleted successfully.</div>";
        header("Location: view_restaurants.php"); //redirect
        exit;
    } else {
        echo "<div class='alert alert-danger'>Failed to delete restaurant.</div>";
        header("Location: view_restaurants.php");
        exit;
    }
} else {
    echo "<div class='alert alert-danger'>Invalid request.</div>";
    header("Location: view_restaurants.php");
    exit;
}
?>
