<?php
$q=$_GET["q"];   //gets the link

$dbc=mysql_connect('localhost','root','') or die('cant conect');
mysql_select_db('search');
$compare="SELECT ipaddres,lasthit FROM completed WHERE url LIKE '".$q."'"; //checks from database that if the link is visited 
$res1 = mysql_query($compare) or die('Error');
$myrow = mysql_fetch_array($res1);
$no = mysql_num_rows($res1);
$p_time = time();
$ip= $_SERVER['REMOTE_ADDR'];
if($no == 0)  //if no
{
   $sql="update completed set hits=hits+1,lasthit ='".$p_time."',ipaddres = '".$ip."'  where url like '".$q."'";
  //echo "here";
 }
else
 {
//if the link is visted

if($myrow[0] == $ip)  // checks the last visited ip with current one
  {
     
     if(($p_time - $myrow[1]) < 500)  //checks the time difference between two vistis,the threshold valuse could be set to any no of secs
 {          
 $sql="update completed set hits=hits+0,lasthit= '".$p_time."' where url like '".$q."'"; //if the link is revisted again within the threshold time period HITS is not incremented but time is updated
     
   } 
 else {
   $sql="update completed set hits=hits+1,lasthit ='".$p_time."',ipaddres = '".$ip."'  where url like '".$q."'";
}
  }
  else {
   $sql="update completed set hits=hits+1,lasthit ='".$p_time."',ipaddres = '".$ip."'  where url like '".$q."'";
 }
   }
$result = mysql_query($sql) or die('boris');
mysql_close($dbc);
?>
