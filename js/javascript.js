// Javascript file containing functions used by the entire project

// When enter is pressed the this function will submit a the form on the page with the name "form"
function onKey(evt)
{
	var charCode = (evt.which) ? evt.which : event.keyCode;
	if(charCode == "13")
		document.form.submit(); 
}

// Tells the browser to go back one page
function previousPage()
{
	history.go(-1);
}