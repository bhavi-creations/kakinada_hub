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
                    <h1 class="h3 mb-0 text-gray-800">Available Shows</h1>
                    <a href="add_movie.php" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                        <i class="fa-solid fa-plus"></i> Add Movies
                    </a>
                    <a href="movies.php" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                        <i class="fa-regular fa-eye"></i> Show Theaters
                    </a>
                </div>

                <div class="container">
                    <div class="row">
                        <div class="row row-custom no-gutters col-12">
                            <?php include '../../db.connection/db_connection.php'; ?>

                            <h2>Movies List</h2>

                            <?php if (isset($_GET['message'])): ?>
                                <div class="alert alert-success" id="successMessage">
                                    <?= $_GET['message'] ?>
                                </div>

                                <script>
                                    // Hide success message after 2 seconds (2000 milliseconds)
                                    setTimeout(function() {
                                        document.getElementById("successMessage").style.display = "none";
                                    }, 2000);
                                </script>
                            <?php endif; ?>

                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>S.No</th>
                                        <th>Screen</th>
                                        <th>Movie Name</th>
                                        <th>Duration</th>
                                        <th>Start Time</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $query = "SELECT movies.id, screens.screen_name, movies.movie_name, movies.duration, movies.start_time 
                                              FROM movies 
                                              JOIN screens ON movies.screen_id = screens.id 
                                              ORDER BY movies.id ASC";
                                    $result = mysqli_query($conn, $query);
                                    $sno = 1;

                                    while ($row = mysqli_fetch_assoc($result)) {
                                        echo "<tr>
                                            <td>{$sno}</td>
                                            <td>{$row['screen_name']}</td>
                                            <td>{$row['movie_name']}</td>
                                            <td>{$row['duration']}</td>
                                            <td>{$row['start_time']}</td>
                                            <td>
                                                <a href='view_movie.php?id={$row['id']}' class='btn btn-info btn-sm'><i class='fa fa-eye'></i> View</a>
                                                <a href='edit_movie.php?id={$row['id']}' class='btn btn-warning btn-sm'><i class='fa fa-edit'></i> Edit</a>
                                                <a href='delete_movie.php?id={$row['id']}' class='btn btn-danger btn-sm' onclick='return confirm(\"Are you sure you want to delete this movie?\")'>
                                                    <i class='fa fa-trash'></i> Delete
                                                </a>
                                            </td>
                                        </tr>";
                                        $sno++;
                                    }
                                    ?>
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>

            </div>
        </div>

        <?php include 'footer.php'; ?>
    </div>
</div>

<?php include 'end.php'; ?>
