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
			
				$code=$_GET['code'];
				$act=$_GET['act'];

				if ($act=='del')
				{
					$receive_id =  $_GET['receive_id'];
					
					$delete = mysqli_query($conn, "DELETE FROM receive WHERE receive_id = '$receive_id'");
					
					
					if($delete == true)
					{
						echo "<div class='alert alert-danger alert-dismissible'>
									<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
									<strong>Thank you!</strong> Receive Asset details successfully deleted.
								</div>";
					}
						
				}

				
			?>
          <div class="row">
            
            
           <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h1 class="display-5 font-weight-bold"><i class='menu-icon hgi-stroke hgi-image-done-02'></i> Asset Receive List</h1>

                  <div class="table-responsive mt-4">
                    <table id="datatable" class="table dataTable no-footer" role="grid">
                      <thead>
                        <tr>
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
					  
						$sql = mysqli_query($conn, "SELECT * FROM receive ORDER BY received_date DESC");
						while($row = mysqli_fetch_array($sql))
						{
							
							//get user level
							if($_SESSION['UserLvl'] == 1)
							{
									  //hide delete function from all staff except admin
									  $function = "
									  				<a href='print_receive.php?receive_id=$row[receive_id]' 
														data-toggle='tooltip' data-placement='left' title='Print'>
															<i class='bi bi-printer-fill text-success' style='font-size: 20px;'></i>
														</a>
													<a href='update_receive.php?receive_id=$row[receive_id]'
													data-toggle='tooltip' data-placement='left' title='Update'>
														<i class='hgi-stroke hgi-pencil-edit-02 text-warning' style='font-size: 20px;'></i>
													</a>
													<a href='receive_list.php?act=del&receive_id=$row[receive_id]'
													data-toggle='tooltip' data-placement='left' title='Remove'
													onclick=\"return confirm('Are you sure you want to remove receive asset $row[category]?');\">
														<i class='hgi-stroke hgi-delete-03 text-danger' style='font-size: 20px;'></i>
													</a>";
							}
							else if($_SESSION['UserLvl'] == 2)
							{
									$function = "
													<a href='print_receive.php?receive_id=$row[receive_id]' 
														data-toggle='tooltip' data-placement='left' title='Print'>
															<i class='bi bi-printer-fill text-success' style='font-size: 20px;'></i>
														</a>
													<a href='update_receive.php?receive_id=$row[receive_id]'
													data-toggle='tooltip' data-placement='left' title='Update'>
														<i class='hgi-stroke hgi-pencil-edit-02 text-warning' style='font-size: 20px;'></i>
													</a>";
							}
							
							echo "<tr>
									<td>$row[category]</td>
									<td>$row[subcategory]</td>
									<td>$row[type]</td>
									<td>$row[brand_model]</td>
									<td>$row[qty_receive]</td>
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