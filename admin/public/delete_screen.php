<?php include '../../db.connection/db_connection.php'; ?>

<?php
if (isset($_GET['screen_id'])) {
    $screen_id = $_GET['screen_id'];

    // Fetch the theater_id before deleting the screen
    $query = "SELECT theater_id FROM screens WHERE id = $screen_id";
    $result = mysqli_query($conn, $query);
    
    if ($row = mysqli_fetch_assoc($result)) {
        $theater_id = $row['theater_id'];

        // Delete screen from the database
        $deleteQuery = "DELETE FROM screens WHERE id = $screen_id";
        if (mysqli_query($conn, $deleteQuery)) {
            header("Location: show_screens.php?theater_id=$theater_id&message=Screen Deleted Successfully");
            exit();
        } else {
            echo "<div class='alert alert-danger'>Error deleting screen.</div>";
        }
    } else {
        echo "<div class='alert alert-danger'>Screen not found.</div>";
    }
} else {
    header("Location: show_screens.php?error=Invalid Screen ID");
    exit();
}
?>
