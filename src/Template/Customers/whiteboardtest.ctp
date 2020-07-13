<!-- File: templates/Customers/index.php -->

<?php  ?>



<div id="sketchpad">
    
    <h5> Whiteboardtest </h5>
    
    <canvas id="myCanvas"></canvas>
    
    <img id="imagetest" src="">
    
    <p> can generate qr code with url, but does not make sense in dev mode..</p>
        
</div>



<script>

window.onload = function() {
    var myCanvas = document.getElementById("myCanvas");
    var ctx = myCanvas.getContext("2d");
    
    // Fill Window Width and Height
    myCanvas.width = window.innerWidth;
    myCanvas.height = window.innerHeight / 3;
	    
    // Set Background Color
    ctx.fillStyle="#39bdba";
    ctx.fillRect(0,0,myCanvas.width,myCanvas.height);
	
    // Mouse Event Handlers
    if(myCanvas){
        var isDown = false;
        var canvasX, canvasY;
        ctx.lineWidth = 1;

        $(myCanvas)
        .mousedown(function(e){
                isDown = true;
                ctx.beginPath();
                canvasX = e.pageX - myCanvas.offsetLeft;
                canvasY = e.pageY - myCanvas.offsetTop;
                ctx.moveTo(canvasX, canvasY);
        })
        .mousemove(function(e){
                if(isDown !== false) {
                        canvasX = e.pageX - myCanvas.offsetLeft;
                        canvasY = e.pageY - myCanvas.offsetTop;
                        ctx.lineTo(canvasX, canvasY);
                        ctx.strokeStyle = "#000";
                        ctx.stroke();
                }
        })
        .mouseup(function(e){
                isDown = false;
                ctx.closePath();
                redrawcanvas();
                
                // could generate a qr with page url, but does not make sense since in localdev mode.. 
                // http://wampprojects/composer_cakephptut/customers/whiteboardtest
        });
    }
	
	// Touch Events Handlers
	draw = {
		started: false,
		start: function(evt) {

			ctx.beginPath();
			ctx.moveTo(
				evt.touches[0].pageX,
				evt.touches[0].pageY
			);

			this.started = true;

		},
		move: function(evt) {

			if (this.started) {
				ctx.lineTo(
					evt.touches[0].pageX,
					evt.touches[0].pageY
				);

				ctx.strokeStyle = "#000";
				ctx.lineWidth = 5;
				ctx.stroke();
			}

		},
		end: function(evt) {
			this.started = false;
		}
	};
	
	// Touch Events
	myCanvas.addEventListener('touchstart', draw.start, false);
	myCanvas.addEventListener('touchend', draw.end, false);
	myCanvas.addEventListener('touchmove', draw.move, false);
	
	// Disable Page Move
	document.body.addEventListener('touchmove',function(evt){
		evt.preventDefault();
	},false);
        
        
        // on clicking button 
        function redrawcanvas() {

            var dataURL = myCanvas.toDataURL('image/png');
            $("#imagetest").attr('src', dataURL);

        };        
        
        
        
    };



</script>



