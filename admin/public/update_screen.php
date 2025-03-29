<?php include '../../db.connection/db_connection.php'; ?>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $screen_id = $_POST['screen_id'];
    $screen_name = $_POST['screen_name'];

    // Fetch the theater_id before updating
    $query_get_theater = "SELECT theater_id FROM screens WHERE id = $screen_id";
    $result = mysqli_query($conn, $query_get_theater);
    $row = mysqli_fetch_assoc($result);
    $theater_id = $row['theater_id'];

    // Handle image upload
    if (!empty($_FILES['screen_image']['name'])) {
        $image = $_FILES['screen_image']['name'];
        $target = "../uploads/screens/" . basename($image);
        move_uploaded_file($_FILES['screen_image']['tmp_name'], $target);

        $query = "UPDATE screens SET screen_name='$screen_name', screen_image='$image' WHERE id=$screen_id";
    } else {
        $query = "UPDATE screens SET screen_name='$screen_name' WHERE id=$screen_id";
    }

    if (mysqli_query($conn, $query)) {
        header("Location: show_screens.php?theater_id=$theater_id&message=Screen Updated Successfully");
        exit();
    } else {
        echo "<div class='alert alert-danger'>Error updating screen.</div>";
    }
} else {
    header("Location: show_screens.php");
    exit();
}
?>
