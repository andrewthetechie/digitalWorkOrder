<?php

	//************************path defines
	define("BASEPATH","http://192.168.1.185/");
	define("APPLICATIONPATH","/var/www");
	define("TEMPPATH",APPLICATIONPATH.DIRECTORY_SEPARATOR."temp");

	//***********************general defines	
		//the offset for work orders so they dont start at 1
	define("WORK_ORDER_OFFSET",9000);

	//***********************database defines	
	define("DB_SERVER","localhost");
	define("DB_PORT",3306);
	define("DB_NAME","digitalWorkOrders");
	define("DB_USER","dWo_dbu");
	define("DB_PASS","zbA5A40z");

	//**************************email defines
	define("MAIL_TYPE", "smtp"); //can be smtp or php
	//only needed if mail_type is smtp
	define("SMTP_HOST", "71.40.14.50");
	define("SMTP_PORT", "25");
	define("SMTP_USER", "andrew@vndx.com");
	define("SMTP_PASS", "!c3987v");
	//This email is for internal communication, forgot password, etc
	define("INTERNAL_FROM_ADDRESS","support@vndtechs.com");
	//This email is used for communication with customer
	define("EXTERNAL_FROM_ADDRESS","billing@vndtechs.com");
	
	//*****************Logging defines
	//can be db or file
	define("LOG_TYPE","db");
		//these settings apply to file logging
		define("LOG_FILE_NAME","dwo.log");
		//full path to the log file, minus trailing /
		define("LOG_FILE_PATH","/var/www/log");
	
		//these settings applt to db logging
		define("LOG_DB_SERVER",DB_SERVER);
		define("LOG_DB_PORT",DB_PORT);
		define("LOG_DB_NAME",DB_NAME);
		define("LOG_DB_USER",DB_USER);
		define("LOG_DB_PASS",DB_PASS);
		define("LOG_DB_TABLE","dwoLog");

//-------------------------------------------------------------
	//No need to edit under this line	
	define("PROGRAMNAME","Digital Work Orders");
	define("PROGRAMVERSION","0.1");
	define("PUBLISHDATE","9/11/13");

?>
