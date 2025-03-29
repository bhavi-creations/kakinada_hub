<?php
include '../../db.connection/db_connection.php';

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['id'])) {
    $id = $_POST['id'];

    // Fetch the image filename
    $query = "SELECT image FROM home_ads WHERE id = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    
    if ($row = mysqli_fetch_assoc($result)) {
        $imagePath = "../uploads/home_ads/" . $row['image'];

        // Delete the image file from the server
        if (file_exists($imagePath) && !empty($row['image'])) {
            unlink($imagePath);
        }
    }

    // Delete from database
    $deleteQuery = "DELETE FROM home_ads WHERE id = ?";
    $stmt = mysqli_prepare($conn, $deleteQuery);
    mysqli_stmt_bind_param($stmt, "i", $id);
    
    if (mysqli_stmt_execute($stmt)) {
        echo "success";
    } else {
        echo "error";
    }

    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}
?>
