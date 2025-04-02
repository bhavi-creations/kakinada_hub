<?php
include '../../db.connection/db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $company_id = mysqli_real_escape_string($conn, $_POST['company_id']);
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $map_url = mysqli_real_escape_string($conn, $_POST['map_url']);
    $category = mysqli_real_escape_string($conn, $_POST['category']);
    $no_of_employees = mysqli_real_escape_string($conn, $_POST['no_of_employees']);
    $experience_years = mysqli_real_escape_string($conn, $_POST['experience_years']);
    $website = mysqli_real_escape_string($conn, $_POST['website']);
    $about = mysqli_real_escape_string($conn, $_POST['about']);

    // Define target directory for uploads
    $target_dir = "../uploads/companies/";

    // Handle logo upload if a new file is provided
    $logo_sql = "";
    if (!empty($_FILES['logo']['name'])) {
        $logo_name = time() . '_' . $_FILES['logo']['name'];
        $target_file = $target_dir . basename($logo_name);

        if (move_uploaded_file($_FILES['logo']['tmp_name'], $target_file)) {
            $logo_sql = ", logo = '$logo_name'";
        }
    }

    // Handle multiple images upload
    $company_images = [];
    if (!empty($_FILES['company_images']['name'][0])) {
        foreach ($_FILES['company_images']['name'] as $key => $image) {
            $image_name = time() . '_' . $image;
            $image_target = $target_dir . basename($image_name);
            if (move_uploaded_file($_FILES['company_images']['tmp_name'][$key], $image_target)) {
                $company_images[] = $image_name;
            }
        }
    }

    // Retrieve old images if new images are not uploaded
    $query = "SELECT company_images FROM companies WHERE id = '$company_id'";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
    $existing_images = $row['company_images'];

    // If new images are uploaded, replace old images; otherwise, keep existing images
    $final_images = (!empty($company_images)) ? implode(',', $company_images) : $existing_images;

    // Update company details
    $update_query = "UPDATE companies SET 
                        name = '$name', 
                        email = '$email', 
                        phone = '$phone', 
                        address = '$address', 
                        map_url = '$map_url', 
                        category = '$category', 
                        no_of_employees = '$no_of_employees', 
                        experience_years = '$experience_years', 
                        website = '$website',
                        about = '$about',
                        company_images = '$final_images'
                        $logo_sql
                    WHERE id = '$company_id'";

    if (mysqli_query($conn, $update_query)) {
        echo "<script>
                setTimeout(function() {
                    window.location.href = 'jobs.php';
                }, 3000);
                document.body.innerHTML += '<div class=\"alert alert-success text-center\">Company details updated successfully!</div>';
              </script>";
    } else {
        echo "<div class='alert alert-danger'>Error updating company: " . mysqli_error($conn) . "</div>";
    }
}
?>
