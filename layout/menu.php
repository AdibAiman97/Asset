<nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
          
		  
		  <?php
		  
		  //menu admin
		  if($_SESSION['UserLvl'] == 1)
		  {
			  //get admin details
			  $sql = mysqli_query($conn, "SELECT * FROM admin WHERE username = '$_SESSION[UserID]'");
			  $row = mysqli_fetch_array($sql);
			  
			  echo "<li class='nav-item nav-profile'>
					<div class='nav-link'>
					  <div class='user-wrapper'>
						<div class='profile-image'>
						  <img src='photo/$row[photo]' alt='profile image'>
						</div>
						<div class='text-wrapper'>
						  <p class='profile-name'>$row[name]</p>
						  <div>
							<small class='designation text-muted'>Admin</small>
							<span class='status-indicator online'></span>
						  </div>
						</div>
					  </div>
					</div>
				  </li>";
				  
			  echo "<li class='nav-item'>
					<a class='nav-link' href='dashboard.php'>
					  <i class='menu-icon hgi-stroke hgi-dashboard-square-01'></i>
					  <span class='menu-title'>Dashboard</span>
					</a>
				  </li>
				  
				  
				  <li class='nav-item'>
					<a class='nav-link' data-toggle='collapse' href='#ui-staff' aria-expanded='false' aria-controls='ui-basic'>
					 <i class='menu-icon hgi-stroke hgi-user-star-01'></i>
					  <span class='menu-title'>Staff</span>
					  <i class='menu-arrow'></i>
					</a>
					<div class='collapse' id='ui-staff'>
					  <ul class='nav flex-column sub-menu'>
						<li class='nav-item'>
						  <a class='nav-link' href='register_staff.php'>Register Staff</a>
						</li>
						<li class='nav-item'>
						  <a class='nav-link' href='manage_staff.php'>Manage Staff</a>
						</li>
					  </ul>
					</div>
				  </li>
				  
				  <li class='nav-item'>
						<a class='nav-link' data-toggle='collapse' href='#ui-aset' aria-expanded='false' aria-controls='ui-basic'>
						  <i class='menu-icon hgi-stroke hgi-file-02'></i>
						  <span class='menu-title'>Asset</span>
						  <i class='menu-arrow'></i>
						</a>
						<div class='collapse' id='ui-aset'>
						  <ul class='nav flex-column sub-menu'>
							<li class='nav-item'>
							  <a class='nav-link' href='add_asset.php'>Add Asset</a>
							</li>
							<li class='nav-item'>
							  <a class='nav-link' href='manage_asset.php'>Manage Asset</a>
							</li>
						  </ul>
						</div>
					  </li>
				  
				  
				  
				  <li class='nav-item'>
						<a class='nav-link' data-toggle='collapse' href='#ui-receive' aria-expanded='false' aria-controls='ui-basic'>
						  <i class='menu-icon hgi-stroke hgi-image-done-02'></i> 
						  <span class='menu-title'>Receive</span>
						  <i class='menu-arrow'></i>
						</a>
						<div class='collapse' id='ui-receive'>
						  <ul class='nav flex-column sub-menu'>
							<li class='nav-item'>
							  <a class='nav-link' href='receive_form.php'>Receive Form</a>
							</li>
							<li class='nav-item'>
							  <a class='nav-link' href='receive_list.php'>Receive List</a>
							</li>
						  </ul>
						</div>
					  </li>
				  
				 
				  <li class='nav-item'>
					<a class='nav-link' data-toggle='collapse' href='#ui-register' aria-expanded='false' aria-controls='ui-basic'>
					  <i class='menu-icon hgi-stroke hgi-image-add-02'></i>
					  <span class='menu-title'>Register</span>
					  <i class='menu-arrow'></i>
					</a>
					<div class='collapse' id='ui-register'>
					  <ul class='nav flex-column sub-menu'>
						<li class='nav-item'>
						  <a class='nav-link' href='registration_form.php'>Registration Form</a>
						</li>
						<li class='nav-item'>
						  <a class='nav-link' href='registration_list.php'>Registration List</a>
						</li>
					  </ul>
					</div>
				  </li>
				 
				  <li class='nav-item'>
					<a class='nav-link' data-toggle='collapse' href='#ui-inspection' aria-expanded='false' aria-controls='ui-basic'>
					  <i class='menu-icon hgi-stroke hgi-image-crop'></i>
					  <span class='menu-title'>Inspection</span>
					  <i class='menu-arrow'></i>
					</a>
					<div class='collapse' id='ui-inspection'>
					  <ul class='nav flex-column sub-menu'>
						<li class='nav-item'>
						  <a class='nav-link' href='inspection_form.php'>Inspection Form</a>
						</li>
						<li class='nav-item'>
						  <a class='nav-link' href='inspection_list.php'>Inspection List</a>
						</li>
					  </ul>
					</div>
				  </li>
				 
				  <li class='nav-item'>
					<a class='nav-link' data-toggle='collapse' href='#ui-disposal' aria-expanded='false' aria-controls='ui-basic'>
					  <i class='menu-icon hgi-stroke hgi-image-delete-02'></i> 
					  <span class='menu-title'>Disposal</span>
					  <i class='menu-arrow'></i>
					</a>
					<div class='collapse' id='ui-disposal'>
					  <ul class='nav flex-column sub-menu'>
						<li class='nav-item'>
						  <a class='nav-link' href='disposal_form.php'>Disposal Form</a>
						</li>
						<li class='nav-item'>
						  <a class='nav-link' href='disposal_list.php'>Disposal List</a>
						</li>
					  </ul>
					</div>
				  </li>
				  
				  <li class='nav-item'>
					<a class='nav-link' href='qrcode.php'>
					  <i class='menu-icon hgi-stroke hgi-qr-code-01'></i> 
					  <span class='menu-title'>QR Code</span>
					</a>
				  </li>
				  
				  
				  
				  ";
		  }
		  
		  //menu Staff
		  else if($_SESSION['UserLvl'] == 2)
		  {
			  //get admin details
			  $sql = mysqli_query($conn, "SELECT * FROM staff WHERE username = '$_SESSION[UserID]'");
			  $row = mysqli_fetch_array($sql);
			  
			  echo "<li class='nav-item nav-profile'>
					<div class='nav-link'>
					  <div class='user-wrapper'>
						<div class='profile-image'>
						  <img src='photo/$row[photo]' alt='profile image'>
						</div>
						<div class='text-wrapper'>
						  <p class='profile-name'>$row[name]</p>
						  <div>
							<small class='designation text-muted'>Staff</small>
							<span class='status-indicator online'></span>
						  </div>
						</div>
					  </div>
					</div>
				  </li>";
				  
			  echo "<li class='nav-item'>
					<a class='nav-link' href='dashboard.php'>
					  <i class='menu-icon hgi-stroke hgi-dashboard-square-01'></i>
					  <span class='menu-title'>Dashboard</span>
					</a>
				  </li>
				  
				  
				  <li class='nav-item'>
						<a class='nav-link' data-toggle='collapse' href='#ui-aset' aria-expanded='false' aria-controls='ui-basic'>
						  <i class='menu-icon hgi-stroke hgi-file-02'></i>
						  <span class='menu-title'>Asset</span>
						  <i class='menu-arrow'></i>
						</a>
						<div class='collapse' id='ui-aset'>
						  <ul class='nav flex-column sub-menu'>
							<li class='nav-item'>
							  <a class='nav-link' href='add_asset.php'>Add Asset</a>
							</li>
							<li class='nav-item'>
							  <a class='nav-link' href='manage_asset.php'>Manage Asset</a>
							</li>
						  </ul>
						</div>
					  </li>
				  
				  
				  
				  <li class='nav-item'>
						<a class='nav-link' data-toggle='collapse' href='#ui-receive' aria-expanded='false' aria-controls='ui-basic'>
						  <i class='menu-icon hgi-stroke hgi-image-done-02'></i> 
						  <span class='menu-title'>Receive</span>
						  <i class='menu-arrow'></i>
						</a>
						<div class='collapse' id='ui-receive'>
						  <ul class='nav flex-column sub-menu'>
							<li class='nav-item'>
							  <a class='nav-link' href='receive_form.php'>Receive Form</a>
							</li>
							<li class='nav-item'>
							  <a class='nav-link' href='receive_list.php'>Receive List</a>
							</li>
						  </ul>
						</div>
					  </li>
				  
				 
				  <li class='nav-item'>
					<a class='nav-link' data-toggle='collapse' href='#ui-register' aria-expanded='false' aria-controls='ui-basic'>
					  <i class='menu-icon hgi-stroke hgi-image-add-02'></i>
					  <span class='menu-title'>Register</span>
					  <i class='menu-arrow'></i>
					</a>
					<div class='collapse' id='ui-register'>
					  <ul class='nav flex-column sub-menu'>
						<li class='nav-item'>
						  <a class='nav-link' href='registration_form.php'>Registration Form</a>
						</li>
						<li class='nav-item'>
						  <a class='nav-link' href='registration_list.php'>Registration List</a>
						</li>
					  </ul>
					</div>
				  </li>
				 
				  <li class='nav-item'>
					<a class='nav-link' data-toggle='collapse' href='#ui-inspection' aria-expanded='false' aria-controls='ui-basic'>
					  <i class='menu-icon hgi-stroke hgi-image-crop'></i>
					  <span class='menu-title'>Inspection</span>
					  <i class='menu-arrow'></i>
					</a>
					<div class='collapse' id='ui-inspection'>
					  <ul class='nav flex-column sub-menu'>
						<li class='nav-item'>
						  <a class='nav-link' href='inspection_form.php'>Inspection Form</a>
						</li>
						<li class='nav-item'>
						  <a class='nav-link' href='inspection_list.php'>Inspection List</a>
						</li>
					  </ul>
					</div>
				  </li>
				 
				  <li class='nav-item'>
					<a class='nav-link' data-toggle='collapse' href='#ui-disposal' aria-expanded='false' aria-controls='ui-basic'>
					  <i class='menu-icon hgi-stroke hgi-image-delete-02'></i> 
					  <span class='menu-title'>Disposal</span>
					  <i class='menu-arrow'></i>
					</a>
					<div class='collapse' id='ui-disposal'>
					  <ul class='nav flex-column sub-menu'>
						<li class='nav-item'>
						  <a class='nav-link' href='disposal_form.php'>Disposal Form</a>
						</li>
						<li class='nav-item'>
						  <a class='nav-link' href='disposal_list.php'>Disposal List</a>
						</li>
					  </ul>
					</div>
				  </li>
				  
				  
				  
				  ";
		  }
		  
		 
		  
		  ?>
          
         
          
        </ul>
      </nav>