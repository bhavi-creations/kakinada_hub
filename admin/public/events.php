<?php include 'header.php'; ?>

<?php
// Fetch events from the database
$query = "SELECT * FROM events ORDER BY created_at DESC";
$result = $conn->query($query);

// Check for query errors
if ($result === false) {
    $error = "Error fetching events: " . $conn->error;
}
?>

<div id="wrapper">
    <?php include 'sidebar.php'; ?>
    <div id="content-wrapper" class="d-flex flex-column">
        <?php include 'navbar.php'; ?>

        <div id="content">
            <div class="container-fluid">

               


                <h1 class="h3 mb-4 text-gray-800">Events List</h1>
                <?php if (isset($_GET['deleted']) && $_GET['deleted'] == 1): ?>
                    <div class="alert alert-success" id="delete-msg">Event deleted successfully.</div>
                    <script>
                        setTimeout(() => {
                            const msg = document.getElementById('delete-msg');
                            if (msg) msg.style.display = 'none';
                        }, 3000);
                    </script>
                <?php endif; ?>
                <?php if (isset($error)): ?>
                    <div class="alert alert-danger m-3"><?= htmlspecialchars($error) ?></div>
                <?php endif; ?>

                <div class="row">
                    <div class="col-md-12">
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">Events</h6>
                            </div>
                            <div class="card-body">

                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>S.No</th>
                                                <th>Occasion</th>
                                                <th>Venue</th>
                                                <th>Location</th>
                                                <th>Event Date</th>
                                                <th>Main Image</th>
                                                <th>Occasion Images</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $sn = 1;
                                            while ($row = $result->fetch_assoc()): ?>
                                                <tr>
                                                    <td><?= $sn++ ?></td>

                                                    <td><?= htmlspecialchars($row['occasion']) ?></td>
                                                    <td><?= htmlspecialchars($row['venue']) ?></td>
                                                    <td><?= htmlspecialchars($row['location_address']) ?></td>
                                                    <td><?= htmlspecialchars($row['event_date']) ?></td>
                                                    <td>
                                                        <?php if (!empty($row['main_image'])): ?>
                                                            <img src="../uploads/events/<?= htmlspecialchars($row['main_image']) ?>" alt="Main Image" style="width: 100px;">
                                                        <?php else: ?>
                                                            No image
                                                        <?php endif; ?>
                                                    </td>
                                                    <td>
                                                        <?php
                                                        $occasion_images = explode(',', $row['occasion_images']);
                                                        if (count($occasion_images) > 0) {
                                                            foreach ($occasion_images as $image) {
                                                                echo '<img src="../uploads/events/' . htmlspecialchars($image) . '" alt="Occasion Image" style="width: 100px; margin-right: 5px;">';
                                                            }
                                                        } else {
                                                            echo 'No images';
                                                        }
                                                        ?>
                                                    </td>
                                                    <td>
                                                        <a href="view_event.php?id=<?= $row['id'] ?>" class="btn btn-info btn-sm">View</a>
                                                        <a href="edit_event.php?id=<?= $row['id'] ?>" class="btn btn-primary btn-sm">Edit</a>
                                                        <a href="delete_event.php?id=<?= $row['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this event?')">Delete</a>
                                                    </td>
                                                </tr>
                                            <?php endwhile; ?>
                                        </tbody>
                                    </table>
                                </div>
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