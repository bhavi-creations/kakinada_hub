<?php include 'header.php'; ?>

<!-- Page Wrapper -->
<div id="wrapper">
    <?php include 'sidebar.php'; ?>

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">
        <?php include 'navbar.php'; ?>

        <div id="content">
            <div class="container-fluid">
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-0 text-gray-800">Add Movie to Screen</h1>

                    <a href="show_movies.php" class="btn btn-sm btn-primary shadow-sm">
                        <i class="fa-regular fa-eye"></i> View Added Movies
                    </a>
                </div>

                <div class="container mt-5">
                    <div class="row">
                        <div class="row row-custom no-gutters col-12">
                            <?php include '../../db.connection/db_connection.php'; ?>

                            <form action="save_movie.php" method="POST" enctype="multipart/form-data">
                                <div class="row">
                                    <!-- Select Screen -->
                                    <div class="col-md-3 mb-3">
                                        <label for="screen_id" class="form-label">Select Screen:</label>
                                        <select name="screen_id" id="screen_id" class="form-control" required>
                                            <option value="">-- Select Screen --</option>
                                            <?php
                                            $result = mysqli_query($conn, "SELECT id, screen_name FROM screens");
                                            while ($row = mysqli_fetch_assoc($result)) {
                                                echo "<option value='{$row['id']}'>" . htmlspecialchars($row['screen_name']) . "</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>

                                    <!-- Movie Name -->
                                    <div class="col-md-3 mb-3">
                                        <label for="movie_name" class="form-label">Movie Name:</label>
                                        <input type="text" name="movie_name" id="movie_name" class="form-control" required>
                                    </div>

                                    <!-- Images (Multiple) -->
                                    <div class="col-md-3 mb-3">
                                        <label for="images" class="form-label">Movie Images:</label>
                                        <input type="file" name="images[]" id="images" class="form-control" multiple required accept="image/*">
                                        <small class="text-muted">Upload only JPG, JPEG, PNG, GIF.</small>
                                    </div>

                                    <!-- Genre -->
                                    <div class="col-md-3 mb-3">
                                        <label for="genre" class="form-label">Genre:</label>
                                        <input type="text" name="genre" id="genre" class="form-control" required>
                                    </div>

                                    <!-- Language -->
                                    <div class="col-md-3 mb-3">
                                        <label for="language" class="form-label">Language:</label>
                                        <input type="text" name="language" id="language" class="form-control" required>
                                    </div>

                                    <!-- Rating -->
                                    <div class="col-md-3 mb-3">
                                        <label for="rating" class="form-label">Rating:</label>
                                        <input type="number" name="rating" id="rating" step="0.1" min="0" max="10" class="form-control" value="5" required>
                                    </div>

                                    <!-- Director -->
                                    <div class="col-md-3 mb-3">
                                        <label for="director" class="form-label">Director:</label>
                                        <input type="text" name="director" id="director" class="form-control" required>
                                    </div>

                                    <!-- Producer -->
                                    <div class="col-md-3 mb-3">
                                        <label for="producer" class="form-label">Producer:</label>
                                        <input type="text" name="producer" id="producer" class="form-control">
                                    </div>

                                    <!-- Musician -->
                                    <div class="col-md-3 mb-3">
                                        <label for="musician" class="form-label">Musician:</label>
                                        <input type="text" name="musician" id="musician" class="form-control">
                                    </div>

                                    <!-- Hero -->
                                    <div class="col-md-3 mb-3">
                                        <label for="hero" class="form-label">Hero:</label>
                                        <input type="text" name="hero" id="hero" class="form-control" required>
                                    </div>

                                    <!-- Heroine -->
                                    <div class="col-md-3 mb-3">
                                        <label for="heroin" class="form-label">Heroine:</label>
                                        <input type="text" name="heroin" id="heroin" class="form-control" required>
                                    </div>

                                    <!-- Duration -->
                                    <div class="col-md-3 mb-3">
                                        <label for="duration" class="form-label">Duration (HH:MM:SS):</label>
                                        <input type="time" name="duration" id="duration" class="form-control" required value="00:00:00">
                                    </div>

                                    <!-- Start Time -->
                                    <div class="col-md-3 mb-3">
                                        <label for="start_time" class="form-label">Start Time:</label>
                                        <input type="time" name="start_time" id="start_time" class="form-control" required>
                                    </div>

                                    <!-- About Movie -->
                                    <div class="col-md-3 mb-3">
                                        <label for="about_movie" class="form-label">About Movie:</label>
                                        <textarea name="about_movie" id="about_movie" class="form-control" rows="4" required></textarea>
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-primary">Add Movie</button>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <?php include 'footer.php'; ?>
    </div>
</div>

<?php include 'end.php'; ?>
