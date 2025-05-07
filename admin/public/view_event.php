<?php
include 'header.php';

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $event_id = intval($_GET['id']);

    // Fetch event details from the database
    $query = "SELECT * FROM events WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $event_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $event = $result->fetch_assoc();
    } else {
        echo "<div class='alert alert-danger'>Event not found.</div>";
        include 'footer.php';
        exit();
    }
    $stmt->close();
} else {
    echo "<div class='alert alert-danger'>Invalid event ID.</div>";
    include 'footer.php';
    exit();
}
?>

<div id="wrapper">
    <?php include 'sidebar.php'; ?>
    <div id="content-wrapper" class="d-flex flex-column">
        <?php include 'navbar.php'; ?>
        <div id="content">
            <div class="container-fluid">
                <h1 class="h3 mb-4 text-gray-800">View Event</h1>
                <div class="card shadow mb-4">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-8">
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <tr>
                                            <th>ID</th>
                                            <td><?= htmlspecialchars($event['id']) ?></td>
                                        </tr>
                                        <tr>
                                            <th>Occasion</th>
                                            <td><?= htmlspecialchars($event['occasion']) ?></td>
                                        </tr>
                                        <tr>
                                            <th>Venue</th>
                                            <td><?= htmlspecialchars($event['venue']) ?></td>
                                        </tr>
                                        <tr>
                                            <th>Location Address</th>
                                            <td><?= htmlspecialchars($event['location_address']) ?></td>
                                        </tr>
                                        <tr>
                                            <th>Location URL</th>
                                            <td><?= htmlspecialchars($event['location_url']) ?></td>
                                        </tr>
                                        <tr>
                                            <th>Phone</th>
                                            <td><?= htmlspecialchars($event['phone']) ?></td>
                                        </tr>
                                        <tr>
                                            <th>Website Text</th>
                                            <td><?= htmlspecialchars($event['website_text']) ?></td>
                                        </tr>
                                        <tr>
                                            <th>Website URL</th>
                                            <td><?= htmlspecialchars($event['website_url']) ?></td>
                                        </tr>
                                        <tr>
                                            <th>Rating</th>
                                            <td><?= htmlspecialchars($event['rating']) ?></td>
                                        </tr>
                                        <tr>
                                            <th>Event Date</th>
                                            <td><?= htmlspecialchars($event['event_date']) ?></td>
                                        </tr>
                                        <tr>
                                            <th>About Event</th>
                                            <td><?= htmlspecialchars($event['about_event']) ?></td>
                                        </tr>
                                        <tr>
                                            <th>About Venue</th>
                                            <td><?= htmlspecialchars($event['about_venue']) ?></td>
                                        </tr>
                                        <tr>
                                            <th>Created At</th>
                                            <td><?= date('F j, Y, g:i a', strtotime($event['created_at'])) ?></td>
                                        </tr>
                                        <tr>
                                            <th>Updated At</th>
                                            <td><?= date('F j, Y, g:i a', strtotime($event['updated_at'])) ?></td>
                                        </tr>
                                        <tr>
                                            <th>Main Image</th>
                                            <td>
                                                <?php if (!empty($event['main_image'])): ?>
                                                    <img src="../uploads/events/<?= htmlspecialchars($event['main_image']) ?>" alt="Main Image" style="width: 200px;">
                                                <?php else: ?>
                                                    No Image
                                                <?php endif; ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Occasion Images</th>
                                            <td>
                                                <?php
                                                $occasion_images = explode(',', $event['occasion_images']);
                                                if (count($occasion_images) > 0) {
                                                    foreach ($occasion_images as $image) {
                                                        echo '<img src="../uploads/events/' . htmlspecialchars($image) . '" alt="Occasion Image" style="width: 200px; margin-right: 10px;"><br>';
                                                    }
                                                } else {
                                                    echo "No images";
                                                }
                                                ?>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                                <a href="edit_event.php?id=<?= $event['id'] ?>" class="btn btn-primary">Edit Event</a>
                                <a href="events.php" class="btn btn-secondary">Back to Events List</a>
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
