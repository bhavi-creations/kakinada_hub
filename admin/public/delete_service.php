<?php
include '../../db.connection/db_connection.php';

if (isset($_POST['id'])) {
    $serviceId = mysqli_real_escape_string($conn, $_POST['id']);
    $query = "DELETE FROM services WHERE id = '$serviceId'";

    if (mysqli_query($conn, $query)) {
        echo "success";
    } else {
        echo "error";
    }
}
?>
