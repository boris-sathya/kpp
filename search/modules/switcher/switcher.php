<?php
// check if the cookie is set from a previous visit, if it is assign the cookie value to our style variable

if(isset($_COOKIE['styleSet'])) {
	$style = $_COOKIE['styleSet'];
// if the cookie is not set assign our default stylesheet to our style variable
} else {
	$style = 'modern.css';
}

if(isset($_GET['style']) && ($_GET['style'] == 'modern')) {
//if the modern stylesheet has been selected
//set style = modern.css
	$style = 'modern.css';
	setcookie('styleSet', '', time()-(60*60));
}
if(isset($_GET['style']) && ($_GET['style'] == 'plain')) {
//if the plain stylesheet has been selected
//set style = plain.css
	$style = 'plain.css';
	setcookie('styleSet', '', time()-(60*60));
}

//set the style cookie
setcookie('styleSet', $style, (time()+(60*60*24*7*2)), '/');
?>