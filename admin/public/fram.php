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
                                <?php include '../../db.connection/db_connection.php'; ?>

                            

                                
    
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <?php include 'footer.php'; ?>
        </div>
    </div>

    <?php include 'end.php'; ?>