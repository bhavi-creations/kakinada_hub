 

<?php
include '../../db.connection/db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $name = $_POST['name'];

    $query = "UPDATE services SET name = ? WHERE id = ?";
    $stmt = mysqli_prepare($conn, $query);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "si", $name, $id);
        if (mysqli_stmt_execute($stmt)) {
            echo "success"; // This response is checked in JavaScript
        } else {
            echo "error";
        }
        mysqli_stmt_close($stmt);
    } else {
        echo "error";
    }
    mysqli_close($conn);
}
?>
