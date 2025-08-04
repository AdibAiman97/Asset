<?php
include "conn/conn.php";
error_reporting(0);
session_start();


{
?>

<!DOCTYPE html>
<html lang="en">

<!-- head -->
<?php include "layout/head.php";?>

<body>


	

	   
      <!-- partial -->
      <div class="main-panel">
 
		<?php
			
				$code=$_GET['code'];
				$act=$_GET['act'];

				if ($act=='del')
				{
					$registration_id =  $_GET['registration_id'];
					
					$delete = mysqli_query($conn, "DELETE FROM registration WHERE registration_id = '$registration_id'");
					
					
					if($delete == true)
					{
						echo "<div class='alert alert-danger alert-dismissible'>
									<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
									<strong>Thank you!</strong> Asset registration details successfully deleted.
								</div>";
					}
						
				}

				
			?>
          <div class="row">
            
            
           <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
				  <h1 class="display-5 font-weight-bold"><i class='menu-icon hgi-stroke hgi-image-add-02'></i> Asset Registration List</h1>
                  <div class="table-responsive mt-4">
                    <table id="datatable" class="table dataTable no-footer" role="grid">
                      <thead>
                        <tr>
						 <th>ID Registration</th>
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
					  
						$sql = mysqli_query($conn, "SELECT * FROM registration");
						while($row = mysqli_fetch_array($sql))
						{
							//get user level
							if($_SESSION['UserLvl'] == 1)
							{
									  //hide delete function from all staff except admin
									  $function = "
													<a href='update_registration.php?registration_id=$row[registration_id]'
													data-toggle='tooltip' data-placement='left' title='Update'>
														<i class='hgi-stroke hgi-pencil-edit-02 text-warning' style='font-size: 20px;'></i>
													</a>
													<a href='registration_list.php?act=del&registration_id=$row[registration_id]'
													data-toggle='tooltip' data-placement='left' title='Remove'
													onclick=\"return confirm('Are you sure you want to remove registration asset $row[category]?');\">
														<i class='hgi-stroke hgi-delete-03 text-danger' style='font-size: 20px;'></i>
													</a>";
							}
							else if($_SESSION['UserLvl'] == 2)
							{
									$function = "
													<a href='update_registration.php?registration_id=$row[registration_id]'
													data-toggle='tooltip' data-placement='left' title='Update'>
														<i class='hgi-stroke hgi-pencil-edit-02 text-warning' style='font-size: 20px;'></i>
													</a>";
							}
							
							echo "<tr>
									<td><label class='badge badge-pill badge-warning'>$row[registration_id]</label></td>
									<td>$row[category]</td>
									<td>$row[subcategory]</td>
									<td>$row[type]</td>
									<td>$row[brand_model]</td>
									<td>$row[qty]</td>
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
