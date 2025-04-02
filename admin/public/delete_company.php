<?php
include '../../db.connection/db_connection.php';

if (isset($_GET['company_id'])) {
    $company_id = mysqli_real_escape_string($conn, $_GET['company_id']);

    // Fetch company details to delete associated files
    $query = "SELECT logo, company_images FROM companies WHERE id = '$company_id'";
    $result = mysqli_query($conn, $query);
    
    if ($row = mysqli_fetch_assoc($result)) {
        $target_dir = "../uploads/companies/";

        // Delete logo file
        if (!empty($row['logo']) && file_exists($target_dir . $row['logo'])) {
            unlink($target_dir . $row['logo']);
        }

        // Delete multiple images
        if (!empty($row['company_images'])) {
            $images = explode(',', $row['company_images']);
            foreach ($images as $image) {
                $image_path = $target_dir . trim($image);
                if (file_exists($image_path)) {
                    unlink($image_path);
                }
            }
        }
    }

    // Delete company from database
    $delete_query = "DELETE FROM companies WHERE id = '$company_id'";
    
    if (mysqli_query($conn, $delete_query)) {
        echo "<script>
                setTimeout(function() {
                    window.location.href = 'jobs.php';
                }, 3000);
                document.body.innerHTML += '<div class=\"alert alert-success text-center\">Company deleted successfully!</div>';
              </script>";
    } else {
        echo "<div class='alert alert-danger'>Error deleting company: " . mysqli_error($conn) . "</div>";
    }
} else {
    echo "<div class='alert alert-danger'>Invalid request.</div>";
}
?>
