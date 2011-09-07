var xmlhttp;

function showUser(str)
{
	xmlhttp=GetXmlHttpObject();
	
	var loc = window.location.href;
	
	var mainStr = loc.substr(0,loc.lastIndexOf("/"));
	
	if (xmlhttp==null)
	  {
		  alert ("Browser does not support HTTP Request");
		  return;
	  }
	var url=mainStr+"/"+"modules/hits/getuser.php";
	
	//document.writeln(url);
	
	//var url="";
	var check=url+"?q="+str;

	xmlhttp.onreadystatechange=stateChanged;
	xmlhttp.open("GET",check,true);
	xmlhttp.send(null);
}

function stateChanged()
{
	if (xmlhttp.readyState==4)
	{
		//document.getElementById("txtHint").innerHTML=xmlhttp.responseText;
	}
}

function GetXmlHttpObject()
{
if (window.XMLHttpRequest)
  {
  // code for IE7+, Firefox, Chrome, Opera, Safari
  return new XMLHttpRequest();
  }
if (window.ActiveXObject)
  {
  // code for IE6, IE5
  return new ActiveXObject("Microsoft.XMLHTTP");
  }
return null;
}