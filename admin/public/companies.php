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
                    <h1 class="h3 mb-0 text-gray-800">Available Companies</h1>
                    <a href="add_job.php" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                        <i class="fa-solid fa-plus"></i> Add Jobs
                    </a>
                    <a href="add_companies.php" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                        <i class="fa-solid fa-plus"></i> Add Companies
                    </a>
                </div>

                <div class="container">
                    <div class="row">
                        <?php
                        include '../../db.connection/db_connection.php';

                        // Fetch companies from the database
                        $query = "SELECT * FROM companies";
                        $result = mysqli_query($conn, $query);

                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                        ?>
                                <div class="col-md-4">
                                    <div class="card mb-4">
                                        <img src="../uploads/companies/<?php echo $row['logo']; ?>" class="card-img-top" alt="Company Logo">
                                        <div class="card-body">
                                            <h5 class="card-title"><?php echo $row['name']; ?></h5>
                                            <p class="card-text"><strong>Category:</strong> <?php echo $row['category']; ?></p>
                                            <p class="card-text"><strong>Experience:</strong> <?php echo $row['experience_years']; ?> Years</p>
                                            <p class="card-text"><strong>Employees:</strong> <?php echo $row['no_of_employees']; ?></p>

                                            <!-- View Button -->
                                            <a href="view_company.php?company_id=<?php echo $row['id']; ?>" class="btn btn-success btn-sm">
                                                <i class="fa fa-eye"></i> View
                                            </a>

                                            <!-- Edit Button -->
                                            <a href="edit_company.php?company_id=<?php echo $row['id']; ?>" class="btn btn-warning btn-sm">
                                                <i class="fa fa-edit"></i> Edit
                                            </a>

                                            <!-- Delete Button -->
                                            <button class="btn btn-danger btn-sm delete-btn" data-id="<?php echo $row['id']; ?>">
                                                <i class="fa fa-trash"></i> Delete
                                            </button>
                                        </div>
                                    </div>
                                </div>
                        <?php
                            }
                        } else {
                            echo "<div class='col-md-12'><div class='alert alert-warning'>No Companies Found.</div></div>";
                        }
                        ?>
                    </div>
                </div>

            </div>
        </div>

        <?php include 'footer.php'; ?>
    </div>
</div>

<?php include 'end.php'; ?>

<!-- Delete Confirmation Script -->
<script>
    document.addEventListener("DOMContentLoaded", function() {
        document.querySelectorAll(".delete-btn").forEach(button => {
            button.addEventListener("click", function() {
                let companyId = this.getAttribute("data-id");

                if (confirm("Are you sure you want to delete this company?")) {
                    window.location.href = "delete_company.php?company_id=" + companyId;
                }
            });
        });
    });
</script>
