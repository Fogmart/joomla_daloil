

function initSPPageBuilderGMap() {
  jQuery('.sppb-addon-gmap-canvas').each(function(index) {
	
    var mapId = jQuery(this).attr('id'),
    zoom = Number(jQuery(this).attr('data-mapzoom')),
	infowindow = jQuery(this).attr('data-infowindow'),
    mousescroll = (jQuery(this).attr('data-mousescroll') === 'true') ? true : false,
    maptype = jQuery(this).attr('data-maptype'),
    latlng = {lat: Number(jQuery(this).attr('data-lat')), lng: Number(jQuery(this).attr('data-lng'))};
	
	var map_type_control = jQuery(this).data('map_type_control');
	var street_view_control = jQuery(this).data('street_view_control');
	var fullscreen_control = jQuery(this).data('fullscreen_control');
	var tmpl_url = jQuery(this).data('tmpl_url');
	
	
    var map = new google.maps.Map(document.getElementById(mapId), {
        zoom: zoom,
        center: latlng,
        //disableDefaultUI: true,
		panControl: false,
      	zoomControl: false,
		scaleControl: false,
		overviewMapControl: false,
		mapTypeControl: map_type_control,
		mapTypeControlOptions: {
			style: google.maps.MapTypeControlStyle.DROPDOWN_MENU,
			position: google.maps.ControlPosition.TOP_RIGHT
		  },
		fullscreenControl: fullscreen_control,
		fullscreenControlOptions: {position: google.maps.ControlPosition.RIGHT_TOP},
		streetViewControl: street_view_control,
        scrollwheel: mousescroll
    });
  
	 map.setMapTypeId(google.maps.MapTypeId[maptype]);
	
		
	 // Google map custom marker icon - .png fallback for IE11
	 var is_internetExplorer11= navigator.userAgent.toLowerCase().indexOf('trident') > -1;
	 var marker_url = ( is_internetExplorer11 ) ? tmpl_url + 'gmap-marker.png' : tmpl_url + 'gmap-marker.svg';
	
	// Add a custom marker to the map				
	 var marker = new google.maps.Marker({
		position: latlng,
		map: map,
		visible: true,
		icon: marker_url
	  });
	
	// Custom Zoom
	function ZoomControl(controlDiv, map) {
		// zoomIn
		var zoomInButton = document.createElement('div');
		zoomInButton.className = 'gm-zoom-in';
		controlDiv.appendChild(zoomInButton);
		// zoomOut
		var zoomOutButton = document.createElement('div');
		zoomOutButton.className = 'gm-zoom-out';
		controlDiv.appendChild(zoomOutButton);
		
		// Setup the click event listeners
		google.maps.event.addDomListener(zoomInButton, 'click', function() {
		map.setZoom(map.getZoom() + 1);
		});
		google.maps.event.addDomListener(zoomOutButton, 'click', function() {
		map.setZoom(map.getZoom() - 1);
		});  
			
	}

	var zoomControlDiv = document.createElement('div');
	zoomControlDiv.className = 'gm-zoom-wrapper';
	var zoomControl = new ZoomControl(zoomControlDiv, map);
	map.controls[google.maps.ControlPosition.TOP_LEFT].push(zoomControlDiv);

	//Get colors
	var water_color                   = jQuery(this).attr('data-water_color');
	var highway_stroke_color          = jQuery(this).attr('data-highway_stroke_color');
	var highway_fill_color            = jQuery(this).attr('data-highway_fill_color');
	var local_stroke_color            = jQuery(this).attr('data-local_stroke_color');
	var local_fill_color              = jQuery(this).attr('data-local_fill_color');
	var poi_fill_color                = jQuery(this).attr('data-poi_fill_color');
	var administrative_color          = jQuery(this).attr('data-administrative_color');
	var landscape_color               = jQuery(this).attr('data-landscape_color');
	var road_text_color               = jQuery(this).attr('data-road_text_color');
	var road_arterial_fill_color      = jQuery(this).attr('data-road_arterial_fill_color');
	var road_arterial_stroke_color    = jQuery(this).attr('data-road_arterial_stroke_color');
	
	var styles = [
	{
		"featureType": "water",
		"elementType": "geometry.fill",
		"stylers": [
			{
				"color": water_color
			}
		]
	},
	{
		"featureType": "transit",
		"stylers": [
			{
				"visibility": "on"
			}
		]
	},
	{
		"featureType": "road.highway",
		"elementType": "geometry.stroke",
		"stylers": [
			{
				"visibility": "on"
			},
			{
				"color": highway_stroke_color
			}
		]
	},
	{
		"featureType": "road.highway",
		"elementType": "geometry.fill",
		"stylers": [
			{
				"color": highway_fill_color
			}
		]
	},
	{
		"featureType": "road.local",
		"elementType": "geometry.stroke",
		"stylers": [
			{
				"color": local_stroke_color
			}
		]
	},
	{
		"featureType": "road.local",
		"elementType": "geometry.fill",
		"stylers": [
			{
				"visibility": "on"
			},
			{
				"color": local_fill_color
			},
			{
				"weight": 1.8
			}
		]
	},
	
	{
		"featureType": "administrative",
		"elementType": "geometry",
		"stylers": [
			{
				"color": administrative_color
			}
		]
	},
	
	{
		"featureType": "landscape",
		"elementType": "geometry.fill",
		"stylers": [
			{
				"visibility": "on"
			},
			{
				"color": landscape_color
			}
		]
	},
	{
		"featureType": "road.all",
		"elementType": "labels.text.fill",
		"stylers": [
			{
				"color": road_text_color
			}
		]
	},
	{
		"featureType": "road.all",
		"elementType": "labels.text.stroke",
		"stylers": [
			{ "visibility": "on" },
			{ "color": local_stroke_color },	
			{ "saturation": -25 }, 
			{ "weight": 1.6 }
		]
	},
	{
		"featureType": "poi",
		"elementType": "labels.text.fill",
		"stylers": [
			{ "visibility": "on" },
			{ "color": road_text_color },
			{ "saturation": -50 }
		]
	},
	{
		"featureType": "poi",
		"elementType": "labels.text.stroke",
		"stylers": [
			{ "visibility": "on" },
			{ "color": local_stroke_color },	
			{ "saturation": -25 }, 
			{ "weight": 2.8 }
		]
	},
	{
		"featureType": "poi",
		"elementType": "labels",
		"stylers": [
			{
				"visibility": "on"
			}
		]
	},
	
	{
		"featureType": "poi",
		"elementType": "geometry.fill",
		"stylers": [
			{
				"visibility": "on"
			},
			{
				"color": poi_fill_color
			}
		]
	},
	{
		"featureType": "road.arterial",
		"elementType": "geometry.fill",
		"stylers": [
			{
				"color": road_arterial_fill_color
			}
		]
	},
	{
		"featureType": "road.arterial",
		"elementType": "geometry.stroke",
		"stylers": [
			{
				"color": road_arterial_stroke_color
			}
		]
	}
	]; // END gmap styles
	
	// Set styles to map
	map.setOptions({styles: styles});
	
	// Infowindow text
    if (infowindow) {
      var infowindow = new google.maps.InfoWindow({
        content: atob(infowindow)
      });
      marker.addListener('click', function() {
        infowindow.open(map, marker);
      });
    }


  });
};

jQuery(window).load(function() {
  initSPPageBuilderGMap();
});

