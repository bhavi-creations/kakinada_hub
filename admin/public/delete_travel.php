<?php
session_start();
include '../../db.connection/db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id'])) {
    $id = $_POST['id'];

    // Get Travel Type and Image Path
    $query = "SELECT type, image FROM travels WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $travel = $result->fetch_assoc();

    if ($travel) {
        $travelType = strtolower(trim($travel['type'])); // Normalize type
        $imagePath = "../uploads/travels/" . $travel['image'];

        // Delete Image File
        if (!empty($travel['image']) && file_exists($imagePath)) {
            unlink($imagePath);
        }

        // Delete Travel Entry from Database
        $delete_query = "DELETE FROM travels WHERE id = ?";
        $stmt = $conn->prepare($delete_query);
        $stmt->bind_param("i", $id);
        
        if ($stmt->execute()) {
            // Check if any remaining travels exist for this type
            $checkQuery = "SELECT COUNT(*) as count FROM travels WHERE type = ?";
            $stmt = $conn->prepare($checkQuery);
            $stmt->bind_param("s", $travelType);
            $stmt->execute();
            $checkResult = $stmt->get_result();
            $countRow = $checkResult->fetch_assoc();
            
            $deletedType = ($countRow['count'] == 0) ? $travelType : null;

            echo json_encode(["success" => true, "deletedType" => $deletedType]);
            exit();
        } else {
            echo json_encode(["success" => false, "message" => "Failed to delete travel!"]);
            exit();
        }
    } else {
        echo json_encode(["success" => false, "message" => "Travel not found!"]);
        exit();
    }
}

echo json_encode(["success" => false, "message" => "Invalid request!"]);
exit();
?>
