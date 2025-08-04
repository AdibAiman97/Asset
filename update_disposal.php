<?php
include "conn/conn.php";
error_reporting(0);
session_start();
if (empty($_SESSION['UserID']) AND empty($_SESSION['Password'])) {
  header('location:index.php');
} else {

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
	
    <div class="container-fluid page-body-wrapper">
      <!-- partial:../../partials/_sidebar.html -->
       <?php include "layout/menu.php";?>
	   
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
            <div class="col-12 grid-margin">
			
            <?php
				// Fetch disposal_id from the URL
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
						$disposal_date = $_POST['disposal_date'];
						$method = $_POST['method'];
						$signature = $_POST['signature'];
						$asset_id = $_POST['asset_id'];
						$staff_name = mysqli_real_escape_string($conn, $_POST['staff']);  // This is the disposal officer


						// Update query
						$update = mysqli_query($conn, "UPDATE disposal SET 
														organization='$organization',
														category='$category',
														sector='$sector',
														subcategory='$subcategory',
														type='$type',
														serial_no='$serial_no',
														warranty='$warranty',
														component='$component',
														barcode_no='$barcode_no',
														ori_acq_price='$ori_acq_price',
														brand_model='$brand_model',
														gov_order_no='$gov_order_no',
														file_ref_no='$file_ref_no',
														purchase_date='$purchase_date',
														retrieval_date='$retrieval_date',
														made_by='$made_by',
														qty='$qty',
														unit='$unit',
														type_engine_no='$type_engine_no',
														cost_per_unit='$cost_per_unit',
														warranty_year='$warranty_year',
														chasis_series='$chasis_series',
														supplier='$supplier',
														spec_notes='$spec_notes',
														supplier_address='$supplier_address',
														hod_date='$hod_date',
														placement_date='$placement_date',
														hod_name='$hod_name',
														placement_code='$placement_code',
														hod_position='$hod_position',
														placement_location='$placement_location',
														placement_name='$placement_name',
														placement_position='$placement_position',
														disposal_date='$disposal_date',
														method='$method',
														asset_id='$asset_id',
														signature='$signature' 
														WHERE disposal_id = '$disposal_id'");
						
						// Check for success or failure
						if ($update) {
							echo "<div class='alert alert-success alert-dismissible'>
									<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
									<strong>Success!</strong> Asset Disposal updated successfully.
								  </div>";
						} else {
							echo "<div class='alert alert-danger alert-dismissible'>
									<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
									<strong>Error!</strong> Failed to update disposal. Error: " . mysqli_error($conn) . "
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
                <div class="card-body">
                  <h1 class="display-5 font-weight-bold"><i class='menu-icon hgi-stroke hgi-image-delete-02'></i> Update Disposal of Asset</h1>

				  <form method="post" enctype="multipart/form-data">
                    <hr />
                    <div class="table-responsive mt-3"id="printableArea">
                    <div class="table-responsive">
                      <table class="table table-sm" role="grid">
                        <thead>
                          <tr>
                            <th class="bg-warning">
								<b style="font-size:16px;">ID Asset</b>
                            </th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td>
                              <select name="asset_id" id="asset_id" class="form-control" required>
                                <option value="">- choose asset -</option>
                                <?php
									$sql = mysqli_query($conn, "SELECT * FROM asset");
									while($row_asset = mysqli_fetch_array($sql)) {
										$selected = ($row_asset['asset_id'] == $selected_asset_id) ? 'selected' : '';  // Pre-select the asset
										echo "<option value='{$row_asset['asset_id']}' 
												data-category='{$row_asset['category']}' 
												data-subcategory='{$row_asset['sub_category']}' 
												data-type='{$row_asset['type']}'
												data-brand='{$row_asset['brand']}'
												data-picture='picture/{$row_asset['picture']}'
												data-qrcode='qrcode/{$row_asset['qrcode']}'
												$selected> 
												{$row_asset['asset_id']}
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
                            <td><input type="text" name="organization" class="form-control" value="<?php echo $organization; ?>" required /></td>
                            <td>Categories</td>
                            <td><input type="text" id="category" name="category" class="form-control" value="<?php echo $category; ?>" readonly /></td>
                          </tr>
                          <tr>
                            <td>Sector</td>
                            <td><input type="text" name="sector" class="form-control" value="<?php echo $sector; ?>" required /></td>
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
                            <td><input type="text" name="serial_no" class="form-control" value="<?php echo $serial_no; ?>" required /></td>
                            <td>Warranty</td>
                            <td><input type="text" name="warranty" class="form-control" value="<?php echo $warranty; ?>" required /></td>
                          </tr>
                          <tr>
                            <td>Component / Accessory</td>
                            <td colspan="3"><textarea name="component" rows="5" class="form-control" required><?php echo $component; ?></textarea></td>
                            <td></td>
                          </tr>
                          <tr>
                            <td>Barcode Number</td>
                            <td><input type="text" name="barcode_no" class="form-control" value="<?php echo $barcode_no; ?>" required /></td>
                            <td>Original Acquisition Price</td>
                            <td><input type="number" step="0.01" name="ori_acq_price" class="form-control" value="<?php echo $ori_acq_price; ?>" required /></td>
                            <td></td>
                          </tr>
                          <tr>
                            <td>Brand / Model</td>
                            <td><input type="text" id="brand_model" name="brand_model" class="form-control" value="<?php echo $brand_model; ?>" readonly /></td>
                            <td>Government Order Number</td>
                            <td><input type="text" name="gov_order_no" class="form-control" value="<?php echo $gov_order_no; ?>" required /></td>
                            <td></td>
                          </tr>
                          <tr>
                            <td>File Ref. No.</td>
                            <td><input type="text" name="file_ref_no" class="form-control" value="<?php echo $file_ref_no; ?>" required /></td>
                            <td>Date of Purchase / Retrieval</td>
                            <td><input type="date" name="purchase_date" class="form-control" value="<?php echo $purchase_date; ?>" required /></td>
                            <td><input type="date" name="retrieval_date" class="form-control" value="<?php echo $retrieval_date; ?>" required /></td>
                          </tr>
                          <tr>
                            <td>Made By</td>
                            <td><input type="text" name="made_by" class="form-control" value="<?php echo $made_by; ?>" required /></td>
                            <td>Quantity</td>
                            <td><input type="number" name="qty" class="form-control" value="<?php echo $qty; ?>" required /></td>
                            <td><input type="text" name="unit" class="form-control" value="<?php echo $unit; ?>" placeholder="unit" required /></td>
                          </tr>
                          <tr>
                            <td>Type &amp; Engine No.</td>
                            <td><input type="text" name="type_engine_no" class="form-control" value="<?php echo $type_engine_no; ?>" required /></td>
                            <td>Cost per unit</td>
                            <td><input type="number" step="0.01" name="cost_per_unit" class="form-control" value="<?php echo $cost_per_unit; ?>" required /></td>
                            <td><input type="number" name="warranty_year" class="form-control" value="<?php echo $warranty_year; ?>" placeholder="Warranty (Year/s)" required /></td>
                          </tr>
                          <tr>
                            <td>Chasis No. / Maker Series(for vehicle)</td>
                            <td><input type="text" name="chasis_series" class="form-control" value="<?php echo $chasis_series; ?>" required /></td>
                            <td>Supplier</td>
                            <td><input type="text" name="supplier" class="form-control" value="<?php echo $supplier; ?>" required /></td>
                            <td></td>
                          </tr>
                          <tr>
                            <td>Specification / Notes</td>
                            <td colspan="3"><textarea name="spec_notes" rows="5" class="form-control" required><?php echo $spec_notes; ?></textarea></td>
                            <td></td>
                          </tr>
                          <tr>
                            <td>Supplier Address</td>
                            <td colspan="3"><textarea name="supplier_address" rows="5" class="form-control" required><?php echo $supplier_address; ?></textarea></td>
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
                            <td><input type="date" name="hod_date" class="form-control" value="<?php echo $hod_date; ?>" required /></td>
                            <td>Date</td>
                            <td><input type="date" name="placement_date" class="form-control" value="<?php echo $placement_date; ?>" required /></td>
							<td>Date</td>
							<td><input type="date" name="disposal_date" class="form-control" value="<?php echo $disposal_date; ?>" required /></td>
                          </tr>
                          <tr>
                            <td>Name</td>
                            <td><input type="text" name="hod_name" class="form-control" value="<?php echo $hod_name; ?>" required /></td>
                            <td>Code</td>
                            <td><input type="text" name="placement_code" class="form-control" value="<?php echo $placement_code; ?>" required /></td>
							<td>Disposal Officer</td>
							<td><input type="text" name="signature" class="form-control" value="<?php echo $signature; ?>" required /></td>
                          </tr>
                          <tr>
                            <td>Position</td>
                            <td><input type="text" name="hod_position" class="form-control" value="<?php echo $hod_position; ?>" required /></td>
                            <td>Location</td>
                            <td><input type="text" name="placement_location" class="form-control" value="<?php echo $placement_location; ?>" required /></td>
							<td>Remark</td>
							<td style="width:25%;"><input type="text" name="method" class="form-control" value="<?php echo $method; ?> "style="height: 110px;" required /></td>
                          </tr>
                          <tr>
                            <td></td>
                            <td></td>
                            <td>Name</td>
                            <td><input type="text" name="placement_name" class="form-control" value="<?php echo $placement_name; ?>" required /></td>
							<td></td>
							<td></td>
                          </tr>
                          <tr>
                            <td></td>
                            <td></td>
                            <td>Position</td>
                            <td><input type="text" name="placement_position" class="form-control" value="<?php echo $placement_position; ?>" required /></td>
							<td></td>
							<td></td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                    
                    <br />
                    <br />

                    </div>
					<a href="disposal_list.php" class="btn btn-outline-dark">
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
      </div>
    </div>
  </div>

   <?php include "layout/script.php";?>
  <!-- JavaScript to auto-fill the fields -->
  <script>
    document.getElementById('asset_id').addEventListener('change', function() {
      var selectedOption = this.options[this.selectedIndex];

      if (selectedOption.value === "") {
        document.getElementById('asset_picture').src = 'images/placeholder.png';
        document.getElementById('asset_qrcode').src = 'images/qr-scan.png';
        document.getElementById('category').value = '';
        document.getElementById('subcategory').value = '';
        document.getElementById('type').value = '';
        document.getElementById('brand_model').value = '';
      } else {
        var category = selectedOption.getAttribute('data-category');
        var subcategory = selectedOption.getAttribute('data-subcategory');
        var type = selectedOption.getAttribute('data-type');
        var brand = selectedOption.getAttribute('data-brand');
        var picture = selectedOption.getAttribute('data-picture') || 'images/placeholder.png';
        var qrcode = selectedOption.getAttribute('data-qrcode') || 'images/qr-scan.png';

        document.getElementById('category').value = category;
        document.getElementById('subcategory').value = subcategory;
        document.getElementById('type').value = type;
        document.getElementById('brand_model').value = brand;

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
