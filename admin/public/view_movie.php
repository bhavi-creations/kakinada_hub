<?php
include '../../db.connection/db_connection.php';

if (isset($_GET['id'])) {
    $id = mysqli_real_escape_string($conn, $_GET['id']);
    $query = "SELECT * FROM movies WHERE id = '$id'";
    $result = mysqli_query($conn, $query);

    if ($row = mysqli_fetch_assoc($result)) {
?>
        <?php include 'header.php'; ?>
        <div id="wrapper">
            <?php include 'sidebar.php'; ?>
            <div id="content-wrapper" class="d-flex flex-column">
                <?php include 'navbar.php'; ?>
                <div id="content">
                    <div class="container-fluid">
                        <h2>Movie Details</h2>
                        <table class="table table-bordered">
                            <tr>
                                <th>Screen ID</th>
                                <td><?= $row['screen_id'] ?></td>
                            </tr>
                            <tr>
                                <th>Movie Name</th>
                                <td><?= $row['movie_name'] ?></td>
                            </tr>
                            <tr>
                                <th>Duration</th>
                                <td><?= $row['duration'] ?></td>
                            </tr>
                            <tr>
                                <th>Start Time</th>
                                <td><?= $row['start_time'] ?></td>
                            </tr>
                            <tr>
                                <th>Genre</th>
                                <td><?= $row['genre'] ?></td>
                            </tr>
                            <tr>
                                <th>Language</th>
                                <td><?= $row['language'] ?></td>
                            </tr>
                            <tr>
                                <th>Rating</th>
                                <td><?= $row['rating'] ?></td>
                            </tr>
                            <tr>
                                <th>About Movie</th>
                                <td><?= $row['about_movie'] ?></td>
                            </tr>
                            <tr>
                                <th>Director</th>
                                <td><?= $row['director'] ?></td>
                            </tr>
                            <tr>
                                <th>Producer</th>
                                <td><?= $row['producer'] ?></td>
                            </tr>
                            <tr>
                                <th>Musician</th>
                                <td><?= $row['musician'] ?></td>
                            </tr>
                            <tr>
                                <th>Hero</th>
                                <td><?= $row['hero'] ?></td>
                            </tr>
                            <tr>
                                <th>Heroin</th>
                                <td><?= $row['heroin'] ?></td>
                            </tr>
                            <tr>
                                <th>Images</th>
                                <td>
                                    <?php
                                    $images = explode(',', $row['images']); // Split images by comma
                                    foreach ($images as $image) {
                                        echo "<img src='../uploads/movies/$image' alt='Movie Image' width='150' style='margin: 5px;'>";
                                    }
                                    ?>
                                </td>
                            </tr>

                        </table>
                        <a href="show_movies.php" class="btn btn-primary">Back to List</a>
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
} else {
    echo "<div class='alert alert-danger'>Invalid Request.</div>";
}
?>