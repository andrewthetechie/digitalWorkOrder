		<div class="row">
			<div class="span12">
				<div class="navbar">
					<div class="navbar-inner">
						
						<ul class="nav">
							<li><a href="index.php">Home</a></li>
							<li class="dropdown">
								<a class="dropdown-toggle" data-toggle="dropdown" href="#">
									Work Orders <b class="caret"></b>
								</a>
								
								<ul class="dropdown-menu">
									<li><a href="myWorkOrders.php">My Work Orders</a></li>
									<?php if($_SESSION['permLevel'] > 0){ //only available to tech2 or higher?>
									<li><a href="newWorkOrder.php">Add New Work Order</a></li>
									<? } ?>
									<?php if($_SESSION['permLevel'] > 1){ //only available to tech3 or higher?>
									<li><a href="listWorkOrders.php">All Work Orders</a></li>
									<? } ?>
								</ul>
								
							</li>
							<?php if($_SESSION['permLevel'] > 0){ //only available to tech2 or higher?>
							<li class="dropdown">
								<a class="dropdown-toggle" data-toggle="dropdown" href="#">
									Clients <b class="caret"></b>
								</a>
								
								<ul class="dropdown-menu">
									<?php if($_SESSION['permLevel'] > 0){ //only available to tech2 or higher?>
									<li><a href="newClient.php">Add New Client</a></li>
									<? } ?>
									<?php if($_SESSION['permLevel'] > 3){ //only available to dispatch or higher?>
									<li><a href="listClients.php">List All Clients</a></li>
									<? } ?>
								</ul>
								
							</li>
							<? } ?>
							<li class="dropdown">
								<a class="dropdown-toggle" data-toggle="dropdown" href="#">
									My Profile <b class="caret"></b>
								</a>
								
								<ul class="dropdown-menu">
									<li><a href="editProfile.php">Edit My Profile</a></li>
									<li><a href="changePassword.php">Change Password</a></li>
								</ul>
								
							</li>
							<?php if($_SESSION['permLevel'] > 3){ //only available to billing or higher?>
							<li class="dropdown">
								<a class="dropdown-toggle" data-toggle="dropdown" href="#">
									Billing <b class="caret"></b>
								</a>
								
								<ul class="dropdown-menu">
									<li><a href="openWorkOrders.php">View Open Work Orders</a></li>
									<li><a href="reports.php?report=">Report1</a></li>
									<li><a href="reports.php?report=">Report2</a></li>
								</ul>
								
							</li>
							<? } ?>
							<?php if($_SESSION['permLevel'] > 4){ //only available to Admin or higher?>
							<li class="dropdown">
								<a class="dropdown-toggle" data-toggle="dropdown" href="#">
									Admin <b class="caret"></b>
								</a>
								
								<ul class="dropdown-menu">
									<li><a href="addUser.php">Add New User</a></li>
									<li><a href="editUser.php">Edit A User</a></li>
									<li><a href="changePassword.php">Change User Passwords</a></li>
								</ul>
								
							</li>
							<? } ?>
						
					
							<li><a href="logout.php">Logout</a></li>
							
						</ul>
						
					</div>
				</div>
				
			</div>
		</div>
