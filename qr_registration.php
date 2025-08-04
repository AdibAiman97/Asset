<?php
include "conn/conn.php";
error_reporting(0);
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<!-- Head -->
<?php include "layout/head.php"; ?>

<style>
  body {
    background: url('images/stdc_bg.jpg') no-repeat center center fixed;
    font-family: 'Poppins', sans-serif;
    min-height: 100vh; /* Ensures the body takes up full height */
    display: flex; /* Enables flexbox */
    align-items: center; /* Vertically centers items */
    justify-content: center; /* Horizontally centers items */
    margin: 0; /* Removes default margin */
    background-size: cover;
    padding: 0;
    min-height: 100vh;
  }

  .container {
    background-color: rgba(255, 255, 255, 0.75); /* Slight transparency to let the background show through */
    width: 100%; /* Full width */
    max-width: 1400px; /* Max width for larger screens */
    padding: 20px; /* Padding for inner spacing */
  }

  .card {
    border-radius: 15px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    background-color: #fefefe;
  }

  .card h1 {
    font-weight: bold;
    color: #3b5998;
  }

  table thead {
    background: #3b5998;
    color: #fff;
  }

  table tbody tr:nth-child(even) {
    background-color: #f9f9f9;
  }

  table tbody tr:hover {
    background-color: #e1eaf6;
    cursor: pointer;
  }

  th,
  td {
    padding: 12px;
    text-align: center;
    vertical-align: middle;
  }

  .btn-outline-warning {
    color: #ffb74d;
    border-color: #ffb74d;
  }

  .btn-outline-warning:hover {
    background-color: #ffb74d;
    color: #fff;
  }

  .btn-outline-danger {
    color: #e57373;
    border-color: #e57373;
  }

  .btn-outline-danger:hover {
    background-color: #e57373;
    color: #fff;
  }

  .table-responsive {
    max-height: 400px;
    overflow-y: auto;
  }

  ::-webkit-scrollbar {
    width: 8px;
  }

  ::-webkit-scrollbar-thumb {
    background-color: #3b5998;
    border-radius: 10px;
  }

  .btn {
        background-color: #ff9800;
        color: white;
        padding: 10px 20px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        margin-top: 10px;
    }

    .btn:hover {
        background-color: #0056b3;
    }
</style>

<body>
<div class="container">
    
       
<h1 class="display-4 font-weight-bold text-center"> 
  <i class='hgi-stroke hgi-image-add-06'></i> Asset Record Based on QR Code
</h1>

        <div class="button-group">         
                <a href="dashboard.php" class="btn"> <-- Back to Dashboard</a>
            </div>
            <div class="table-responsive mt-3">
          <table id="datatable" class="table table-hover table-striped align-middle text-center">
          <thead class="table-dark">
              <tr>
              <th>ID Registration</th>
					   <th>Categories</th>
						 <th>Sub Categories</th>
              <th>Inspection Date</th>
						  <th>Status</th>
						  <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $sql = mysqli_query($conn, "SELECT * FROM inspection");
              while ($row = mysqli_fetch_array($sql)) {
                  // Define action buttons based on user level
                  if ($_SESSION['UserLvl'] == 1) {
                      $function = "
                        <a href='qrupdate_registration.php?ref_no=$row[ref_no]&registration_id=$row[registration_id]' 
                           class='btn btn-outline-warning btn-sm me-2' 
                           data-toggle='tooltip' data-placement='top' title='Print'>
                        <i class='bi bi-pencil-square'></i> Print
                        </a>
                      ";
                  } elseif ($_SESSION['UserLvl'] == 2) {
                      $function = "
                        <a href='qrupdate_registration.php?registration_id=ref_no=$row[ref_no]&registration_id=$row[registration_id]' 
                           class='btn btn-outline-warning btn-sm me-2' 
                           data-toggle='tooltip' data-placement='top' title='Print'>
                        <i class='bi bi-pencil-square'></i> Print
                        </a>
                      ";
                  } else {
                      $function = "<span class='text-muted'>No Actions Available</span>";
                  }
                  $dateString = str_replace('-', '/', $row['inspection_date_asset']);
                  $dateStringFormat = date('d/m/Y', strtotime($dateString));
                  echo "<tr>
                      <td><label class='badge badge-pill badge-warning'>$row[registration_id]</label></td>
                      <td>$row[asset_category]</td>
                      <td>$row[asset_sub_category]</td>
                      <td>$dateStringFormat</td>
                      <td>$row[inspection_status]</td>
                      <td>$function</td>
                      </tr>";
              }
              ?>
            </tbody>
            
          </table>
        </div>
      </div>
    </div>
  </div>
  
  <!-- Scripts -->
  <?php include "layout/script.php"; ?>
  
  <script>
    // Enable Bootstrap tooltips
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-toggle="tooltip"]'));
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
      return new bootstrap.Tooltip(tooltipTriggerEl);
    });
  </script>
</body>

</html>


