<?php include '../../db.connection/db_connection.php'; ?>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $theater_id = $_POST['theater_id'];
    $name = $_POST['name'];
    $location = $_POST['location'];

    // Handle image upload
    if (!empty($_FILES['image']['name'])) {
        $image = $_FILES['image']['name'];
        $target = "../uploads/theaters/" . basename($image);
        move_uploaded_file($_FILES['image']['tmp_name'], $target);

        $query = "UPDATE theaters SET name='$name', location='$location', image='$image' WHERE id=$theater_id";
    } else {
        $query = "UPDATE theaters SET name='$name', location='$location' WHERE id=$theater_id";
    }

    if (mysqli_query($conn, $query)) {
        header("Location: movies.php?message=Theater Updated Successfully");
        exit();
    } else {
        echo "<div class='alert alert-danger'>Error updating theater.</div>";
    }
} else {
    header("Location: movies.php");
    exit();
}
?>
