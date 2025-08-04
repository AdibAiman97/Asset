<?php
include "conn/conn.php";



// Check the database connection
if ($conn->connect_error) {
    echo json_encode(['success' => false, 'message' => 'Database connection failed']);
    exit();
}

// Check if asset_id is provided via POST
if (isset($_POST['asset_id'])) {
    $asset_id = $_POST['asset_id'];

    // Query to fetch registration details
    $sql = mysqli_query($conn, "SELECT * FROM registration WHERE asset_id = '$asset_id'");

    // Check if query is successful and if any row is returned
    if ($sql && mysqli_num_rows($sql) > 0) {
        $row = mysqli_fetch_array($sql, MYSQLI_ASSOC);

        // Send the registration data as JSON
        echo json_encode(['success' => true] + $row);
    } else {
        // No record found
        echo json_encode(['success' => false, 'message' => 'No record found for the provided asset ID']);
    }
} else {
    // asset_id not provided
    echo json_encode(['success' => false, 'message' => 'Asset ID is missing']);
}
?>


