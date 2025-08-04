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
      <?php include "layout/menu.php";?>

      <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
            <div class="col-12 grid-margin">
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

						// Handle form submission for updating
						if (isset($_POST['submit'])) {
							$ordered_by = htmlspecialchars($_POST['ordered_by'], ENT_QUOTES);
							$no_LO = $_POST['no_LO'];
							$LO_date = $_POST['LO_date'];
							$acceptance_type = $_POST['acceptance_type'];
							$supplier = htmlspecialchars($_POST['supplier'], ENT_QUOTES);
							$address = htmlspecialchars($_POST['address'], ENT_QUOTES);
							$no_DO = $_POST['no_DO'];
							$DO_date = $_POST['DO_date'];
							$received_date = $_POST['received_date'];
							$transportation = $_POST['transportation'];
							$receive_officer_name = htmlspecialchars($_POST['receive_officer_name'], ENT_QUOTES);
							$receive_officer_position = $_POST['receive_officer_position'];
							$receive_officer_department = $_POST['receive_officer_department'];
							$receive_officer_date = $_POST['receive_officer_date'];
							$technical_officer_name = htmlspecialchars($_POST['technical_officer_name'], ENT_QUOTES);
							$technical_officer_position = $_POST['technical_officer_position'];
							$technical_officer_department = $_POST['technical_officer_department'];
							$technical_officer_date = $_POST['technical_officer_date'];
							$section = $_POST['section'];
							$procurement = $_POST['procurement'];
							$phone = $_POST['phone'];
							$category = $_POST['category'];
							$subcategory = $_POST['subcategory'];
							$type = $_POST['type'];
							$brand_model = htmlspecialchars($_POST['brand_model'], ENT_QUOTES);
							$qty_requested = $_POST['qty_requested'];
							$qty_sent = $_POST['qty_sent'];
							$qty_receive = $_POST['qty_receive'];
							$unit_price = $_POST['unit_price'];
							$total_price = $_POST['total_price'];
							$expiry_date = $_POST['expiry_date'];
							$notes = htmlspecialchars($_POST['notes'], ENT_QUOTES);
							$asset_id = $_POST['asset_id'];

							// Update the record in the database
							$sql = mysqli_query($conn, "UPDATE receive SET
															asset_id = '$asset_id',
															ordered_by = '$ordered_by',
															no_LO = '$no_LO',
															LO_date = '$LO_date',
															acceptance_type = '$acceptance_type',
															supplier = '$supplier',
															address = '$address',
															no_DO = '$no_DO',
															DO_date = '$DO_date',
															received_date = '$received_date',
															transportation = '$transportation',
															receive_officer_name = '$receive_officer_name',
															receive_officer_position = '$receive_officer_position',
															receive_officer_department = '$receive_officer_department',
															receive_officer_date = '$receive_officer_date',
															technical_officer_name = '$technical_officer_name',
															technical_officer_position = '$technical_officer_position',
															technical_officer_department = '$technical_officer_department',
															technical_officer_date = '$technical_officer_date',
															section = '$section',
															procurement = '$procurement',
															phone = '$phone',
															category = '$category',
															subcategory = '$subcategory',
															type = '$type',
															brand_model = '$brand_model',
															qty_requested = '$qty_requested',
															qty_sent = '$qty_sent',
															qty_receive = '$qty_receive',
															unit_price = '$unit_price',
															total_price = '$total_price',
															expiry_date = '$expiry_date',
															notes = '$notes'
														WHERE receive_id = '$receive_id'");

							if ($sql == true) {
								echo "<div class='alert alert-success alert-dismissible'>
										<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
										<strong>Thank you!</strong> Asset receive form successfully updated.
									  </div>";
							} else {
								echo "<div class='alert alert-danger alert-dismissible'>
										<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
										<strong>Error!</strong> Could not update the record.
									  </div>";
								echo "Error: " . mysqli_error($conn);
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
                  <h1 class="display-5 font-weight-bold"><i class='menu-icon hgi-stroke hgi-image-done-02'></i>  Update Asset Receive Form</h1>

                  <form method="post" enctype="multipart/form-data">
                    <hr />
                    <div class="table-responsive mt-3"id="printableArea">
                    <div class="table-responsive">
						<table class="table table-sm" role="grid">
						  <thead>
							<tr class="table-warning">
							  <th class="bg-warning" colspan="6">
								<b style="font-size:16px;">Receive Information</b>
							  </th>
							</tr>
						  </thead>
						  <tbody>
							<tr>
							  <td>Ordered By</td>
							  <td><input type="text" name="ordered_by" class="form-control" value="<?php echo $ordered_by; ?>" required />
							  </td>
							  <td>No. DO</td>
							  <td><input type="text" name="no_DO" class="form-control" value="<?php echo $no_DO; ?>" required /></td>
							  <td class="2"><b>Receive Officer</b></td>
							</tr>
							<tr>
							  <td>No. LO</td>
							  <td><input type="text" name="no_LO" class="form-control" value="<?php echo $no_LO; ?>" required /></td>
							  <td>DO Date</td>
							  <td><input type="date" name="DO_date" class="form-control" value="<?php echo $DO_date; ?>" required /></td>
							  <td>Name</td>
							  <td><input type="text" name="receive_officer_name" class="form-control" value="<?php echo $receive_officer_name; ?>" required /></td>
							</tr>
							<tr>
							  <td>LO Date</td>
							  <td><input type="date" name="LO_date" class="form-control" value="<?php echo $LO_date; ?>" required /></td>
							  <td>Date of Receiving</td>
							  <td><input type="date" name="received_date" class="form-control" value="<?php echo $received_date; ?>" required /></td>
							  <td>Position</td>
							  <td><input type="text" name="receive_officer_position" class="form-control" value="<?php echo $receive_officer_position; ?>" required /></td>
							</tr>
							<tr>
							  <td>Acceptance Type</td>
							  <td><input type="text" name="acceptance_type" class="form-control" value="<?php echo $acceptance_type; ?>" required /></td>
							  <td>Transportation</td>
							  <td><input type="text" name="transportation" class="form-control" value="<?php echo $transportation; ?>" required /></td>
							  <td>Department</td>
							  <td><input type="text" name="receive_officer_department" class="form-control" value="<?php echo $receive_officer_department; ?>" required /></td>
							</tr>
							<tr>
							  <td>Supplier</td>
							  <td><input type="text" name="supplier" class="form-control" value="<?php echo $supplier; ?>" required /></td>
							  <td></td>
							  <td></td>
							  <td>Date</td>
							  <td><input type="date" name="receive_officer_date" class="form-control" value="<?php echo $receive_officer_date; ?>" required /></td>
							</tr>
							<tr>
							  <td>Address</td>
							  <td><textarea name="address" rows="5" class="form-control" required><?php echo $address; ?></textarea></td>
							  <td></td>
							  <td></td>
							   <td class="2"><b>Technical Officer</b></td>
							</tr>
							<tr>
							  <td></td>
							  <td></td>
							  <td></td>
							  <td></td>
							  <td>Name</td>
							  <td><input type="text" name="technical_officer_name" class="form-control" value="<?php echo $technical_officer_name; ?>" required /></td>
							</tr>
							<tr>
							  <td></td>
							  <td></td>
							  <td></td>
							  <td></td>
							  <td>Position</td>
							  <td><input type="text" name="technical_officer_position" class="form-control" value="<?php echo $technical_officer_position; ?>" required /></td>
							</tr>
							<tr>
							  <td></td>
							  <td></td>
							  <td></td>
							  <td></td>
							  <td>Department</td>
							  <td><input type="text" name="technical_officer_department" class="form-control" value="<?php echo $technical_officer_department; ?>" required /></td>
							</tr>
							<tr>
							  <td></td>
							  <td></td>
							  <td></td>
							  <td></td>
							  <td>Date</td>
							  <td><input type="date" name="technical_officer_date" class="form-control" value="<?php echo $technical_officer_date; ?>" required /></td>
							</tr>
						  </tbody>
						</table>
					</div>
					
					<div class="table-responsive mt-3">
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
												data-quantity='{$row_asset['quantity']}'
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

                    <!-- Asset Receive Information -->
                    <div class="table-responsive mt-3">
                        <table class="table table-sm" role="grid">
                          <thead>
                            <tr>
                              <th class="bg-warning" colspan="4">
								<b style="font-size:16px;">Asset Receive Information</b>
                              </th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr>
                              <td>Section</td>
                              <td><input type="text" name="section" class="form-control" value="<?php echo $section; ?>" required /></td>
                              <td>Quantity Requested</td>
                              <td><input type="number" name="qty_requested" id="qty_requested" class="form-control" value="<?php echo $qty_requested; ?>" readonly /></td>
                            </tr>
                            <tr>
                              <td>Procurement List</td>
                              <td><input type="text" name="procurement" class="form-control" value="<?php echo $procurement; ?>" required /></td>
                              <td>Quantity Sent</td>
                              <td><input type="number" name="qty_sent" class="form-control" value="<?php echo $qty_sent; ?>" required /></td>
                            </tr>
                            <tr>
                              <td>Phone</td>
                              <td><input type="text" name="phone" class="form-control" value="<?php echo $phone; ?>" required /></td>
                              <td>Quantity Receive</td>
                              <td><input type="number" id="qty_receive" name="qty_receive" class="form-control" value="<?php echo $qty_receive; ?>" required /></td>
                            </tr>
                            <tr>
                              <td>Categories</td>
                              <td><input type="text" name="category" id="category" class="form-control" value="<?php echo $category; ?>" readonly /></td>
                              <td>Unit Price</td>
                              <td><input type="number" step="0.01" id="unit_price" name="unit_price" class="form-control" value="<?php echo $unit_price; ?>" required /></td>
                            </tr>
                            <tr>
                              <td>Sub Categories</td>
                              <td><input type="text" name="subcategory" id="subcategory" class="form-control" value="<?php echo $subcategory; ?>" readonly /></td>
                              <td>Total Price</td>
                              <td><input type="number" step="0.01" id="total_price" name="total_price" class="form-control" value="<?php echo $total_price; ?>" readonly /></td>
                            </tr>
                            <tr>
                              <td>Type</td>
                              <td><input type="text" name="type" id="type" class="form-control" value="<?php echo $type; ?>" readonly /></td>
                              <td>Expiry Date</td>
                              <td><input type="date" step="0.01" name="expiry_date" class="form-control" value="<?php echo $expiry_date; ?>" required /></td>
                            </tr>
                            <tr>
                              <td>Brand/Model</td>
                              <td><input type="text" name="brand_model" id="brand_model" class="form-control" value="<?php echo $brand_model; ?>" readonly /></td>
                              <td>Notes</td>
                              <td><textarea name="notes" rows="5" class="form-control" required><?php echo $notes; ?></textarea></td>
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
                    </div>
                    <br />
					<a href="receive_list.php" class="btn btn-outline-dark">
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
  
  <!-- SCRIPT -->
  <?php include "layout/script.php";?>

  <!-- JavaScript for auto-filling fields -->
  <script>
      document.getElementById('asset_id').addEventListener('change', function() {
          var selectedOption = this.options[this.selectedIndex];

          if (selectedOption.value === "") {
              document.getElementById('category').value = '';
              document.getElementById('subcategory').value = '';
              document.getElementById('type').value = '';
              document.getElementById('brand_model').value = '';
              document.getElementById('qty_requested').value = '';
              document.getElementById('asset_picture').src = 'images/placeholder.png';
              document.getElementById('asset_qrcode').src = 'images/qr-scan.png';
          } else {
              document.getElementById('category').value = selectedOption.getAttribute('data-category');
              document.getElementById('subcategory').value = selectedOption.getAttribute('data-subcategory');
              document.getElementById('type').value = selectedOption.getAttribute('data-type');
              document.getElementById('brand_model').value = selectedOption.getAttribute('data-brand');
              document.getElementById('qty_requested').value = selectedOption.getAttribute('data-quantity');
              document.getElementById('asset_picture').src = selectedOption.getAttribute('data-picture');
              document.getElementById('asset_qrcode').src = selectedOption.getAttribute('data-qrcode');
          }
      });
  </script>

  <!-- JavaScript for calculating total price -->
  <script>
      function calculateTotal() {
          var qtyReceive = parseFloat(document.getElementById('qty_receive').value) || 0;
          var unitPrice = parseFloat(document.getElementById('unit_price').value) || 0;
          var totalPrice = qtyReceive * unitPrice;
          document.getElementById('total_price').value = totalPrice.toFixed(2);
      }

      document.getElementById('qty_receive').addEventListener('input', calculateTotal);
      document.getElementById('unit_price').addEventListener('input', calculateTotal);
  </script>

</body>

</html>

<?php
}
?>
