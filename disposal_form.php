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
    .card-body::-webkit-scrollbar {
        width: 8px;
    }

    .card-body::-webkit-scrollbar-thumb {
        background-color: #ffaf00; /* Customize scrollbar color */
        border-radius: 10px;
    }

    .card-body::-webkit-scrollbar-track {
        background-color: #f1f1f1; /* Customize scrollbar track color */
        border-radius: 10px;
    }
	table {
		border-collapse: collapse;
		border: 1px solid black; /* Outer border */
	}

	th, td {
		border: none; /* No border for individual cells */
	}
	.table td img, .table th img {
		border-radius: 20%;
	}

	.table td img, .table th img {
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
					if (isset($_POST['submit'])) {
					// Capture form data
					$organization = htmlspecialchars($_POST['organization'], ENT_QUOTES);
					$category = $_POST['category'];
					$sector = $_POST['sector'];
					$subcategory = $_POST['subcategory'];
					$qrcode = $_POST['qrcode'];
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
					$disposal_date = $_POST['disposal_date'];
					$method = $_POST['method'];
					$asset_id = $_POST['asset_id'];
					$staff_name = mysqli_real_escape_string($conn, $_POST['staff']); // Capture selected staff for signature
					$qty = $_POST['qty'];  // Disposal quantity
					$asset_id = $_POST['asset_id'];  // The asset ID
				
					// Fetch the current quantity from the asset table
					$sqlFetchQty = mysqli_query($conn, "SELECT quantity FROM asset WHERE asset_id = '$asset_id'");
					$assetData = mysqli_fetch_array($sqlFetchQty);
					$currentQty = $assetData['quantity'];
				
					// Calculate the new quantity after disposal
					$newQty = $currentQty - $qty;
				
					// Check if the new quantity is not negative
					if ($newQty < 0) {
						echo "<div class='alert alert-danger alert-dismissible'>
								<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
								<strong>Error:</strong> Disposal quantity exceeds the available asset quantity.
							</div>";
					} else {
						// Update the asset table with the new quantity
						$sqlUpdateAsset = mysqli_query($conn, "UPDATE asset SET quantity = '$newQty' WHERE asset_id = '$asset_id'");
				
						if ($sqlUpdateAsset == true) {
							// Insert the disposal record into the disposal table
							$sqlInsertDisposal = mysqli_query($conn, "INSERT INTO disposal (
																		organization,
																		category,
																		sector,
																		subcategory,
																		type,
																		serial_no,
																		warranty,
																		component,
																		barcode_no,
																		ori_acq_price,
																		brand_model,
																		gov_order_no,
																		file_ref_no,
																		purchase_date,
																		retrieval_date,
																		made_by,
																		qty,
																		unit,
																		type_engine_no,
																		cost_per_unit,
																		warranty_year,
																		chasis_series,
																		supplier,
																		spec_notes,
																		supplier_address,
																		hod_date,
																		placement_date,
																		hod_name,
																		placement_code,
																		hod_position,
																		placement_location,
																		placement_name,
																		placement_position,
																		disposal_date,
																		method,
																		signature,
																		asset_id
																	)
																	VALUES (
																		'$organization',
																		'$category',
																		'$sector',
																		'$subcategory',
																		'$type',
																		'$serial_no',
																		'$warranty',
																		'$component',
																		'$barcode_no',
																		'$ori_acq_price',
																		'$brand_model',
																		'$gov_order_no',
																		'$file_ref_no',
																		'$purchase_date',
																		'$retrieval_date',
																		'$made_by',
																		'$qty',
																		'$unit',
																		'$type_engine_no',
																		'$cost_per_unit',
																		'$warranty_year',
																		'$chasis_series',
																		'$supplier',
																		'$spec_notes',
																		'$supplier_address',
																		'$hod_date',
																		'$placement_date',
																		'$hod_name',
																		'$placement_code',
																		'$hod_position',
																		'$placement_location',
																		'$placement_name',
																		'$placement_position',
																		'$disposal_date',
																		'$method',
																		'$staff_name', 
																		'$asset_id'
																	)");
				
							// Check if the disposal insert query was successful
							if ($sqlInsertDisposal == true) {
								// Store activity
								// ... (your existing activity logging code)
				
								echo "<div class='alert alert-success alert-dismissible'>
										<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
										<strong>Thank You!</strong> Disposal Form successfully submitted. New asset quantity: $newQty.
									</div>";
							} else {
								echo "<div class='alert alert-danger alert-dismissible'>
										<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
										<strong>Sorry!</strong> Error inserting disposal record.
									</div>";
							}
						} else {
							echo "<div class='alert alert-danger alert-dismissible'>
									<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
									<strong>Sorry!</strong> Error updating asset quantity.
								</div>";
						}
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
                <div class="card-body" style="max-height: 630px; overflow-y: auto;">
				  <h1 class="display-5 font-weight-bold"><i class='menu-icon hgi-stroke hgi-image-delete-02'></i> Disposal of Asset</h1>

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
                            <td><input type="number" name="qty" class="form-control" value="<?php echo $qty; ?>" required /></td>
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
								<th class="bg-primary" colspan="2">
									<b style="font-size:16px;">Disposal</b>
								</th>
							</tr>
						  </thead>
						  <tbody>
						  <tr>
						  <td>Date</td>
                            <td><input type="date" name="hod_date" class="form-control" value="<?php echo $hod_date; ?>" readonly /></td>
                            <td>Date</td>
                            <td><input type="date" name="placement_date" class="form-control" value="<?php echo $placement_date; ?>" readonly /></td>
							<td>Date</td>
							<td><input type="date" name="disposal_date" class="form-control" required /></td>
						  </tr>
						  <tr>
						   <<td>Name</td>
                            <td><input type="text" name="hod_name" class="form-control" value="<?php echo $hod_name; ?>" readonly /></td>
                            <td>Code</td>
                            <td><input type="text" name="placement_code" class="form-control" value="<?php echo $placement_code; ?>" readonly /></td>
							<td>Disposal Officer </td>
							<td>
									<select name="staff" class="form-control" required>
										<option value="">-Select Staff-</option>
										<?php
										// Fetch staff data from the database
										$query = mysqli_query($conn, "SELECT  name, position FROM staff");

										// Loop through each staff member and create an option for the dropdown
										while ($row = mysqli_fetch_assoc($query)) {
											$staff_name = $row['name'];
											$position = $row['position'];

											// Use staff_id as the value, or you can use other values like position
											echo "<option value='$staff_name'> $staff_name  - ($position)</option>";
										}
										?>
									</select>
								</td>
						  </tr>
						  <tr>
						  <td>Position</td>
                            <td><input type="text" name="hod_position" class="form-control" value="<?php echo $hod_position; ?>" readonly /></td>
                            <td>Location</td>
                            <td><input type="text" name="placement_location" class="form-control" value="<?php echo $placement_location; ?>" readonly/></td>
							<td>Remark</td>
							<td style="width:25%;"><textarea name="method" rows="3" class="form-control" style="height: 110px;" required></textarea></td>
						  </tr>
						  <tr>
							<td></td>
							<td></td>
							<td>Name</td>
                            <td><input type="text" name="placement_name" class="form-control" value="<?php echo $placement_name; ?>" readonly /></td>
							<td></td>
							<td></td>
						  </tr>
						  <tr>
							<td></td>
							<td></td>
							<td>Position</td>
							<td><input type="text" name="placement_position" class="form-control" required /></td>
							<td></td>
							<td></td>
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
	<!-- JavaScript to auto-fill the fields -->
	<script>
		document.getElementById('asset_id').addEventListener('change', function() {
			// Get the selected option
			var selectedOption = this.options[this.selectedIndex];

			// If "choose asset" is selected (value is empty)
			if (selectedOption.value === "") {
				// Reset the images to the default placeholder images
				document.getElementById('asset_picture').src = 'images/placeholder.png';
				document.getElementById('asset_qrcode').src = 'images/qr-scan.png';
				
				// Clear the input fields as well
				document.getElementById('category').value = '';
				document.getElementById('subcategory').value = '';
				document.getElementById('type').value = '';
				document.getElementById('brand_model').value = '';
			} else {
				// Get the data attributes from the selected option
				var category = selectedOption.getAttribute('data-category');
				var subcategory = selectedOption.getAttribute('data-subcategory');
				var type = selectedOption.getAttribute('data-type');
				var brand = selectedOption.getAttribute('data-brand');
				var picture = selectedOption.getAttribute('data-picture') || 'path/to/placeholder.png'; // Fallback to placeholder if no picture
				var qrcode = selectedOption.getAttribute('data-qrcode') || 'path/to/placeholder.png';   // Fallback to placeholder if no QR code

				// Set the values in the input fields
				document.getElementById('category').value = category;
				document.getElementById('subcategory').value = subcategory;
				document.getElementById('type').value = type;
				document.getElementById('brand_model').value = brand;

				// Set the src for the images (Picture and QR Code)
				document.getElementById('asset_picture').src = picture;
				document.getElementById('asset_qrcode').src = qrcode;
			}
		});


	</script>

<script>
        function updateURL() {
            // Get the selected registration_id value
            var registrationId = document.getElementById('registration_id').value;
            
            // Update the URL with the selected registration_id
            var newURL = `http://localhost/STDC-Asset-System/disposal_form.php?ref_no=&registration_id=${registrationId}`;
            
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