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
				$act=$_GET['act'];

				if ($act=='del')
				{
					$username =  $_GET['username'];
					
					$deleteLogin = mysqli_query($conn, "DELETE FROM login WHERE UserID = '$username'");
					$delStaff = mysqli_query($conn, "DELETE FROM staff WHERE username = '$username'");
					
					if(($deleteLogin == true) && ($delStaff == true))
					{
						echo "<div class='alert alert-danger alert-dismissible'>
									<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
									<strong>Thank you!</strong> Staff account successfully removed.
								</div>";
					}
						
				}
				else if ($act=='activate')
				{
					$username =  $_GET['username'];
					
					$sql = mysqli_query($conn, "UPDATE login SET Status = 'Active'WHERE UserID = '$username'");
					
					if($sql == true)
					{
						echo "<div class='alert alert-success alert-dismissible'>
									<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
									<strong>Thank you!</strong> Staff account successfully activated.
								</div>";
					}
						
				}
				else if ($act=='deactivate')
				{
					$username =  $_GET['username'];
					
					$sql = mysqli_query($conn, "UPDATE login SET Status = 'Inactive'WHERE UserID = '$username'");
					
					if($sql == true)
					{
						echo "<div class='alert alert-danger alert-dismissible'>
									<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
									<strong>Thank you!</strong> Staff account successfully deactivated.
								</div>";
					}
						
				}

				
			?>
          <div class="row">
            
            
           <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
				  <h1 class="display-5 font-weight-bold"><i class='menu-icon hgi-stroke hgi-user-star-01'></i> List of Staff</h1>

                  <div class="table-responsive mt-4">
                    <table id="datatable" class="table dataTable no-footer" role="grid">
                      <thead>
                        <tr>
                          <th>Staff</th>
                          <th>Name</th>
                          <th>Position</th>
                          <th>Email</th>
                          <th>Phone</th>
                          <th>Gender</th>
						  <th>Status</th>
						  <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
					  <?php
					  
						$sql = mysqli_query($conn, "SELECT * FROM login l, staff s, gender g
															WHERE l.UserID = s.username
															AND s.gender_id = g.gender_id
															AND l.UserLvl = 2");
						while($row = mysqli_fetch_array($sql))
						{
							if($row['Status'] == "Active")
							{
								$displayStatus = "<a href='manage_staff.php?act=deactivate&username=$row[username]'
													data-toggle='tooltip' data-placement='right' title='Deactivate'
													onclick=\"return confirm('Are you sure you want to deactivated staff $row[name] account?');\">
														<button class='btn btn-success btn-xs'>
															$row[Status]
														</button>
													</a>";
							}
							else if($row['Status'] == "Inactive")
							{
								$displayStatus = "<a href='manage_staff.php?act=activate&username=$row[username]'
													data-toggle='tooltip' data-placement='right' title='Activate'>
														<button class='btn btn-danger btn-xs'>
															$row[Status]
														</button>
													</a>";
							}
							
							//highlight Gender
							if($row['gender_id'] == "M")
								$gender = "<span class='badge badge-primary'>$row[gender_id]</span>";
							else if($row['gender_id'] == "F")
								$gender = "<span class='badge badge-danger'>$row[gender_id]</span>";
							
												
							echo "<tr>
									<td class='py-1'><img src='photo/$row[photo]' data-toggle='tooltip' data-placement='right' title data-original-title='$row[username]'/></td>
									<td>
									    $row[name]<br /><br />
									    <small class='text-warning'>ID: $row[username]<br />
									             Pass: <span id='password-$row[username]' style='display: inline;'>".str_repeat('*', strlen($row['Password']))."</span>
                                				<span id='password-visible-$row[username]' style='display: none;'>$row[Password]</span>
                                				<a href='javascript:void(0);' onclick=\"togglePasswordVisibility('$row[username]');\">
                                					<i id='icon-$row[username]' class='mdi mdi-eye text-muted'></i>
                                				</a>
									    </small>
									</td>
									<td>$row[position]</td>
									<td>$row[email]</td>
									<td>$row[phone]</td>
									<td>$gender</td>
									<td>$displayStatus</td>
									<td>
									
										<a href='update_staff.php?username=$row[username]'
										data-toggle='tooltip' data-placement='left' title='Update'>
											<i class='hgi-stroke hgi-pencil-edit-02 text-warning' style='font-size: 20px;'></i>
										</a>
										<a href='manage_staff.php?act=del&username=$row[username]'
										data-toggle='tooltip' data-placement='left' title='Remove'
										onclick=\"return confirm('Are you sure you want to remove staff $row[name] account ?');\">
											<i class='hgi-stroke hgi-delete-03 text-danger' style='font-size: 20px;'></i>
										</a>
									</td>
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
      <script>
    function togglePasswordVisibility(username) {
        var password = document.getElementById("password-" + username);
        var passwordVisible = document.getElementById("password-visible-" + username);
        var icon = document.getElementById("icon-" + username);
    
        if (password.style.display === "none") {
            password.style.display = "inline";
            passwordVisible.style.display = "none";
            icon.classList.remove("mdi-eye-off");
            icon.classList.add("mdi-eye");
        } else {
            password.style.display = "none";
            passwordVisible.style.display = "inline";
            icon.classList.remove("mdi-eye");
            icon.classList.add("mdi-eye-off");
        }
    }
    </script>
</body>

</html>
<?php
}
?>