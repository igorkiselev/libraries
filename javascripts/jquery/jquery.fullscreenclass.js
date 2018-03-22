/*	Default html construction */

//	<section id="" class="fullscreen">
//		<div class="parent">
//			<div class="child">
//					
//			</div>
//		</div>
//	</section>


/*	Default css construction */

//	section.fullscreen.show{
//		opacity:1;
//		z-index:999;
//		transition: opacity .5s, z-index 0s;
//	}
//	section.fullscreen{
//		position:fixed;
//		width:100%;
//		height:100%;
//		top:0px;
//		opacity:0;
//		z-index:-1;
//		transition: opacity .5s, z-index 0s .5s;
//	}


/*	Default jquery construction */

//	jQuery('a').click(function(e) {
//		jQuery('.fullscreen').fullscreen({
//			result : function(){},
//			notClickable : '.background',
//			escapeKey: true
//		});
//		e.preventDefault();
//	});


jQuery.fn.extend({
	fullscreen: function ($options) {
		$this = this;
		$body = jQuery('body');
		
		$this.click(function(e) {
			
			$this.removeClass('show');
			
			$body.css({'overflow':'auto'});
			
			e.preventDefault();
			
			$options.onClose.call();
		
		});
		
		if($options.notClickable){
			jQuery($options.notClickable).click(function(e) {
				e.stopPropagation();
			});
		}
		
		if($options.escapeKey){
			jQuery(document).keyup(function(e) {
				if (e.keyCode == 27) {$this.click();}
				e.preventDefault();
			});
		}
			
		if(!$this.hasClass('show')){
			
			$body.css({'overflow':'hidden'});
			
			$this.addClass('show');
			
		}else{
			$this.click();
		}
		
		$options.result.call();
	}
});
