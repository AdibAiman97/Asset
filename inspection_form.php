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
</style>
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

				// Fetch relevant details
				$qr_code = $row['qr_code']; // Get the QR code from the registration table


				date_default_timezone_set("Asia/Kuala_Lumpur");
				$today = date("Y-m-d");
		

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
				$asset_id = $row['asset_id'];

				
			}

			// When form is submitted for updating
			if (isset($_POST['submit'])) {
				// Get form data
				$ref_no = mysqli_real_escape_string($conn, htmlspecialchars($_POST['ref_no'], ENT_QUOTES));
				$registration_id = mysqli_real_escape_string($conn, htmlspecialchars($_POST['registration_id'], ENT_QUOTES));
				$inspection_date_officer = mysqli_real_escape_string($conn, $_POST['inspection_date_officer']);
				$inspection_title = mysqli_real_escape_string($conn, $_POST['inspection_title']);
				$inspection_officer = mysqli_real_escape_string($conn, $_POST['inspection_officer']);
				$serial_no = mysqli_real_escape_string($conn, $_POST['serial_no']);
				$asset_category = mysqli_real_escape_string($conn, $_POST['asset_category']);
				$asset_sub_category = mysqli_real_escape_string($conn, $_POST['asset_sub_category']);
				$inspection_date_asset = mysqli_real_escape_string($conn, $_POST['inspection_date_asset']);
				$location = mysqli_real_escape_string($conn, $_POST['location']);
				$local_officer = mysqli_real_escape_string($conn, htmlspecialchars($_POST['local_officer'], ENT_QUOTES));
				$complete = mysqli_real_escape_string($conn, $_POST['complete']);
				$correction = mysqli_real_escape_string($conn, $_POST['correction']);
				$inspection_status = mysqli_real_escape_string($conn, $_POST['inspection_status']);
				$inspection_notes = mysqli_real_escape_string($conn, htmlspecialchars($_POST['inspection_notes'], ENT_QUOTES));
				
				// Fetch asset_id from the registration table based on registration_id
				$sql_registration = mysqli_query($conn, "SELECT asset_id FROM registration WHERE registration_id = '$registration_id'");
				
				if (mysqli_num_rows($sql_registration) > 0) {
					$row = mysqli_fetch_assoc($sql_registration);
					$asset_id = $row['asset_id'];
					
					// Insert data into inspection table including ref_no, registration_id, and asset_id
					$sql = mysqli_query($conn, "INSERT INTO inspection (
													ref_no,
													registration_id,
													inspection_date_officer,
													inspection_title,
													inspection_officer,
													serial_no,
													asset_category,
													asset_sub_category,
													inspection_date_asset,
													location,
													local_officer,
													complete,
													correction,
													inspection_status,
													inspection_notes,
													asset_id
												) VALUES (
													'$ref_no',
													'$registration_id',
													'$inspection_date_officer',
													'$inspection_title',
													'$inspection_officer',
													'$serial_no',
													'$asset_category',
													'$asset_sub_category',
													'$inspection_date_asset',
													'$location',
													'$local_officer',
													'$complete',
													'$correction',
													'$inspection_status',
													'$inspection_notes',
													'$asset_id'
												)");
					
					if ($sql) {
						// Success message
						echo "<div class='alert alert-success'>Inspection form successfully submitted with Reference No: $ref_no.</div>";
						
						// Log activity
						$activity_date = date("Y-m-d");
						$item = $asset_category . ", " . $asset_sub_category . ", Serial# (" . $serial_no . ")";
						$sqlA = mysqli_query($conn, "INSERT INTO activity (
														activity_date,
														user_id,
														user_level,
														action,
														item
													) VALUES (
														'$activity_date',
														'$_SESSION[UserID]',
														'$_SESSION[UserLvl]',
														'Inspection',
														'$item')");
					} else {
						// Error message
						echo "<div class='alert alert-danger'>Error submitting form: " . mysqli_error($conn) . "</div>";
					}
				} else {
					// Error if registration_id is invalid
					echo "<div class='alert alert-danger'>Invalid registration_id. Please check and try again.</div>";
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


?>
		    <div class="card">
                <div class="card-body">
				  <h1 class="display-5 font-weight-bold"><i class='menu-icon hgi-stroke hgi-image-crop'></i> Inspection Form</h1>
				  
				  

                  <form method="post" enctype="multipart/form-data">
					<hr />
					<div class="table-responsive">
					<table class="table table-sm" role="grid">
						<thead>
							<tr>
								<th class="bg-warning">
									<label style="font-size:16px;" for="registration_id"><strong>Registration ID</strong></label>
								</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>
									<select id="registration_id" name="registration_id" onchange="updateURL()" class="form-control" required>
										<option value="">- Choose Registration ID -</option>
										<?php
											// Connect to the database (assuming connection is already set)
											// Get the current selected registration_id from the URL
											$selected_registration_id = isset($_GET['registration_id']) ? $_GET['registration_id'] : '';

											// Query to fetch all organizations from the registration table
											$sql = mysqli_query($conn, "SELECT * FROM registration");
											while($row_asset = mysqli_fetch_array($sql)) {
												// Set selected attribute if this organization matches the selected registration_id
												$selected = ($row_asset['registration_id'] == $selected_registration_id) ? 'selected' : '';
												echo "<option value='{$row_asset['registration_id']}' $selected> 
														{$row_asset['registration_id']}
													</option>";
											}
										?>
									</select>
								</td>
							</tr>
						</tbody>
					</table>
				</div>
				<br>
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

									// Query to fetch asset information
									$sql = mysqli_query($conn, "SELECT * FROM registration WHERE registration_id = '$selected_registration_id'");
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
								  src="<?php echo !empty($selected_asset_id) ? 'qrcode/' . getAssetqrcode($selected_asset_id, $conn) : 'images/qr-scan.png'; ?>" 
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
							  <th class="table-warning" colspan="2"><b>Officer</b></th>
							  <th class="table-success" colspan="2"><b>Asset</b></th>
							  <th class="table-warning" colspan="2"><b>Location</b></th>
							</tr>
						  </thead>
						  <tbody>
							<tr>
							  <td class="table-warning">Reference Number</td>
							  <td class="table-warning"><input type="text" name="ref_no" id="ref_no" class="form-control" value="<?php echo isset($ref_no) ? $ref_no : ''; ?>" required></td>
							  <td class="table-success">Serial Number</td>
							  <td class="table-success"><input type="text" name="serial_no" value="<?php echo $asset_id; ?>" class="form-control" readonly /></td>
							  <td class="table-warning">Location</td>
							  <td class="table-warning"><input type="text" name="location" class="form-control" required /></td>
							</tr>
							<tr>
							  <td class="table-warning">Inspection Date</td>
							  <td class="table-warning"><input type="date" name="inspection_date_officer" class="form-control" required /></td>
							  <td class="table-success">Asset Categories</td>
							  <td class="table-success"><input type="text" name="asset_category" value="<?php echo $category; ?>" class="form-control" readonly /></td>
							  <td class="table-warning">Local Officer</td>
							  <td class="table-warning"><input type="text" name="local_officer" class="form-control" required /></td>
							</tr>
							<tr>
							  <td class="table-warning">Inspection Title</td>
							  <td class="table-warning"><input type="text" name="inspection_title" class="form-control" required /></td>
							  <td class="table-success">Asset Sub-categories</td>
							  <td class="table-success"><input type="text" name="asset_sub_category" value="<?php echo $subcategory; ?>" class="form-control" readonly /></td>
							  <td  class="table-warning" rowspan="2" colspan="2"></td>
							</tr>
							<tr>
							  <td class="table-warning">Inspection Officer</td>
							  <td class="table-warning"><input type="text" name="inspection_officer" class="form-control" required /></td>
							  <td class="table-success">Inspection Date</td>
							  <td class="table-success"><input type="date" name="inspection_date_asset" class="form-control" required /></td>
							  
							</tr>
							
						  </tbody>
						</table>
					</div>
					
					<div class="table-responsive mt-3">
						<table class="table table-sm" role="grid">
						  <thead>
							<tr style="border-bottom: dashed;" >
							  <th class="table-warning" colspan="3" width="35%"><b>KEW.PA Record</b></th>
							  <th class="table-success" colspan="2"><b>Asset Status &amp; Inpsection Meeting</b></th>
							  <th class="table-warning"><b>Notes/Inspection Findings</b></th>
							</tr>
						  </thead>
						  <tbody>
							<tr>
							  <td class="table-warning">Complete</td>
							  <td class="table-warning"><input type="radio" name="complete" value="Yes" required /> Yes</td>
							  <td class="table-warning"><input type="radio" name="complete" value="No" /> No</td>
							  <td class="table-success" colspan="2">Inspection Status</td>
							  <td class="table-warning"  rowspan="4"><textarea name="inspection_notes" rows="5" class="form-control" required></textarea></td>
							</tr>
							<tr>
							  <td class="table-warning">Correction</td>
							  <td class="table-warning"><input type="radio" name="correction" value="Yes" required /> Yes</td>
							  <td class="table-warning"><input type="radio" name="correction" value="No" /> No</td>
							  <td class="table-success"><input type="radio" name="inspection_status" value="In use" required /> In use</td>
							  <td class="table-success"><input type="radio" name="inspection_status" value="Not used" /> Not used</td>
							</tr>
							<tr>
							  <td class="table-warning" rowspan="3" colspan="3"></td>
							  <td class="table-success"><input type="radio" name="inspection_status" value="Needs improvement" /> Needs improvement</td>
							  <td class="table-success"><input type="radio" name="inspection_status" value="In maintenance" /> In maintenance</td>
							</tr>
							<tr>
							  <td class="table-success" colspan="2"><input type="radio" name="inspection_status" value="Missing" /> Missing</td>
							</tr>
							
							
						  </tbody>
						</table>
					</div>
					
                    <br />
                    <br />
                    <button type="reset" class="btn btn-outline-dark"><i class="mdi mdi-refresh"></i> Reset</button>
					<button type="submit" name="submit" class="btn btn-warning mr-2"><i class="mdi mdi-check"></i> Save</button>
                  </form>
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
	    <script>
        function updateURL() {
            // Get the selected registration_id value
            var registrationId = document.getElementById('registration_id').value;
            
            // Update the URL with the selected registration_id
            var newURL = `http://localhost/STDC-Asset-System/inspection_form.php?ref_no=&registration_id=${registrationId}`;
            
            // Redirect to the new URL
            window.location.href = newURL;

			// Change the URL in the browser without reloading the page
			window.history.pushState(null, '', newURL);
        }
    </script>
</body>

</html>
<?php
}
?>