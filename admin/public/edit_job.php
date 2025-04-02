<?php include 'header.php'; ?>
<?php include '../../db.connection/db_connection.php'; ?> 

<?php
if (isset($_GET['id'])) {
    $job_id = $_GET['id'];
    
    // Fetch job details
    $sql = "SELECT * FROM jobs WHERE id = $job_id";
    $result = mysqli_query($conn, $sql);
    $job = mysqli_fetch_assoc($result);

    if (!$job) {
        die("Job not found.");
    }
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $job_title = $_POST['job_title'];
    $vacancies = $_POST['vacancies'];

    $update_sql = "UPDATE jobs SET job_title = '$job_title', vacancies = '$vacancies' WHERE id = $job_id";
    
    if (mysqli_query($conn, $update_sql)) {
        echo '<script>alert("Job updated successfully!"); window.location.href="jobs.php";</script>';
    } else {
        echo '<script>alert("Error updating job!");</script>';
    }
}
?>

<!-- Page Wrapper -->
<div id="wrapper">
    <?php include 'sidebar.php'; ?>

    <div id="content-wrapper" class="d-flex flex-column">
        <?php include 'navbar.php'; ?>

        <div id="content">
            <div class="container-fluid">
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-0 text-gray-800">Edit Job</h1>
                    <a href="jobs.php" class="btn btn-secondary btn-sm"><i class="fa-solid fa-arrow-left"></i> Back</a>
                </div>

                <div class="col-md-6">
                    <form method="POST">
                        <div class="form-group">
                            <label>Job Title:</label>
                            <input type="text" name="job_title" class="form-control" value="<?= $job['job_title'] ?>" required>
                        </div>
                        <div class="form-group">
                            <label>No. of Vacancies:</label>
                            <input type="number" name="vacancies" class="form-control" value="<?= $job['vacancies'] ?>" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </form>
                </div>

            </div>
        </div>

        <?php include 'footer.php'; ?>
    </div>
</div>

<?php include 'end.php'; ?>
