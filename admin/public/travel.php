<?php 
include 'header.php'; 
include '../../db.connection/db_connection.php'; // Include database connection
?>

<!-- Page Wrapper -->
<div id="wrapper">
    <?php include 'sidebar.php'; ?>

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">
        <?php include 'navbar.php'; ?>

        <div id="content">
            <div class="container-fluid">
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-0 text-gray-800">Travel Types List</h1>
                    <a href="add_travel_type.php" class="btn btn-sm btn-primary shadow-sm">
                        <i class="fa-solid fa-plus"></i> Add Travel Service
                    </a>
                    <a href="add_travel.php" class="btn btn-sm btn-primary shadow-sm">
                        <i class="fa-solid fa-plus"></i> Add Travel Type
                    </a>
                </div>

                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>S.no</th>
                                        <th>Name</th>
                                        <th>Image</th>
                                        <th>Created At</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $query = "SELECT * FROM travels ORDER BY id DESC";
                                    $result = mysqli_query($conn, $query);
                                    if (mysqli_num_rows($result) > 0) {
                                        $i = 1;
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            echo "<tr>
                                                <td>{$i}</td>
                                                <td>{$row['name']}</td>
                                                <td><img src='../uploads/travels/{$row['filter_image']}' width='80' height='50' alt='Image'></td>
                                                <td>{$row['created_at']}</td>
                                                <td>
                                                    <a href='view_travel.php?id={$row['id']}' class='btn btn-info btn-sm'>View</a>
                                                    <a href='edit_travel.php?id={$row['id']}' class='btn btn-warning btn-sm'>Edit</a>
                                                    <a href='delete_travel.php?id={$row['id']}' class='btn btn-danger btn-sm' onclick='return confirm(\"Are you sure?\")'>Delete</a>
                                                </td>
                                            </tr>";
                                            $i++;
                                        }
                                    } else {
                                        echo "<tr><td colspan='5' class='text-center'>No travel types found.</td></tr>";
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
