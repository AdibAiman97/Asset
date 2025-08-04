<nav class="navbar default-layout col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
      <div class="text-center navbar-brand-wrapper d-flex align-items-top justify-content-center">
        <a class="navbar-brand brand-logo" href="index.php">
          <h3 class="page-title">STDC Asset</h3>
        </a>
        <a class="navbar-brand brand-logo-mini" href="index.php">
           <h5 class="page-title">STDC Asset</h5>
        </a>
      </div>
      <div class="navbar-menu-wrapper d-flex align-items-center">
        
        <ul class="navbar-nav navbar-nav-right">
         <?php
		 
			//top menu admin
			if($_SESSION['UserLvl'] == 1)
			{
				//get admin details
				$sql = mysqli_query($conn, "SELECT * FROM admin WHERE username = '$_SESSION[UserID]'");
				$row = mysqli_fetch_array($sql);
			  
				echo "<li class='nav-item dropdown  d-xl-inline-block'>
						<a class='nav-link dropdown-toggle' id='UserDropdown' href='#' data-toggle='dropdown' aria-expanded='false'>
						  <span class='profile-text'>Welcome!</span>
						  <img class='img-xs rounded-circle' src='photo/$row[photo]' alt='Profile image'>
						</a>
						<div class='dropdown-menu dropdown-menu-right navbar-dropdown' aria-labelledby='UserDropdown'>
						  <a href='profile_admin.php' class='dropdown-item mt-2'>
							<i class='mdi mdi-account-outline'></i>	Profile
							</a>
						  <a href='update_password.php' class='dropdown-item'>
							<i class='mdi mdi-lock-outline'></i> Password
						  </a>
						  <a href='logout.php' class='dropdown-item'>
							<i class='mdi mdi-arrow-top-right'></i> Logout
						  </a>
						</div>
					  </li>";
				
			}
			
			//top menu staff
			else if($_SESSION['UserLvl'] == 2)
			{
				//get staff details
				$sql = mysqli_query($conn, "SELECT * FROM staff WHERE username = '$_SESSION[UserID]'");
				$row = mysqli_fetch_array($sql);
				
				echo "<li class='nav-item dropdown  d-xl-inline-block'>
						<a class='nav-link dropdown-toggle' id='UserDropdown' href='#' data-toggle='dropdown' aria-expanded='false'>
						  <span class='profile-text'>Welcome!</span>
						  <img class='img-xs rounded-circle' src='photo/$row[photo]' alt='Profile image'>
						</a>
						<div class='dropdown-menu dropdown-menu-right navbar-dropdown' aria-labelledby='UserDropdown'>
						  <a href='profile_staff.php' class='dropdown-item mt-2'>
							<i class='mdi mdi-account-outline'></i>	Profile
							</a>
						  <a href='update_password.php' class='dropdown-item'>
							<i class='mdi mdi-lock-outline'></i> Password
						  </a>
						  <a href='logout.php' class='dropdown-item'>
							<i class='mdi mdi-arrow-top-right'></i> Logout
						  </a>
						</div>
					  </li>";
					  
				
			}
			
		 ?>
          
        </ul>
		<button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
          <span class="mdi mdi-menu"></span>
        </button>
        
      </div>
    </nav>