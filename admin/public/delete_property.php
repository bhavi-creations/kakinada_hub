<?php
session_start();
include '../../db.connection/db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id'])) {
    $id = $_POST['id'];

    // Get Image Path
    $query = "SELECT image FROM properties WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $property = $result->fetch_assoc();

    if ($property) {
        // Delete Image File
        $imagePath = "../uploads/properties/" . $property['image'];
        if (!empty($property['image']) && file_exists($imagePath)) {
            unlink($imagePath);
        }

        // Delete Property from Database
        $delete_query = "DELETE FROM properties WHERE id = ?";
        $stmt = $conn->prepare($delete_query);
        $stmt->bind_param("i", $id);
        
        if ($stmt->execute()) {
            echo json_encode(["success" => true, "message" => "Property deleted successfully!"]);
            exit();
        } else {
            echo json_encode(["success" => false, "message" => "Failed to delete property!"]);
            exit();
        }
    } else {
        echo json_encode(["success" => false, "message" => "Property not found!"]);
        exit();
    }
}

echo json_encode(["success" => false, "message" => "Invalid request!"]);
exit();
?>


 