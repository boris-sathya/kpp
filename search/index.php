<?php 
	$rootdir = "";
	$cssroot = "css/"; 
	$imagesroot = "images/";
	$jsroot = "js/";
	$modulesroot = "modules/";
	$cacheroot = "kppsearch/";
	$includesroot = "includes/";
	include($modulesroot.'switcher/switcher.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>K++ Search</title>
<link rel="stylesheet" type="text/css" href="<?php if(isset($style)) { echo $cssroot.$style; } else { echo $cssroot.'modern.css';} ?>" />
<script type="text/javascript" src="<?php echo $jsroot; ?>validateInput.js" ></script>
<style type="text/css"> 
#clock { font-family: Arial, Helvetica, sans-serif; font-size: 0.8em; color: white; background-color: black; border: 2px solid purple; padding: 4px; }
</style> 
 
<script type="text/javascript" src="js/dateandtime.js"></script> 
</head>

<body onload="formatTime();"> 
<div id ="wrapper">
<div class="right" >
<ul><li><a href="<?php echo $modulesroot; ?>weather/weather.php" >Weather Page </a></li>
<li><a href="<?php echo $modulesroot; ?>updatecache/updatecache.php" >Update Cache </a></li>
<ul><li><a href="<?php echo $modulesroot; ?>stock/stock.php" >Stock Market</a></li></ul>
</div>

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
		<input name="inputbox" type="text" size="55" />
		<input type="submit" value="Search" />
        <input type="submit" value="I'm Feeling Lucky" name="lucky" />
	</form>
    <a href="<?php echo $modulesroot; ?>advanced/advindex.php">Advanced Search</a><br />
    </center>

<div id="switcher">
<p>Select a Style</p>
	<ul>
		<li>~ <a href="<?php echo $_SERVER['PHP_SELF'].'?style=modern';?>">Modern</a> ~</li>
		<li>~ <a href="<?php echo $_SERVER['PHP_SELF'].'?style=plain';?>">Plain</a> ~</li>
	</ul>
</div><br />

<p>You are currently viewing the site using <?php echo $style; ?>.</p>

</div>
</body>
</html>
