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
                    <h1 class="h3 mb-0 text-gray-800">Available Services</h1>
                    <a href="add_service.php" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                        <i class="fa-solid fa-plus"></i> Add Property Types
                    </a>
                </div>

                <div class="container">
                    <div class="row">
                        <div class="row row-custom no-gutters col-12">
                            <?php
                            include '../../db.connection/db_connection.php';

                            $sql = "SELECT * FROM orange_slides ORDER BY id DESC";
                            $result = $conn->query($sql);

                            if ($result->num_rows > 0):
                                while ($row = $result->fetch_assoc()):
                            ?>
                                    <div class="col-md-4 mb-4">
                                        <div class="card h-100 shadow">
                                            <img src="../<?php echo $row['image_name']; ?>" class="card-img-top" alt="Slide Image" style="height: 200px; object-fit: cover;">
                                            <div class="card-body">
                                                <h5 class="card-title"><?php echo htmlspecialchars($row['heading_text']); ?></h5>
                                                <p>
                                                    <a href="<?php echo htmlspecialchars($row['button_link']); ?>" class="btn btn-sm btn-outline-primary mb-2">
                                                        <?php echo htmlspecialchars($row['button_text']); ?>
                                                    </a>
                                                </p>
                                                <div class="d-flex justify-content-between">
                                                    
                                                    <a href="edit_home_slide.php?id=<?php echo $row['id']; ?>" class="btn btn-sm btn-warning">
                                                        <i class="fas fa-edit"></i> Edit
                                                    </a>
                                                    <a href="delete_home_slide.php?id=<?php echo $row['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this slide?');">
                                                        <i class="fas fa-trash"></i> Delete
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                            <?php
                                endwhile;
                            else:
                                echo "<div class='col-12'><div class='alert alert-info'>No slides found.</div></div>";
                            endif;

                            $conn->close();
                            ?>
                        </div>

                    </div>
                </div>

            </div>
        </div>

        <?php include 'footer.php'; ?>
    </div>
</div>

<?php include 'end.php'; ?>