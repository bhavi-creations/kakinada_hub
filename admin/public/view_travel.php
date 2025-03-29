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
                    <h1 class="h3 mb-0 text-gray-800">Travel Details</h1>
                    <a href="add_travel.php" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                        <i class="fa-solid fa-plus"></i> Add Travel Details
                    </a>
                </div>

                <div class="container">
                    <div class="row">
                        <div class="row row-custom no-gutters col-12">
                            <?php
                            include '../../db.connection/db_connection.php';

                            if (isset($_GET['id'])) {
                                $id = $_GET['id'];
                                $query = "SELECT * FROM travels WHERE id = $id";
                                $result = mysqli_query($conn, $query);
                                $travel = mysqli_fetch_assoc($result);
                            } else {
                                $_SESSION['message'] = "Travel details not found!";
                                $_SESSION['msg_type'] = "danger";
                                header("Location: travels_list.php"); // Redirect to travel list
                                exit();
                            }
                            ?>

                            <div class="container mt-5">
                                <h2>Travel Details</h2>
                                <table class="table table-bordered">
                                    <tr>
                                        <th>Type</th>
                                        <td><?php echo $travel['type']; ?></td>
                                    </tr>
                                    <tr>
                                        <th>Model</th>
                                        <td><?php echo $travel['model']; ?></td>
                                    </tr>
                                    <tr>
                                        <th>Seating Capacity</th>
                                        <td><?php echo $travel['seating_capacity']; ?></td>
                                    </tr>
                                    <tr>
                                        <th>Fuel Efficiency</th>
                                        <td><?php echo $travel['fuel_efficiency']; ?></td>
                                    </tr>
                                    <tr>
                                        <th>Price</th>
                                        <td><?php echo $travel['price']; ?></td>
                                    </tr>
                                    <tr>
                                        <th>Image</th>
                                        <td>
                                            <img src="../uploads/travels/<?php echo $travel['image']; ?>" width="300">
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Created At</th>
                                        <td><?php echo $travel['created_at']; ?></td>
                                    </tr>
                                </table>
                                <a href="travel.php" class="btn btn-secondary">Back to List</a>
                            </div>

                        </div>
                    </div>
                </div>

            </div>
        </div>

        <?php include 'footer.php'; ?>
    </div>
</div>

<?php include 'end.php'; ?>