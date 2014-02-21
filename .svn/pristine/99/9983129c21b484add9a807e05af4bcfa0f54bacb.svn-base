<?php
	include("includes/php/functions.php");

	session_start();//need to start our session first, of course

	//check if any login data has been posted our way
	if ( !empty($_POST['username']) && !empty($_POST['password']) )
	{

		//assign input data to temp vars
		$username = $_POST['username'];
		$password = $_POST['password'];

		$query = "select password, permLevel from users where ";
		$query .= "deleted=0 and username = ?";
		$db = dbConnect();
		
	
	
		$statement = $db->prepare($query);		 
		$statement -> execute(array($_POST['username']));

		$row = $statement->fetchObject();

		//login is correct, username and pw match, user is an admin
		if(password_verify($password, $row->password))
		{
			echo "Password verified";	
			//time to set sessions and stuff
			$_SESSION['username'] = $username;
			$_SESSION['permLevel'] = $row->permLevel;

			//send the redirect header
			header('Location: index.php');
			exit();

		}//end of login is correct
		else{
			//login is bad, either role doesnt match or invalid 
			//username and password
			header('Location: index.php?status=Invalid');
			exit();
		}


	}//end of login data has been sent
	else{ //no login data sent, send back to login form
		header('Location: index.php?status=Invaild');
	}
?>
