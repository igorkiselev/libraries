jQuery.fn.extend({
	stretch: function($debug) {
		this.each(function() {
			var $image = jQuery(this);
			
			console.log($image);
			
			$image.css({
				opacity: 0
			});
			
			var maxWidth;
			
			var maxHeight;
			
			$image.css({
				width: '100%',
				height: 'auto'
			});
			
			
			
								
			if ($image.attr('width') && $image.attr('height')) {
				
				maxWidth = $image.attr('width');
				maxHeight = $image.attr('height');
				
				if ($debug) {
					console.log('stretchClass: ' + $image.attr('src') + ', by width&height in <img> (' + maxWidth + '/' + maxHeight + 'px)');
				}
				
			} else {
				
				$image.imagesLoaded().done(function(i) {
					
					maxWidth = i.images[0].img.naturalWidth;
					
					maxHeight = i.images[0].img.naturalHeight;
					
					if ($debug) {
						console.log('stretchClass: ' + $image.attr('src') + ', by natural width&height via imageLoad (' + maxWidth + '/' + maxHeight + 'px)');
					}
					
				});
			}
		
			$image.css({
				maxWidth: maxWidth + 'px',
				maxHeight: maxHeight + 'px',
			});
				
			
			
			$image.css({
				opacity: 1
			});
			
		});
	}
});