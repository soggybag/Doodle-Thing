<!DOCTYPE html>
<html>
<head>
	<title></title>
	<script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
	<script src="sketch.js"></script>
	<script>
		var sketch;
		$(function() {
			$("#loading-gif").hide();
			sketch = $('#drawing').sketch();
			$("#save-button").click(function(event){
				event.preventDefault();
				submit_drawing();
			})
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
			ctx.clearRect(0, 0, myCanvas.width, myCanvas.height);
		}
		
		$('.reset-canvas').click(function(){
			clear_canvas();
		});
	</script>
</head>
<body>
	<div id="canvas" style="width:320px; height:320px; border:1px solid black">
		<canvas id="drawing" width="320" height="320"></canvas>
	</div>
	<a href="#drawing" data-tool="eraser">Eraser</a>
	<a href="#drawing" data-tool="marker">Marker</a>
	<!-- <a href="#drawing" data-tool="clear">Clear</a> -->
	<a id="save-button" href="save.php">Save</a>
	
	<div id="loading-gif" style="position:absolute; top:160px; left:60px">
		<img src="ajax-loader.gif">
	</div>
	<!-- <form id="form" method="post" type="multipartformdata" action="">
		<input type="hidden" value="">
		<input type="submit" value="submit">
	</form> -->
	
	<div id="image-feed">
	
	</div>
	
</body>
</html>