<?php 
include 'header.php'; 
include '../../db.connection/db_connection.php'; 

if (!isset($_GET['id']) || empty($_GET['id'])) {
    echo "Invalid Request!";
    exit;
}

$travel_id = mysqli_real_escape_string($conn, $_GET['id']); 
$query = "SELECT * FROM travel_details WHERE travel_id = '$travel_id'";
$result = mysqli_query($conn, $query);
$columns = [
    'model' => 'Model',
    'seating_capacity' => 'Seating Capacity',
    'fuel_efficiency' => 'Fuel Efficiency',
    'price' => 'Price',
    'name' => 'Driver Name',
    'age' => 'Age',
    'gender' => 'Gender',
    'experience' => 'Experience',
    'price_per_6hrs' => 'Price per 6hrs',
    'image' => 'Image',
    'created_at' => 'Created At'
];

// Fetch data to determine which fields have values
$rows = [];
$visible_columns = [];

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
        foreach ($columns as $key => $label) {
            if (!empty($row[$key])) {
                $visible_columns[$key] = $label; // Store columns that have at least one non-null value
            }
        }
}
} else {
    echo "<p class='text-center'>No travel details found.</p>";
    include 'footer.php'; 
    include 'end.php'; 
    exit;
}

?>

<div id="wrapper">
    <?php include 'sidebar.php'; ?>
    <div id="content-wrapper" class="d-flex flex-column">
        <?php include 'navbar.php'; ?>
        <div id="content">
            <div class="container-fluid">
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-0 text-gray-800">Travel Details</h1>
                    <a href="add_travel_type.php?travel_id=<?= $travel_id ?>" class="btn btn-primary">
                        <i class="fa fa-plus"></i> Add Travel Detail
                    </a>
                    <a href="travel.php?travel_id=<?= $travel_id ?>" class="btn btn-primary">
                    <i class="fa-regular fa-eye"></i> Back To Travel List
                    </a>
                </div>

                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>S.no</th>
                            <?php foreach ($visible_columns as $label): ?>
                                <th><?= $label ?></th>
                            <?php endforeach; ?>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 1;
                        foreach ($rows as $row) {
                            echo "<tr><td>{$i}</td>";
                            foreach ($visible_columns as $key => $label) {
                                if ($key == 'image') {
                                    echo "<td><img src='../uploads/travels/{$row[$key]}' width='80' height='50'></td>";
                                } else {
                                    echo "<td>{$row[$key]}</td>";
                                }
                            }
                            echo "<td>
                                    <a href='edit_travel_details.php?id={$row['id']}' class='btn btn-warning btn-sm'>Edit</a>
                                    <a href='delete_travel_details.php?id={$row['id']}' class='btn btn-danger btn-sm' onclick='return confirm(\"Are you sure?\")'>Delete</a>
                                  </td></tr>";
                            $i++;
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
        <?php include 'footer.php'; ?>
    </div>
</div>
<?php include 'end.php'; ?>
