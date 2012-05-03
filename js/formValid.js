$(function() {
  $('.error').hide();

$(".button").click(function() {
		// validate and process form
		// first hide any error messages
    $('.error').hide();
	
	});
});
	runOnLoad(function(){
  $("input#name").select().focus();
});