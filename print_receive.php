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
    <title>Receive Record</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    
    <style>
        body {
            background: url('images/stdc_bg.jpeg') no-repeat center center fixed;      
            display: flex;        
            background-size: cover;
            padding: 0;
            min-height: 100vh;
        }

        /* A4 Paper Size */
        .a4-container {
            background-color: rgba(255, 255, 255, 0.95);
            width: 300mm;
            height: 370mm;
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
   // Fetch the receive ID from the URL
   if (isset($_GET['receive_id'])) {
    $receive_id = $_GET['receive_id'];

    // Fetch the receive data from the database
    $query = mysqli_query($conn, "SELECT * FROM receive WHERE receive_id = '$receive_id'");
    $row = mysqli_fetch_assoc($query);

    // Pre-fill variables with the fetched data
    $selected_asset_id = $row['asset_id'];
    $ordered_by = $row['ordered_by'];
    $no_LO = $row['no_LO'];
    $LO_date = $row['LO_date'];
    $acceptance_type = $row['acceptance_type'];
    $supplier = $row['supplier'];
    $address = $row['address'];
    $no_DO = $row['no_DO'];
    $DO_date = $row['DO_date'];
    $received_date = $row['received_date'];
    $transportation = $row['transportation'];
    $receive_officer_name = $row['receive_officer_name'];
    $receive_officer_position = $row['receive_officer_position'];
    $receive_officer_department = $row['receive_officer_department'];
    $receive_officer_date = $row['receive_officer_date'];
    $technical_officer_name = $row['technical_officer_name'];
    $technical_officer_position = $row['technical_officer_position'];
    $technical_officer_department = $row['technical_officer_department'];
    $technical_officer_date = $row['technical_officer_date'];
    $section = $row['section'];
    $procurement = $row['procurement'];
    $phone = $row['phone'];
    $category = $row['category'];
    $subcategory = $row['subcategory'];
    $type = $row['type'];
    $brand_model = $row['brand_model'];
    $qty_requested = $row['qty_requested'];
    $qty_sent = $row['qty_sent'];
    $qty_receive = $row['qty_receive'];
    $unit_price = $row['unit_price'];
    $total_price = $row['total_price'];
    $expiry_date = $row['expiry_date'];
    $notes = $row['notes'];
   }
    ?>


    <div class="header-container">
        <div class="logo-container">
            <img src="images/logo.png" alt="logo"/>
        </div>
        <h1 class="display-10 font-weight-bold">RECEIVE RECORD INFORMATION</h1>
    </div>
<br>
<br>
<div class="section-head">ASSET INFORMATION</div>
    <table class="table table-bordered">
        <tr>
            <th>Asset ID:</th>
            <td><?php echo $row['asset_id']; ?></td>
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
            <th>Phone Number:</th>
            <td><?php echo $row['phone']; ?></td>
            <th>Total Price:</th>
            <td>RM <?php echo $row['total_price']; ?></td>
        </tr>
        <tr>
            <th>Quantity Request:</th>
            <td><?php echo $row['qty_requested']; ?></td>
            <th>Date Received:</th>
            <td><?php echo date('d/m/Y', strtotime($row['received_date'])); ?></td>
        </tr>
        <tr>
            <th>Quantity Sent:</th>
            <td><?php echo $row['qty_sent']; ?></td>
            <th>Date Expiry:</th>
            <td><?php echo date('d/m/Y', strtotime($row['expiry_date'])); ?></td>
        </tr>
        <tr>
            <th>Quantity Receive:</th>
            <td><?php echo $row['qty_receive']; ?></td>
            <th>Notes:</th>
            <td><?php echo $row['notes'] ; ?> </td>
        </tr>
        
       
        <tr>
            <th>Supplier Name:</th>
            <td><?php echo $row['supplier']; ?></td>
            <th>Supplier Address:</th>
            <td><?php echo $row['address']; ?></td>
        </tr>
    </table>

    <div class="section-header">RECEIVE INFORMATION</div>
    <table class="table no-border-table">
        <tr>
            <th>Number DO:</th>
            <td><?php echo $row['no_DO']; ?></td>
            <th>Number LO:</th>
            <td><?php echo $row['no_LO']; ?></td>
        </tr>
        <tr>
                <th>DO Date:</th>
                <td><?php echo date('d/m/Y', strtotime($row['DO_date'])); ?></td>
                <th>LO Date:</th>
                <td><?php echo date('d/m/Y', strtotime($row['LO_date'])); ?></td>
        </tr>
      
        <tr>
            <th>Ordered By:</th>
            <td><?php echo $row['ordered_by']; ?></td>
        </tr>
        <tr>
            <th>Transportation:</th>
            <td><?php echo $row['transportation']; ?></td>
        </tr>
        <tr>
            <th>Acceptance Type:</th>
            <td><?php echo $row['acceptance_type']; ?></td>
        </tr>
    </table>

    <div class="section-header">RECEIVE OFFICER</div>
    <table class="table no-border-table">
        <tr>
                <th>Date:</th>
                <td><?php echo date('d/m/Y', strtotime($row['receive_officer_date'])); ?></td>
        </tr>
        <tr>
            <th>Name:</th>
            <td><?php echo $row['receive_officer_name']; ?></td>
        </tr>
        <tr>
            <th>Position:</th>
            <td><?php echo $row['receive_officer_position']; ?></td>
        </tr>
        <tr>
            <th>Department:</th>
            <td><?php echo $row['receive_officer_department']; ?></td>
        </tr>
        <tr>
            <th>Signature:</th>
            <td></td>
        </tr>
    </table>


    

    <div class="section-header">TECHNICAL OFFICER</div>
    <table class="table no-border-table">
     
        <tr>
            <th>Date:</th>
            <td><?php echo date('d/m/Y', strtotime($row['technical_officer_date'])); ?></td>
        </tr>
        <tr>
            <th>Officer Name:</th>
            <td><?php echo $row['technical_officer_name']; ?></td>
        </tr>
        <tr>
            <th>Position:</th>
            <td><?php echo $row['technical_officer_position']; ?></td>
        </tr>
        <tr>
            <th>Signature:</th>
            <td></td>
        </tr>
    </table>


    <a href="receive_list.php" class="btn btn-outline-dark">
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


