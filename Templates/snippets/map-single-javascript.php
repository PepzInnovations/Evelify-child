{if isset($options['gpsLatitude'], $options['gpsLongitude']) && !(empty($options['gpsLatitude']) && empty($options['gpsLongitude']))}
<script type="text/javascript">
	var map,
		mapDiv,
		smallMapDiv,
		infobox;

	/*******************************************
	 MARTIN 11.7.2013 MAP STYLING SUPPORT
	********************************************/					
	function aitAddMapStyles(hueVal, lightnessVal, saturationVal, gammaVal) {

		var stylersArray = [];

		if (hueVal) {
			stylersArray.push({
				"hue": hueVal
			});
		}

		 if (lightnessVal) {
			var mapLightness = parseInt(lightnessVal);
			if (mapLightness < -100) {
				mapLightness = -100;
			} else if (mapLightness > 100) {
				mapLightness = 100;
			}
			stylersArray.push({
				"lightness": mapLightness
			});
		}

		if (saturationVal) {
			var mapSaturation = parseInt(saturationVal);
			if (mapSaturation < -100) {
				mapSaturation = -100;
			} else if (mapSaturation > 100) {
				mapSaturation = 100;
			}
			stylersArray.push({
				"saturation": mapSaturation
			});
		}

		if (gammaVal) {
			var mapGamma = parseFloat(gammaVal);
			if (mapGamma < 0.01) {
				mapGamma = 0.01;
			} else if (mapGamma > 9.99) {
				mapGamma = 9.99;
			}
			stylersArray.push({
				"gamma": mapGamma
			});
		}

		return stylersArray;
	}
	/*******************************************
	 // END MAP STYLING SUPPORT
	********************************************/

	jQuery(document).ready(function($) {
		mapDiv = $("#directory-main-bar");
		smallMapDiv = $(".item-map");

		smallMapDiv.width(1000).height(400).gmap3({
			map: {
				options: {
					center: [{ifset $options['gpsLatitude']}{$options['gpsLatitude']}{else}0{/ifset}, {ifset $options['gpsLongitude']}{$options['gpsLongitude']}{else}0{/ifset}],
					zoom: 18,
					scrollwheel: false
				}
			},
			marker: {
				values: [
					{
						latLng: [{ifset $options['gpsLatitude']}{$options['gpsLatitude']}{else}0{/ifset}, {ifset $options['gpsLongitude']}{$options['gpsLongitude']}{else}0{/ifset}]
					}
				]
			}
		});

		mapDiv.height({!$themeOptions->directoryMap->mapHeight}).gmap3({
			map: {
				options: {
					{foreach parseMapOptions($themeOptions->directoryMap) as $key => $value}
					{if $iterator->first}{$key}: {!$value}{else},{$key}: {!$value}{/if}
					{/foreach}
					{if count($items) <= 1}
					,center: [{ifset $options['gpsLatitude']}{$options['gpsLatitude']}{else}0{/ifset}, {ifset $options['gpsLongitude']}{$options['gpsLongitude']}{else}0{/ifset}]
					,zoom: {!$themeOptions->directory->setZoomIfOne}
					{/if}

					/*******************************************
					 MARTIN 11.7.2013 MAP STYLING SUPPORT
					********************************************/

					{if isset($themeOptions->directoryMap->changeMapStyle) &&
						(!empty($themeOptions->directoryMap->mapStyleHue) || !empty($themeOptions->directoryMap->mapStyleSaturation) || 
						 !empty($themeOptions->directoryMap->mapStyleLightness) || !empty($themeOptions->directoryMap->mapStyleGamma))}
					,styles: [{
						"stylers": aitAddMapStyles({$themeOptions->directoryMap->mapStyleHue}, {$themeOptions->directoryMap->mapStyleLightness}, 
							{$themeOptions->directoryMap->mapStyleSaturation}, {$themeOptions->directoryMap->mapStyleGamma})
					}]
					{/if}
					/*******************************************
					 // END MAP STYLING SUPPORT
					********************************************/
				}

			},
			marker: {
				values: [
					{foreach $items as $item}
						{
							latLng: [{ifset $item->optionsDir['gpsLatitude']}{!$item->optionsDir['gpsLatitude']}{else}0{/ifset},{ifset $item->optionsDir['gpsLongitude']}{!$item->optionsDir['gpsLongitude']}{else}0{/ifset}],
							options: {
								icon: "{!$item->marker}",
								shadow: "{!$themeOptions->directoryMap->mapMarkerImageShadow}",
							},
							data: 	'<div class="marker-holder">'+
									'<div class="marker-content{ifset $item->thumbnailDir} with-image"><img src="{thumbnailResize $item->thumbnailDir, w => 120, h => 160}" alt="">{else}">{/ifset}'+
										'<div class="map-item-info">'+
											'<div class="title">'+{ifset $item->post_title}{$item->post_title}+{/ifset}'</div>'+
											{if $item->rating}
											'<div class="rating">'+
												{for $i=1; $i <= $item->rating["max"]; $i++}
													'<div class="star{if $i <= $item->rating["val"]} active{/if}"></div>'+
												{/for}
											'</div>'+
											{/if}
											'<div class="address">'+{ifset $item->optionsDir["address"]}{$item->optionsDir["address"]|nl2br}+{/ifset}'</div>'+
											'<div data-link="{!$item->link}" class="more-button">' + {__ 'VIEW MORE'} + '</div>'+
											'</div><div class="arrow"></div><div class="close"></div>'+
										'</div>'+
									'</div>'+
								'</div>',
							tag: "marker-{!$item->ID}"
						}
					{if !($iterator->last)},{/if}
					{/foreach}
				],
				options:{
					draggable: false
				},
				events: {
					click: function(marker, event, context){
						map.panTo(marker.getPosition());

						infobox.setContent(context.data);
						infobox.open(map,marker);

						// if map is small
						// 	var iWidth = 260;
						// 	var iHeight = 300;
						// 	if((mapDiv.width() / 2) < iWidth ){
						// 		var offsetX = iWidth - (mapDiv.width() / 2);
						// 		map.panBy(offsetX,0);
						// 	}
						// 	if((mapDiv.height() / 2) < iHeight ){
						// 		var offsetY = -(iHeight - (mapDiv.height() / 2));
						// 		map.panBy(0,offsetY);
						// 	}
					}
				}
			}
			{ifset $isGeolocation}
			,getgeoloc:{
				callback : function(latLng){

					$(this).gmap3({
						marker: {
							latLng: latLng,
							options: {
								animation: google.maps.Animation.DROP
							}
						}
					});

				}
			}
			{/ifset}
			{ifset $options['showStreetview']}
			,streetviewpanorama:{
				options: {
					container: mapDiv,
					opts:{
						position: [parseFloat({$options['streetViewLatitude']}),parseFloat({$options['streetViewLongitude']})],
						pov: {
							heading: parseFloat({$options['streetViewHeading']}),
							pitch: parseFloat({$options['streetViewPitch']}),
							zoom: parseInt({$options['streetViewZoom']})
						},
						scrollwheel : {ifset $themeOptions->directoryMap->scrollwheel}true{else}false{/ifset},
						enableCloseButton : true
					}
				}
			}
			{/ifset}
		}{if count($items) > 1},"autofit"{/if});

		map = mapDiv.gmap3("get");
		infobox = new InfoBox({
			pixelOffset: new google.maps.Size(-225, -65),
			closeBoxURL: '',
			enableEventPropagation: true
		});
		mapDiv.delegate('.infoBox .close','click',function () {
			infobox.close();
		});
		// hotfix for chrome on android
		mapDiv.delegate('.infoBox div.more-button', 'click', function() {
			window.location = $(this).data('link');
		});

		var currMarker = mapDiv.gmap3({ get: { name: "marker", tag: "marker-{!$post->id}"}});
		infobox.setContent(
			'<div class="marker-holder">'+
				'<div class="marker-content{if !empty($thumbnailDir)} with-image"><img src="{timthumb src => $thumbnailDir, w => 120, h => 160}" alt="">{else}">{/if}'+
					'<div class="map-item-info">'+
						'<div class="title">'+{$post->title}+'</div>'+
						{if $rating}
						'<div class="rating">'+
							{for $i=1; $i <= $rating["max"]; $i++}
								'<div class="star{if $i <= $rating["val"]} active{/if}"></div>'+
							{/for}
						'</div>'+
						{/if}
						'<div class="address">'+{ifset $options["address"]}{$options["address"]|nl2br}+{/ifset}'</div>'+
						'<div data-link="{!$post->link}" class="more-button">' + {__ 'VIEW MORE'} + '</div>'+
						'</div><div class="arrow"></div><div class="close"></div>'+
					'</div>'+
				'</div>'+
			'</div>'
		);
		infobox.open(map,currMarker);
		{if count($items) > 1}
		map.panTo(new google.maps.LatLng({!$options['gpsLatitude']}, {!$options['gpsLongitude']}));
		{/if}

		if (Modernizr.touch){
			{ifset $themeOptions->directoryMap->draggableForTouch}map.setOptions({ draggable : true });{else}map.setOptions({ draggable : false });{/ifset}
			{ifset $themeOptions->directoryMap->draggableToggleButton}
			var draggableClass = {ifset $themeOptions->directoryMap->draggableForTouch}'active'{else}'inactive'{/ifset};
			var draggableTitle = {ifset $themeOptions->directoryMap->draggableForTouch}{__ 'Deactivate map'}{else}{__ 'Activate map'}{/ifset};
			var draggableButton = $('<div class="draggable-toggle-button '+draggableClass+'">'+draggableTitle+'</div>').appendTo(mapDiv);
			draggableButton.click(function () {
				if($(this).hasClass('active')){
					$(this).removeClass('active').addClass('inactive').text({__ 'Activate map'});
					map.setOptions({ draggable : false });
				} else {
					$(this).removeClass('inactive').addClass('active').text({__ 'Deactivate map'});
					map.setOptions({ draggable : true });
				}
			});
			{/ifset}
		}

		{include 'ajaxfunctions-javascript.php'}

	});
</script>
{/if}