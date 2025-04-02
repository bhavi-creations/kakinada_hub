<?php
include '../../db.connection/db_connection.php';

if (isset($_GET['id'])) {
    $job_id = $_GET['id'];
    $delete_sql = "DELETE FROM jobs WHERE id = $job_id";
    
    if (mysqli_query($conn, $delete_sql)) {
        echo '<script>alert("Job deleted successfully!"); window.location.href="jobs.php";</script>';
    } else {
        echo '<script>alert("Error deleting job!"); window.location.href="jobs.php";</script>';
    }
}
?>
