<?php
include "conn/conn.php";
error_reporting(0);
session_start();
if (empty($_SESSION['UserID']) AND empty($_SESSION['Password']))
{
  header('location:index.php');
}
else
{
?>

<!DOCTYPE html>
<html lang="en">

<!-- head -->
<?php include "layout/head.php";?>

<body>
  <div class="container-scroller">
    <!-- partial:../../partials/_navbar.html -->
    <?php include "layout/top.php";?>
	
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <!-- partial:../../partials/_sidebar.html -->
       <?php include "layout/menu.php";?>
	      <!-- Bootstrap Icons -->
		  <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css" rel="stylesheet">

			<!-- jQuery (for tooltip) -->
			<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

			<!-- Popper.js and Bootstrap JS (for tooltip) -->
			<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
			<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

			<script>
	// Initialize tooltip
	$(document).ready(function () {
		$('[data-toggle="tooltip"]').tooltip();
	});
</script>
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
		<?php
				// Get the parameters from the URL
				$code = isset($_GET['code']) ? $_GET['code'] : '';
				$act = isset($_GET['act']) ? $_GET['act'] : '';

				// Check if action is 'del'
				if ($act == 'del') {

					// Check if 'ref_no' exists for deleting from the 'inspection' table
					if (isset($_GET['ref_no'])) {
						$ref_no = $_GET['ref_no'];
						$deleteInspection = mysqli_query($conn, "DELETE FROM inspection WHERE ref_no = '$ref_no'");

						if ($deleteInspection) {
							echo "<div class='alert alert-danger alert-dismissible'>
									<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
									<strong>Thank you!</strong> Inspection $ref_no successfully deleted.
								</div>";
						} else {
							echo "<div class='alert alert-danger alert-dismissible'>
									<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
									<strong>Error!</strong> Unable to delete Inspection $ref_no.
								</div>";
						}
					}

					// Check if 'receive_id' exists for deleting from the 'receive' table
					if (isset($_GET['receive_id'])) {
						$receive_id = $_GET['receive_id'];
						$deleteReceive = mysqli_query($conn, "DELETE FROM receive WHERE receive_id = '$receive_id'");

						if ($deleteReceive) {
							echo "<div class='alert alert-danger alert-dismissible'>
									<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
									<strong>Thank you!</strong> Receive Asset details $receive_id successfully deleted.
								</div>";
						} else {
							echo "<div class='alert alert-danger alert-dismissible'>
									<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
									<strong>Error!</strong> Unable to delete Receive Asset details $receive_id.
								</div>";
						}
					}
				}
			?>

<div class="row">
            
            
			<div class="col-lg-12 grid-margin stretch-card">
			   <div class="card">
				 <div class="card-body">
				   <h1 class="display-5 font-weight-bold"><i class='menu-icon hgi-stroke hgi-image-add-02'></i> Asset Inspection List</h1>
				   <div class="table-responsive mt-4">
					 <table id="datatable" class="table dataTable no-footer" role="grid">
					   <thead>
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
								while($row = mysqli_fetch_array($sql))
								{
								//get user level
								if($_SESSION['UserLvl'] == 1)
								{
										//hide delete function from all staff except admin
										$function = "
														<a href='print_inspection.php?ref_no=$row[ref_no]&registration_id=$row[registration_id]' 
														data-toggle='tooltip' data-placement='left' title='Print'>
															<i class='bi bi-printer-fill text-success' style='font-size: 20px;'></i>
														</a>
														<a href='update_inspection.php?ref_no=$row[ref_no]&registration_id=$row[registration_id]'
														data-toggle='tooltip' data-placement='left' title='Update'>
															<i class='hgi-stroke hgi-pencil-edit-02 text-warning' style='font-size: 20px;'></i>
														</a>
														<a href='inspection_list.php?act=del&ref_no=$row[ref_no]'
														data-toggle='tooltip' data-placement='left' title='Remove'
														onclick=\"return confirm('Are you sure you want to remove inspection asset $row[asset_category]?');\">
															<i class='hgi-stroke hgi-delete-03 text-danger' style='font-size: 20px;'></i>
														</a>";
								}
								else if($_SESSION['UserLvl'] == 2)
								{
										$function = "
														<a href='print_inspection.php?ref_no=$row[ref_no]&registration_id=$row[registration_id]' 
														data-toggle='tooltip' data-placement='left' title='Print'>
															<i class='bi bi-printer-fill text-success' style='font-size: 20px;'></i>
														</a>
														<a href='update_inspection.php?ref_no=$row[ref_no]&registration_id=$row[registration_id]'
														data-toggle='tooltip' data-placement='left' title='Update'>
															<i class='hgi-stroke hgi-pencil-edit-02 text-warning' style='font-size: 20px;'></i>
														</a>";
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
            
          
          </div>
        </div>
        <!-- content-wrapper ends -->
        <!-- partial:../../partials/_footer.html -->
        <?php include "layout/footer.php";?>
		
        <!-- partial -->
      </div>
      <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->
  <!-- plugins:js -->
  <!-- SCRIPT -->
   <?php include "layout/script.php";?>
</body>

</html>
<?php
}
?>