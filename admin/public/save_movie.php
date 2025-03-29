<?php 
include '../../db.connection/db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $screen_id = mysqli_real_escape_string($conn, $_POST['screen_id']);
    $movie_name = mysqli_real_escape_string($conn, $_POST['movie_name']);
    $duration = mysqli_real_escape_string($conn, $_POST['duration']);  // Fixed duration
    $start_time = mysqli_real_escape_string($conn, $_POST['start_time']);
    $genre = mysqli_real_escape_string($conn, $_POST['genre']);
    $language = mysqli_real_escape_string($conn, $_POST['language']);
    $rating = mysqli_real_escape_string($conn, $_POST['rating']);
    $about_movie = mysqli_real_escape_string($conn, $_POST['about_movie']);
    $director = mysqli_real_escape_string($conn, $_POST['director']);
    $producer = mysqli_real_escape_string($conn, $_POST['producer']);
    $musician = mysqli_real_escape_string($conn, $_POST['musician']);
    $hero = mysqli_real_escape_string($conn, $_POST['hero']);
    $heroin = mysqli_real_escape_string($conn, $_POST['heroin']);  // Fixed heroin

    $uploadDir = "../uploads/movies/";
    $imagePaths = [];

    // Handling multiple image uploads
    if (!empty($_FILES["images"]["name"][0])) {
        foreach ($_FILES["images"]["name"] as $key => $fileName) {
            $fileTmpName = $_FILES["images"]["tmp_name"][$key];
            $fileType = pathinfo($fileName, PATHINFO_EXTENSION);
            $allowedTypes = ['jpg', 'jpeg', 'png', 'gif'];

            if (in_array(strtolower($fileType), $allowedTypes)) {
                // Generate a unique filename
                $uniqueFileName = time() . "_" . uniqid() . "." . $fileType;
                $targetFilePath = $uploadDir . $uniqueFileName;

                if (move_uploaded_file($fileTmpName, $targetFilePath)) {
                    $imagePaths[] = $uniqueFileName;
                } else {
                    echo "<div class='alert alert-danger'>Error uploading $fileName.</div>";
                }
            } else {
                echo "<div class='alert alert-danger'>$fileName has an invalid file type.</div>";
            }
        }
    } else {
        echo "<div class='alert alert-warning'>No image uploaded or an error occurred.</div>";
    }

    if (!empty($imagePaths)) {
        // Convert array to comma-separated string for database storage
        $imagePathsString = implode(",", $imagePaths);

        // **Insert all fields into the database**
        $query = "INSERT INTO movies 
                  (screen_id, movie_name, duration, start_time, images, genre, language, rating, about_movie, director, producer, musician, hero, heroin) 
                  VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, "ssssssssssssss", 
            $screen_id, $movie_name, $duration, $start_time, $imagePathsString, 
            $genre, $language, $rating, $about_movie, $director, 
            $producer, $musician, $hero, $heroin
        );

        if (mysqli_stmt_execute($stmt)) {
            header("Location: show_movies.php?message=Movie Added Successfully");
            exit();
        } else {
            echo "<div class='alert alert-danger'>Error adding movie: " . mysqli_error($conn) . "</div>";
        }
        mysqli_stmt_close($stmt);
    }
} else {
    header("Location: add_movie.php");
    exit();
}
?>
