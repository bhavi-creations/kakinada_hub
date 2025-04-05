<?php include 'header.php'; ?>
<?php include '../../db.connection/db_connection.php'; ?>

<!-- Page Wrapper -->
<div id="wrapper">
    <?php include 'sidebar.php'; ?>
    <div id="content-wrapper" class="d-flex flex-column">
        <?php include 'navbar.php'; ?>
        <div id="content">
            <div class="container-fluid">
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-0 text-gray-800">Available Properties</h1>
                    <a href="add_property_type.php" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                        <i class="fa-solid fa-plus"></i> Add Property Types
                    </a>
                </div>

                <!-- Filter Section -->
                <div class="row mb-4">
                    <div class="col-md-6">
                        <label>Category:</label>
                        <select id="category-filter" class="form-control">
                            <option value="all">All</option>
                            <option value="Residential">Residential</option>
                            <option value="Commercial">Commercial</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label>Type:</label>
                        <select id="type-filter" class="form-control" disabled>
                            <option value="all">All</option>
                        </select>
                    </div>
                </div>

                <!-- Property Table -->
                <div class="card shadow mb-4">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>S.No</th>
                                        <th>Property Name</th>
                                        <th>Category</th>
                                        <th>Type</th>
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
                                    ?>
                                        <tr class="property-row"
                                            data-category="<?php echo ucfirst($row['category']); ?>"
                                            data-type="<?php echo ucfirst($row['type']); ?>">
                                            <td><?php echo $s_no++; ?></td>
                                            <td><?php echo $row['title']; ?></td>
                                            <td><?php echo ucfirst($row['category']); ?></td>
                                            <td><?php echo ucfirst($row['type']); ?></td>
                                            <td><?php echo $row['location']; ?></td>
                                            <td><?php echo $row['price']; ?></td>
                                            <td><img src="../uploads/properties/<?php echo $row['image']; ?>" width="100" height="70"></td>
                                            <td>
                                                <a href="view_property.php?id=<?php echo $row['id']; ?>" class="btn btn-info btn-sm mb-1"><i class="fas fa-eye"></i> View</a>
                                                <a href="edit_property.php?id=<?php echo $row['id']; ?>" class="btn btn-warning btn-sm mb-1"><i class="fas fa-edit"></i> Edit</a>
                                                <a href="delete_property.php?id=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm mb-1" onclick="return confirm('Are you sure you want to delete this property?');"><i class="fas fa-trash-alt"></i> Delete</a>
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
        <?php include 'footer.php'; ?>
    </div>
</div>
<?php include 'end.php'; ?>

<!-- Filter Script -->
<script>
document.addEventListener("DOMContentLoaded", function() {
    const categoryFilter = document.getElementById("category-filter");
    const typeFilter = document.getElementById("type-filter");
    const propertyRows = document.querySelectorAll(".property-row");

    const typeOptions = {
        "Residential": ["For Rent", "For Sale", "For Lease"],
        "Commercial": ["For Rent", "For Sale", "For Lease"]
    };

    // Populate types when category changes
    categoryFilter.addEventListener("change", function() {
        const selectedCategory = this.value;
        typeFilter.innerHTML = '<option value="all">All</option>';

        if (selectedCategory !== "all" && typeOptions[selectedCategory]) {
            typeOptions[selectedCategory].forEach(type => {
                typeFilter.innerHTML += `<option value="${type}">${type}</option>`;
            });
            typeFilter.disabled = false;
        } else {
            typeFilter.disabled = true;
        }

        filterProperties();
    });

    // Trigger filtering on type change
    typeFilter.addEventListener("change", filterProperties);

    // Core filtering logic
    function filterProperties() {
        const selectedCategory = categoryFilter.value;
        const selectedType = typeFilter.value;

        propertyRows.forEach(row => {
            const rowCategory = row.getAttribute("data-category");
            const rowType = row.getAttribute("data-type");

            const categoryMatch = (selectedCategory === "all" || rowCategory === selectedCategory);
            const typeMatch = (selectedType === "all" || rowType === selectedType);

            row.style.display = (categoryMatch && typeMatch) ? "" : "none";
        });
    }
});
</script>
