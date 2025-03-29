<?php include 'header.php';   ?>


<!-- Page Wrapper -->
<div id="wrapper">

    <?php include 'sidebar.php';   ?>

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

        <?php include 'navbar.php';  ?>

        <!-- Main Content -->
        <div id="content">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-0 text-gray-800">CREATE SERVICE</h1>
                 
                    <a href="view_services.php" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fa-regular fa-eye"></i>  View Services</a>
                </div>

                <div class="row">
                    <div class="col-xl-11">
                        <div class="card shadow mb-4">
                            <!-- Card Header -->
                            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                <h6 class="m-0 font-weight-bold text-success">ADD SERVICE</h6>
                            </div>



                            <!-- Card Body -->
                            <div class="card-body">


                                <form style='color:black;' id="addblogform" action="add_service_conn.php" method="POST" enctype="multipart/form-data">
                                    <div class="mb-3">

                                        <input type="text" class="form-control text-grey-900" name='name' id="exampleFormControlInput1" placeholder="Enter Service Name" required>
                                    </div>
                                    <?php
                                    if (isset($_SESSION['success'])) {
                                        echo "<div class='alert alert-success' id='successMessage' role='alert'>" . $_SESSION['success'] . "</div>";
                                        unset($_SESSION['success']); // Remove message after displaying
                                    }
                                    if (isset($_SESSION['error'])) {
                                        echo "<div class='alert alert-danger' id='errorMessage' role='alert'>" . $_SESSION['error'] . "</div>";
                                        unset($_SESSION['error']); // Remove message after displaying
                                    }
                                    ?>
                                    <div class='row p-3'>
                                        <div class='col-xl-7 col-sm-2'></div>
                                        <button type='reset' class='btn btn-danger mx-1 my-2 col-xl-2'>Clear</button>
                                        <button type='submit' class='btn btn-success mx-1 my-2 col-xl-2'>Add Service</button>
                                    </div>
                                </form>


                            </div>
                        </div>
                    </div>
                </div>

                <script>
                    // Auto-hide success/error message after 4 seconds
                    setTimeout(function() {
                        let successMessage = document.getElementById("successMessage");
                        let errorMessage = document.getElementById("errorMessage");
                        if (successMessage) successMessage.style.display = "none";
                        if (errorMessage) errorMessage.style.display = "none";
                    }, 2000);
                </script>




                <!-- /.container-fluid -->
            </div>


        </div>



        <?php include 'footer.php'; ?>

    </div>

</div>


<?php include 'end.php'; ?>