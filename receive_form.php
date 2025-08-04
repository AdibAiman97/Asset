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
			
			
					date_default_timezone_set("Asia/Kuala_Lumpur");
					$today = date("Y-m-d");
			
					if (isset($_POST['submit']))
					{
						
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
						
						$sql = mysqli_query($conn, "INSERT INTO receive (ordered_by,
																				no_LO,
																				LO_date,
																				acceptance_type,
																				supplier,
																				address,
																				no_DO,
																				DO_date,
																				received_date,
																				transportation,
																				receive_officer_name,
																				receive_officer_position,
																				receive_officer_department,
																				receive_officer_date,
																				technical_officer_name,
																				technical_officer_position,
																				technical_officer_department,
																				technical_officer_date,
																				section,
																				procurement,
																				phone,
																				category,
																				subcategory,
																				type,
																				brand_model,
																				qty_requested,
																				qty_sent,
																				qty_receive,
																				unit_price,
																				total_price,
																				expiry_date,
																				notes,
																				asset_id)
																	VALUES ('$ordered_by',
																				'$no_LO',
																				'$LO_date',
																				'$acceptance_type',
																				'$supplier',
																				'$address',
																				'$no_DO',
																				'$DO_date',
																				'$received_date',
																				'$transportation',
																				'$receive_officer_name',
																				'$receive_officer_position',
																				'$receive_officer_department',
																				'$receive_officer_date',
																				'$technical_officer_name',
																				'$technical_officer_position',
																				'$technical_officer_department',
																				'$technical_officer_date',
																				'$section',
																				'$procurement',
																				'$phone',
																				'$category',
																				'$subcategory',
																				'$type',
																				'$brand_model',
																				'$qty_requested',
																				'$qty_sent',
																				'$qty_receive',
																				'$unit_price',
																				'$total_price',
																				'$expiry_date',
																				'$notes',
																				'$asset_id')");
							
						
														
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
																				'Receive',
																				'$item')");
						
							echo "<div class='alert alert-success alert-dismissible'>
										<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
										<strong>Thank You!</strong> Asset Receive Form successfully saved.
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
                  <h1 class="display-5 font-weight-bold"><i class='menu-icon hgi-stroke hgi-image-done-02'></i>  Asset Receive Form</h1>

                  <form method="post" enctype="multipart/form-data">
					<hr />
					
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
							  <td><input type="text" name="ordered_by" class="form-control" required />
							  </td>
							  <td>No. DO</td>
							  <td><input type="text" name="no_DO" class="form-control" required /></td>
							  <td class="2"><b>Receive Officer</b></td>
							</tr>
							<tr>
							  <td>No. LO</td>
							  <td><input type="text" name="no_LO" class="form-control" required /></td>
							  <td>DO Date</td>
							  <td><input type="date" name="DO_date" class="form-control" required /></td>
							  <td>Name</td>
							  <td><input type="text" name="receive_officer_name" class="form-control" required /></td>
							</tr>
							<tr>
							  <td>LO Date</td>
							  <td><input type="date" name="LO_date" class="form-control" required /></td>
							  <td>Date of Receiving</td>
							  <td><input type="date" name="received_date" class="form-control" required /></td>
							  <td>Position</td>
							  <td><input type="text" name="receive_officer_position" class="form-control" required /></td>
							</tr>
							<tr>
							  <td>Acceptance Type</td>
							  <td><input type="text" name="acceptance_type" class="form-control" required /></td>
							  <td>Transportation</td>
							  <td><input type="text" name="transportation" class="form-control" required /></td>
							  <td>Department</td>
							  <td><input type="text" name="receive_officer_department" class="form-control" required /></td>
							</tr>
							<tr>
							  <td>Supplier</td>
							  <td><input type="text" name="supplier" class="form-control" required /></td>
							  <td></td>
							  <td></td>
							  <td>Date</td>
							  <td><input type="date" name="receive_officer_date" class="form-control" required /></td>
							</tr>
							<tr>
							  <td>Address</td>
							  <td><textarea name="address" rows="5" class="form-control" required></textarea></td>
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
							  <td><input type="text" name="technical_officer_name" class="form-control" required /></td>
							</tr>
							<tr>
							  <td></td>
							  <td></td>
							  <td></td>
							  <td></td>
							  <td>Position</td>
							  <td><input type="text" name="technical_officer_position" class="form-control" required /></td>
							</tr>
							<tr>
							  <td></td>
							  <td></td>
							  <td></td>
							  <td></td>
							  <td>Department</td>
							  <td><input type="text" name="technical_officer_department" class="form-control" required /></td>
							</tr>
							<tr>
							  <td></td>
							  <td></td>
							  <td></td>
							  <td></td>
							  <td>Date</td>
							  <td><input type="date" name="technical_officer_date" class="form-control" required /></td>
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
							  <th class="bg-warning" colspan="4">
								<b style="font-size:16px;">Asset Receive Information</b>
							  </th>
							</tr>
						  </thead>
						  <tbody>
							<tr>
							  <td>Section</td>
							  <td><input type="text" name="section" class="form-control" required /></td>
							  <td>Quantity Requested</td>
							  <td><input type="number" name="qty_requested" id="qty_requested" class="form-control" readonly /></td>
							</tr>
							<tr>
							  <td>Procurement List</td>
							  <td><input type="text" name="procurement" class="form-control" required /></td>
							  <td>Quantity Sent</td>
							  <td><input type="number" name="qty_sent" class="form-control" required /></td>
							</tr>
							<tr>
							  <td>Phone</td>
							  <td><input type="text" name="phone" class="form-control" required /></td>
							  <td>Quantity Receive</td>
							  <td><input type="number" id="qty_receive" name="qty_receive" class="form-control" required /></td>
							</tr>
							<tr>
							  <td>Categories</td>
							  <td><input type="text" name="category" id="category" class="form-control" readonly /></td>
							  <td>Unit Price</td>
							  <td><input type="number" step="0.01" id="unit_price" name="unit_price" class="form-control" required /></td>
							</tr>
							<tr>
							  <td>Sub Categories</td>
							  <td><input type="text" name="subcategory" id="subcategory" class="form-control" readonly /></td>
							  <td>Total Price</td>
							  <td><input type="number" step="0.01" id="total_price" name="total_price" class="form-control" readonly /></td>
							</tr>
							<tr>
							  <td>Type</td>
							  <td><input type="text" name="type" id="type" class="form-control" readonly /></td>
							  <td>Expiry Date</td>
							  <td><input type="date" step="0.01" name="expiry_date" class="form-control" required /></td>
							</tr>
							<tr>
							  <td>Brand/Model</td>
							  <td><input type="text" name="brand_model" id="brand_model" class="form-control" readonly /></td>
							  <td>Notes</td>
							  <td><textarea name="notes" rows="5" class="form-control" required></textarea></td>
							</tr>
							<tr>
							  <td>Picture</td>
							  <td><img id="asset_picture" src="images/placeholder.png" alt="Asset Picture" width="100" /></td>
							  <td>Qr Code </td>
							  <td><img id="asset_qrcode" src="images/qr-scan.png" alt="QR Code" width="100" /></td>
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
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
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
				document.getElementById('qty_requested').value = '';
			} else {
				// Get the data attributes from the selected option
				var category = selectedOption.getAttribute('data-category');
				var subcategory = selectedOption.getAttribute('data-subcategory');
				var type = selectedOption.getAttribute('data-type');
				var brand = selectedOption.getAttribute('data-brand');
				var quantity = selectedOption.getAttribute('data-quantity');
				var picture = selectedOption.getAttribute('data-picture') || 'path/to/placeholder.png'; // Fallback to placeholder if no picture
				var qrcode = selectedOption.getAttribute('data-qrcode') || 'path/to/placeholder.png';   // Fallback to placeholder if no QR code

				// Set the values in the input fields
				document.getElementById('category').value = category;
				document.getElementById('subcategory').value = subcategory;
				document.getElementById('type').value = type;
				document.getElementById('brand_model').value = brand;
				document.getElementById('qty_requested').value = quantity;

				// Set the src for the images (Picture and QR Code)
				document.getElementById('asset_picture').src = picture;
				document.getElementById('asset_qrcode').src = qrcode;
			}
		});


	</script>
	
	<!-- JavaScript to auto-calculate total price -->
	<script>
		// Function to calculate total price
		function calculateTotal() {
			var qtyReceive = parseFloat(document.getElementById('qty_receive').value) || 0;
			var unitPrice = parseFloat(document.getElementById('unit_price').value) || 0;

			var totalPrice = qtyReceive * unitPrice;
			document.getElementById('total_price').value = totalPrice.toFixed(2);
		}

		// Add event listeners to quantity and unit price fields
		document.getElementById('qty_receive').addEventListener('input', calculateTotal);
		document.getElementById('unit_price').addEventListener('input', calculateTotal);
	</script>


</body>

</html>
<?php
}
?>