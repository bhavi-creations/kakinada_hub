<?php
// delete_company_ad.php
include '../../db.connection/db_connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $id = (int)$_POST['id'];

    // Fetch the filename so we can remove it
    $stmt = $conn->prepare("SELECT file_name FROM company_ads WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->bind_result($file);
    if ($stmt->fetch()) {
        $stmt->close();

        // Delete file
        $path = "../uploads/company_ads/" . $file;
        if (file_exists($path)) unlink($path);

        // Delete record
        $del = $conn->prepare("DELETE FROM company_ads WHERE id = ?");
        $del->bind_param("i", $id);
        if ($del->execute()) {
            echo json_encode(['success' => true]);
            exit;
        }
    }

    echo json_encode(['success' => false, 'message' => 'Could not delete that ad.']);
    exit;
}

// Fallback
echo json_encode(['success' => false, 'message' => 'Invalid request']);
