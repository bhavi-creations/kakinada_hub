<?php
include '../../db.connection/db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $title = $_POST['title'];
    $position = $_POST['position']; // New position (Upper/Lower)
    $image = $_FILES['image']['name'];

    if (!empty($image)) {
        $targetDir = "../uploads/home_ads/";
        $targetFile = $targetDir . basename($image);
        move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile);

        // Update with new image
        $updateQuery = "UPDATE home_ads SET title = '$title', type = '$position', image = '$image' WHERE id = $id";
    } else {
        // Update only title and position
        $updateQuery = "UPDATE home_ads SET title = '$title', type = '$position' WHERE id = $id";
    }

    if (mysqli_query($conn, $updateQuery)) {
        echo "success";
    } else {
        echo "error: " . mysqli_error($conn);
    }

    mysqli_close($conn);
}
?>
