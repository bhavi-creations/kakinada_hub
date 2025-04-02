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
 
 include '../../db.connection/db_connection.php'; // Database connection
 
 // Get the travel type details
 if (isset($_GET['id'])) {
     $id = $_GET['id'];
     $query = "SELECT * FROM travels WHERE id = $id";
     $result = mysqli_query($conn, $query);
     $row = mysqli_fetch_assoc($result);
 }
 
 // Update travel type
 if (isset($_POST['update'])) {
     $name = mysqli_real_escape_string($conn, $_POST['name']);
 
     // Handle Image Upload
     if (!empty($_FILES["filter_image"]["name"])) {
         $targetDir = "../uploads/travels/";
         $fileName = basename($_FILES["filter_image"]["name"]);
         $targetFilePath = $targetDir . $fileName;
         $fileType = strtolower(pathinfo($targetFilePath, PATHINFO_EXTENSION));
         $allowTypes = array("jpg", "jpeg", "png", "gif");
 
         if (in_array($fileType, $allowTypes)) {
             if (move_uploaded_file($_FILES["filter_image"]["tmp_name"], $targetFilePath)) {
                 $updateQuery = "UPDATE travels SET name='$name', filter_image='$fileName' WHERE id=$id";
             } else {
                 echo "<div class='alert alert-danger'>Error uploading image.</div>";
             }
         } else {
             echo "<div class='alert alert-danger'>Invalid file type. Allowed types: JPG, JPEG, PNG, GIF.</div>";
         }
     } else {
         // Update without changing the image
         $updateQuery = "UPDATE travels SET name='$name' WHERE id=$id";
     }
 
     if (mysqli_query($conn, $updateQuery)) {
         header("Location: travel.php?success=updated");
         exit();
     } else {
         echo "<div class='alert alert-danger'>Database error: " . mysqli_error($conn) . "</div>";
     }
 }
 ?>
 
 <!-- Edit Travel Type Form -->
 <div class="container">
     <h2>Edit Travel Type</h2>
     <form action="" method="POST" enctype="multipart/form-data">
         <div class="mb-3">
             <label for="name" class="form-label">Travel Type Name</label>
             <input type="text" class="form-control" id="name" name="name" value="<?php echo $row['name']; ?>" required>
         </div>
         <div class="mb-3">
             <label for="filter_image" class="form-label">Upload New Image (Optional)</label>
             <input type="file" class="form-control" id="filter_image" name="filter_image">
             <p>Current Image: <img src="../uploads/travels/<?php echo $row['filter_image']; ?>" width="100"></p>
         </div>
         <button type="submit" name="update" class="btn btn-primary">Update Travel Type</button>
     </form>
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