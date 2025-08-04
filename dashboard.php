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
	.carousel-inner > .carousel-item {
	   height: 500px;
	}
	.carousel-caption {
	  top: 18rem;
	  z-index: 10;
	}
	#loadMore {
		padding-bottom: 30px;
		padding-top: 30px;
		text-align: center;
		width: 100%;
	}
	#loadMore a {
		display: inline-block;
		padding: 10px 30px;
		transition: all 0.25s ease-out;
		-webkit-font-smoothing: antialiased;
	}

	.card-link {
    text-decoration: none; /* Remove underline */
    color: black; /* Default link color */
}

.card-link:hover {
    color: red; /* Color when hovered */
}
	
</style>

<body>
  <div class="container-scroller">
  
    <!-- partial:partials/_navbar.html -->
	<?php include "layout/top.php";?>
    
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <!-- partial:partials/_sidebar.html -->
	  
	  <?php include "layout/menu.php"; ?>
      
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
		
		<?php
		
			date_default_timezone_set("Asia/Kuala_Lumpur");
			$today = date("Y-m-d");
								
			$todayString = str_replace('-', '/', $today);
			$todayStringFormat = date('d/m/Y', strtotime($todayString));
			
			//calculate total asset received
			$sqlReceive = mysqli_query($conn, "SELECT *, SUM(qty_receive) AS total_qty_received FROM receive");
			$rowReceive = mysqli_fetch_array($sqlReceive);
			
			//calculate total asset registration
			$sqlReg = mysqli_query($conn, "SELECT *, SUM(qty) AS total_registration FROM registration");
			$rowReg = mysqli_fetch_array($sqlReg);
			
			//calculate total asset inpsection
			$sqlInsp = mysqli_query($conn, "SELECT * FROM inspection");
			$numRowInsp = mysqli_num_rows($sqlInsp);
			
			
			//calculate total asset disposed
			$sqlDisposal = mysqli_query($conn, "SELECT *, SUM(qty) AS total_qty_disposed FROM disposal");
			$rowDisposal = mysqli_fetch_array($sqlDisposal);
			
			
			
							
			echo "<div class='row'>
					<div class='col-xl-3 col-lg-3 col-md-3 col-sm-6 grid-margin stretch-card'>
					<a href='receive_list.php' class='card-link'> 
					  <div class='card card-statistics bg-success'>
						<div class='card-body'>
						  <div class='clearfix'>
							<div class='float-left'>
							  <i class='hgi-stroke hgi-image-done-02 icon-lg'></i>
							</div>
							<div class='float-right'>
							  <p class='mb-0 text-right'>Receive</p>
							  <div class='fluid-container'>
								<h3 class='font-weight-medium text-right mb-0'>$rowReceive[total_qty_received]</h3>
							  </div>
							</div>
						  </div>
						  <p class='mt-3 mb-0'>
							<i class='mdi mdi-information mr-1' aria-hidden='true'></i> Total Asset Received
						  </p>
						</div>
						</a>
					  </div>
					</div>
					
					<div class='col-xl-3 col-lg-3 col-md-3 col-sm-6 grid-margin stretch-card'>
					<a href='registration_list.php' class='card-link'>
					  <div class='card card-statistics bg-primary'>
						<div class='card-body'>
						  <div class='clearfix'>
							<div class='float-left'>
							  <i class='hgi-stroke hgi-image-add-02 icon-lg'></i>
							</div>
							<div class='float-right'>
							  <p class='mb-0 text-right'>Register</p>
							  <div class='fluid-container'>
								<h3 class='font-weight-medium text-right mb-0'>$rowReg[total_registration]</h3>
							  </div>
							</div>
						  </div>
						  <p class='mt-3 mb-0'>
							<i class='mdi mdi-information mr-1' aria-hidden='true'></i> Total Asset Registered
						  </p>
						</div>
						</a>
					  </div>
					</div>
					
					<div class='col-xl-3 col-lg-3 col-md-3 col-sm-6 grid-margin stretch-card'>
					<a href='inspection_list.php' class='card-link'>
					  <div class='card card-statistics bg-warning'>
						<div class='card-body'>
						  <div class='clearfix'>
							<div class='float-left'>
							  <i class='hgi-stroke hgi-image-crop icon-lg'></i>
							</div>
							<div class='float-right'>
							  <p class='mb-0 text-right'>Inspection</p>
							  <div class='fluid-container'>
								<h3 class='font-weight-medium text-right mb-0'>$numRowInsp</h3>
							  </div>
							</div>
						  </div>
						  <p class='mt-3 mb-0'>
							<i class='mdi mdi-information mr-1' aria-hidden='true'></i> Total Asset Inspected
						  </p>
						</div>
						</a>
					  </div>
					</div>
					
					<div class='col-xl-3 col-lg-3 col-md-3 col-sm-6 grid-margin stretch-card'>
					<a href='disposal_list.php' class='card-link'>
					  <div class='card card-statistics bg-danger'>
						<div class='card-body'>
						  <div class='clearfix'>
							<div class='float-left'>
							  <i class='hgi-stroke hgi-image-delete-02 icon-lg'></i>
							</div>
							<div class='float-right'>
							  <p class='mb-0 text-right'>Disposal</p>
							  <div class='fluid-container'>
								<h3 class='font-weight-medium text-right mb-0'>$rowDisposal[total_qty_disposed]</h3>
							  </div>
							</div>
						  </div>
						  <p class='mt-3 mb-0'>
							<i class='mdi mdi-information mr-1' aria-hidden='true'></i> Total Asset Disposed
						  </p>
						</div>
						</a>
					  </div>
					</div>
					
				  </div>";
				 
				$act = $_GET['act'];

				if ($act == 'del') {
					$activity_id = $_GET['activity_id'];
					
					$delete = mysqli_query($conn, "DELETE FROM activity WHERE activity_id = '$activity_id'");
					
					if ($delete == true) {
						echo "<div class='alert alert-danger alert-dismissible'>
								  <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
								  <strong>Thank you!</strong> Activity successfully deleted.
							  </div>";
					} else {
						echo "<div class='alert alert-danger alert-dismissible'>
								  <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
								  <strong>Error!</strong> Failed to delete activity.
							  </div>";
					}
				}
			
			//display delete column for admin only
			if($_SESSION['UserLvl'] == 1)
			{
				$th = "<th></th>";
			}
			else if($_SESSION['UserLvl'] == 2)
			{
				$th = "";
			}
				  
				  
			echo "<div class='row'>
					<div class='col-lg-12 grid-margin'>
					  <div class='card'>
						<div class='card-body'>
						  <h4 class='card-title'>User Activity</h4>
						  <div class='table-responsive'>
							<table id='datatable' class='table dataTable no-footer' role='grid'>
							  <thead>
								<tr>
								  <th>Date</th>
								  <th>User</th>
								  <th>Position</th>
								  <th>Action</th>
								  <th>Item</th>
								  $th
								</tr>
							  </thead>
							  <tbody>";
							  
							  $sql = mysqli_query($conn, "SELECT * FROM activity ORDER BY activity_id DESC");
							  while($row = mysqli_fetch_array($sql))
							  {
								  $dateString = str_replace('-', '/', $row['activity_date']);
								  $dateStringFormat = date('d/m/Y', strtotime($dateString));
			
								  //get user position based on level
								  if($row['user_level'] == 1)
									  $table = "admin";
								  else if($row['user_level'] == 2)
									  $table = "staff";
								  
								  //display delete fn for admin only
								  if($_SESSION['UserLvl'] == 1)
								  {
									  $delete = "<td>
														<a href='dashboard.php?act=del&activity_id=$row[activity_id]'
														data-toggle='tooltip' data-placement='left' title='Remove'
														onclick=\"return confirm('Are you sure you want to remove this activity?');\">
															<i class='hgi-stroke hgi-delete-03 text-danger' style='font-size: 20px;'></i>
														</a>
													</td>";
								  }
								  else if($_SESSION['UserLvl'] == 2)
								  {
									 $delete = ""; 
								  }
									  
								  
								  $sqlPos = mysqli_query($conn, "SELECT * FROM `$table` WHERE username = '$row[user_id]'");
								  $rowPos = mysqli_fetch_array($sqlPos);
								  
								  echo "<tr>
										<td>$dateStringFormat</td>
										<td>$row[user_id]</td>
										<td>$rowPos[position]</td>
										<td>$row[action]</td>
										<td>$row[item]</td>
										$delete
									  </tr>";
							  }
								  
						echo"</tbody>
							</table>
						  </div>
						</div>
					  </div>
					</div>
				  </div>";
				  
			
		
		?>
          
          
         
        </div>
        <!-- content-wrapper ends -->
        <!-- partial:partials/_footer.html -->
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


</body>

</html>
<?php
}
?>