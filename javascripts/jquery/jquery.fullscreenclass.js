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

(function($) {
	
	$.fn.extend({

		fullscreen: function(o) {

			var	$this = this,
				$b = $('body'),
				s = $.extend({
					notClickable : '.content',
					escapeKey : false,
					showClass : 'show',
					onInit : function(){},
					onClose : function(){},
					onOpen : function(){}
				}, o);
			
		

			$this.click(function(e) {
			
				$this.removeClass(s.showClass);
			
				$b.css({'overflow':'auto'});
			
				e.preventDefault();
			
				s.onClose.call();
		
			});
		
		
			if (s.notClickable){
			
				$(s.notClickable).click(function(e) {
				
					e.stopPropagation();
				
				});
			}
		
			if (s.escapeKey){
			
				$(document).keyup(function(e) {
				
					if (e.keyCode == 27) {
						$this.click();
					}
				
					e.preventDefault();
				
				});
			}
		
			if (!$this.hasClass(s.showClass)){
			
				$b.css({'overflow':'hidden'});
			
				$this.addClass(s.showClass);
	
			}else{
			
				$this.click();
			
			}
		
			s.onOpen.call();
		}
	});
	
}(jQuery));


