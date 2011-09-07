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
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>K++ Search</title>
<link rel="stylesheet" type="text/css" href="<?php if(isset($style)) { echo $cssroot.$style; } else { echo $cssroot.'modern.css';} ?>" />
<script type="text/javascript" src="<?php echo $jsroot; ?>validateInput.js" ></script>
</head>

<body>
<div id ="wrapper">

<center>
<div class="img">
  <a target="_blank" href="<?php echo $rootdir; ?>index.php">
  <img src="<?php echo $imagesroot; ?>image.jpg" alt="K++ Search" width="300" height="100" />
  </a></div></center>
  <center>
  <form method="get" action="adv.php" onSubmit="return validate(this);" >
				<input name="inputbox" type="text" size="55" />
	  Site Name:<input name="sitename" type="text" size="55" />
				<input type="submit" value="Advanced Search" />
	</form>
	<a href="<?php echo $rootdir; ?>index.php">Normal Search</a><br />
	</center>

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
