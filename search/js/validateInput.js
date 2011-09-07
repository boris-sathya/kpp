function validate(gett)
{
	if(gett.inputbox.value == "" || gett.inputbox.value==" " || gett.inputbox.value==null)
	{
		alert(" Enter Text");
		return false;
	}
	return true;
}