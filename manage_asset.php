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
		<?php
			
				$code=$_GET['code'];
				$act = $_GET['act'];

				if ($act == 'del') {
					$asset_id = $_GET['asset_id'];
					
					// Step 1: Retrieve the file names (picture and qrcode) from the database
					$query = mysqli_query($conn, "SELECT picture, qrcode FROM asset WHERE asset_id = '$asset_id'");
					$row = mysqli_fetch_array($query);

					$picture = $row['picture']; // Get the picture file name
					$qrcode = $row['qrcode'];   // Get the QR code file name

					// Step 2: Delete the picture and QR code files if they exist
					if (file_exists("picture/$picture")) {
						unlink("picture/$picture"); // Delete the picture
					}
					
					if (file_exists("qrcode/$qrcode")) {
						unlink("qrcode/$qrcode");   // Delete the QR code
					}

					// Step 3: Delete the asset details from the database
					$delete = mysqli_query($conn, "DELETE FROM asset WHERE asset_id = '$asset_id'");
					
					if ($delete == true) {
						echo "<div class='alert alert-danger alert-dismissible'>
								  <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
								  <strong>Thank you!</strong> Asset details successfully deleted.
							  </div>";
					} else {
						echo "<div class='alert alert-danger alert-dismissible'>
								  <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
								  <strong>Error!</strong> Failed to delete asset details.
							  </div>";
					}
				}


				
			?>
          <div class="row">
            
            
           <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h1 class="display-5 font-weight-bold"><i class='menu-icon hgi-stroke hgi-file-02'></i> List of Asset</h1>

                  <div class="table-responsive mt-4">
                    <table id="datatable" class="table dataTable no-footer" role="grid">
                      <thead>
                        <tr>
						  <th>ID Asset</th>
                          <th>Categories</th>
                          <th>Sub Categories</th>
                          <th>Type</th>
                          <th>Brand / Model</th>
						  <th>Quantity</th>
						  <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
					  <?php
					  
						$sql = mysqli_query($conn, "SELECT * FROM asset ORDER BY asset_id ASC");
						while($row = mysqli_fetch_array($sql))
						{
							//get user position based on level
							if($_SESSION['UserLvl'] == 1)
							{
									  //hide delete function from all staff except admin
									  $function = "<a href='update_asset.php?asset_id=$row[asset_id]'
													data-toggle='tooltip' data-placement='left' title='Update'>
														<i class='hgi-stroke hgi-pencil-edit-02 text-warning' style='font-size: 20px;'></i>
													</a>
													<a href='manage_asset.php?act=del&asset_id=$row[asset_id]'
													data-toggle='tooltip' data-placement='left' title='Remove'
													onclick=\"return confirm('Are you sure you want to remove asset $row[asset_id]?');\">
														<i class='hgi-stroke hgi-delete-03 text-danger' style='font-size: 20px;'></i>
													</a>";
							}
							else if($_SESSION['UserLvl'] == 2)
							{
									$function = "<a href='update_asset.php?asset_id=$row[asset_id]'
													data-toggle='tooltip' data-placement='left' title='Update'>
														<i class='hgi-stroke hgi-pencil-edit-02 text-warning' style='font-size: 20px;'></i>
													</a>";
							}
							
							echo "<tr>
									<td><label class='badge badge-pill badge-warning'>$row[asset_id]</label></td>
									<td>$row[category]</td>
									<td>$row[sub_category]</td>
									<td>$row[type]</td>
									<td>$row[brand]</td>
									<td>$row[quantity]</td>
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