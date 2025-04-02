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
                    <h1 class="h3 mb-0 text-gray-800">Available jobs</h1>
                    <a href="add_job.php" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                        <i class="fa-solid fa-plus"></i> Add Jobs
                    </a>
                    <a href="add_companies.php" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                        <i class="fa-solid fa-plus"></i> Add Companies
                    </a>
                </div>

                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Company Name</th>
                                <th>Job Title</th>
                                <th>Vacancies</th>
                                <th>Total Vacancies</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $sql = "SELECT jobs.id, jobs.job_title, jobs.vacancies, jobs.total_vacancies, 
                                           companies.name AS company_name 
                                    FROM jobs 
                                    JOIN companies ON jobs.company_id = companies.id";
                            $result = mysqli_query($conn, $sql);
                            $counter = 1;

                            while ($row = mysqli_fetch_assoc($result)) {
                                echo "<tr>";
                                echo "<td>" . $counter++ . "</td>";
                                echo "<td>" . $row['company_name'] . "</td>";
                                echo "<td>" . $row['job_title'] . "</td>";
                                echo "<td>" . $row['vacancies'] . "</td>";
                                echo "<td>" . $row['total_vacancies'] . "</td>";
                                echo "<td>
                                        <a href='edit_job.php?id=" . $row['id'] . "' class='btn btn-warning btn-sm'>Edit</a>
                                        <a href='delete_job.php?id=" . $row['id'] . "' class='btn btn-danger btn-sm' onclick='return confirm(\"Are you sure you want to delete this job?\")'>Delete</a>
                                      </td>";
                                echo "</tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>

        <?php include 'footer.php'; ?>
    </div>
</div>

<?php include 'end.php'; ?>
