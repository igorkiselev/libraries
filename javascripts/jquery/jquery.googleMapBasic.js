var	$theme = [
  {
    "featureType": "administrative.land_parcel",
    "stylers": [
      {
        "visibility": "off"
      }
    ]
  },
  {
    "featureType": "administrative.neighborhood",
    "stylers": [
      {
        "visibility": "off"
      }
    ]
  },
  {
    "featureType": "landscape.natural",
    "elementType": "geometry.fill",
    "stylers": [
      {
        "saturation": -50
      },
      {
        "lightness": 20
      }
    ]
  },
  {
    "featureType": "poi",
    "elementType": "labels.text",
    "stylers": [
      {
        "visibility": "off"
      }
    ]
  },
  {
    "featureType": "poi.park",
    "stylers": [
      {
        "saturation": -25
      }
    ]
  },
  {
    "featureType": "road",
    "stylers": [
      {
        "color": "#f5f5f5"
      }
    ]
  },
  {
    "featureType": "road",
    "elementType": "labels",
    "stylers": [
      {
        "visibility": "off"
      }
    ]
  },
  {
    "featureType": "road.arterial",
    "elementType": "labels",
    "stylers": [
      {
        "visibility": "off"
      }
    ]
  },
  {
    "featureType": "road.highway",
    "elementType": "labels",
    "stylers": [
      {
        "visibility": "off"
      }
    ]
  },
  {
    "featureType": "road.local",
    "stylers": [
      {
        "visibility": "off"
      }
    ]
  },
  {
    "featureType": "water",
    "stylers": [
      {
        "saturation": -80
      },
      {
        "lightness": 20
      }
    ]
  },
  {
    "featureType": "water",
    "elementType": "labels.text",
    "stylers": [
      {
        "visibility": "off"
      }
    ]
  }
];


jQuery.fn.extend({
	googleMap: function ($options) {
		this.each(function() {
			// Defaults if not set;
			var zoom; zoom=$options.zoom?$options.zoom:15;
			var object = jQuery(this);
			var markers = object.find('.marker');
			var route = object.find('.route');
			
			var icon; icon=$options.marker.icon?"data"==$options.marker.icon?"data":!0:!1;
			var url; url=$options.marker.url?$options.marker.url:"/wp-content/assets/static/svg/pin.svg";
			var iconWidth; iconWidth=$options.marker.width?$options.marker.width:24;
			var iconHeight; iconHeight=$options.marker.height?$options.marker.height:31;
			
			var style; style=$options.style?$options.style:false;
			var scrollwheel; scrollwheel=$options.scrollwheel?$options.scrollwheel:false;
			
			
			var args = {
				zoom : zoom,
				disableDefaultUI : !0,
				center : new google.maps.LatLng(0, 0),
				mapTypeId : google.maps.MapTypeId.ROADMAP,
				scrollwheel: scrollwheel
			};
			
			var map = new google.maps.Map( object[0], args);
			map.markers = [];
			
			if(style){
				map.set( "styles" , style );
			}
			
			markers.each(function(){
				var $this = jQuery(this);
				
				var latlng = new google.maps.LatLng( $this.data('lat'), $this.data('lng'));
				
				if(icon == 'data'){
					url =  $this.data('pin');
				}
				var point = new google.maps.Marker({
					position	: latlng,
					map			: map,
					id			: $this.attr('id'),
					size		: new google.maps.Size(iconWidth, iconHeight),
					icon		: url,
					optimized	: false
				});
				
				if($options.activePins){
					var zoomActivePin; zoomActivePin=$options.activePins.zoom?$options.activePins.zoom:false;
					
					point.addListener('click', function() {
						if(zoomActivePin){
							map.setZoom(zoomActivePin);
						}
						map.setCenter(point.getPosition());
					});
				}
				
				map.markers.push( point );
			});
			
			
			
			if(route){
				var routeArray = [];
				
				route.each(function(){
					var $this = jQuery(this);
					if($this[0] === route.last()[0] || $this[0] === route.first()[0]) {
						if($this[0] === route.last()[0]) {
							url =  $options.marker.finish;
						}
						if($this[0] === route.first()[0]) {
							url =  $options.marker.start;
						}
						
						map.markers.push(
							new google.maps.Marker({
								position	: new google.maps.LatLng($this.data('lat'),$this.data('lng')),
								map			: map,
								size		: new google.maps.Size(iconWidth, iconHeight),
								icon		: {
									url : url,
									anchor: new google.maps.Point(0, 31),
									size		: new google.maps.Size(iconWidth, iconHeight),
									scaledSize: new google.maps.Size(iconWidth, iconHeight),			
								},
								
								optimized	: false
							})
						)
					}
					
					
					var latlng = new google.maps.LatLng($this.data('lat'),$this.data('lng'));
					routeArray.push(latlng);
				});

				var segments = new google.maps.Polyline({
					path: routeArray,
					geodesic: true,
					strokeColor: '#4a64a5',
					strokeOpacity: 0.9,
					strokeWeight: 2
				});
				segments.setMap(map);
			}
			
			var bounds = new google.maps.LatLngBounds();
			
			 jQuery.each( routeArray, function( i, polyline ){
			 	bounds.extend(new google.maps.LatLng(polyline.lat(), polyline.lng()));
			 });
			
			
	
			jQuery.each( map.markers, function( i, marker ){
				bounds.extend(new google.maps.LatLng(marker.position.lat(), marker.position.lng()));
			});
			
			
			
			var timer;
			
			jQuery(window).resize(function(){
				clearTimeout(timer),timer=setTimeout(function(){
				1==map.markers.length?map.panTo(bounds.getCenter()).setZoom(zoom):map.fitBounds(bounds);
			},100)}).resize();
			
			if($options.nav){
				var container = document.createElement('div');
				
				jQuery(container).addClass('zoom hidden-sm-down');
				jQuery("\<div\>").appendTo(jQuery(container)).addClass('in').click(function(event) {map.setZoom(map.getZoom() + 1);});
				jQuery("\<div\>").appendTo(jQuery(container)).addClass('out').click(function(event) {map.setZoom(map.getZoom() - 1);});
				
				map.controls[google.maps.ControlPosition.TOP_RIGHT].push(container);
			}
			
			if($options.activePins){
				jQuery($options.activePins.className).click(function(e){
					var zoomActivePin; zoomActivePin=$options.activePins.zoom?$options.activePins.zoom:false;
					$pin = jQuery(this).attr('href').replace('#','');
					
					jQuery.each(map.markers, function(index, val) {
						if(this.id == $pin){
							map.panTo(this.position)
							if(zoomActivePin){
								map.setZoom(zoomActivePin);
							}
						}
					});
				e.preventDefault();
				});
			}
			
			
			
		});
	}
});

// 