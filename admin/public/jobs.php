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
                    <h1 class="h3 mb-0 text-gray-800">Available Jobs</h1>
                    <a href="add_job.php" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                        <i class="fa-solid fa-plus"></i> Add Jobs
                    </a>
                    <a href="add_companies.php" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                        <i class="fa-solid fa-plus"></i> Add Companies
                    </a>
                </div>

                <!-- Filter Section -->
                <div class="row my-5">
                    <div class="col-md-4">
                        <input type="text" id="searchJob" class="form-control" placeholder="Search by Job Title...">
                    </div>
                    <div class="col-md-4">
                        <select id="filterCompany" class="form-control">
                            <option value="">All Companies</option>
                            <?php
                            // Fetch all companies
                            $company_query = "SELECT * FROM companies";
                            $company_result = mysqli_query($conn, $company_query);
                            while ($company = mysqli_fetch_assoc($company_result)) {
                                echo "<option value='" . $company['name'] . "'>" . $company['name'] . "</option>";
                            }
                            ?>
                        </select>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table table-bordered" id="jobsTable">
                        <thead>
                            <tr>
                                <th>S.no</th>
                                <th>Company Name</th>
                                <th>Job Title</th>
                                <th>Vacancies</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $sql = "SELECT jobs.id, jobs.job_title, jobs.vacancies, 
                                           companies.name AS company_name 
                                    FROM jobs 
                                    JOIN companies ON jobs.company_id = companies.id";
                            $result = mysqli_query($conn, $sql);
                            $counter = 1;

                            while ($row = mysqli_fetch_assoc($result)) {
                                echo "<tr>";
                                echo "<td>" . $counter++ . "</td>";
                                echo "<td class='company-name'>" . $row['company_name'] . "</td>";
                                echo "<td class='job-title'>" . $row['job_title'] . "</td>";
                                echo "<td>" . $row['vacancies'] . "</td>";
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

<!-- JavaScript for Filtering -->
<script>
document.getElementById('searchJob').addEventListener('keyup', function() {
    let searchValue = this.value.toLowerCase();
    let rows = document.querySelectorAll("#jobsTable tbody tr");

    rows.forEach(row => {
        let jobTitle = row.querySelector(".job-title").textContent.toLowerCase();
        if (jobTitle.includes(searchValue)) {
            row.style.display = "";
        } else {
            row.style.display = "none";
        }
    });
});

document.getElementById('filterCompany').addEventListener('change', function() {
    let selectedCompany = this.value.toLowerCase();
    let rows = document.querySelectorAll("#jobsTable tbody tr");

    rows.forEach(row => {
        let companyName = row.querySelector(".company-name").textContent.toLowerCase();
        if (selectedCompany === "" || companyName === selectedCompany) {
            row.style.display = "";
        } else {
            row.style.display = "none";
        }
    });
});
</script>
