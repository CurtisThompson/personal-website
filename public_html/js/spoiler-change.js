$(document).ready(function(){

	$(".spoilerbutton").click(function(){
		var theButton = $(this);
		
		theButton.next().slideToggle();
		theButton.toggleClass("blue");
		
		theButton.text(function(){
			var theText = theButton.text();
			theText = theText.replace(/▲/, "►");
			theText = theText.replace(/▼/, "▲");
			theText = theText.replace(/►/, "▼");
			return theText;		
		});
	});

});