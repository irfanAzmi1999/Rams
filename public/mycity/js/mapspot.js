(function(A) {

	if (!Array.prototype.forEach)
		A.forEach = A.forEach || function(action, that) {
			for (var i = 0, l = this.length; i < l; i++)
				if (i in this)
					action.call(that, this[i], i, this);
			};

		})(Array.prototype);

		var
		mapObject,
		markers = [],
		markersData = {
			'Maut': [
    			{
    				name: 'Jalan Sultan Salahuddin',
    				location_latitude: 3.155410, 
    				location_longitude: 101.688099,
    				name_point: 'MA1',
    				description_point: 'Jalan Sultan Salahuddin, 50480 Kuala Lumpur'
    			}
			],
            
            'Parah': [
    			{
    				name: 'Jalan Dato Onn',
    				location_latitude: 43.119445, 
    				location_longitude: 131.881006,
    				name_point: 'PA1',
    				description_point: 'Jalan Dato Onn, 50480 Kuala Lumpur'
    			},
    			{
    				name: 'Jalan Sultan Salahuddin',
    				location_latitude: 3.155496, 
    				location_longitude: 101.687026,
    				name_point: 'PA2',
    				description_point: 'Jalan Sultan Salahuddin, 50480 Kuala Lumpur'
    			}
    		],
            
			'Ringan': [
    			{
    				name: 'Jalan Sultan Salahuddin',
    				location_latitude: 3.155633, 
    				location_longitude: 101.686343,
    				name_point: 'RI1',
    				description_point: 'Jalan Sultan Salahuddin, 50480 Kuala Lumpur. Jalan Sultan Salahuddin, 50480 Kuala Lumpur. Jalan Sultan Salahuddin, 50480 Kuala Lumpur. Jalan Sultan Salahuddin, 50480 Kuala Lumpur. Jalan Sultan Salahuddin, 50480 Kuala Lumpur. Jalan Sultan Salahuddin, 50480 Kuala Lumpur. Jalan Sultan Salahuddin, 50480 Kuala Lumpur. Jalan Sultan Salahuddin, 50480 Kuala Lumpur. Jalan Sultan Salahuddin, 50480 Kuala Lumpur. Jalan Sultan Salahuddin, 50480 Kuala Lumpur. Jalan Sultan Salahuddin, 50480 Kuala Lumpur. Jalan Sultan Salahuddin, 50480 Kuala Lumpur. Jalan Sultan Salahuddin, 50480 Kuala Lumpur. Jalan Sultan Salahuddin, 50480 Kuala Lumpur. Jalan Sultan Salahuddin, 50480 Kuala Lumpur. Jalan Sultan Salahuddin, 50480 Kuala Lumpur. Jalan Sultan Salahuddin, 50480 Kuala Lumpur.'
    			},
    			{
    				name: 'Jalan Sultan Salahuddin',
    				location_latitude: 3.155432, 
    				location_longitude: 101.880126,
    				name_point: 'RI5',
    				description_point: 'Jalan Sultan Salahuddin, 50480 Kuala Lumpur'
    			}
			],

			'Rosak': [
    			{
    				name: 'Jalan Sultan Salahuddin',
    				location_latitude: 3.155415, 
    				location_longitude: 101.687622,
    				name_point: 'RO1',
    				description_point: 'Jalan Sultan Salahuddin, 50480 Kuala Lumpur'
    			}
    		]

        };
        
        function initialize () {
			var mapOptions = {
				zoom: 16,
                center: new google.maps.LatLng(3.1544913, 101.687028),
				mapTypeId: google.maps.MapTypeId.ROADMAP,

				mapTypeControl: false,
				mapTypeControlOptions: {
					style: google.maps.MapTypeControlStyle.DROPDOWN_MENU,
					position: google.maps.ControlPosition.LEFT_CENTER
				},
				panControl: false,
				panControlOptions: {
					position: google.maps.ControlPosition.TOP_RIGHT
				},
				zoomControl: true,
				zoomControlOptions: {
					style: google.maps.ZoomControlStyle.LARGE,
					position: google.maps.ControlPosition.TOP_LEFT
				},
				scaleControl: true,
				scaleControlOptions: {
					position: google.maps.ControlPosition.TOP_LEFT
				},
				streetViewControl: false,
				streetViewControlOptions: {
					position: google.maps.ControlPosition.LEFT_TOP
				},
				//styles: [{"featureType":"poi","stylers":[{"visibility":"off"}]},{"stylers":[{"saturation":-70},{"lightness":37},{"gamma":1.15}]},{"elementType":"labels","stylers":[{"gamma":0.26},{"visibility":"off"}]},{"featureType":"road","stylers":[{"lightness":0},{"saturation":0},{"hue":"#ffffff"},{"gamma":0}]},{"featureType":"road","elementType":"labels.text.stroke","stylers":[{"visibility":"off"}]},{"featureType":"road.arterial","elementType":"geometry","stylers":[{"lightness":20}]},{"featureType":"road.highway","elementType":"geometry","stylers":[{"lightness":50},{"saturation":0},{"hue":"#ffffff"}]},{"featureType":"administrative.province","stylers":[{"visibility":"on"},{"lightness":-50}]},{"featureType":"administrative.province","elementType":"labels.text.stroke","stylers":[{"visibility":"off"}]},{"featureType":"administrative.province","elementType":"labels.text","stylers":[{"lightness":20}]}]
                //styles: [{"featureType":"water","stylers":[{"saturation":43},{"lightness":-11},{"hue":"#0088ff"}]},{"featureType":"road","elementType":"geometry.fill","stylers":[{"hue":"#ff0000"},{"saturation":-100},{"lightness":99}]},{"featureType":"road","elementType":"geometry.stroke","stylers":[{"color":"#808080"},{"lightness":54}]},{"featureType":"landscape.man_made","elementType":"geometry.fill","stylers":[{"color":"#ece2d9"}]},{"featureType":"poi.park","elementType":"geometry.fill","stylers":[{"color":"#ccdca1"}]},{"featureType":"road","elementType":"labels.text.fill","stylers":[{"color":"#767676"}]},{"featureType":"road","elementType":"labels.text.stroke","stylers":[{"color":"#ffffff"}]},{"featureType":"poi","stylers":[{"visibility":"off"}]},{"featureType":"landscape.natural","elementType":"geometry.fill","stylers":[{"visibility":"on"},{"color":"#b8cb93"}]},{"featureType":"poi.park","stylers":[{"visibility":"on"}]},{"featureType":"poi.sports_complex","stylers":[{"visibility":"on"}]},{"featureType":"poi.medical","stylers":[{"visibility":"on"}]},{"featureType":"poi.business","stylers":[{"visibility":"simplified"}]}]
                styles: [{"featureType":"water","stylers":[{"saturation":43},{"lightness":-11},{"hue":"#0088ff"}]},{"featureType":"road","elementType":"geometry.fill","stylers":[{"hue":"#ff0000"},{"saturation":-100},{"lightness":99}]},{"featureType":"road","elementType":"geometry.stroke","stylers":[{"color":"#808080"},{"lightness":54}]},{"featureType":"landscape.man_made","elementType":"geometry.fill","stylers":[{"color":"#ece2d9"}]},{"featureType":"poi.park","elementType":"geometry.fill","stylers":[{"color":"#ccdca1"}]},{"featureType":"road","elementType":"labels.text.fill","stylers":[{"color":"#767676"}]},{"featureType":"road","elementType":"labels.text.stroke","stylers":[{"color":"#ffffff"}]},{"featureType":"poi","stylers":[{"visibility":"off"}]},{"featureType":"landscape.natural","elementType":"geometry.fill","stylers":[{"visibility":"on"},{"color":"#b8cb93"}]},{"featureType":"poi.park","stylers":[{"visibility":"off"}]},{"featureType":"poi.sports_complex","stylers":[{"visibility":"off"}]},{"featureType":"poi.medical","stylers":[{"visibility":"off"}]},{"featureType":"poi.business","stylers":[{"visibility":"off"}]},{"featureType":"transit.station.rail","stylers":[{"visibility":"off"}]},{"featureType":"transit.station.bus","stylers":[{"visibility":"off"}]}]
			};
			var
			marker;
			mapObject = new google.maps.Map(document.getElementById('map'), mapOptions);
			for (var key in markersData)
				markersData[key].forEach(function (item) {
					marker = new google.maps.Marker({
						position: new google.maps.LatLng(item.location_latitude, item.location_longitude),
						map: mapObject,
						icon: 'rams/images/spot/' + key + '.png',
					});

					if ('undefined' === typeof markers[key])
						markers[key] = [];
					markers[key].push(marker);
					google.maps.event.addListener(marker, 'click', (function () {
                      closeInfoBox();
                      getInfoBox(item).open(mapObject, this);
                      mapObject.setCenter(new google.maps.LatLng(item.location_latitude, item.location_longitude));
                     }));

					
			});
        };

		function hideAllMarkers () {
			for (var key in markers)
				markers[key].forEach(function (marker) {
					marker.setMap(null);
				});
		};

		function toggleMarkers (category) {
			hideAllMarkers();
			closeInfoBox();

			if ('undefined' === typeof markers[category])
				return false;
			markers[category].forEach(function (marker) {
				marker.setMap(mapObject);
				marker.setAnimation(google.maps.Animation.DROP);

			});
		};
		
		function closeInfoBox() {
			$('div.infoBox').remove();
		};

		function getInfoBox(item) {
			return new InfoBox({
				content:
				'<div class="marker_info none" id="marker_info">' +
    				'<div class="info" id="info">'+
        				'<a class="close close_info" onclick="closeInfoBox();">x</a>' +
                        '<h2>'+ item.name_point +'<span></span></h2>' +
        				'<span>'+ item.description_point +'</span>' +
                        '<span class="arrow"></span>' +
    				'</div>' +
				'</div>',
				disableAutoPan: true,
				maxWidth: 0,
				pixelOffset: new google.maps.Size(40, -210),
				//closeBoxMargin: '50px 200px',
				closeBoxURL: '',
				isHidden: false,
				pane: 'floatPane',
				enableEventPropagation: false
            });
        };
        
        function getInfoBox2(item) {
			return new InfoBox({
				content:
				'<div class="marker_info none" id="marker_info">' +
    				'<div class="info" id="info">'+
    				'<img src="' + item.map_image_url + '" class="logotype" alt=""/>' +
    				'<h2>'+ item.name_point +'<span></span></h2>' +
    				'<span>'+ item.description_point +'</span>' +
    				'<a href="'+ item.url_point + '" class="green_btn">More info</a>' +
    				'<span class="arrow"></span>' +
    				'</div>' +
				'</div>',
				disableAutoPan: true,
				maxWidth: 0,
				pixelOffset: new google.maps.Size(40, -210),
				closeBoxMargin: '50px 200px',
				closeBoxURL: '',
				isHidden: false,
				pane: 'floatPane',
				enableEventPropagation: true
            });
        };




