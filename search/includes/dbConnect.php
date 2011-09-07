<?php

class BackEnd
{
	/**
	*	This class contains all the functions which help in connecting to the database.
	*	This class has been implemented keeping in mind the deploy-time troubles.
	* 	Assume that when you deploy there is a different password for the database than the one you have used,
	*	you need not go all around your files and change the password in every file.
	*	Just change it here. :)
	*
	*	Sometimes when deploying you will be given a prefix for all your tables to differentiate your software tables
	*	from the others deployed. Again changing the table name everywhere is tough. So you can use the getTableName function
	*	which adds the necessary prefix :)
	*/
	private $prefix = "";
	
	function connectToSearchDb()
	{
		$database = "search";	
		$con = mysql_connect("localhost", "root", "") or die("Cannot connect to database:".mysql_error());
		$db = mysql_select_db($database, $con) or die("Database not found:".mysql_error());
		
		return $con;
	}
	
	function getTableName($tablename)
	{
		return $prefix.$tablename;
	}
}

?>