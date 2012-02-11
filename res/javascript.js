// Javascript file containing functions used by the entire project

function onKey(evt)
{
	var charCode = (evt.which) ? evt.which : event.keyCode;
	if(charCode == "13")
		document.form.submit(); 
}