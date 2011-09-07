<?php
class searcherMain
{
	function microtime_float()
{
    list($usec, $sec) = explode(" ", microtime());
    return ((float)$usec + (float)$sec);
}
	function search($searchqry, $includesroot,$startrow)
	{

	
		include_once($includesroot.'dbConnect.php');
		
		$db = new BackEnd();
		$con = $db->connectToSearchDb();
		
		$tablesUsed = array("COMPLETED", "REFERENCE");
		$sea=str_replace(' ','%',$searchqry);
		
		$qr=" select count(*) from completed ";
		$res=mysql_query($qr,$con);
		$row=mysql_fetch_array($res);
		$p=$row['count(*)'];
		if($startrow>$p)
			$startrow=0;
		$qr="select a.PATHINCACHE,a.TITLE,a.DATA,a.url from completed a,reference b where a.URL=b.URL  and b.keyword like '".$sea."' group by url order by avg(b.key1) desc limit $startrow,10";	
		//echo $qr;
		$res=mysql_query($qr,$con);
		if(mysql_num_rows($res)>0)
		{
			$i=1;
			echo '<table><tr><td width=\"1%\"></td><td width=\"70%\"></td><td width=\"20%\"></td></tr>';
		while($row2=mysql_fetch_array($res))
		  {
			$k=0;
				$url= $row2['url'];
				$title=$row2['TITLE'];
				$string=$row2['PATHINCACHE'];
				
				if(isset($_GET['lucky']))
				{
					echo "<script language='JavaScript'>parent.location='".$url."';</script>";
				}
			    $string='kppSearch/'.$string;
				$title1=explode(' ',$title);
				$data=$row2['DATA'];
				preg_replace("%<.*?>%", '', $data);
            $new_string = preg_replace('/[^a-zA-Z\s]/', '', strip_tags($data));
		
				foreach($title1 as $temp)
				{
					$k++;
				}
				//echo $title1[1];
				if($k>1)
				 $k=1;
				else
				 $k=0;
				$j=stripos($new_string,$searchqry); 
		echo '<tr><td>'.$i.'</td>';$i++;
			echo '<td>';
			echo '<a href="'.$url.'" onclick="showUser(\''.$url.'\')">'.$title.'</a>'.'<br /><div class="close">'.substr($new_string,$j,500).
			'</div></td>';
			echo '<td>';
			echo "<a href=\"".$string."\">".Cached."</a>".'</td></tr>';
		  } 
		}
		else
		
		{
		
		
		$qry2 = "select URL 
  , length(URL) as len 
  , length(replace(lower(URL),lower('".$sea."'),'')) as lrep 

  , ( length(URL) 
    - length(replace(lower(URL),'".$sea."','')) ) 
    / length('".$sea."') as occ 

  , length(URL) + 1 
   -length(replace(URL,' ','')) as wds 

  , ( ( length(URL) 
    - length(replace(lower(URL),'".$sea."','')) ) 
    / length('".$sea."') ) 
     / (length(URL) + 1 
   -length(replace(URL,' ','')))  as occwds 

  , ( length(URL) 
    - length(replace(lower(URL),'".$sea."','')) ) 
    / length(URL) as occlen 
	
  , (( ( length(URL) 
    - length(replace(lower(URL),'".$sea."','')) ) 
    / length('".$sea."') ) 
     / (length(URL) + 1 
   -length(replace(URL,' ',''))))*RANK as key1	

  from completed 
 where URL like '%".$sea."%'
UNION
select URL 
  , length(TITLE) as len 
  , length(replace(lower(TITLE),lower('".$sea."'),'')) as lrep 

  , ( length(TITLE) 
    - length(replace(lower(TITLE),lower('".$sea."'),'')) ) 
    / length('".$sea."') as occ 

  , length(TITLE) + 1 
   -length(replace(TITLE,' ','')) as wds 

  , ( ( length(TITLE) 
    - length(replace(lower(TITLE),lower('".$sea."'),'')) ) 
    / length('".$sea."') ) 
     / (length(TITLE) + 1 
   -length(replace(TITLE,' ','')))  as occwds 

  , ( length(TITLE) 
    - length(replace(lower(TITLE),lower('".$sea."'),'')) ) 
    / length(TITLE) as occlen 
	
	, (( ( length(TITLE) 
    - length(replace(lower(TITLE),lower('".$sea."'),'')) ) 
    / length('".$sea."') ) 
     / (length(TITLE) + 1 
   -length(replace(TITLE,' ',''))))*RANK as key1

  from completed 
 where TITLE like '%".$sea."%'
UNION
select URL 
  
  , length(KEYWORDS) as len 
  , length(replace(lower(KEYWORDS),lower('".$sea."'),'')) as lrep 

  , ( length(KEYWORDS) 
    - length(replace(lower(KEYWORDS),lower('".$sea."'),'')) ) 
    / length('".$sea."') as occ 

  , length(KEYWORDS) + 1 
   -length(replace(KEYWORDS,' ','')) as wds 

  , ( ( length(KEYWORDS) 
    - length(replace(lower(KEYWORDS),lower('".$sea."'),'')) ) 
    / length('".$sea."') ) 
     / (length(KEYWORDS) + 1 
   -length(replace(KEYWORDS,' ','')))  as occwds 
	 
 

  , ( length(KEYWORDS) 
    - length(replace(lower(KEYWORDS),lower('".$sea."'),'')) ) 
    / length(KEYWORDS) as occlen 
	
	 ,(( ( length(KEYWORDS) 
    - length(replace(lower(KEYWORDS),lower('".$sea."'),'')) ) 
    / length('".$sea."') ) 
     / (length(KEYWORDS) + 1 
   -length(replace(KEYWORDS,' ',''))))*RANK as key1

  from completed 
 where KEYWORDS like '%".$sea."%'
UNION
select URL 
  , length(DATA) as len 
  , length(replace(lower(DATA),lower('".$sea."'),'')) as lrep 

  , ( length(DATA) 
    - length(replace(lower(DATA),lower('".$sea."'),'')) ) 
    / length('".$sea."') as occ 

  , WORDCOUNT as wds

  , (( length(DATA) 
     - length(replace(lower(DATA),lower('".$sea."'),'')) ) 
     / length('".$sea."') ) 
     /WORDCOUNT as occwds 

  , ( length(DATA) 
    - length(replace(lower(DATA),lower('".$sea."'),'')) ) 
    / length(DATA) as occlen 
	
  ,((( length(DATA) 
     - length(replace(lower(DATA),lower('".$sea."'),'')) ) 
     / length('".$sea."') ) 
     /WORDCOUNT)*RANK as key1
 
  from completed 
 where DATA like '%".$sea."%'";
	//	echo $qry2;
		
		$i=1;
		$res2=mysql_query($qry2,$con);
		while($arr2=mysql_fetch_array($res2))
			{
			    
				$k=0;
				$url= $arr2['URL'];
				$len=$arr2['len'];
				$lrep=$arr2['lrep'];
				$occ=$arr2['occ'];
				$wds=$arr2['wds'];
				$occwds=$arr2['occwds'];
				$occlen=$arr2['occlen'];
				$key1=$arr2['key1'];
				$query3="insert into reference values('$sea','$url','$len','$lrep','$occ','$wds','$occwds','$occlen','$key1')";
			
				$result=mysql_query($query3,$con);
			}
				
			$query4="select a.PATHINCACHE,a.TITLE,a.DATA,a.url from completed a,reference b where a.URL=b.URL  and b.keyword like '".$sea."' group by url order by avg(b.key1) desc limit $startrow,10";	
		
				$result4=mysql_query($query4,$con);
				echo '<table><tr><td width=\"1%\"></td><td width=\"70%\"></td><td width=\"20%\"></td></tr>';
				while($row4=mysql_fetch_array($result4))
				{		
				$url= $row4['URL'];
				$title=$row4['TITLE'];
				$string=$row4['PATHINCACHE'];
			    $string='kppSearch/'.$string;
				$title1=explode(' ',$searchqry);
				$data=$row4['DATA'];
				if(isset($_GET['lucky']))
				{
					echo "<script language='JavaScript'>parent.location='".$url."';</script>";
				}
				preg_replace("%<.*?>%", '', $data);
            $new_string = preg_replace('/[^a-zA-Z\s]/', '', strip_tags($data));
		       foreach($title1 as $temp)
				{
					$k++;
				}
				if($k>1)
				 $k=1;
				else
				 $k=0;
				$j=stripos($new_string,$searchqry); 
				
		echo '<tr><td>'.$i.'</td>';$i++;
			echo '<td>';
			echo '<a href="'.$url.'" onclick="showUser(\''.$url.'\')">'.$title.'</a>'.'<br /><div class="close">'.substr($new_string,$j,500).
			'</div></td>';
			echo '<td>';
			echo "<a href=\"".$string."\">".Cached."</a>".'</td></tr>';
			}
		}
	
			if(($i-1)==0)
		{
			echo 'Sorry We Do not have any Results for Your Query';
			$nk=0;
			$query="select * from dictionary where word like '%".$sea."%'";
			$qry="select * from ".$db->getTableName($tablesUsed[1])." group by keyword";
			//echo $qry;
			$re=mysql_query($query,$con);
			$res=mysql_query($qry,$con);
			while($row=mysql_fetch_array($re))
			{
				similar_text($row['word'],$searchqry,$percent);
				 {
					 if($percent>50)
					 {
						 if($nk==0)
						 {
						 echo '<br />Did You Mean : ';
						 }
						 echo '<b><a href="searchresults.php?inputbox='.$row['word'].'">'.$row['word'].'</a></b>';
						 echo '     '; 
						 $nk++;
					 }
				 }
			}
			while($row=mysql_fetch_array($res))
			{
				similar_text($row['keyword'],$searchqry,$percent);
				 {
					 if($percent>50)
					 {
						 if($nk==0)
						 {
						 echo '<br />Did You Mean : ';
						 }
						 echo '<b><a href="searchresults.php?inputbox='.$row['keyword'].'">'.$row['keyword'].'</a></b>';
						 echo '     '; 
						 $nk++;
					 }
				 }
			}
		}
		else	
		{
			echo '<tr> <td></td><td>';
			$prev = $startrow - 10;
			if ($prev >= 0)
			{
				echo '<a href="../search3/searchresults.php'.'?inputbox='.$searchqry.'&&startrow='.$prev.'">Previous</a>';
				echo '</td><td>';
			}
			echo '<a href="../search3/searchresults.php'.'?inputbox='.$searchqry.'&&startrow='.($startrow+10).'">Next</a>';
			echo '</td>';
			
			echo '</tr>';
			echo '</table>'.'<b><br />Total Number of items per page '.($i-1).'</b>';
		}
	}
}
		
		