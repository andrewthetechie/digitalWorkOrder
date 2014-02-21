<?php
	include('includes/php/header.php');


	if(!isset($_SESSION['username']) || !isset($_SESSION['permLevel'])){
		header("Location: logout.php");
		exit();
	}

	if($_SESSION['permLevel'] < 5) // user not an admin
	{
		header("Location: logout.php");
		exit();
	}
	include('includes/php/htmlHeader.php');
	?>
	<body>
	<div class="container">
	
	<?php include('includes/php/navbar.php'); 

	if(isset($_POST['action']))
	{
		//process forn
		$email = $_POST['email'];
		$result = false;
		if(!filter_var($email, FILTER_VALIDATE_EMAIL))
		{
			$result="Invalid Email. Please try again";
		}
		if(getUser($_POST['username']))	
		{
			$result .= "<br />User already exists. Please try again";
		}
		if(checkPasswordStrength($_POST['password']) < 3)
		{
			$result .= "<br />Password too weak. Please try again";
		}
		if(!$result)
		{
			
			$data = array();
			$data['username'] = clean($_POST['username']);
			$data['password'] = createPassword($_POST['password']);
			$data['email'] = $email;
			$data['permissionLevel'] = $_POST['permissionLevel'] - 1;
			$data['techname'] = $_POST['techname'];
			$result = addUser($data);

			if(count($result) == 0)
				$result = "User added";
			else
				$result = "Error";
		}
		echo "<h3>$result</h3>";
	}
?>

<form class="form-horizontal" action="addUser.php" method="POST">
<fieldset>
<input type="hidden" name="action" value="addUser" />
<!-- Form Name -->
<legend>Add A User</legend>

<!-- Text input-->
<div class="control-group">
  <label class="control-label" for="username">UserName:</label>
  <div class="controls">
    <input id="username" name="username" placeholder="username" class="input-xlarge" required="" type="text">
    <p class="help-block">No spaces or special characters</p>
  </div>
</div>

<!-- Text input-->
<div class="control-group">
  <label class="control-label" for="password">Password</label>
  <div class="controls">
    <input id="password" name="password" placeholder="***********" class="input-xlarge" required="" type="text">
    <p class="help-block">No spaces</p>
  </div>
</div>
<!-- Text input-->
<div class="control-group">
  <label class="control-label" for="techname">User's Name</label>
  <div class="controls">
    <input id="techname" name="techname" placeholder="John Doe" class="input-xlarge" required="" type="text">
    
  </div>
</div>
<!-- Text input-->
<div class="control-group">
  <label class="control-label" for="email">User's Email</label>
  <div class="controls">
    <input id="email" name="email" placeholder="name@domain.com" class="input-xlarge" required="" type="text">
    <p class="help-block">Valid email address required</p>
  </div>
</div>
<!-- Select Basic -->
<div class="control-group">
  <label class="control-label" for="permissionLevel">Permission Level</label>
  <div class="controls">
    <select id="permissionLevel" name="permissionLevel" class="input-large">
      <option value="1">Contractor</option>
      <option value="2">Tech1</option>
      <option value="3">Tech2</option>
      <option value="4">Dispatch</option>
      <option value="5">Billing</option>
      <option value="6">Admin</option>
    </select>
  </div>
</div>
<!-- Button -->
<div class="control-group">
  <label class="control-label" for="submit"></label>
  <div class="controls">
    <button id="submit" name="submit" class="btn btn-success">Create User</button>
  </div>
</div>

</fieldset>
</form>
<?php 

	include('includes/php/footer.php');
?>
