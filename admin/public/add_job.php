<?php include 'header.php'; ?>
<?php include '../../db.connection/db_connection.php'; ?> 

<!-- Page Wrapper -->
<div id="wrapper">
    <?php include 'sidebar.php'; ?>

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">
        <?php include 'navbar.php'; ?>

        <div id="content">
            <div class="container-fluid">
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-0 text-gray-800">Add New Job</h1>
                    <a href="jobs.php" class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm">
                        <i class="fa-solid fa-arrow-left"></i> Back to Jobs
                    </a>
                </div>

                <div class="container">
                    <div class="row">
                        <div class="col-md-8 offset-md-2">
                            <?php
                            // Fetch all companies for the dropdown
                            $query = "SELECT id, name FROM companies";
                            $result = mysqli_query($conn, $query);

                            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                                $company_id = $_POST['company_id'];
                                $job_titles = $_POST['job_title']; // Array of job titles
                                $vacancies = $_POST['vacancies']; // Array of vacancies
                                $total_vacancies = array_sum($vacancies); // Calculate total vacancies

                                // Insert each job into the database
                                foreach ($job_titles as $index => $title) {
                                    $vacancy_count = $vacancies[$index];
                                    $sql = "INSERT INTO jobs (company_id, job_title, vacancies, total_vacancies) 
                                            VALUES ('$company_id', '$title', '$vacancy_count', '$total_vacancies')";
                                    mysqli_query($conn, $sql);
                                }

                                echo '<div class="alert alert-success" id="success-msg">Job(s) added successfully!</div>';
                                echo '<script>
                                        setTimeout(() => { 
                                            document.getElementById("success-msg").style.display = "none"; 
                                            window.location.href = "jobs.php"; 
                                        }, 3000);
                                      </script>';
                            }
                            ?>

                            <form method="POST" action="add_job.php">
                                <div class="form-group">
                                    <label>Select Company:</label>
                                    <select name="company_id" class="form-control" required>
                                        <option value="">Select a Company</option>
                                        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                                            <option value="<?= $row['id'] ?>"><?= $row['name'] ?></option>
                                        <?php } ?>
                                    </select>
                                </div>

                                <div id="job_fields">
                                    <div class="job_entry border p-3 mb-2">
                                        <label>Job Title:</label>
                                        <input type="text" name="job_title[]" class="form-control" required>
                                        
                                        <label>No. of Vacancies:</label>
                                        <input type="number" name="vacancies[]" class="form-control" required>

                                        <button type="button" class="btn btn-danger remove_job mt-2">Remove</button>
                                    </div>
                                </div>

                                <button type="button" id="add_more" class="btn btn-secondary mt-2">Add More Jobs</button>
                                <button type="submit" class="btn btn-primary mt-3">Submit</button>
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

<script>
    document.getElementById('add_more').addEventListener('click', function() {
        let jobFields = document.getElementById('job_fields');
        let newJob = document.createElement('div');
        newJob.classList.add('job_entry', 'border', 'p-3', 'mb-2');
        newJob.innerHTML = `
            <label>Job Title:</label>
            <input type="text" name="job_title[]" class="form-control" required>
            
            <label>No. of Vacancies:</label>
            <input type="number" name="vacancies[]" class="form-control" required>

            <button type="button" class="btn btn-danger remove_job mt-2">Remove</button>
        `;
        jobFields.appendChild(newJob);
    });

    document.addEventListener('click', function(e) {
        if (e.target.classList.contains('remove_job')) {
            e.target.parentElement.remove();
        }
    });
</script>
