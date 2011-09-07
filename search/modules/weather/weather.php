<html>
    <head>
        <title>Weather Report</title>
        <script Language="JavaScript">
		<!-- 
		function Length_TextField_Validator(form_name)
		{
			// Check the length of the value of the element named text_name1
			if (form_name.inputbox.value.length==0) 
			{
				// Build alert box message showing how many characters entered
				mesg = "Please enter an input and submit again."
				alert(mesg);
				// Place the cursor on the field for revision
				form_name.inputbox.focus();
				// return false to stop further processing
				return (false);
			}
			// If text_name is not null continue processing
			return (true);
		}
		-->
		</script>
    </head>
    <body>
    	<?php
if(isset($_POST['submit'])&&strlen($_POST['inputbox'])>0)
{
	
	$place=$_POST['inputbox'];
}
else
{
	$place='chennai';
}

	$xml = simplexml_load_file('http://www.google.com/ig/api?weather='.$place);

$information = $xml->xpath("/xml_api_reply/weather/forecast_information");
$current = $xml->xpath("/xml_api_reply/weather/current_conditions");
$forecast_list = $xml->xpath("/xml_api_reply/weather/forecast_conditions");
?>

        <h1><?php  print $information[0]->city['data']; ?></h1>
        <h2>Today's weather</h2>
        <div class="weather">		
            <img src="<?php echo 'http://www.google.com' . $current[0]->icon['data']?>" alt="weather"?>
            <span class="condition">
            <?php  echo $current[0]->temp_f['data'] ?>&deg; F,
            <?php echo $current[0]->condition['data'] ?>
            </span>
        </div>
        <h2>Forecast</h2>
        <?php foreach ($forecast_list as $forecast) : ?>
        <div class="weather">
            <img src="<?php echo 'http://www.google.com' . $forecast->icon['data']?>" alt="weather"?>
            <div><?php echo $forecast->day_of_week['data']; ?></div>
            <span class="condition">
	            <?php echo $forecast->low['data'] ?>&deg; F - <?php echo $forecast->high['data'] ?>&deg; F,
	            <?php echo $forecast->condition['data'] ?>
            </span>
        </div>	
        <?php endforeach ?>
 <form method="post" action="weather.php" name="form_name" onsubmit="return Length_TextField_Validator(this)">
Please enter the city: <input type="text"  name="inputbox" >
    <input type="submit" name="submit" value="SUBMIT">
    </form>
    </body>
</html>
