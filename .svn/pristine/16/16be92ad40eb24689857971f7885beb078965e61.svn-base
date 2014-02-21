<?php
	include("config.php");
	include("password.php");


	//*******************Wordk Order Functions********************
        //Functions that work with Work Orders
	
	//reutnrs an array of open work orders for a user, ordered by date
	function getActiveWorkOrders($user)
	{
		$user = getUser($user);

		$db = dbConnect();
		$query = "select A.id,B.companyName,A.startdate from ";
		$query .= "workOrders A INNER JOIN customers B on ";
		$query .= "(A.companyId = B.id) where A.assignedUser=? ";
		$query .= " and A.status<=2";

		$data=array($user->id);

		$statement = $db -> prepare($query);
		$statement->execute($data);
		$result = $statement->fetchAll();

		return($result);	
	}


	//*******************User Functions********************
        //Functions that work with users
	function addUser($userData)
	{
		$db = dbConnect();
		$query = "insert into users ";
		$query .= "(id,username,password,email,permLevel,";
		$query .= "techName) VALUES ";
		$query .= "(NULL,:user,:pass,:email,:perm,:techName)";
		
		$data = array();
		$data[':user'] = $userData['username'];
		$data[':pass'] = $userData['password'];
		$data[':email'] = $userData['email'];
		$data[':perm'] = $userData['permissionLevel'];
		$data[':techName'] = $userData['techname'];
		$statement = $db -> prepare($query);
		$statement->execute($data);
		$result = $statement->fetchAll();

		return $result;
	}

	function deleteUser($user)
	{

	}	
	
	//takes a username, id, or email in as argument
	//returns an object of user data
	function getUser($identifier)
	{
		$db = dbConnect();

		//first determine if an email or something else has been passed
		if(filter_var($identifier, FILTER_VALIDATE_EMAIL)) 
		{
			// email was passed
			$query = "select * from users where email=?";
			$statement = $db->prepare($query);
			$statement->execute(array($identifier));
			$row = $statement -> fetchObject();
		}
		else 
		{
			//not an email passed in, test if entirely numeric
			if(ctype_digit($identifier))
			{
				$query = "select * from users where id=?";
				$statement = $db->prepare($query);
				$statement->execute(array($identifier));
				$row = $statement -> fetchObject();
			}
			else
			{
				//username passed in
				$query = "select * from users where username=?";
				$statement = $db->prepare($query);
				$statement->execute(array($identifier));
				$row = $statement -> fetchObject();
			
			}
		}
		//prepare return variable
		if(!$row)
		{		
			//identifier doesnt match a user
			$toReturn = false;
		}
		else
		{
			//prepare user object to return
			$toReturn = $row;
		}

		return $toReturn;

	}

	function getUserList()
	{
		$db = dbConnect();
		$query = "select id,username,techName,email from users";
		$query.= " order by username";
		$statement = $db -> prepare($query);
		$statement->execute(array());
		$userList = array();
		for($i=0; $row=$statement->fetchObject(); $i++)
		{
			$thisUser = array();
			$thisUser['id'] = $row->id;
			$thisUser['username'] = $row->username;
			$thisUser['techName'] = $row->techName;
			$thisUser['email'] = $row->email;
			$userList[$i] = $thisUser;	
		}
		return $userList;

	}

	function getUserLookupTable()
	{
	}
	
	function createPassword($string)
	{
		return password_hash($string, PASSWORD_DEFAULT);
	}
	
	//changes a user's password
	//user = username
	//pass = unhashed new password	
	function changePassword($user,$pass)
	{
		$query="update users set password=:hash where username=:user";
		$data = array();
			$data[':hash'] = createPassword($pass);
			$data[':user'] = $user;
		$db = dbConnect();
		$statement = $db->prepare($query);
		$statement->execute($data);
	}

	//returns true is a user has a forgotpassword hash and flag set
	function checkForgotPassword($user)
	{
		$db = dbConnect();
		$query = "select id from users where username=? and ";
		$query .="forgotPassword=1 and forgotPasswordHash IS NOT NULL";

		$statement = $db->prepare($query);
		$statement->execute(array($user));
		$row = $statement -> fetchObject();
		if($row->id > 0)
			$toReturn = true;
		else
			$toReturn = false;
		
		return $toReturn;

	}

	//returns a password strenght score from 0-5, 0 being very weak
	//Argument:
	//$password - the password to check
	function checkPasswordStrength($pwd) 
	{
		$score = 1;

		if (strlen($pwd) < 1)
		{
			return $strength[0]; 
		}
		if (strlen($pwd) < 4)
		{
			return $strength[1]; 
		}

		if (strlen($pwd) >= 8)
		{
			$score++; 
		}
		if (strlen($pwd) >= 10)
		{
			$score++; 
		}

		if (preg_match("/[a-z]/", $pwd) && preg_match("/[A-Z]/", $pwd)) 
		{
			$score++; 
		}
		if (preg_match("/[0-9]/", $pwd)) 
		{
			$score++; 
		}
		if (preg_match("/.[!,@,#,$,%,^,&,*,?,_,~,-,£,(,)]/", $pwd)) 
		{
			$score++; 
		}

		return $score;
	}

	//*******************Mail Functions************************

        //sends an email message
	//arguments
	//To: the address to send to
	//Type: internal or external, determines from
	//Message: array('Subject'=>"Message Subject",'Data'=>'Message')
	//Attachment: FALSE if no attachment, array of attachment paths
	function sendEmail($to,$type,$message,$attachment)
	{
		$validTo = filter_var($to, FILTER_VALIDATE_EMAIL);

		if($validTo)
		{
			switch($type)
			{
				case 'internal':
				default:
					$from = INTERNAL_FROM_ADDRESS;
					break;
			
				case 'external':
					$from= EXTERNAL_FROM_ADDRESS;
					break;
			}

			switch(MAIL_TYPE)
			{
			case 'php':
			default:
			$uid = md5(uniqid(time()));

			$header = "From: ".$from." <".$from.">\r\n";
			$header .= "Reply-To: ".$from."\r\n";
			$header .= "MIME-Version: 1.0\r\n";
			$header .= "Content-Type: multipart/mixed; boundary=\"";
			$header .=$uid."\"\r\n\r\n";
			$header .= "This is a multi-part message in MIME format";
			$header .= ".\r\n";
			$header .= "--".$uid."\r\n";
			$header .= "Content-type:text/html; charset=iso-8859-1";
			$header .="\r\n";
			$header .= "Content-Transfer-Encoding: 7bit\r\n\r\n";
			$header .= $message['data']."\r\n\r\n";
			
			if($attachment)
			{
			foreach ($attachment as $filename) 
			{ 
				$file = $path.$filename;
				$name = basename($file);
				$file_size = filesize($file);
				$handle = fopen($file, "r");
				$content = fread($handle, $file_size);
				fclose($handle);
				$content = chunk_split(base64_encode($content));

				$header .= "--".$uid."\r\n";
				// use different content types here
				$header .= "Content-Type: ";
				$header .= "application/octet-stream; name=\"";
				$header .= $filename."\"\r\n"; 
				
				$header .= "Content-Transfer-Encoding: base64";
				$header .= "\r\n";
				$header .= "Content-Disposition: attachment; ";
				$header .= "filename=\"".$filename."\"\r\n\r\n";
				$header .= $content."\r\n\r\n";
			}//end loop
			}//end attachment found

			$header .= "--".$uid."--";
			
			$toReturn = mail($to,$message['subject'],
				"",$header);
			break; //end php mail

			case 'smtp':
			//send messages via SMTP
			include('class.phpmailer.php');
			$mail = new PHPMailer;
			$mail->IsSMTP();
			$mail->Host = SMTP_HOST;
			$mail->SMTPAuth = true;
			$mail->Username = SMTP_USER;
			$mail->Password = SMTP_PASS;
			$mail->From = $from;
			$mail->FromName = $from;
			$mail->AddReplyTo($from,$from);

			$mail->AddAddress($to);  // Add a recipient
			$mail->Subject = $message['subject'];
			$mail->Body    = $message['data'];

			if($attachment)
			{
			foreach ($attachment as $filename) 
			{ 
				$mail->addAttachment($filename);
			} //end loop
			}//end attachment foudn 
			if(!$mail->Send()) {
				logger("error",
				'Mailer Error: ' . $mail->ErrorInfo);
				$toReturn= FALSE;
			} else
			{
				$toReturn= TRUE;
			}
			break; //end SMTP mail
			

			} //end swithc
		} //end valid TO
		else
		{
			//To address is invalid, return false
			$toReturn = FALSE;
		}

		return $toReturn;
	}

	//*******************Logging Functions********************

	//calls methods to log based on LOG_TYPE
	//Arguments;
	//class - class of log, ie error, warning etc
	//message - The message to be logged
	function logger($class,$message)
	{	
		switch(LOG_TYPE)
		{
			case "file":
				fileLog($class,$message);
				break;
			
			case "db":
				dbLog($class,$message);
			
			default:
				echo "config.php is incorrect for logging type";
				echo "<br /> Please correct it and try again";
				exit();
				break;
		}
	}

	//logs to a file
	//called from logger
	//Arguments: 
	//class - class of log, i.e. error, warning, etc
	//message - the message to be logged
	function fileLog($class,$message)
	{
		$logFile = LOG_FILE_PATH . DIRECTORY_SEPARATOR . LOG_FILE_NAME;
		$timestamp = date("m.d.y,H:i:s");
		$logString = $timestamp.",".$class.",".$message."\n";
		echo "$logFile<br />$logString";
		file_put_contents($logFile,$logString, FILE_APPEND);	
	}

	//logs to a db table
	//called from logger
	//Arguments: 
	//class - class of log, i.e. error, warning, etc
	//message - the message to be logged
	function dbLog($class,$message)
	{
		$dsn = "mysql:host=".LOG_DB_SERVER;
		$dsn .=	";port=" .LOG_DB_PORT;
		$dsn .=	";dbname=".LOG_DB_NAME;
		$db = new PDO($dsn, LOG_DB_USER, LOG_DB_PASS); 
		
		if(!tableExists($db,LOG_DB_TABLE))
		{
			//log table hasn't been created, needs to be setup
			$fields = array('id'=>'INT AUTO_INCREMENT NOT NULL',
				'timestamp'=>'varchar(200) NOT NULL',
				'class'=>'varchar(200) NOT NULL',
				'message'=>'varchar(200) NOT NULL');
			createDBTable($db,LOG_DB_TABLE,$fields);	
		}
		$timestamp = date("m.d.y,H:i:s");
	
		$query = "INSERT INTO " . LOG_DB_TABLE; 
		$query.= " (id,timestamp,class,message) values ";
		$query.= "(NULL, :time, :class, :message)";

		$data = array();
		$data['time'] = $timestamp;
		$data['class'] = $class;
		$data['message'] = $message;

		$statement = $db->prepare($query);
		$statement->execute($data);	

		
	}


	//*******************Database Functions********************

        //connects to the database and returns a db object
        function dbConnect()
        {
		$dsn = "mysql:host=".DB_SERVER;
		$dsn .=	";port=" . DB_PORT;
		$dsn .=	";dbname=".DB_NAME;
		$db = new PDO($dsn, DB_USER, DB_PASS); 

                return $db;
        }	
	

	//cleans a string by replacing all spaces with a - and removes all
	//special chars
	function clean($string) {
		// Replaces all spaces with hyphens.
		$string = str_replace(" ", "-", $string); 
		// Removes special chars.
		$string = preg_replace('/[^A-Za-z0-9\-]/', '', $string); 
		// Replaces multiple hyphens with single one.
		return preg_replace('/-+/', '-', $string); 
	}
	
	//checks if the passed $tableName exists. Returns true/false
	//Arguments
	//db : pdo object
	//$tablename : name of the table to check for
	function tableExists($pdo, $table)
	{
		// Try a select statement against the table
		// Run it in try/catch in case PDO is in ERRMODE_EXCEPTION.
		try {
			$result = $pdo->query("SELECT 1 FROM $table LIMIT 1");
		} catch (Exception $e) {
			// We got an exception == table not found
			$result= FALSE;
		}

		// Result is either boolean FALSE (no table found) or 
		//PDOStatement Object (table found)
		return $result !== FALSE;
	}

	function createDBTable($pdo,$table,$fields)
	{

		$sql = "CREATE TABLE IF NOT EXISTS `$table` (";
		$pk  = '';

		foreach($fields as $field => $type)
		{
			$sql.= "`$field` $type,";

			if (preg_match('/AUTO_INCREMENT/i', $type))
			{
				$pk = $field;
			}
		}

		$sql = rtrim($sql,',') . ', PRIMARY KEY (`'.$pk.'`)';

		$sql .= ") CHARACTER SET utf8 COLLATE utf8_general_ci"; 
		if($pdo->exec($sql) !== false)
			$toReturn = true; 
		else
			$toReturn = false;

		return $toReturn;
	}
	
?>
