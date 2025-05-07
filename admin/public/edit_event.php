<?php
include 'header.php';

// Upload directory
$uploadDir = '../uploads/events/';

// Fetch event data
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    echo "<div class='alert alert-danger'>Invalid event ID.</div>";
    include 'footer.php';
    exit();
}

$event_id = intval($_GET['id']);
$stmt = $conn->prepare("SELECT * FROM events WHERE id = ?");
$stmt->bind_param("i", $event_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows != 1) {
    echo "<div class='alert alert-danger'>Event not found.</div>";
    include 'footer.php';
    exit();
}

$event = $result->fetch_assoc();
$stmt->close();

// Handle form submission
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

    // Handle Main Image
    $main_image_name = $event['main_image'];
    if (!empty($_FILES['main_image']['name'])) {
        $ext = pathinfo($_FILES['main_image']['name'], PATHINFO_EXTENSION);
        $main_image_name = uniqid() . '.' . $ext;
        move_uploaded_file($_FILES['main_image']['tmp_name'], $uploadDir . $main_image_name);
    }

    // Handle Occasion Images
    $occasion_images = '';

    // Delete old images from server
    $old_images = explode(',', $event['occasion_images']);
    foreach ($old_images as $old_img) {
        $old_img_path = $uploadDir . $old_img;
        if (file_exists($old_img_path)) {
            unlink($old_img_path); // delete file
        }
    }

    // Upload and collect new occasion images
    if (!empty($_FILES['occasion_images']['name'][0])) {
        $new_images = [];
        foreach ($_FILES['occasion_images']['tmp_name'] as $key => $tmp_name) {
            $ext = pathinfo($_FILES['occasion_images']['name'][$key], PATHINFO_EXTENSION);
            $filename = uniqid() . '.' . $ext;
            if (move_uploaded_file($tmp_name, $uploadDir . $filename)) {
                $new_images[] = $filename;
            }
        }
        $occasion_images = implode(',', $new_images);
    }

    // Update database
    $stmt = $conn->prepare("UPDATE events SET 
        occasion = ?, venue = ?, location_address = ?, location_url = ?, phone = ?, 
        website_text = ?, website_url = ?, rating = ?, event_date = ?, 
        about_event = ?, about_venue = ?, main_image = ?, occasion_images = ? 
        WHERE id = ?");
    $stmt->bind_param("sssssssssssssi", $occasion, $venue, $location_address, $location_url, $phone,
        $website_text, $website_url, $rating, $event_date, $about_event, $about_venue,
        $main_image_name, $occasion_images, $event_id);

    if ($stmt->execute()) {
        header("Location: view_event.php?id=$event_id&updated=1");
        exit();
    } else {
        $error = $stmt->error;
    }
    $stmt->close();
}
?>

<div id="wrapper">
    <?php include 'sidebar.php'; ?>
    <div id="content-wrapper" class="d-flex flex-column">
        <?php include 'navbar.php'; ?>
        <div id="content">
            <div class="container-fluid">
                <h1 class="h3 mb-4 text-gray-800">Edit Event</h1>
                <?php if (!empty($error)): ?>
                    <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
                <?php endif; ?>
                <form method="POST" enctype="multipart/form-data">
                    <div class="row">
                        <?php
                        $fields = [
                            'occasion' => 'Occasion',
                            'venue' => 'Venue',
                            'location_address' => 'Location Address',
                            'location_url' => 'Location URL',
                            'phone' => 'Phone',
                            'website_text' => 'Website Text',
                            'website_url' => 'Website URL',
                            'rating' => 'Rating',
                            'event_date' => 'Event Date'
                        ];
                        foreach ($fields as $key => $label): ?>
                            <div class="form-group col-6">
                                <label><?= $label ?>:</label>
                                <input type="<?= $key === 'event_date' ? 'date' : 'text' ?>" class="form-control"
                                       name="<?= $key ?>" value="<?= htmlspecialchars($event[$key]) ?>">
                            </div>
                        <?php endforeach; ?>

                        <div class="form-group col-6">
                            <label>About Event:</label>
                            <textarea class="form-control" name="about_event" rows="4"><?= htmlspecialchars($event['about_event']) ?></textarea>
                        </div>
                        <div class="form-group col-6">
                            <label>About Venue:</label>
                            <textarea class="form-control" name="about_venue" rows="4"><?= htmlspecialchars($event['about_venue']) ?></textarea>
                        </div>

                        <div class="form-group col-6">
                            <label>Main Image:</label><br>
                            <?php if (!empty($event['main_image'])): ?>
                                <img src="../uploads/events/<?= htmlspecialchars($event['main_image']) ?>" width="150"><br>
                            <?php endif; ?>
                            <input type="file" name="main_image" class="form-control-file" accept="image/*">
                        </div>

                        <div class="form-group col-6">
                            <label>Occasion Images:</label><br>
                            <?php
                            $images = explode(',', $event['occasion_images']);
                            foreach ($images as $img) {
                                echo '<img src="../uploads/events/' . htmlspecialchars($img) . '" width="100" style="margin:5px;">';
                            }
                            ?>
                            <input type="file" name="occasion_images[]" class="form-control-file" accept="image/*" multiple>
                            <small class="form-text text-muted">Uploading new images will remove old ones.</small>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Update Event</button>
                    <a href="view_event.php?id=<?= $event_id ?>" class="btn btn-secondary">Cancel</a>
                </form>
            </div>
        </div>
        <?php include 'footer.php'; ?>
    </div>
</div>
<?php include 'end.php'; ?>
