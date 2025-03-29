 <?php include 'header.php';   ?>

 <div id="wrapper">

     <?php include 'sidebar.php';   ?>

     <div id="content-wrapper" class="d-flex flex-column">

         <?php include 'navbar.php';  ?>

         <div id="content">

             <div class="container-fluid">


                 <section>

                     <?php
                        include '../../db.connection/db_connection.php';

                        if (isset($_GET['id'])) {
                            $service_id = mysqli_real_escape_string($conn, $_GET['id']);

                            $query = "SELECT * FROM services WHERE id = '$service_id'";
                            $result = mysqli_query($conn, $query);
                            $service = mysqli_fetch_assoc($result);

                            if (!$service) {
                                echo "<h2 class='text-center text-danger'>Service Not Found!</h2>";
                                exit();
                            }
                        } else {
                            echo "<h2 class='text-center text-danger'>Invalid Service</h2>";
                            exit();
                        }
                        ?>
                     <div class="container mt-4">
                         <h2 class="text-primary"><?php echo $service['name']; ?></h2>
                         <p>Details about <?php echo $service['name']; ?> will be displayed here.</p>
                     </div>


                 </section>

             </div>

         </div>

         <?php include 'footer.php'; ?>

     </div>

 </div>


 <?php include 'end.php'; ?>