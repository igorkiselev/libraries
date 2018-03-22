/*
	Plugin Name: aspectRatio
	Plugin URI: http://www.igorkiselev.com/jquery-plugin/aspectRatio/
	Description: Plug-in for keeping aspect ratio of an object, with responsive grid brakepoints;
	Version: 0.0.2
	Author: Igor Kiselev
	Author URI: http://www.igorkiselev.com/
	Copyright: Igor Kiselev
*/

/*
	1) Javascript init (more about default settings on line )

	<script>
		jQuery('.ratio').aspectRatio({});
	</script>

*/

/*
	2) Html constriction

	<div class="ratio" data-xs-ration="1/1" data-sm-ration="1/1" data-md-ration="1/1" data-lg-ration="1/1" data-xl-ration="1/1">
		anything
	</div>

*/

(function ( $ ) {
	 $.fn.extend({
		aspectRatio: function( options ) {
			
			// Basic settings for a plug-in
			
			var settings = $.extend({
				brakepoint : {
					lg : 1199,
					md : 991,
					sm : 767,
					xs : 543
				}, // Brake points for script, similar for bootstrap grid;
				overflow : false, // Overflow or not, for the container if contents height is bigger than the ratio height;
				transition: true, // Smooth height transition;
				transitionSpeed: 1, // Transition speed in seconds;
				debug: false, // Debug (adds border for objects and logs height information);
				addClass : 'aspectRatio' // Name of the class to set
			}, options );
			
			// Add style with css transition
			
			if(settings.transition){
				$('body').prepend('<style>.' + settings.addClass + '{transition: height ' + settings.transitionSpeed + 's;}</style>');
			}
			
			// Cycle throug objects
			
			this.each(function() {
				
				var $this = $(this),
					$window = $(window),
					timer,
					ratio,
					ratioObject = {};
				
				
				$this.addClass(settings.addClass);
			
				$.each($this.data(),function(t,a){key=t.replace("Ratio",""),ratioObject[key]=a.split("/")});
				
				settings.debug&&$this.css({border:"1px Solid #f00"}).children().css({border:"1px Solid #00f"});
				
				settings.overflow?$this.css({overflow:"hidden"}):$this.css({overflow:"auto"});
				
				
				// Resize object with delay;
				
				$window.resize(function(){
					clearTimeout(timer);
					timer = setTimeout(function(){
						var totalHeight = 0, width = $window.width();
						
						// Count children object height;
						$this.children().each(function(){totalHeight+=$(this).outerHeight(!0)});
						
						
						settings.debug&&console.log($this.height()+"/"+totalHeight);
					
						// XS is set as the default
						if(ratioObject.xs && ratioObject.xs != 'none'){
							ratio = ratioObject.xs;
						}
						
						// Cycle through brakepoints;
						// Future task — cycle through brakepoints and check if there is a data-[xs,sm,md,lg,xl]-ratio;
						
						width>=settings.brakepoint.xs&&ratioObject.sm&&(ratio=ratioObject.sm),
						width>=settings.brakepoint.sm&&ratioObject.md&&(ratio=ratioObject.md),
						width>=settings.brakepoint.md&&ratioObject.lg&&(ratio=ratioObject.lg),
						width>=settings.brakepoint.lg&&ratioObject.xl&&(ratio=ratioObject.xl);
					
					
						settings.debug&&console.log("Ratio: "+ratio);
					
					
						if(ratio){
							// Count the ratio width/height;
							var $newHeight=Math.floor($this.width()/(1*ratio[0])*(1*ratio[1])),
								$canvasHeight=Math.floor(totalHeight);
							
							// Ratio height or Canvas height;
							$newHeight<$canvasHeight?settings.overflow?$this.css({height:$newHeight}):$this.css({height:$canvasHeight}):$this.css({height:$newHeight});
							
						}else{
							$this.css({height:'auto'});
						}
					}, 100);
					
				}).resize();
			});
		}
	});
}( jQuery ));


jQuery('.ratio').aspectRatio({});