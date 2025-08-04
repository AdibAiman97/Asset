<?php
include "conn/conn.php";
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
					$username = "";
					if (isset($_POST['submit']))
					{
						
						$username = $_POST['username'];
						$name = $_POST['name'];
						$position = $_POST['position'];
						$email = $_POST['email'];
						$phone = $_POST['phone'];
						$gender_id = $_POST['gender_id'];
						$UserLvl = 2;
						
						$file_location 	= $_FILES['photo']['tmp_name'];
						$file_type		= $_FILES['photo']['type'];
						$file_name		= $_FILES['photo']['name'];
						
						move_uploaded_file($file_location,"photo/$file_name");
						
						$addLogin = mysqli_query($conn, "INSERT INTO login (UserID, Password, UserLvl, Status)
																VALUES ('$username', '$username', '$UserLvl', 'Active')");
						
						$addStaff = mysqli_query($conn, "INSERT INTO staff (username, name, position, email, phone, gender_id, photo)
																VALUES ('$username', '$name', '$position', '$email', '$phone', '$gender_id', '$file_name')");
															
															
							
						
														
						if(($addLogin == true) && ($addStaff == true))
						{
							$username = "";
							$name = "";
							$position = "";
							$email = "";
							$phone = "";
							$gender_id = "";
						
							echo "<div class='alert alert-success alert-dismissible'>
														<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
														<strong>Thank you!</strong> Staff account is successfully created.
									</div>";
						}
						else
							echo "<div class='alert alert-danger alert-dismissible'>
									<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
									<strong>Sorry!</strong> Staff ID $username already being used.
								</div>";
					}

			?>
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Register Staff</h4>

                  <form method="post" enctype="multipart/form-data">
                    <p class="card-description text-warning">
                      <i class="hgi-stroke hgi-user-star-01"></i> Add Staff Details
                    </p>
					
					<hr />
                    <div class="row">
                      <div class="col-md-3">
						<div class="form-group">
							<label>Staff ID</label>
							<input type="text" class="form-control" name="username" value="<?php echo $username; ?>" placeholder="Staff ID" required />
						</div>
                      </div>
					  <div class="col-md-6">
						<div class="form-group">
							<label>Name</label>
							<input type="text" class="form-control" name="name" value="<?php echo $name; ?>" placeholder="Name" required />
						</div>
                      </div>
					  <div class="col-md-3">
						<div class="form-group">
							<label>Position</label>
							<input type="text" class="form-control" name="position" value="<?php echo $position; ?>" placeholder="Position" required />
						</div>
                      </div>
                    </div>
                    
                    <div class="row">
                      <div class="col-md-3">
						<div class="form-group">
							<label>Email</label>
							<input type="email" class="form-control" name="email" value="<?php echo $email; ?>" placeholder="Email Address" required />
						</div>
                      </div>
					  <div class="col-md-3">
						<div class="form-group">
							<label>Phone No.</label>
							<input type="text" class="form-control" name="phone" value="<?php echo $phone; ?>" placeholder="Phone No." required />
						</div>
                      </div>
					  <div class="col-md-3">
						<div class="form-group">
							<label>Gender</label>
							<select class="form-control" name="gender_id" required />
							<option value="">- choose gender -</option>
							<?php
								$sqlGender = mysqli_query($conn, "SELECT * FROM gender");
								while($rowGender = mysqli_fetch_array($sqlGender))
								{
									if($rowGender['gender_id'] == $gender_id)
										echo "<option value='$rowGender[gender_id]' selected>$rowGender[gender]</option>";
									else
										echo "<option value='$rowGender[gender_id]'>$rowGender[gender]</option>";
								}
							?>
							</select>
						</div>
                      </div>
					  <div class="col-md-3">
						<div class="form-group">
							<label>Photo</label>
							<input type="file" class="form-control" name="photo" placeholder="Photo" required />
						</div>
                      </div>
                    </div>
					
					<hr />
					<p class="card-description text-warning">
                      <i class="icon icon-lock"></i> Login Details
                    </p>
					
					<div class="row">
                      <div class="col-md-12">
						<div class="form-group">
							<label>Staff ID & Password</label><br />
							<div class="badge badge-warning">ID & Password are equal to Staff ID (auto matched)</div>
						</div>
                      </div>
                    </div>
					
                    
                    
                    <br />
                    <button type="reset" class="btn btn-outline-dark"><i class="mdi mdi-refresh"></i> Reset</button>
					<button type="submit" name="submit" class="btn btn-warning mr-2"><i class="mdi mdi-check"></i> Register</button>
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