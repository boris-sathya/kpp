<?php 
	$rootdir = "../../";
	$cssroot = "../../css/"; 
	$imagesroot = "../../images/";
	$jsroot = "../../js/";
	$modulesroot = "../../modules/";
	$cacheroot = "../../kppsearch/";
	$includesroot = "../../includes/";
	include($modulesroot.'switcher/switcher.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>Update Cache</title>
  <link rel="stylesheet" type="text/css" href="" />
</head>
<body>
  <img name="kpplogo" src="<?php echo $imagesroot; ?>image.jpg" width="500" height="100" border="0" alt="K++ LOGO" />
  <p>Please select the links that need to be updated to the cache</p>
  <form method="post" action="<?php echo $_SERVER['../cacheupdate/PHP_SELF']; ?>">
Type in the URL you want to Update :<input type="text" name="inp"  >
    <input type="submit" name="submit" value="Update" />
<?php

 include_once($includesroot.'dbConnect.php');
		
		$db = new BackEnd();
		$con = $db->connectToSearchDb();

  if (isset($_POST['submit'])) 
  {
    foreach ($_POST['todelete'] as $update_id) 
	{
		
		$query="insert into waiting values('".$update_id."',CURRENT_TIMESTAMP)";

		$result1=mysql_query($query,$con);
    
    } 
	if(isset($_POST['inp']))
					{
						$query="insert into waiting values('".$_POST['inp']."',CURRENT_TIMESTAMP)";

		$result1=mysql_query($query,$con);
					}

    echo 'Cache  Updated.<br />';
	
	echo "Successfully Updated!";
  }

  // Display the customer rows with checkboxes for deleting
/*  $query = "SELECT * FROM completed";
 $result = mysql_query($query, $con) or die("Query execution failed:".mysql_error());
  while ($row = mysql_fetch_array($result))
  {
	
    echo '<input type="checkbox" value="' . $row['URL'] . '" name="todelete[]" />';
    echo $row['URL'];
    echo '<br />';
  }*/
  mysql_close($con);
?>
  </form>
</body>
</html>
