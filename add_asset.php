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
						
						//generate random code
						function random_code($limit)
						{
							return substr(base_convert(sha1(uniqid(mt_rand())), 16, 36), 0, $limit);
						}
						$code  = strtoupper(random_code(5));
						
						//split user id
						$user_id = $_SESSION['UserID'];
						$substring = substr($user_id, 3, 11);
						
						// combine all to get unique bmc code
						$asset_id = "STDC" . $substring . $code;
						
						do{
							// check samada id dah wujud atau belum
							$sqlCheck = mysqli_query($conn, "SELECT * FROM asset WHERE asset_id = '$asset_id'");
							$numRowCheck = mysqli_fetch_array($sqlCheck);
							
							// jika dah ada generate code baru.
							if($numRowCheck > 0)
							{
								$code  = strtoupper(random_code(5));
								$asset_id = "STDC" . $substring . $code;
							}
							
						}while($numRowCheck > 0);
							
						
						$category = $_POST['category'];
						$sub_category = $_POST['sub_category'];
						$type = $_POST['type'];
						$brand = $_POST['brand'];
						$quantity = $_POST['quantity'];
						
						
						//upload picture
						$file_location 	= $_FILES['picture']['tmp_name'];
						$file_type		= $_FILES['picture']['type'];
						$file_name		= $_FILES['picture']['name'];
						move_uploaded_file($file_location,"picture/$file_name");
						
						/* generate QR Code */
						
						$encrypted_qrc = md5($asset_id);
						
						

						// include file qrlib.php
						include "phpqrcode/qrlib.php";

						//QR Code Latest Folder
						$tempdir = "qrcode/";

						//if no folder, create new
						if (!file_exists($tempdir)){
							mkdir($tempdir);
						}

						#qrcode parameter
						$qrtexts = $asset_id;
						$qrname = $encrypted_qrc.".png";
						$quality = 'H'; //L (Low), M(Medium), Q(Good), H(High)
						$size = 10; // scale 1-10
						$padding = 2;
						$url = "http://localhost/STDC-Asset-System/qr_registration.php?ref_no=" . $ref_no;

						QRCode::png($url, $tempdir . $qrname, $quality, $size, $padding);
						
						/* end of qr code generate */
						
						$sql = mysqli_query($conn, "INSERT INTO asset (asset_id,
																		category,
																		sub_category,
																		type,
																		brand,
																		quantity,
																		picture,
																		qrcode)
																VALUES ('$asset_id',
																		'$category',
																		'$sub_category',
																		'$type',
																		'$brand',
																		'$quantity',
																		'$file_name',
																		'$qrname')");
															
						
														
						if($sql == true)
						{
							/* store activity */
							$activity_date = $today;
							$item = $category . ", " . $sub_category . ", " . $brand;
							$sqlA = mysqli_query($conn, "INSERT INTO activity (activity_date,
																				user_id,
																				user_level,
																				action,
																				item)
																		VALUES ('$activity_date',
																				'$_SESSION[UserID]',
																				'$_SESSION[UserLvl]',
																				'Add Asset',
																				'$item')");
							
						
							echo "<div class='alert alert-success alert-dismissible'>
												<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
												<strong>Thank you!</strong> New Asset successfully added.
									</div>";
						
							//reset value
							$category = "";
							$sub_category = "";
							$type = "";
							$brand = "";
							$quantity = "";
						}
						else
						{
							echo "<div class='alert alert-danger alert-dismissible'>
									<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
									<strong>Sorry!</strong> error.
								</div>";
							echo "Error: " . mysqli_error($conn);
						}
					}

			?>
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Add New Asset</h4>

                  <form method="post" enctype="multipart/form-data">
                    <p class="card-type text-warning">
                      <i class="hgi-stroke hgi-file-02"></i> Add Asset Details
                    </p>
					
					<hr />
					
                    <div class="row">
                      <div class="col-md-6">
						<div class="form-group">
							<label>Category</label>
							<input type="text" class="form-control" name="category" value="<?php echo $category; ?>" placeholder="Category" required />
						</div>
                      </div>
					  <div class="col-md-6">
						<div class="form-group">
							<label>Sub Category</label>
							<input type="text" class="form-control" name="sub_category" value="<?php echo $sub_category; ?>" placeholder="Sub Category" required />
						</div>
                      </div>
                    </div>
                    <div class="row">
					  <div class="col-md-6">
						<div class="form-group">
							<label>Type</label>
							<input type="text" class="form-control" name="type" value="<?php echo $type; ?>" placeholder="Asset Type" required />
						</div>
                      </div>
					  <div class="col-md-6">
						<div class="form-group">
							<label>Brand / Model</label>
							<input type="text" class="form-control" name="brand" value="<?php echo $brand; ?>" placeholder="Brand / Model" required />
						</div>
                      </div>
                    </div>
                    <div class="row">
					  <div class="col-md-6">
						<div class="form-group">
							<label>Quantity</label>
							<input type="number" min="1" class="form-control" name="quantity" value="<?php echo $quantity; ?>" placeholder="Quantity" required />
						</div>
                      </div>
					  <div class="col-md-6">
						<div class="form-group">
							<label>Picture</label>
							<input type="file" class="form-control" name="picture" placeholder="Picture" required />
						</div>
                      </div>
                    </div>
                    
                   
                    
                    <br />
                    <button type="reset" class="btn btn-outline-dark"><i class="mdi mdi-refresh"></i> Reset</button>
					<button type="submit" name="submit" class="btn btn-warning mr-2"><i class="mdi mdi-check"></i> Submit</button>
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
</body>

</html>
<?php
}
?>