<?php
include "conn/conn.php";
error_reporting(0);
session_start();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Asset QR Record</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    
    <style>
        body {
            background: url('images/stdc_bg.jpg') no-repeat center center fixed;      
            display: flex;        
            background-size: cover;
            padding: 0;
            min-height: 100vh;
        }

        /* A4 Paper Size */
        .a4-container {
            background-color: rgba(255, 255, 255, 0.95);
            width: 300mm;
            height: 400mm;
            margin: 20px auto;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
        }

        .header-container {
            text-align: center;
            margin-bottom: 20px;
        }

        .logo-container img {
            max-width: 300px; /* Adjust this value as needed */
            height: auto;
        }

        .section-header {
            background-color: #D3D3D3;
            padding: 5px;
            margin-bottom: 15px;
            font-weight: bold;
            border-radius: 5px;
            text-align: center;
            font-size: 18px;
        }

        .section-head {
            background-color: #D3D3D3;
            padding: 5px;
            margin-bottom: 15px;
            font-weight: bold;
            border-radius: 5px;
            text-align: center;
            font-size: 18px;
        }

        .table {
            width: 100%;
            margin-top: 5px;
            border-collapse: collapse; /* Ensures table borders are merged */
        }

        .table th, .table td {
            padding: 5px; /* Reduced padding */
            text-align: left; /* Align text to the left */
            font-size: 16px;
        }

        .table th {
            width: 60%; /* Set a width for the header cells */
        }

        .table td {
            width: 20%; /* Set a width for the data cells */
        }
        .table th {
            width: 20%; /* Set a width for the header cells */
        }

        /* Table without borders for Asset Information */
        .no-border-table th, .no-border-table td {
            border: none; /* No border for asset information table */
        }

        /* Ensure print matches the preview layout */
        @media print {
            body * {
                visibility: hidden;
            }

            .a4-container, .a4-container * {
                visibility: visible;
            }

            .a4-container {
                margin: 0;
                box-shadow: none;
            }

            .btn {
                display: none;
            }
        }

        .signature-section {
            margin-top: 40px;
            text-align: right;
        }

        .signature {
            display: inline-block;
            margin-top: 60px;
            border-top: 1px solid #333; /* For signature line */
            width: 200px; /* Adjust width as needed */
            text-align: center;
        }

        h1 {
            font-size: 28px;
            margin-bottom: 20px;
            color: #A9A9A9;
        }
         /* Mobile-specific styling */
         @media (max-width: 768px) {
            .a4-container {
                width: 90%; /* Full width on small screens */
                height: 80%; /* Full width on small screens */
                
                padding: 10px;
            }
            .table th, .table td {
                font-size: 10px; /* Smaller font for mobile */
            }
        }

	
    </style>

    <script>
        function printPreview() {
            window.print();
        }
    </script>
</head>
<body>

<div class="container a4-container">
<?php
// Fetch registration_id from the URL
if (isset($_GET['registration_id'])) {
    $registration_id = $_GET['registration_id'];

    // Combined query to fetch details from both 'registration' and 'inspection'
    $sql = mysqli_query($conn, "
        SELECT r.*, i.* 
        FROM registration r
        LEFT JOIN inspection i ON r.registration_id = i.registration_id
        WHERE r.registration_id = '$registration_id'
    ");

    $row = mysqli_fetch_array($sql);
}

if (isset($_GET['disposal_id'])) {
	$disposal_id = $_GET['disposal_id'];

	// Fetch the existing disposal details
	$sql = mysqli_query($conn, "SELECT * FROM disposal WHERE disposal_id = '$disposal_id'");
	$row = mysqli_fetch_array($sql);

	// Assign fetched data to variables
	$organization = $row['organization'];
	$category = $row['category'];
	$sector = $row['sector'];
	$subcategory = $row['subcategory'];
	$type = $row['type'];
	$serial_no = $row['serial_no'];
	$warranty = $row['warranty'];
	$component = $row['component'];
	$barcode_no = $row['barcode_no'];
	$ori_acq_price = $row['ori_acq_price'];
	$brand_model = $row['brand_model'];
	$gov_order_no = $row['gov_order_no'];
	$file_ref_no = $row['file_ref_no'];
	$purchase_date = $row['purchase_date'];
	$retrieval_date = $row['retrieval_date'];
	$made_by = $row['made_by'];
	$qty = $row['qty'];
	$unit = $row['unit'];
	$type_engine_no = $row['type_engine_no'];
	$cost_per_unit = $row['cost_per_unit'];
	$warranty_year = $row['warranty_year'];
	$chasis_series = $row['chasis_series'];
	$supplier = $row['supplier'];
	$spec_notes = $row['spec_notes'];
	$supplier_address = $row['supplier_address'];
	$hod_date = $row['hod_date'];
	$placement_date = $row['placement_date'];
	$hod_name = $row['hod_name'];
	$placement_code = $row['placement_code'];
	$hod_position = $row['hod_position'];
	$placement_location = $row['placement_location'];
	$placement_name = $row['placement_name'];
	$placement_position = $row['placement_position'];
	$disposal_date = $row['disposal_date'];
	$method = $row['method'];
	$signature = $row['signature'];  // Correct the typo here
	$selected_asset_id = $row['asset_id'];
}
?>


    <div class="header-container">
        <div class="logo-container">
            <img src="images/logo.png" alt="logo"/>
        </div>
        <h1 class="display-10 font-weight-bold">ASSET RECORD BASED ON QR CODE</h1>
    </div>
<br>
<br>
<div class="section-head">ASSET INFORMATION</div>
    <table class="table table-bordered">
        <tr>
            <th>Asset ID:</th>
            <td><?php echo $row['registration_id']; ?></td>
        </tr>
        <tr>
            <th>Category:</th>
            <td><?php echo $row['category']; ?></td> 
        </tr>
        <tr>    
            <th>Subcategory:</th>
            <td><?php echo $row['subcategory']; ?></td>
        </tr>
        <tr>    
            <th>Type/Brand/Model:</th>
            <td><?php echo $row['type']; ?>/<?php echo $row['brand_model']; ?></td>
        </tr>          
        <tr>
            <th>Made By:</th>
            <td><?php echo $row['made_by']; ?></td>
            <th>Original Procurement Price:</th>
            <td><?php echo $row['ori_acq_price']; ?></td>
        </tr>
        <tr>
            <th>Type and Engine Number:</th>
            <td><?php echo $row['type_engine_no']; ?></td>
            <th>Date Received:</th>
            <td><?php echo date('d/m/Y', strtotime($row['retrieval_date'])); ?></td>
        </tr>
        <tr>
            <th>Chasis Number/Maker Series:</th>
            <td><?php echo $row['chasis_series']; ?></td>
            <th>Oficial Government Order Number:</th>
            <td><?php echo $row['gov_order_no']; ?></td>
        </tr>
        <tr>
            <th>Chasis Number/Maker Series:</th>
            <td><?php echo $row['chasis_series']; ?></td>
            <th>Oficial Government Order Number:</th>
            <td><?php echo $row['gov_order_no']; ?></td>
        </tr>
        <tr>
            <th>Serial No:</th>
            <td><?php echo $row['serial_no']; ?></td>
            <th>Warranty Period:</th>
            <td><?php echo $row['warranty_year'] ; ?> Years</td>
        </tr>
        
       
        <tr>
            <th>Supplier Name:</th>
            <td><?php echo $row['supplier']; ?></td>
            <th>Supplier Address:</th>
            <td><?php echo $row['supplier_address']; ?></td>
        </tr>
    </table>

    <div class="section-header">HEAD OF DEPARTMENT</div>
    <table class="table no-border-table">
        <tr>
                <th>Date:</th>
                <td><?php echo date('d/m/Y', strtotime($row['hod_date'])); ?></td>
        </tr>
        <tr>
            <th>Name:</th>
            <td><?php echo $row['hod_name']; ?></td>
        </tr>
        <tr>
            <th>Position:</th>
            <td><?php echo $row['hod_position']; ?></td>
        </tr>
        <tr>
            <th>Signature:</th>
            <td></td>
        </tr>
    </table>


    

    <div class="section-header">PLACEMENT</div>
    <table class="table no-border-table">
        <tr>
            <th>Location:</th>
            <td><?php echo $row['placement_location']; ?></td>
        </tr>
        <tr>
            <th>Date:</th>
            <td><?php echo date('d/m/Y', strtotime($row['placement_date'])); ?></td>
        </tr>
        <tr>
            <th>Officer Name:</th>
            <td><?php echo $row['placement_name']; ?></td>
        </tr>
        <tr>
            <th>Position:</th>
            <td><?php echo $row['placement_position']; ?></td>
        </tr>
        <tr>
            <th>Signature:</th>
            <td></td>
        </tr>
    </table>
<div class="section-header">INSPECTION</div>
    <table class="table no-border-table">
        
        <tr>
            <th>Date:</th>
            <td><?php echo date('d/m/Y', strtotime($row['inspection_date_officer'])); ?></td>
        </tr>
        <tr>
            <th>Inspection Status:</th>
            <td><?php echo $row['inspection_status']; ?></td>
        </tr>
        <tr>
            <th>Officer Name:</th>
            <td><?php echo $row['inspection_officer']; ?></td>
        </tr>
        <tr>
            <th>Signature:</th>
            <td></td>
        </tr>
    </table>

	
    <a href="qr_registration.php" class="btn btn-outline-dark">
        <i class="mdi mdi-keyboard-backspace"></i> Back
    </a>
    <button class="btn btn-warning mr-2" onclick="printPreview()">
        <i class="mdi mdi-printer"></i> Print
    </button>
</div>

<!-- Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
