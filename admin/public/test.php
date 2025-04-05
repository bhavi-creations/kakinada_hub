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
                    <h1 class="h3 mb-0 text-gray-800">Available Properties</h1>
                    <a href="add_property_type.php" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                        <i class="fa-solid fa-plus"></i> Add Property
                    </a>
                </div>

                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <?php include '../../db.connection/db_connection.php'; ?>

                            <!-- Display Success Message -->
                            <?php if (isset($_SESSION['message'])): ?>
                                <div id="alert-box" class="alert alert-<?php echo $_SESSION['msg_type']; ?>">
                                    <?php echo $_SESSION['message']; ?>
                                    <?php unset($_SESSION['message']); ?>
                                </div>

                                <script>
                                    setTimeout(function() {
                                        let alertBox = document.getElementById('alert-box');
                                        if (alertBox) {
                                            alertBox.style.display = 'none';
                                        }
                                    }, 3000);
                                </script>
                            <?php endif; ?>

                            <!-- Filter Buttons -->
                            <div class="mb-3">
                                <button class="btn btn-primary filter-btn" data-filter="all">All</button>
                                <button class="btn btn-success filter-btn" data-filter="For Sale">For Sale</button>
                                <button class="btn btn-warning filter-btn" data-filter="For Rent">For Rent</button>
                                <button class="btn btn-info filter-btn" data-filter="For Lease">For Lease</button>
                            </div>

                            <!-- Property Table -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Property List</h6>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered" width="100%" cellspacing="0">
                                            <thead>
                                                <tr>
                                                    <th>S.No</th>
                                                    <th>Property Name</th>
                                                    <th>Location</th>
                                                    <th>Price</th>
                                                    <th>Image</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody id="property-table-body">
                                                <?php
                                                $query = "SELECT * FROM properties ORDER BY id DESC";
                                                $result = mysqli_query($conn, $query);
                                                $s_no = 1;
                                                while ($row = mysqli_fetch_assoc($result)):
                                                    $propertyType = trim($row['type']); // Ensure no spaces
                                                ?>
                                                    <tr class="property-row" data-type="<?php echo $propertyType; ?>">
                                                        <td class="serial-no"><?php echo $s_no++; ?></td>
                                                        <td><?php echo $row['title']; ?></td>
                                                        <td><?php echo $row['location']; ?></td>
                                                        <td><?php echo $row['price']; ?></td>
                                                        <td>
                                                            <img src="../uploads/properties/<?php echo $row['image']; ?>" width="100" height="70" alt="Property Image">
                                                        </td>
                                                        <td>
                                                            <a href="view_property.php?id=<?php echo $row['id']; ?>" class="btn btn-info btn-sm">View</a>
                                                            <a href="edit_property.php?id=<?php echo $row['id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                                                            <button class="btn btn-danger btn-sm delete-btn" data-id="<?php echo $row['id']; ?>">Delete</button>
                                                        </td>
                                                    </tr>
                                                <?php endwhile; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <!-- JavaScript for Filtering -->
                <script>
                    document.addEventListener("DOMContentLoaded", function() {
                        const filterButtons = document.querySelectorAll(".filter-btn");
                        const propertyRows = document.querySelectorAll(".property-row");

                        filterButtons.forEach(button => {
                            button.addEventListener("click", function() {
                                const filter = this.getAttribute("data-filter");

                                propertyRows.forEach(row => {
                                    const type = row.getAttribute("data-type").trim(); // Normalize type

                                    if (filter === "all" || type === filter) {
                                        row.style.display = "";
                                    } else {
                                        row.style.display = "none";
                                    }
                                });
                            });
                        });
                    });
                </script>


                <script>
                    document.addEventListener("DOMContentLoaded", function() {
                        document.querySelectorAll(".delete-btn").forEach(button => {
                            button.addEventListener("click", function() {
                                let propertyId = this.getAttribute("data-id");
                                if (confirm("Are you sure you want to delete this property?")) {
                                    fetch("delete_property.php", {
                                            method: "POST",
                                            headers: {
                                                "Content-Type": "application/x-www-form-urlencoded"
                                            },
                                            body: "id=" + propertyId
                                        })
                                        .then(response => response.json())
                                        .then(data => {
                                            if (data.success) {
                                                // Remove the row from the table
                                                let row = document.querySelector(`tr[data-id='${propertyId}']`);
                                                row.remove();

                                                // Re-adjust serial numbers
                                                let serialCells = document.querySelectorAll(".serial-no");
                                                serialCells.forEach((cell, index) => {
                                                    cell.textContent = index + 1;
                                                });
                                            } else {
                                                alert("Error deleting property.");
                                            }
                                        })
                                        .catch(error => console.error("Error:", error));
                                }
                            });
                        });
                    });
                </script>


            </div>
        </div>

        <?php include 'footer.php'; ?>
    </div>
</div>

<?php include 'end.php'; ?> 