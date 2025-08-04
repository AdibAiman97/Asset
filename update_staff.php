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
					if (isset($_POST['submit']))
					{
						
						$username = $_POST['username'];
						$name = $_POST['name'];
						$position = $_POST['position'];
						$email = $_POST['email'];
						$phone = $_POST['phone'];
						$gender_id = $_POST['gender_id'];
						
						$file_location 	= $_FILES['photo']['tmp_name'];
						$file_type		= $_FILES['photo']['type'];
						$file_name		= $_FILES['photo']['name'];
						
						if (empty($file_location))
						{
							$sql = mysqli_query($conn, "UPDATE staff SET name = '$name',
																			position = '$position',
																			email = '$email',
																			phone = '$phone',
																			gender_id = '$gender_id'
																			WHERE username = '$username'");
						}
						else
						{
							move_uploaded_file($file_location,"photo/$file_name");
							
							$sql = mysqli_query($conn, "UPDATE staff SET name = '$name',
																			position = '$position',
																			email = '$email',
																			phone = '$phone',
																			gender_id = '$gender_id',
																			photo = '$file_name'
																			WHERE username = '$username'");
						}
						
						
						
						if($sql == true)
						{
						
							echo "<div class='alert alert-success alert-dismissible'>
														<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
														<strong>Thank you!</strong> Staff account is successfully updated.
									</div>";
						}
						else
							echo "<div class='alert alert-danger alert-dismissible'>
									<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
									<strong>Sorry!</strong> error.
								</div>";
					}
					
					$username = $_GET['username'];
					$sql = mysqli_query($conn, "SELECT * FROM staff WHERE username = '$username'");
					$row = mysqli_fetch_array($sql);

			?>
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Update Staff</h4>

                  <form method="post" enctype="multipart/form-data">
                    <p class="card-description text-warning">
                      <i class="hgi-stroke hgi-user-star-01"></i> Update Staff Details
                    </p>
					<hr />
                    <div class="row">
                      <div class="col-md-3">
						<div class="form-group">
							<label>Staff ID</label>
							<input type="text" class="form-control" name="username" value="<?php echo $row['username']; ?>" placeholder="Staff ID" readonly />
						</div>
                      </div>
					  <div class="col-md-6">
						<div class="form-group">
							<label>Name</label>
							<input type="text" class="form-control" name="name" value="<?php echo $row['name']; ?>" placeholder="Name" required />
						</div>
                      </div>
					  <div class="col-md-3">
						<div class="form-group">
							<label>Position</label>
							<input type="text" class="form-control" name="position" value="<?php echo $row['position']; ?>" placeholder="Position" required />
						</div>
                      </div>
                    </div>
                    
                    <div class="row">
                      <div class="col-md-3">
						<div class="form-group">
							<label>Email</label>
							<input type="email" class="form-control" name="email" value="<?php echo $row['email']; ?>" placeholder="Email Address" required />
						</div>
                      </div>
					  <div class="col-md-3">
						<div class="form-group">
							<label>Phone No.</label>
							<input type="text" class="form-control" name="phone" value="<?php echo $row['phone']; ?>" placeholder="Phone No." required />
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
									if($rowGender['gender_id'] == $row['gender_id'])
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
							<label>New Photo <span class="badge badge-warning">(if any)</span></label>
							<input type="file" class="form-control" name="photo" placeholder="Photo" />
						</div>
                      </div>
                    </div>
                   
                    
                    
                    <br />
					<a href="manage_staff.php" class="btn btn-outline-dark">
						<i class="mdi mdi-keyboard-backspace"></i> Back
					</a>
					<button type="submit" name="submit" class="btn btn-warning mr-2"><i class="mdi mdi-check"></i> Update</button>
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