<?php
include '../../db.connection/db_connection.php';

if (isset($_GET['id'])) {
    $id = mysqli_real_escape_string($conn, $_GET['id']);
    $query = "SELECT * FROM movies WHERE id = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($row = mysqli_fetch_assoc($result)) {
        if (isset($_POST['update'])) {
            $movie_name = mysqli_real_escape_string($conn, $_POST['movie_name']);
            $duration = mysqli_real_escape_string($conn, $_POST['duration']);
            $start_time = mysqli_real_escape_string($conn, $_POST['start_time']);
            $genre = mysqli_real_escape_string($conn, $_POST['genre']);
            $language = mysqli_real_escape_string($conn, $_POST['language']);
            $rating = mysqli_real_escape_string($conn, $_POST['rating']);
            $about_movie = mysqli_real_escape_string($conn, $_POST['about_movie']);
            $director = mysqli_real_escape_string($conn, $_POST['director']);
            $producer = mysqli_real_escape_string($conn, $_POST['producer']);
            $musician = mysqli_real_escape_string($conn, $_POST['musician']);
            $hero = mysqli_real_escape_string($conn, $_POST['hero']);
            $heroin = mysqli_real_escape_string($conn, $_POST['heroin']);

            $target_dir = "../uploads/movies/";
            $uploaded_images = [];

            // Remove old images from server
            $old_images = explode(',', $row['images']);
            foreach ($old_images as $old_image) {
                if (!empty($old_image) && file_exists($target_dir . $old_image)) {
                    unlink($target_dir . $old_image);
                }
            }

            // Handling multiple file uploads
            if (!empty($_FILES['images']['name'][0])) {
                foreach ($_FILES['images']['name'] as $key => $image_name) {
                    $image_tmp = $_FILES['images']['tmp_name'][$key];
                    $ext = pathinfo($image_name, PATHINFO_EXTENSION);
                    $unique_name = uniqid() . '.' . $ext;
                    $target_file = $target_dir . $unique_name;

                    if (move_uploaded_file($image_tmp, $target_file)) {
                        $uploaded_images[] = $unique_name;
                    }
                }
                $image_names = implode(',', $uploaded_images);
            } else {
                $image_names = ""; // No images uploaded
            }

            // Using prepared statement for updating the record
            $updateQuery = "UPDATE movies SET 
                movie_name = ?, duration = ?, start_time = ?, genre = ?, language = ?, rating = ?, 
                about_movie = ?, director = ?, producer = ?, musician = ?, hero = ?, heroin = ?, images = ? 
                WHERE id = ?";

            $stmt = mysqli_prepare($conn, $updateQuery);
            mysqli_stmt_bind_param(
                $stmt,
                "sssssssssssssi",
                $movie_name,
                $duration,
                $start_time,
                $genre,
                $language,
                $rating,
                $about_movie,
                $director,
                $producer,
                $musician,
                $hero,
                $heroin,
                $image_names,
                $id
            );

            if (mysqli_stmt_execute($stmt)) {
                header("Location: show_movies.php?message=Movie Updated Successfully");
                exit();
            } else {
                echo "<div class='alert alert-danger'>Error updating record: " . mysqli_error($conn) . "</div>";
            }
        }
?>

        <?php include 'header.php'; ?>
        <div id="wrapper">
            <?php include 'sidebar.php'; ?>
            <div id="content-wrapper" class="d-flex flex-column">
                <?php include 'navbar.php'; ?>
                <div id="content">
                    <div class="container-fluid">
                        <h2>Edit Movie</h2>
                        <form method="POST" enctype="multipart/form-data">
                            <div class="row">
                                <div class="form-group col-md-4 mb-3">
                                    <label>Movie Name</label>
                                    <input type="text" name="movie_name" class="form-control" value="<?= $row['movie_name'] ?>" required>
                                </div>
                                <div class="form-group col-md-4 mb-3">
                                    <label>Duration</label>
                                    <input type="text" name="duration" class="form-control" value="<?= $row['duration'] ?>" required>
                                </div>
                                <div class="form-group col-md-4 mb-3">
                                    <label>Start Time</label>
                                    <input type="text" name="start_time" class="form-control" value="<?= $row['start_time'] ?>" required>
                                </div>
                                <div class="form-group col-md-4 mb-3">
                                    <label>Genre</label>
                                    <input type="text" name="genre" class="form-control" value="<?= $row['genre'] ?>" required>
                                </div>
                                <div class="form-group col-md-4 mb-3">
                                    <label>Language</label>
                                    <input type="text" name="language" class="form-control" value="<?= $row['language'] ?>" required>
                                </div>
                                <div class="form-group col-md-4 mb-3">
                                    <label>Rating</label>
                                    <input type="text" name="rating" class="form-control" value="<?= $row['rating'] ?>" required>
                                </div>
                                <div class="form-group col-md-4 mb-3">
                                    <label>Director</label>
                                    <input type="text" name="director" class="form-control" value="<?= $row['director'] ?>" required>
                                </div>
                                <div class="form-group col-md-4 mb-3">
                                    <label>Producer</label>
                                    <input type="text" name="producer" class="form-control" value="<?= $row['producer'] ?>" required>
                                </div>
                                <div class="form-group col-md-4 mb-3">
                                    <label>Musician</label>
                                    <input type="text" name="musician" class="form-control" value="<?= $row['musician'] ?>" required>
                                </div>
                                <div class="form-group col-md-4 mb-3">
                                    <label>Hero</label>
                                    <input type="text" name="hero" class="form-control" value="<?= $row['hero'] ?>" required>
                                </div>
                                <div class="form-group col-md-4 mb-3">
                                    <label>Heroin</label>
                                    <input type="text" name="heroin" class="form-control" value="<?= $row['heroin'] ?>" required>
                                </div>
                                <div class="form-group col-md-4 mb-3">
                                    <label>About Movie</label>
                                    <input type="text" name="about_movie" class="form-control" value="<?= $row['about_movie'] ?>" required>
                                </div>
                                 


                                <div class="form-group col-md-4 mb-3">
                                    <label>Existing Images</label>
                                    <div>
                                        <?php
                                        $image_list = explode(',', $row['images']);
                                        foreach ($image_list as $image) {
                                            if (!empty($image)) {
                                                echo "<img src='../uploads/movies/$image' alt='Movie Image' width='100' style='margin-right: 10px;'>";
                                            }
                                        }
                                        ?>
                                    </div>
                                </div>
                                <div class="form-group col-md-4 mb-3">
                                    <label>Upload New Images (This will replace old ones)</label>
                                    <input type="file" name="images[]" class="form-control" multiple>
                                </div>
                            </div>
                            <button type="submit" name="update" class="btn btn-success">Update</button>
                        <a href="show_movies.php" class="btn btn-primary">Cancle</a>

                        </form>
                    </div>
                </div>
                <?php include 'footer.php'; ?>
            </div>
        </div>
        <?php include 'end.php'; ?>
<?php
    } else {
        echo "<div class='alert alert-danger'>Movie not found.</div>";
    }
}
?>