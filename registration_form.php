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
						

						// Start session and set timezone
						date_default_timezone_set("Asia/Kuala_Lumpur");
						$today = date("Y-m-d");

						if (isset($_POST['submit'])) {

							// Generate a random code
							function random_code($limit) {
								return substr(base_convert(sha1(uniqid(mt_rand())), 16, 36), 0, $limit);
							}
							$code = strtoupper(random_code(5));

							// Split the user ID from session to use in registration_id
							$user_id = $_SESSION['UserID'];
							$substring = substr($user_id, 3, 11);

							// Combine the elements to get a unique registration_id
							$registration_id = "STDC" . $substring . $code;

							// Ensure the registration_id is unique by checking the database
							do {
								$sqlCheck = mysqli_query($conn, "SELECT * FROM registration WHERE registration_id = '$registration_id'");
								$numRowCheck = mysqli_fetch_array($sqlCheck);

								if ($numRowCheck > 0) {
									// If registration_id already exists, regenerate a new one
									$code = strtoupper(random_code(5));
									$registration_id = "STDC" . $substring . $code;
								}
							} while ($numRowCheck > 0);
							
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
			
							// Insert the data into the registration table
							$sql = mysqli_query($conn, "INSERT INTO registration (registration_id, organization, category, sector, subcategory, type, serial_no, warranty, component, barcode_no, ori_acq_price, brand_model, gov_order_no, file_ref_no, purchase_date, retrieval_date, made_by, qty, unit, type_engine_no, cost_per_unit, warranty_year, chasis_series, supplier, spec_notes, supplier_address, hod_date, placement_date, hod_name, placement_code, hod_position, placement_location, placement_name, placement_position, asset_id) VALUES ('$registration_id', '$organization', '$category', '$sector', '$subcategory', '$type', '$serial_no', '$warranty', '$component', '$barcode_no', '$ori_acq_price', '$brand_model', '$gov_order_no', '$file_ref_no', '$purchase_date', '$retrieval_date', '$made_by', '$qty', '$unit', '$type_engine_no', '$cost_per_unit', '$warranty_year', '$chasis_series', '$supplier', '$spec_notes', '$supplier_address', '$hod_date', '$placement_date', '$hod_name', '$placement_code', '$hod_position', '$placement_location', '$placement_name', '$placement_position', '$asset_id')");

							if($sql == true)
						{
							/* store activity */
							$activity_date = $today;
							$item = $category . ", " . $subcategory . ", " . $brand_model;
							$sqlA = mysqli_query($conn, "INSERT INTO activity (activity_date,
																				user_id,
																				user_level,
																				action,
																				item)
																		VALUES ('$activity_date',
																				'$_SESSION[UserID]',
																				'$_SESSION[UserLvl]',
																				'Registration',
																				'$item')");
						
							echo "<div class='alert alert-success alert-dismissible'>
										<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
										<strong>Thank You!</strong> Registration Form successfully saved.
									</div>";
						}
						else
							echo "<div class='alert alert-danger alert-dismissible'>
									<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
									<strong>Sorry!</strong> error.
								</div>";
						}
						?>



              <div class="card">
                <div class="card-body" style="max-height: 630px; overflow-y: auto;">
				  <h1 class="display-5 font-weight-bold"><i class='menu-icon hgi-stroke hgi-image-add-02'></i> Registration of Asset</h1>

                  <form method="post" enctype="multipart/form-data">
					<hr />
					
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
								<select name="asset_id" id="asset_id" class="form-control" required>
									<option value="">- Choose Asset ID -</option>
									<?php
									$sql = mysqli_query($conn, "SELECT * FROM asset");
									while($row = mysqli_fetch_array($sql)) {
										echo "<option value='$row[asset_id]' 
												data-category='$row[category]' 
												data-subcategory='$row[sub_category]' 
												data-type='$row[type]'
												data-brand='$row[brand]'
												data-quantity='$row[quantity]'
												data-picture='picture/$row[picture]'
												data-qrcode='qrcode/$row[qrcode]'> 
												$row[asset_id]
											  </option>";
									}
									?>
								</select>

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
							<td><input type="text" name="organization" class="form-control" required /></td>
							<td>Categories</td>
							<td><input type="text" id="category" name="category" class="form-control" readonly /></td>
						  </tr>
						  <tr>
							<td>Sector</td>
							<td><input type="text" name="sector" class="form-control" required /></td>
							<td>Sub Categories</td>
							<td><input type="text" id="subcategory" name="subcategory" class="form-control" readonly /></td>
						  </tr>
						  <tr>
							<td></td>
							<td></td>
							<td>Type</td>
							<td><input type="text" id="type" name="type" class="form-control" readonly /></td>
						  </tr>
							<tr>
							  <td>Picture</td>
							  <td><img id="asset_picture" src="images/placeholder.png" alt="Asset Picture" width="100" /></td>
							  <td>Qr Code</td>
							  <td><img id="asset_qrcode" src="images/qr-scan.png" alt="QR Code" width="100" /></td>
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
							<td><input type="text" name="serial_no" class="form-control" required /></td>
							<td>Warranty</td>
							<td><input type="text" name="warranty" class="form-control" required /></td>
							<td></td>
						  </tr>
						  <tr>
							<td>Component / Accessory</td>
							<td colspan="3"><textarea name="component" rows="5" class="form-control" required></textarea></td>
							<td></td>
						  </tr>
						  <tr>
							<td>Barcode Number</td>
							<td><input type="text" name="barcode_no" class="form-control" required /></td>
							<td>Original Acquisition Price</td>
							<td><input type="number" step="0.01" name="ori_acq_price" class="form-control" required /></td>
							<td></td>
						  </tr>
						  <tr>
							<td>Brand / Model</td>
							<td><input type="text" id="brand_model" name="brand_model" class="form-control" readonly /></td>
							<td>Government Order Number</td>
							<td><input type="text" name="gov_order_no" class="form-control" required /></td>
							<td></td>
						  </tr>
						  <tr>
							<td>File Ref. No.</td>
							<td><input type="text" name="file_ref_no" class="form-control" required /></td>
							<td>Date of Purchase / Retrieval</td>
							<td><input type="date" name="purchase_date" class="form-control" required /></td>
							<td><input type="date" name="retrieval_date" class="form-control" required /></td>
						  </tr>
						  <tr>
							<td>Made By</td>
							<td><input type="text" name="made_by" class="form-control" required /></td>
							<td>Quantity</td>
							<td><input type="number" name="qty" class="form-control" required /></td>
							<td><input type="text" name="unit" class="form-control" placeholder="Unit" required /></td>
						  </tr>
						  <tr>
							<td>Type &amp; Engine No.</td>
							<td><input type="text" name="type_engine_no" class="form-control" required /></td>
							<td>Cost per unit</td>
							<td><input type="number" step="0.01" name="cost_per_unit" class="form-control" required /></td>
							<td><input type="number" name="warranty_year" class="form-control" placeholder="Warranty (Year/s)" required /></td>
							
						  </tr>
						  <tr>
							<td>Chasis No. / Maker Series(for vehicle)</td>
							<td><input type="text" name="chasis_series" class="form-control" required /></td>
							<td>Supplier</td>
							<td><input type="text" name="supplier" class="form-control" required /></td>
							<td></td>
						  </tr>
						  <tr>
							<td>Specification / Notes</td>
							<td colspan="3"><textarea name="spec_notes" rows="5" class="form-control" required></textarea></td>
							<td></td>
						  </tr>
						  <tr>
							<td>Supplier Address</td>
							<td colspan="3"><textarea name="supplier_address" rows="5" class="form-control" required></textarea></td>
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
							<td><input type="date" name="hod_date" class="form-control" required /></td>
							<td>Date</td>
							<td><input type="date" name="placement_date" class="form-control" required /></td>
						  </tr>
						  <tr>
							<td>Name</td>
							<td><input type="text" name="hod_name" class="form-control" required /></td>
							<td>Code</td>
							<td><input type="text" name="placement_code" class="form-control" required /></td>
						  </tr>
						  <tr>
							<td>Position</td>
							<td><input type="text" name="hod_position" class="form-control" required /></td>
							<td>Location</td>
							<td><input type="text" name="placement_location" class="form-control" required /></td>
						  </tr>
						  <tr>
							<td></td>
							<td></td>
							<td>Name</td>
							<td><input type="text" name="placement_name" class="form-control" required /></td>
						  </tr>
						  <tr>
							<td></td>
							<td></td>
							<td>Position</td>
							<td><input type="text" name="placement_position" class="form-control" required /></td>
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
</body>

</html>
<?php
}
?>