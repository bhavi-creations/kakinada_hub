<?php include 'header.php'; ?>

<?php
// Upload folder
$uploadDir = '../uploads/events/';

// Check if the upload directory exists, and create it if not
if (!is_dir($uploadDir)) {
    if (!mkdir($uploadDir, 0755, true)) {
        die('Failed to create upload directory.'); // Handle the error appropriately
    }
}

// Handle POST request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $occasion         = $_POST['occasion'];
    $venue            = $_POST['venue'];
    $location_address = $_POST['location_address'];
    $location_url     = $_POST['location_url'];
    $phone            = $_POST['phone'];
    $website_text     = $_POST['website_text'];
    $website_url      = $_POST['website_url'];
    $rating           = $_POST['rating'];
    $event_date       = $_POST['event_date'];
    $about_event      = $_POST['about_event'];
    $about_venue      = $_POST['about_venue'];

    // === Handle Main Image Upload ===
    $main_image_name = '';
    if (!empty($_FILES['main_image']['name'])) {
        $main_image_name = time() . '_' . basename($_FILES['main_image']['name']);
        if (!move_uploaded_file($_FILES['main_image']['tmp_name'], $uploadDir . $main_image_name)) {
            $error = "Failed to upload the main image.";
        }
    }

    // === Handle Multiple Occasion Images ===
    $occasion_images_arr = [];
    if (!empty($_FILES['occasion_images']['name'][0])) {
        foreach ($_FILES['occasion_images']['tmp_name'] as $key => $tmp_name) {
            // Generate a random name for the image file
            $filename = time() . rand(1000, 9999) . '.' . pathinfo($_FILES['occasion_images']['name'][$key], PATHINFO_EXTENSION);

            // Move the uploaded file to the designated directory
            if (move_uploaded_file($tmp_name, $uploadDir . $filename)) {
                $occasion_images_arr[] = $filename; // Add the filename to the array
            } else {
                $error = "Failed to upload one of the occasion images.";
                break; // Stop processing if one fails
            }
        }
    }
    $occasion_images = implode(',', $occasion_images_arr); // Convert the array to a comma-separated string

    // Insert data into the database
    if (empty($error)) { // Only proceed with database insertion if there were no upload errors
        $stmt = $conn->prepare("INSERT INTO events
            (occasion, venue, location_address, location_url, phone, website_text, website_url, rating, event_date, about_event, about_venue, main_image, occasion_images)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssssssssssss", $occasion, $venue, $location_address, $location_url, $phone, $website_text, $website_url, $rating, $event_date, $about_event, $about_venue, $main_image_name, $occasion_images);

        if ($stmt->execute()) {
            header("Location: " . $_SERVER['PHP_SELF'] . "?success=1");
            exit();
        } else {
            $error = $stmt->error;
        }

        $stmt->close();
    }
}
?>

<div id="wrapper">
    <?php include 'sidebar.php'; ?>
    <div id="content-wrapper" class="d-flex flex-column">
        <?php include 'navbar.php'; ?>

        <div id="content">
            <div class="container-fluid">
                <h1 class="h3 mb-4 text-gray-800">Available Services & Add New Event</h1>

                <?php if (isset($_GET['success'])): ?>
                    <div class="alert alert-success m-3" id="success-msg">Event added successfully!</div>
                <?php endif; ?>
                <?php if (!empty($error)): ?>
                    <div class="alert alert-danger m-3"><?= htmlspecialchars($error) ?></div>
                <?php endif; ?>

                <div class="row">
                    <div class="col-md-12">
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">Add New Event</h6>
                            </div>
                            <div class="card-body">
                                <form action="" method="POST" enctype="multipart/form-data">
                                    <div class="row">
                                        <div class="form-group col-6">
                                            <label for="occasion">Occasion:</label>
                                            <input type="text" class="form-control" name="occasion" required>
                                        </div>
                                        <div class="form-group col-6">
                                            <label for="venue">Venue:</label>
                                            <input type="text" class="form-control" name="venue">
                                        </div>
                                        <div class="form-group col-6">
                                            <label for="location_address">Location Address:</label>
                                            <input type="text" class="form-control" name="location_address">
                                        </div>
                                        <div class="form-group col-6">
                                            <label for="location_url">Google Maps URL:</label>
                                            <input type="url" class="form-control" name="location_url">
                                        </div>
                                        <div class="form-group col-6">
                                            <label for="phone">Phone:</label>
                                            <input type="text" class="form-control" name="phone">
                                        </div>
                                        <div class="form-group col-6">
                                            <label for="website_text">Website Text (Display):</label>
                                            <input type="text" class="form-control" name="website_text">
                                        </div>
                                        <div class="form-group col-6">
                                            <label for="website_url">Website URL:</label>
                                            <input type="url" class="form-control" name="website_url">
                                        </div>
                                        <div class="form-group col-6">
                                            <label for="rating">Rating:</label>
                                            <input type="number" class="form-control" name="rating" step="0.01" min="0" max="5">
                                        </div>
                                        <div class="form-group col-6">
                                            <label for="event_date">Event Date:</label>
                                            <input type="date" class="form-control" name="event_date">
                                        </div>
                                        <div class="form-group col-6">
                                            <label for="about_event">About Event:</label>
                                            <textarea class="form-control" name="about_event" rows="4"></textarea>
                                        </div>
                                        <div class="form-group col-6">
                                            <label for="about_venue">About Venue:</label>
                                            <textarea class="form-control" name="about_venue" rows="4"></textarea>
                                        </div>

                                        <div class="form-group col-6">
                                            <label for="main_image">Main Image (Venue):</label>
                                            <input type="file" class="form-control-file" name="main_image" accept="image/*">
                                        </div>
                                        <div class="form-group col-6">
                                            <label for="occasion_images">Occasion Images (Multiple):</label>
                                            <input type="file" class="form-control-file" name="occasion_images[]" accept="image/*" multiple>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Add Event</button>
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

<script>
    setTimeout(() => {
        const msg = document.getElementById('success-msg');
        if (msg) msg.style.display = 'none';
    }, 3000);
</script>   