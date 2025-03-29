<?php
include '../../db.connection/db_connection.php';

if (isset($_GET['id'])) {
    $id = mysqli_real_escape_string($conn, $_GET['id']);

    // Delete query
    $deleteQuery = "DELETE FROM movies WHERE id = '$id'";
    
    if (mysqli_query($conn, $deleteQuery)) {
        header("Location: show_movies.php?message=Movie Deleted Successfully");
    } else {
        echo "<div class='alert alert-danger'>Error deleting record: " . mysqli_error($conn) . "</div>";
    }
}
?>

