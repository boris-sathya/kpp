<?php 
	$rootdir = "";
	$cssroot = "css/";
	$imagesroot = "images/";
	$jsroot = "js/";
	$modulesroot = "modules/";
	$cacheroot = "kppsearch/";
	$includesroot = "includes/";
	require_once($modulesroot.'switcher/switcher.php');
	require_once($modulesroot.'search/searcher.php');
	require_once($modulesroot.'extensions/cache/cache.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>K++ Search</title>
<link rel="stylesheet" type="text/css" href="<?php if(isset($style)) { echo $cssroot.$style; } else { echo $cssroot.'modern.css';} ?>" />
<script type="text/javascript" src="<?php echo $jsroot; ?>selectlink.js" ></script>
<script type="text/javascript" src="<?php echo $jsroot; ?>validateInput.js" ></script>
<style type="text/css"> 
#clock { font-family: Arial, Helvetica, sans-serif; font-size: 0.8em; color: white; background-color: black; border: 2px solid purple; padding: 4px; }
</style> 
 
<script type="text/javascript" src="js/dateandtime.js"></script> 
</head>

<body onload="formatTime();"> 
<script type="text/javascript" src="http://shots.snap.com/ss/186a7aa23d7c443e50c0ba41d2be45f3/snap_shots.js"></script>
<div id ="wrapper">

<div style="width: 10em; margin: 20px;"> 
<form name="clock">&nbsp;
<input type="text" name="sivam" size="12" readonly="readonly" /><br />
 <label for="1"><input type="radio" id="1" name="sivamtime" checked /><font face="verdana, arial, helvetica, ms sans serif" size="1">12 Hour Format</font></label><br />
    <label for="2"><input type="radio" id="2" name="sivamtime" /><font face="verdana, arial, helvetica, ms sans serif" size="1">24 Hour Format</font></label></form> 
</div> 
<?php 
print  date("l dS  F Y ");?> 
<center>
<div class="img">
  <a target="_blank" href="index.php">
  <img src="<?php echo $imagesroot; ?>image.jpg" alt="K++ Search" width="300" height="100" />
  </a></div>
  </center>
  <center>
  <form method="get" action="searchresults.php" onSubmit="return validate(this);" >
		<input name="inputbox" type="text" size="55" /></br></br>
		<input type="submit" value="Search" />
        <input type="submit" value="I'm Feeling Lucky" name="lucky" />
	</form></center>
	<hr />
    <a href="<?php echo $modulesroot; ?>advanced/advindex.php">Advanced Search</a>
	<h3>Results</h3>
	<?php		
		$searchqry = $_GET["inputbox"];
		
		if ($searchqry != "") 
        { // Check that the user has entered a search.
			$obj = new searcherMain();
			
			//The below code is to ensure pagination.
			if (!isset($_GET['startrow']) or !is_numeric($_GET['startrow'])) 
			{
				$startrow = 0;
			}
			else 
			{
				$startrow = (int)$_GET['startrow'];
			}
			
			//Check for prefixes like cache: ectc
			$prefixCheck = new keywordCheck;
			
			if($prefixCheck->intelliSense($searchqry, $includesroot) == 0) /* If there were no keywords then it will return 0. So the regular search routine is called */
			     $time_start = $obj->microtime_float();
				$obj->search($searchqry, $includesroot,$startrow);
				$time_end = $obj->microtime_float();
				$time = $time_end - $time_start;
				echo "<br /><b>Search Done in $time seconds\n</b>";
		}
	?>

<div id="switcher">
<p>Select a Style</p>
	<ul>
		<li>~ <a href="<?php echo $_SERVER['PHP_SELF'].'?style=modern';?>">Modern</a> ~</li>
		<li>~ <a href="<?php echo $_SERVER['PHP_SELF'].'?style=plain';?>">Plain</a> ~</li>
	</ul>
</div>

<p>You are currently viewing the site using <?php echo $style; ?>.</p>
</div>
</body>
</html>
