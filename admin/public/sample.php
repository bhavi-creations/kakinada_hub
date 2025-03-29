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
                    <h1 class="h3 mb-0 text-gray-800">Available Services</h1>
                    <a href="add_service.php" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                        <i class="fa-solid fa-plus"></i> Add Property Types
                    </a>
                </div>

                <div class="container">
                    <div class="row">
                        <div class="row row-custom no-gutters col-12">
                            <?php include '../../db.connection/db_connection.php'; ?>


                            <h2>Add Movie to Screen</h2>

                            <form action="save_movie.php" method="POST">
                                <div class="mb-3">
                                    <label for="screen_id" class="form-label">Select Screen:</label>
                                    <select name="screen_id" id="screen_id" class="form-control" required>
                                        <option value="">-- Select Screen --</option>
                                        <?php
                                        $result = mysqli_query($conn, "SELECT id, screen_name FROM screens");
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            echo "<option value='{$row['id']}'>{$row['screen_name']}</option>";
                                        }
                                        ?>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="movie_name" class="form-label">Movie Name:</label>
                                    <input type="text" name="movie_name" id="movie_name" class="form-control" required>
                                </div>

                                <div class="mb-3">
                                    <label for="duration" class="form-label">Duration (HH:MM:SS):</label>
                                    <input type="time" name="duration" id="duration" class="form-control" required>
                                </div>

                                <div class="mb-3">
                                    <label for="start_time" class="form-label">Start Time:</label>
                                    <input type="time" name="start_time" id="start_time" class="form-control" required>
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