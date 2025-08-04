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
<style>
        table {
            border-collapse: collapse;
            border: 1px solid black; /* Outer border */
        }

        th, td {
            border: none; /* No border for individual cells */
        }
        .table td img, .table th img {
            border-radius: 20%;
            width: 150px;
            height: 150px;
        }
		@media print {
      .no-print {
        display: none;
      }
    }
</style>
<script>
function printDiv(divName) {
      var printContents = document.getElementById(divName).innerHTML;
      var originalContents = document.body.innerHTML;
      document.body.innerHTML = printContents;
      window.print();
      document.body.innerHTML = originalContents;
    }
	</script>
<body>
  <div class="container-scroller">
    <!-- partial:../../partials/_navbar.html -->
    <?php include "layout/top.php";?>
	
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <!-- partial:../../partials/_sidebar.html -->
       <?php include "layout/menu.php";?>
	   
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
            
            
            <div class="col-12 grid-margin">
			<?php
						// Fetch registration_id from the URL
						if (isset($_GET['registration_id'])) {
							$registration_id = $_GET['registration_id'];
			
							// Fetch the existing registration details
							$sql = mysqli_query($conn, "SELECT * FROM registration WHERE registration_id = '$registration_id'");
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
							$selected_asset_id = $row['asset_id'];
			
							// When form is submitted for updating
							if (isset($_POST['submit'])) {
								$organization = htmlspecialchars($_POST['organization'], ENT_QUOTES);
								$category = $_POST['category'];
								$sector = $_POST['sector'];
								$subcategory = $_POST['subcategory'];
								$type = $_POST['type'];
								$serial_no = $_POST['serial_no'];
								$warranty = $_POST['warranty'];
								$component = $_POST['component'];
								$barcode_no = $_POST['barcode_no'];
								$ori_acq_price = $_POST['ori_acq_price'];
								$brand_model = $_POST['brand_model'];
								$gov_order_no = $_POST['gov_order_no'];
								$file_ref_no = $_POST['file_ref_no'];
								$purchase_date = $_POST['purchase_date'];
								$retrieval_date = $_POST['retrieval_date'];
								$made_by = htmlspecialchars($_POST['made_by'], ENT_QUOTES);
								$qty = $_POST['qty'];
								$unit = $_POST['unit'];
								$type_engine_no = $_POST['type_engine_no'];
								$cost_per_unit = $_POST['cost_per_unit'];
								$warranty_year = $_POST['warranty_year'];
								$chasis_series = $_POST['chasis_series'];
								$supplier = htmlspecialchars($_POST['supplier'], ENT_QUOTES);
								$spec_notes = $_POST['spec_notes'];
								$supplier_address = htmlspecialchars($_POST['supplier_address'], ENT_QUOTES);
								$hod_date = $_POST['hod_date'];
								$placement_date = $_POST['placement_date'];
								$hod_name = htmlspecialchars($_POST['hod_name'], ENT_QUOTES);
								$placement_code = $_POST['placement_code'];
								$hod_position = $_POST['hod_position'];
								$placement_location = $_POST['placement_location'];
								$placement_name = htmlspecialchars($_POST['placement_name'], ENT_QUOTES);
								$placement_position = $_POST['placement_position'];
								$asset_id = $_POST['asset_id'];
			
							
							}
						}
						
						// Helper function to get the picture from the asset table
						function getAssetPicture($asset_id, $conn) {
							$query = mysqli_query($conn, "SELECT picture FROM asset WHERE asset_id = '$asset_id'");
							$row = mysqli_fetch_assoc($query);
							return !empty($row['picture']) ? $row['picture'] : 'placeholder.png';
						}
			
						// Helper function to get the QR code from the asset table
						function getAssetQRCode($asset_id, $conn) {
							$query = mysqli_query($conn, "SELECT qrcode FROM asset WHERE asset_id = '$asset_id'");
							$row = mysqli_fetch_assoc($query);
							return !empty($row['qrcode']) ? $row['qrcode'] : 'qr-scan.png';
						}
			
			
					date_default_timezone_set("Asia/Kuala_Lumpur");
					$today = date("Y-m-d");
			
					if (isset($_POST['submit']))
					{
						
						$ref_no = htmlspecialchars($_POST['ref_no'], ENT_QUOTES);
						$inspection_date_officer = $_POST['inspection_date_officer'];
						$inspection_title = $_POST['inspection_title'];
						$inspection_officer = $_POST['inspection_officer'];
						$serial_no = $_POST['serial_no'];
						$asset_category = $_POST['asset_category'];
						$asset_sub_category = $_POST['asset_sub_category'];
						$inspection_date_asset = $_POST['inspection_date_asset'];
						$location = $_POST['location'];
						$local_officer = htmlspecialchars($_POST['local_officer'], ENT_QUOTES);
						$complete = $_POST['complete'];
						$correction = $_POST['correction'];
						$inspection_status = $_POST['inspection_status'];
						$inspection_notes = htmlspecialchars($_POST['inspection_notes'], ENT_QUOTES);
						
						$sql = mysqli_query($conn, "UPDATE inspection SET inspection_date_officer = '$inspection_date_officer',
																			inspection_title = '$inspection_title',
																			inspection_officer = '$inspection_officer',
																			serial_no = '$serial_no',
																			asset_category = '$asset_category',
																			asset_sub_category = '$asset_sub_category',
																			inspection_date_asset = '$inspection_date_asset',
																			location = '$location',
																			local_officer = '$local_officer',
																			complete = '$complete',
																			correction = '$correction',
																			inspection_status = '$inspection_status',
																			inspection_notes = '$inspection_notes'
																			WHERE ref_no = '$ref_no'");
							
						
														
						if($sql == true)
						{
						
							echo "<div class='alert alert-success alert-dismissible'>
										<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
										<strong>Thank You!</strong> Asset Inspection Form successfully saved.
									</div>";
						}
						else
							echo "<div class='alert alert-danger alert-dismissible'>
									<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
									<strong>Sorry!</strong> error.
								</div>";
					}
					
					
					//get inspection details
					$ref_no = $_GET['ref_no'];
					$sql = mysqli_query($conn, "SELECT * FROM inspection WHERE ref_no = '$ref_no'");
					$row = mysqli_fetch_array($sql);
					
					//auto check previous data kewpa
					if($row['complete'] == "Yes")
						$checkedCompleteYes = "checked";
					else if($row['complete'] == "No")
						$checkedCompleteNo = "checked";
					
					//auto check previous data correction
					if($row['correction'] == "Yes")
						$checkedCorrectionYes = "checked";
					else if($row['correction'] == "No")
						$checkedCorrectionNo = "checked";
					
					//auto check previous data inspection status
					if($row['inspection_status'] == "In use")
						$checkedInUsed = "checked";
					else
						$checkedInUsed = "";
					
					if($row['inspection_status'] == "Not used")
						$checkedNotUsed = "checked";
					else
						$checkedNotUsed = "";
					
					if($row['inspection_status'] == "Needs improvement")
						$checkedNeedImprov = "checked";
					else
						$checkedNeedImprov = "";
					
					if($row['inspection_status'] == "In maintenance")
						$checkedInMaintenance = "checked";
					else
						$checkedInMaintenance = "";
					
					if($row['inspection_status'] == "Missing")
						$checkedMissing = "checked";
					else
						$checkedMissing = "";

				?>
              <div class="card">
                <div class="card-body">
				  <h1 class="display-5 font-weight-bold"><i class='menu-icon hgi-stroke hgi-image-crop'></i> Update Inspection Form</h1>
				
                  <form method="post" enctype="multipart/form-data">
					<hr />

					<div class="table-responsive mt-3"id="printableArea">
					<div class="table-responsive">
                      <table class="table table-sm" role="grid">
                        <thead>
                          <tr>
                            <th class="bg-warning">
								<b style="font-size:16px;">Asset ID</b>
                            </th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
						  <td>
								<?php
									// Query to fetch asset information
									$sql = mysqli_query($conn, "SELECT * FROM asset WHERE asset_id = '$selected_asset_id'");
									$row_asset = mysqli_fetch_array($sql);

									// Check if an asset was found and display its details in a readonly field
									if ($row_asset) {
										echo "
										<input type='text' class='form-control' 
											value='{$row_asset['asset_id']}' 
											readonly>
										<input type='hidden' name='asset_id' value='{$row_asset['asset_id']}'>";
									} else {
										echo "<input type='text' class='form-control' value='No asset found' readonly>";
									}
								?>
							</td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                    
                    <div class="table-responsive mt-3">
                      <table class="table table-sm" role="grid">
                        <thead>
                          <tr>
                            <th class="bg-primary" colspan="4">
								<b style="font-size:16px;">Organization</b>
                            </th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td>Organization</td>
                            <td><input type="text" name="organization" class="form-control" value="<?php echo $organization; ?>" readonly /></td>
                            <td>Categories</td>
                            <td><input type="text" id="category" name="category" class="form-control" value="<?php echo $category; ?>" readonly /></td>
                          </tr>
                          <tr>
                            <td>Sector</td>
                            <td><input type="text" name="sector" class="form-control" value="<?php echo $sector; ?>" readonly /></td>
                            <td>Sub Categories</td>
                            <td><input type="text" id="subcategory" name="subcategory" class="form-control" value="<?php echo $subcategory; ?>" readonly /></td>
                          </tr>
                          <tr>
                            <td></td>
                            <td></td>
                            <td>Type</td>
                            <td><input type="text" id="type" name="type" class="form-control" value="<?php echo $type; ?>" readonly /></td>
                          </tr>
                          <tr>
							  <td>Picture</td>
							  <td>
								<img 
								  id="asset_picture" 
								  src="<?php echo !empty($selected_asset_id) ? 'picture/' . getAssetPicture($selected_asset_id, $conn) : 'images/placeholder.png'; ?>" 
								  alt="Asset Picture" 
								  width="100" />
							  </td>
							  <td>Qr Code</td>
							  <td>
								<img 
								  id="asset_qrcode" 
								  src="<?php echo !empty($selected_asset_id) ? 'qrcode/' . getAssetQRCode($selected_asset_id, $conn) : 'images/qr-scan.png'; ?>" 
								  alt="QR Code" 
								  width="100" />
							  </td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                    
                    <div class="table-responsive mt-3">
                      <table class="table table-sm" role="grid">
                        <thead>
                          <tr>
                            <th class="bg-warning" colspan="5">
								<b style="font-size:16px;">Asset Information</b>
                            </th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td>Serial Number</td>
                            <td><input type="text" name="serial_no" class="form-control" value="<?php echo $serial_no; ?>" readonly /></td>
                            <td>Warranty</td>
                            <td><input type="text" name="warranty" class="form-control" value="<?php echo $warranty; ?>" readonly /></td>
                          </tr>
                          <tr>
                            <td>Component / Accessory</td>
                            <td colspan="3"><textarea name="component" rows="5" class="form-control" readonly><?php echo $component; ?></textarea></td>
                            <td></td>
                          </tr>
                          <tr>
                            <td>Barcode Number</td>
                            <td><input type="text" name="barcode_no" class="form-control" value="<?php echo $barcode_no; ?>" readonly /></td>
                            <td>Original Acquisition Price</td>
                            <td><input type="number" step="0.01" name="ori_acq_price" class="form-control" value="<?php echo $ori_acq_price; ?>" readonly /></td>
                            <td></td>
                          </tr>
                          <tr>
                            <td>Brand / Model</td>
                            <td><input type="text" id="brand_model" name="brand_model" class="form-control" value="<?php echo $brand_model; ?>" readonly /></td>
                            <td>Government Order Number</td>
                            <td><input type="text" name="gov_order_no" class="form-control" value="<?php echo $gov_order_no; ?>" readonly /></td>
                            <td></td>
                          </tr>
                          <tr>
                            <td>File Ref. No.</td>
                            <td><input type="text" name="file_ref_no" class="form-control" value="<?php echo $file_ref_no; ?>" readonly /></td>
                            <td>Date of Purchase / Retrieval</td>
                            <td><input type="date" name="purchase_date" class="form-control" value="<?php echo $purchase_date; ?>" readonly /></td>
                            <td><input type="date" name="retrieval_date" class="form-control" value="<?php echo $retrieval_date; ?>" readonly /></td>
                          </tr>
                          <tr>
                            <td>Made By</td>
                            <td><input type="text" name="made_by" class="form-control" value="<?php echo $made_by; ?>" readonly/></td>
                            <td>Quantity</td>
                            <td><input type="number" name="qty" class="form-control" value="<?php echo $qty; ?>" readonly /></td>
                            <td><input type="text" name="unit" class="form-control" value="<?php echo $unit; ?>" placeholder="unit" readonly /></td>
                          </tr>
                          <tr>
                            <td>Type &amp; Engine No.</td>
                            <td><input type="text" name="type_engine_no" class="form-control" value="<?php echo $type_engine_no; ?>" readonly /></td>
                            <td>Cost per unit</td>
                            <td><input type="number" step="0.01" name="cost_per_unit" class="form-control" value="<?php echo $cost_per_unit; ?>" readonly /></td>
                            <td><input type="number" name="warranty_year" class="form-control" value="<?php echo $warranty_year; ?>" placeholder="Warranty (Year/s)" readonly /></td>
                          </tr>
                          <tr>
                            <td>Chasis No. / Maker Series(for vehicle)</td>
                            <td><input type="text" name="chasis_series" class="form-control" value="<?php echo $chasis_series; ?>" readonly /></td>
                            <td>Supplier</td>
                            <td><input type="text" name="supplier" class="form-control" value="<?php echo $supplier; ?>" readonly /></td>
                            <td></td>
                          </tr>
                          <tr>
                            <td>Specification / Notes</td>
                            <td colspan="3"><textarea name="spec_notes" rows="5" class="form-control" readonly><?php echo $spec_notes; ?></textarea></td>
                            <td></td>
                          </tr>
                          <tr>
                            <td>Supplier Address</td>
                            <td colspan="3"><textarea name="supplier_address" rows="5" class="form-control" readonly><?php echo $supplier_address; ?></textarea></td>
                            <td></td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                    
                    <div class="table-responsive mt-3">
                      <table class="table table-sm" role="grid">
                        <thead>
                          <tr>
								<th class="bg-primary" colspan="2">
									<b style="font-size:16px;">Head of Department</b>
								</th>
								<th class="bg-primary" colspan="2">
									<b style="font-size:16px;">Current Placement</b>
								</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td>Date</td>
                            <td><input type="date" name="hod_date" class="form-control" value="<?php echo $hod_date; ?>" readonly /></td>
                            <td>Date</td>
                            <td><input type="date" name="placement_date" class="form-control" value="<?php echo $placement_date; ?>" readonly /></td>
                          </tr>
                          <tr>
                            <td>Name</td>
                            <td><input type="text" name="hod_name" class="form-control" value="<?php echo $hod_name; ?>" readonly /></td>
                            <td>Code</td>
                            <td><input type="text" name="placement_code" class="form-control" value="<?php echo $placement_code; ?>" readonly /></td>
                          </tr>
                          <tr>
                            <td>Position</td>
                            <td><input type="text" name="hod_position" class="form-control" value="<?php echo $hod_position; ?>" readonly /></td>
                            <td>Location</td>
                            <td><input type="text" name="placement_location" class="form-control" value="<?php echo $placement_location; ?>" readonly/></td>
                          </tr>
                          <tr>
                            <td></td>
                            <td></td>
                            <td>Name</td>
                            <td><input type="text" name="placement_name" class="form-control" value="<?php echo $placement_name; ?>" readonly /></td>
                          </tr>
                          <tr>
                            <td></td>
                            <td></td>
                            <td>Position</td>
                            <td><input type="text" name="placement_position" class="form-control" value="<?php echo $placement_position; ?>" readonly /></td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
					<br>
					
					
					<div class="table-responsive">
						<table class="table table-sm"role="grid">
						  <thead>
							<tr style="border-bottom: dashed;" >
							  <th class="table-warning" colspan="2">Officer</th>
							  <th class="table-success" colspan="2">Asset</th>
							  <th class="table-warning" colspan="2">Location</th>
							</tr>
						  </thead>
						  <tbody>
							<tr>
							  <td class="table-warning">Reference Number</td>
							  <td class="table-warning"><input type="text" name="ref_no" value="<?php echo $row['ref_no']; ?>" class="form-control" readonly /></td>
							  <td class="table-success">Serial Number</td>
							  <td class="table-success"><input type="text" name="serial_no" value="<?php echo $row['serial_no']; ?>" class="form-control" readonly /></td>
							  <td class="table-warning">Location</td>
							  <td class="table-warning"><input type="text" name="location" value="<?php echo $row['location']; ?>" class="form-control" required /></td>
							</tr>
							<tr>
							  <td class="table-warning">Inspection Date</td>
							  <td class="table-warning"><input type="date" name="inspection_date_officer" value="<?php echo $row['inspection_date_officer']; ?>" class="form-control" required /></td>
							  <td class="table-success">Asset Categories</td>
							  <td class="table-success"><input type="text" name="asset_category" value="<?php echo $row['asset_category']; ?>" class="form-control" readonly/></td>
							  <td class="table-warning">Local Officer</td>
							  <td class="table-warning"><input type="text" name="local_officer" value="<?php echo $row['local_officer']; ?>" class="form-control" required /></td>
							</tr>
							<tr>
							  <td class="table-warning">Inspection Title</td>
							  <td class="table-warning"><input type="text" name="inspection_title" value="<?php echo $row['inspection_title']; ?>" class="form-control" required /></td>
							  <td class="table-success">Asset Sub-categories</td>
							  <td class="table-success"><input type="text" name="asset_sub_category" value="<?php echo $row['asset_sub_category']; ?>" class="form-control" readonly /></td>
							  <td  class="table-warning" rowspan="2" colspan="2"></td>
							</tr>
							<tr>
							  <td class="table-warning">Inspection Officer</td>
							  <td class="table-warning"><input type="text" name="inspection_officer" value="<?php echo $row['inspection_officer']; ?>" class="form-control" required /></td>
							  <td class="table-success">Inspection Date</td>
							  <td class="table-success"><input type="date" name="inspection_date_asset" value="<?php echo $row['inspection_date_asset']; ?>" class="form-control" required /></td>
							  
							</tr>
							
						  </tbody>
						</table>
					</div>
					
					<div class="table-responsive mt-3">
						<table class="table table-sm" role="grid">
						  <thead>
							<tr style="border-bottom: dashed;" >
							  <th class="table-warning" colspan="3" width="35%">KEW.PA Record</th>
							  <th class="table-success" colspan="2">Asset Status &amp; Inpsection Meeting</th>
							  <th class="table-warning">Notes/Inspection Findings</th>
							</tr>
						  </thead>
						  <tbody>
							<tr>
							  <td class="table-warning">Complete</td>
							  <td class="table-warning"><input type="radio" name="complete" value="Yes" <?php echo $checkedCompleteYes; ?> required /> Yes</td>
							  <td class="table-warning"><input type="radio" name="complete" value="No" <?php echo $checkedCompleteNo; ?> /> No</td>
							  <td class="table-success" colspan="2">Inspection Status</td>
							  <td class="table-warning"  rowspan="4"><textarea name="inspection_notes" rows="5" class="form-control" required><?php echo $row['inspection_notes']; ?></textarea></td>
							</tr>
							<tr>
							  <td class="table-warning">Correction</td>
							  <td class="table-warning"><input type="radio" name="correction" value="Yes" <?php echo $checkedCorrectionYes; ?> required /> Yes</td>
							  <td class="table-warning"><input type="radio" name="correction" value="No" <?php echo $checkedCorrectionNo; ?> /> No</td>
							  <td class="table-success"><input type="radio" name="inspection_status" value="In use" <?php echo $checkedInUsed; ?> required /> In use</td>
							  <td class="table-success"><input type="radio" name="inspection_status" value="Not used" <?php echo $checkedNotUsed; ?> /> Not used</td>
							</tr>
							<tr>
							  <td class="table-warning" rowspan="3" colspan="3"></td>
							  <td class="table-success"><input type="radio" name="inspection_status" value="Needs improvement" <?php echo $checkedNeedImprov; ?> /> Needs improvement</td>
							  <td class="table-success"><input type="radio" name="inspection_status" value="In maintenance" <?php echo $checkedInMaintenance; ?> /> In maintenance</td>
							</tr>
							<tr>
							  <td class="table-success" colspan="2"><input type="radio" name="inspection_status" value="Missing" <?php echo $checkedMissing; ?> /> Missing</td>
							</tr>
							
							
						  </tbody>
						</table>
					</div>
					</div>
					
                    <br />
                    <br />
					<a href="inspection_list.php" class="btn btn-outline-dark">
						<i class="mdi mdi-keyboard-backspace"></i> Back
					</a>
					<button type="submit" name="submit" class="btn btn-warning mr-2"><i class="mdi mdi-check"></i> Update</button>
					<button class="btn btn-warning mr-2"  onclick="printDiv('printableArea')"><i class="mdi mdi-printer"></i>Print</button>
                  </form>
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
   <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	<script>
	$(document).ready(function() {
		$('#id_daerah').change(function() {
			var idDaerah = $(this).val();
			$.ajax({
				url: 'fetch_tempat.php',
				type: 'POST',
				data: {id_daerah: idDaerah},
				success: function(response) {
					$('#id_tempat').html(response);
				}
			});
		});
	});

	</script>
</body>

</html>
<?php
}
?>