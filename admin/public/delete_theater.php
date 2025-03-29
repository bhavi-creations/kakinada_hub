<?php include '../../db.connection/db_connection.php'; ?>

<?php
if (isset($_GET['theater_id'])) {
    $theater_id = $_GET['theater_id'];

    // Delete theater from database
    $query = "DELETE FROM theaters WHERE id = $theater_id";

    if (mysqli_query($conn, $query)) {
        header("Location: index.php?message=Theater Deleted Successfully");
        exit();
    } else {
        echo "<div class='alert alert-danger'>Error deleting theater.</div>";
    }
} else {
    header("Location: index.php");
    exit();
}
?>
