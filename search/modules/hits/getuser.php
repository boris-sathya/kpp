<?php
$q=$_GET["q"];

$dbc=mysqli_connect('localhost','root','','search') or die('sundaram');

$sql="update completed set hits=hits+1 where url like '".$q."'";

$result = mysqli_query($dbc,$sql) or die('sasidaren');
mysql_close($con);
?>