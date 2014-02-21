<?php

	include('includes/php/functions.php');

	$refer = $_SERVER['HTTP_REFERER'];
	$refer = explode("?",$refer);

	$refer = $refer[0];
	
	//gets a user from what was passed as username
	$user = getUser($_POST['username']);

	//if the referrer isnt the main index page, what was passed isnt a user
	//or the user passed a number only, return back to index.php
	if($refer != BASEPATH ."index.php" || !$user || 
		ctype_digit($_POST['username']))
	{
		header('Location: index.php?status=forgotBad');
		exit();
	}

	$id = $user->id;
	$random = substr(md5(rand()), 0, 12);
	$hash = password_hash($random , PASSWORD_DEFAULT); 	

	$query="update users set forgotPassword=1, ";
	$query.="forgotPasswordHash=:hash where id=:userid";
	$statement = $db->prepare($query);
	$data = array(':hash'=>$hash,':userid'=>$id); 
	$statement -> execute($data);

	
	
		
	

?>
