<?php include 'header.php'; ?>
<?php include '../../db.connection/db_connection.php'; ?>

<?php
if (!isset($_GET['id']) || empty($_GET['id'])) {
    die('Invalid request.');
}

$id = intval($_GET['id']);
$result = mysqli_query($conn, "SELECT * FROM offers WHERE id = $id");
$item = mysqli_fetch_assoc($result);

if (!$item) {
    die('offers item not found.');
}
?>

<div id="wrapper">
    <?php include 'sidebar.php'; ?>
    <div id="content-wrapper" class="d-flex flex-column">
        <?php include 'navbar.php'; ?>

        <div id="content">
            <div class="container-fluid">
                <h1 class="h3 mb-4 text-gray-800">View offers Item</h1>

                <div class="card shadow p-4">
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <img src="../uploads/home_offers/<?= $item['image'] ?>" class="img-fluid rounded shadow" alt="offers Image">
                        </div>
                        <div class="col-md-8">
                            <h4>Title:</h4>
                            <p><?= htmlspecialchars($item['title']) ?></p>

                            <h4>Description:</h4>
                            <p><?= nl2br(htmlspecialchars($item['description'])) ?></p>

                            <h4>Offer:</h4>
                            <p><?= htmlspecialchars($item['offer']) ?></p>

                            <h4>Offer Code:</h4>
                            <p><?= htmlspecialchars($item['offer_code']) ?></p>

                            <h4>Link:</h4>
                            <p>
                                <?php if (!empty($item['link'])): ?>
                                    <a href="<?= $item['link'] ?>" target="_blank"><?= $item['link'] ?></a>
                                <?php else: ?>
                                    —
                                <?php endif; ?>
                            </p>

                            <h4>Type:</h4>
                            <p><?= ucfirst($item['type']) ?></p>
                        </div>
                    </div>
                </div>

                <a href="view_home_offers.php" class="btn btn-secondary mt-3">← Back to List</a>
            </div>
        </div>

        <?php include 'footer.php'; ?>
    </div>
</div>

<?php include 'end.php'; ?>
