<?php

class keywordCheck
{	
	function intelliSense($searchqry, $includesroot)
	{
		include_once($includesroot.'dbConnect.php');
		$tablesUsed = array("COMPLETED");
		
		$db = new BackEnd();
		$con = $db->connectToSearchDb();
		
		$prefix=explode(':',$searchqry);
		
		switch($prefix[0])
		{
			case "cache": 	$qry = $prefix[1];
							$search='http://'.trim($qry);
							$query="select PATHINCACHE from ".$db->getTableName($tablesUsed[0])." where URL like '".$search."'";
							$result=mysql_query($query,$con) or die("Query failed");
							echo "Please wait., you are being redirected to ".$search."<br />";
							$row=mysql_fetch_array($result);
							if($row['PATHINCACHE'] != "")
							{
								$home_url='kppSearch/'.$row['PATHINCACHE'];
								echo "<script language='JavaScript'>parent.location='".$home_url."';</script>";
							}
							else
							{
								echo "NOT FOUND";
							}
							
							break;
							
			default:
							return 0; // If returned 0 then it means there were no keywords in the prefix
		}
		
		return 1; // Returning 1 means that it had keywords and they were processed :)
		
	}
	
}

?>