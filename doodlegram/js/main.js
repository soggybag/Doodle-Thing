var sketch;
$(function() {
	$("#loading-gif").hide();
	$("#loading-gif").css("opacity", "0.5");
	sketch = $('#drawing').sketch();
	
	$("#save-button").click(function(event){
		event.preventDefault();
		submit_drawing();
	});
	
	$("a.clear-button").click(function(){
		clear_canvas();
	});
	
	
	$("a.eraser-button,a.marker-button").click(function() {
		$("a.eraser-button,a.marker-button").removeClass( "selected" );
		$(this).addClass("selected");
	});
	
	$("a.marker-button").addClass( "selected" );
	
	
	// When ready...
	window.addEventListener("load",function() {
		// Set a timeout...
		setTimeout(function(){
		// Hide the address bar!
		window.scrollTo(0, 1);
		}, 0);
	});
	
	get_images();
});

function submit_drawing() {
	var canvas = document.getElementById( "drawing" );
	var dataURL = canvas.toDataURL();
	$("#loading-gif").show();
	$.post( "save.php", {image: dataURL}, function( data ) {
		console.log( "Saved filename: " + data );
		get_images();
		clear_canvas();
		$("#loading-gif").hide();
	});
}

function get_images() {
	$.post( "image-feed.php", function(data){
		// console.log( data );
		$("#image-feed").html( data );
	} );
}

function clear_canvas() {
	sketch.sketch().actions = [];       // this line empties the actions. 
	var myCanvas = document.getElementById("drawing");
	var ctx = myCanvas.getContext('2d');
	ctx.clearRect( 0, 0, myCanvas.width, myCanvas.height );
}




