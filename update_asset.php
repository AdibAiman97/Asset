<?php
include "conn/conn.php";
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();
if (empty($_SESSION['UserID']) && empty($_SESSION['Password'])) {
    header('location:index.php');
} else {

    
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
						// Step 1: Get the asset_id from the URL to know which asset to update
						if (isset($_GET['asset_id'])) {
							$asset_id = $_GET['asset_id'];

							// Step 2: Fetch the existing asset details from the database
							$query = mysqli_query($conn, "SELECT * FROM asset WHERE asset_id = '$asset_id'");
							$row = mysqli_fetch_array($query);

							$category = $row['category'];
							$sub_category = $row['sub_category'];
							$type = $row['type'];
							$brand = $row['brand'];
							$quantity = $row['quantity'];
							$current_picture = $row['picture']; // Current picture for optional update

							// Step 3: Handle form submission for updating the asset
							if (isset($_POST['submit'])) {
								$category = $_POST['category'];
								$sub_category = $_POST['sub_category'];
								$type = $_POST['type'];
								$brand = $_POST['brand'];
								$quantity = $_POST['quantity'];

								// Handle picture upload
								if (!empty($_FILES['picture']['tmp_name'])) {
									$file_location = $_FILES['picture']['tmp_name'];
									$file_type = $_FILES['picture']['type'];
									$file_name = $_FILES['picture']['name'];
									
									// Remove the old picture if it exists
									if (file_exists("picture/$current_picture")) {
										unlink("picture/$current_picture");
									}

									// Move the new picture to the desired location
									move_uploaded_file($file_location, "picture/$file_name");
								} else {
									$file_name = $current_picture; // Keep the current picture if not updated
								}

								// Update the asset in the database
								$sql = mysqli_query($conn, "UPDATE asset SET
															category = '$category',
															sub_category = '$sub_category',
															type = '$type',
															brand = '$brand',
															quantity = '$quantity',
															picture = '$file_name'
															WHERE asset_id = '$asset_id'");

								if ($sql == true) {
									echo "<div class='alert alert-success alert-dismissible'>
											<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
											<strong>Success!</strong> Asset details successfully updated.
										  </div>";
								} else {
									echo "<div class='alert alert-danger alert-dismissible'>
											<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
											<strong>Error!</strong> Could not update the asset details.
										  </div>";
									echo "Error: " . mysqli_error($conn);
								}
							}
						}
						?>
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Update Asset</h4>

                                    <form method="post" enctype="multipart/form-data">
                                        <p class="card-type text-warning">
                                            <i class="hgi-stroke hgi-file-02"></i> Update Asset Details
                                        </p>
                                        <hr />
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Category</label>
                                                    <input type="text" class="form-control" name="category" value="<?php echo $category; ?>" required />
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Sub Category</label>
                                                    <input type="text" class="form-control" name="sub_category" value="<?php echo $sub_category; ?>" required />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Type</label>
                                                    <input type="text" class="form-control" name="type" value="<?php echo $type; ?>" required />
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Brand / Model</label>
                                                    <input type="text" class="form-control" name="brand" value="<?php echo $brand; ?>" required />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Quantity</label>
                                                    <input type="number" min="1" class="form-control" name="quantity" value="<?php echo $quantity; ?>" required />
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Picture <small class="text-warning">Leave blank if you don't want to update the picture.</small></label>
                                                    <input type="file" class="form-control" name="picture" />
                                                </div>
                                            </div>
                                        </div>
                                        <br />
                                        <a href="manage_asset.php" class="btn btn-outline-dark">
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
