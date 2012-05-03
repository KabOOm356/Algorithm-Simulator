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

$(window).load(function() {
/*
    $("#tableTD1").each(function() {
        $(this).circulate({
            speed: Math.floor(Math.random()*300) + 100,
            height: Math.floor(Math.random()*1000) - 470,
            width: Math.floor(Math.random()*1000) - 470
        });
    }).click(function() {
        $(this).circulate({
            speed: Math.floor(Math.random()*300) + 100,
            height: Math.floor(Math.random()*1000) - 470,
            width: Math.floor(Math.random()*1000) - 470
        });
    });
	*/
	function startBallThree() {
        $("#tableTD2").circulate({
            speed: 4000,
            height: 140,
            width: -700,
            sizeAdjustment: 30,
            loop: true,
            zIndexValues: [3, 3, 1, 1]
        }).fadeIn();
    }
            
    setTimeout(startBallThree, 2000);
    
});