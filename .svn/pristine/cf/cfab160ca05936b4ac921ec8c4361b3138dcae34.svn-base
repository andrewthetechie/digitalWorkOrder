<?php
	
	include('includes/php/header.php');
	include('includes/php/htmlHeader.php');
	if(isset($_GET['status']))
	{
		switch($_GET['status'])
		{
			case 'Invalid':
				$status="Invalid Login";
				break;
			case 'forgotOk':
				$status="Password reset sent to your email";
				break;
			case 'forgotBad':
				$status="No user with that username or email";
				break;
			default:
				$status="huh?";
				break;
		}

	}

	?>
	<body>
	<div class="container">
	
	<?	
	if(!isset($_SESSION['username']) && !isset($_SESSION['permLevel'])){
?>

	<form action="login.php" method="post" name="login" target="_self" 
		id="login" class="form-horizontal">
		<h3><? if(isset($status)) echo $status; ?></h3>
	<fieldset>

	<!-- Form Name -->
	<legend>Login</legend>

	<!-- Text input-->
	<div class="control-group">
	  <label class="control-label" for="username">Username</label>
	  <div class="controls">
		<input id="username" name="username" type="text" placeholder="username"
			class="input-large" required="">
		
	  </div>
	</div>

	<!-- Password input-->
	<div class="control-group">
	  <label class="control-label" for="password">Password</label>
	  <div class="controls">
		<input id="password" name="password" type="password" 
			placeholder="**********" class="input-large" required="">
		
	  </div>
	</div>

	<!-- Button -->
	<div class="control-group">
	  <label class="control-label" for="submit"></label>
	  <div class="controls">
		<button id="submit" name="submit" class="btn btn-info">Login</button>
	  </div>
	</div>

	</fieldset>
	</form>

	<form class="form-horizontal" action="forgotPassword.php" method="POST">
	<fieldset>

	<!-- Form Name -->
	<legend>Forgot Password</legend>

	<!-- Text input-->
	<div class="control-group">
	  <label class="control-label" for="username">Username/Email</label>
	  <div class="controls">
	    <input id="username" name="username" placeholder="username" 
		class="input-xlarge" required="" type="text">
	    <p class="help-block">Enter your username or email</p>
	  </div>
	</div>

	<!-- Button -->
	<div class="control-group">
	  <label class="control-label" for="submit"></label>
	  <div class="controls">
	    <button id="submit" name="submit" 
		class="btn btn-info">Forgot Password</button>
	  </div>
	</div>

	</fieldset>
	</form>



<? 
	}//end user not logged in, show login form
	
	else{
	echo "<body>";
	include('includes/php/navbar.php'); 

	if(checkForgotPassword($_SESSION['username']))
	{
?>
	<h5>A request to reset your password has been made. If this is an 
	error, <a href='forgotPassword.php?action=clear'>click here</a> 
	to clear the request.</h5>

<?php } ?>
	
<?	
	include('includes/php/footer.php');
	}//end else
?>
