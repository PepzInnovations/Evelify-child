// loading spinner
var opts = {
	lines: 13, // The number of lines to draw
	length: 9, // The length of each line
	width: 9, // The line thickness
	radius: 27, // The radius of the inner circle
	corners: 1, // Corner roundness (0..1)
	rotate: 0, // The rotation offset
	color: '#FFF', // #rgb or #rrggbb
	speed: 1.8, // Rounds per second
	trail: 81, // Afterglow percentage
	shadow: true, // Whether to render a shadow
	hwaccel: false, // Whether to use hardware acceleration
	className: 'spinner', // The CSS class to assign to the spinner
	zIndex: 2e9, // The z-index (defaults to 2000000000)
	top: 'auto', // Top position relative to parent in px
	left: 'auto' // Left position relative to parent in px
};

var target = document.getElementById('directory-main-bar'),
	spinner = new Spinner(opts).spin(target),
	spinnerDiv = mapDiv.find('.spinner');

var search = $('#directory-search'),
	searchInput = $('#dir-searchinput-text'),
	searchSubmit = $('#dir-searchsubmit'),
	categoryInput = $('#dir-searchinput-category'),
	locationInput = $('#dir-searchinput-location'),
	geoInput = $('#dir-searchinput-geo'),
	geoInputRadius = $('#dir-searchinput-geo-radius'),
	geoInputLat = $('#dir-searchinput-geo-lat'),
	geoInputLng = $('#dir-searchinput-geo-lng');

function showLoading(disableSubmit) {
	var topPosition = mapDiv.height() / 2;
	spinnerDiv.css('top',topPosition+'px').fadeIn();
	if (disableSubmit) {
		searchSubmit.attr('disabled', true);
	}
}

function hideLoading() {
	spinnerDiv.fadeOut();
	searchSubmit.attr('disabled', false);
}

// set interactive search
if(search.data('interactive') == 'yes'){
	searchInput.typeWatch({
		callback: function() {
			ajaxGetMarkers(true,false);
		},
		wait: 500,
		highlight: false,
		captureLength: 0
	});

	categoryInput.on("autocompleteselect", function( event, ui ) {
		ajaxGetMarkers(true,false,ui.item.value,false);
	});
	locationInput.on("autocompleteselect", function( event, ui ) {
		ajaxGetMarkers(true,false,false,ui.item.value);
	});
	categoryInput.on("autocompleteclose", function( event, ui ) {
		if($('#dir-searchinput-category-id').val() == '0'){
			ajaxGetMarkers(true,false);
		}
	});
	locationInput.on("autocompleteclose", function( event, ui ) {
		if($('#dir-searchinput-location-id').val() == '0'){
			ajaxGetMarkers(true,false);
		}
	});
}

$('#dir-searchinput-settings .icon').click(function() {
	$('#dir-search-advanced').toggle();
});

$('#dir-search-advanced-close').click(function() {
	$('#dir-search-advanced').hide();
});

$('#dir-search-advanced .value-slider').slider({
	value: geoInputRadius.val(),
	min: {ifset $themeOptions->search->advancedSearchMinValue}{$themeOptions->search->advancedSearchMinValue}{else}5{/ifset},
	max: {ifset $themeOptions->search->advancedSearchMaxValue}{$themeOptions->search->advancedSearchMaxValue}{else}2000{/ifset},
	step: {ifset $themeOptions->search->advancedSearchStepValue}{$themeOptions->search->advancedSearchStepValue}{else}5{/ifset},
	change: function(event, ui) {
		if(search.data('interactive') == 'yes' && geoInput.is(':checked')){
			ajaxGetMarkers(true,false);
		}
	},
	slide: function(event, ui) {
		geoInputRadius.val(ui.value);
	}
});

// Geolocation

geoInput.FancyCheckbox();

function enableGeo() {
	geoInput.attr('checked', true);
	geoInput.next().removeClass('off').addClass('on');
}

function disableGeo() {
	geoInput.attr('checked', false);
	geoInput.next().removeClass('on').addClass('off');
}

{if isset($isGeolocation, $_GET['geo-lat'], $_GET['geo-lng'], $_GET['geo-radius'])}
	generateOnlyGeo({$_GET['geo-lat']},{$_GET['geo-lng']},{$_GET['geo-radius']});
{else}
	if(geoInput.is(":checked")) {

		// enable after user allow geolocation
		disableGeo();
		showLoading(true);

		if (navigator.geolocation) {
			navigator.geolocation.getCurrentPosition(function(position) {

				geoInputLat.val(position.coords.latitude);
				geoInputLng.val(position.coords.longitude);

				enableGeo();

				ajaxGetMarkers(true,false);

			}, function(error){
				disableGeo();
				hideLoading();
			});
		} else {
			disableGeo();
			hideLoading();
		}

	}
{/if}

geoInput.on("change",function(event) {

	if(geoInput.is(":checked")) {

		// enable after user allow geolocation
		disableGeo();
		showLoading(true);

		if (navigator.geolocation) {
			navigator.geolocation.getCurrentPosition(function(position) {

				geoInputLat.val(position.coords.latitude);
				geoInputLng.val(position.coords.longitude);

				enableGeo();

				if(search.data('interactive') == 'yes'){
					ajaxGetMarkers(true,false);
				} else {
					hideLoading();
				}

			}, function(error){
				disableGeo();
				hideLoading();
			});
		} else {
			disableGeo();
			hideLoading();
		}

	} else {

		if(search.data('interactive') == 'yes'){
			ajaxGetMarkers(true,false);
		}

	}

});

function ajaxGetMarkers(ajax,geoloc,rewriteCategory,rewriteLocation,reset) {

	showLoading();

	radius = new Array();

	var category = 0;
	var location = 0;
	var search = '';

	if(ajax){
		if(rewriteCategory){
			category = rewriteCategory;
		} else {
			category = $('#dir-searchinput-category-id').val();
		}
		if(rewriteLocation){
			location = rewriteLocation;
		} else {
			location = $('#dir-searchinput-location-id').val();
		}
		search = $('#dir-searchinput-text').val();

		var ajaxGeo = $('#dir-searchinput-geo').attr("checked");

		if(ajaxGeo && !reset){
			var inputRadius = geoInputRadius.val();
			if(!isNaN(inputRadius)){
				radius.push(parseInt(inputRadius));
			} else {
				geoInputRadius.val(geoInputRadius.data('default-value'));
				radius.push(parseInt(geoInputRadius.data('default-value')));
			}
			radius.push(parseFloat(geoInputLat.val()));
			radius.push(parseFloat(geoInputLng.val()));
		}
	} else {
		if(reset){
			category = parseInt(mapDiv.data('category'));
			location = parseInt(mapDiv.data('location'));
			search = mapDiv.data('search');
		} else {
			if(geoloc){
				radius.push(parseInt({ifset $geolocationRadius}{$geolocationRadius}{else}100{/ifset}));
				radius.push(geoloc.lat());
				radius.push(geoloc.lng());

				category = parseInt(mapDiv.data('category'));
				location = parseInt(mapDiv.data('location'));
				search = mapDiv.data('search');
			}
		}
	}
	// get items from ajax
	$.post(
		// MyAjax defined in functions.php
		MyAjax.ajaxurl,
	    {
	        action : 'get_items',
	        category : category,
	        location : location,
	        search : search,
	        radius : radius
	    },
	    function( response ) {
	    	// show reset ajax button
	    	if((!reset) && (!geoloc) && ($('#directory-search').data('interactive') == 'yes')){
	    		$('#directory-search .reset-ajax').show();
	    	}
	    	{if isset($themeOptions->search->interactiveReplaceContent) && ($themeOptions->search->interactiveReplaceContent == 'enabled') }
	    	if((!reset) && (!geoloc)){
	    		generateContent(response);
	    	}
	    	{/if}
	    	if(ajaxGeo && !reset){
	    		var ajaxGeoObj = new google.maps.LatLng(parseFloat(geoInputLat.val()),parseFloat(geoInputLng.val()));
	    		generateMarkers(response,ajaxGeoObj,true);
	    	} else {
	    		generateMarkers(response,geoloc);
	    	}
	    }
	)
	.fail(function(e) { console.log("AJAX ERROR", e); });
}

function generateMarkers(dataRaw,geoloc,ajaxGeo) {

	// clear map
	infobox.close();
	mapDiv.gmap3({ clear: { } });

	map.setZoom({!$themeOptions->directory->setZoomIfOne});

	var len = $.map(dataRaw, function(n, i) { return i; }).length;

	var i = 0;
	// prepare data
	var data = new Array();
    for(var key in dataRaw){
    	if (!(dataRaw[key].optionsDir['gpsLatitude'] == "0" && dataRaw[key].optionsDir['gpsLongitude'] == "0")) {
	    	var rating = '';
			if(dataRaw[key].rating){
				rating += '<div class="rating">';
				for (var j = 1; j <= dataRaw[key].rating['max']; j++) {
					rating += '<div class="star';
					if(j <= dataRaw[key].rating['val']) {
						rating += ' active';
					}
					rating += '"></div>';
				}
				rating += '</div>';
			}

	    	var thumbCode = (dataRaw[key].timthumbUrl) ? ' with-image"><img src="'+dataRaw[key].timthumbUrl+'" alt="">' : '">';
	    	data[i] = {
				latLng: [dataRaw[key].optionsDir['gpsLatitude'],dataRaw[key].optionsDir['gpsLongitude']],
				options: {
					icon: dataRaw[key].marker,
					shadow: "{!$themeOptions->directoryMap->mapMarkerImageShadow}",
				},
				data: '<div class="marker-holder"><div class="marker-content'+thumbCode+'<div class="map-item-info"><div class="title">'+dataRaw[key].post_title+'</div>'+rating+'<div class="address">'+dataRaw[key].optionsDir["address"]+'</div><a href="'+dataRaw[key].link+'" class="more-button">{__ 'VIEW MORE'}</a></div><div class="arrow"></div><div class="close"></div></div></div></div>'
			};
			i++;
		}
    }

    // show geoloc marker
    if(geoloc){
    	mapDiv.gmap3({
			marker: {
    			latLng: geoloc,
    			options: {
    				animation: google.maps.Animation.DROP,
    				zIndex: 1000,
    				icon: "{$themeImgUrl}/geolocation-pin.png"
    			}
    		}
    	});
	}

	// generate markers in map
	var mapObj = {
		marker: {
			values: data,
			options:{
				draggable: false
			},
			{if !isset($themeOptions->directoryMap->clusterDisable)}
			cluster:{
				radius: {!((!empty($themeOptions->directoryMap->clusterRadius)) ? $themeOptions->directoryMap->clusterRadius : 20)},
				// This style will be used for clusters with more than 0 markers
				0: {
					content: "<div class='cluster cluster-1'>CLUSTER_COUNT</div>",
					width: 90,
					height: 80
				},
				// This style will be used for clusters with more than 20 markers
				20: {
					content: "<div class='cluster cluster-2'>CLUSTER_COUNT</div>",
					width: 90,
					height: 80
				},
				// This style will be used for clusters with more than 50 markers
				50: {
					content: "<div class='cluster cluster-3'>CLUSTER_COUNT</div>",
					width: 90,
					height: 80
				},
				events: {
					click: function(cluster) {
						map.panTo(cluster.main.getPosition());
						map.setZoom(map.getZoom() + 2);
					}
				}
			},
			{/if}
			events: {
				click: function(marker, event, context){
					map.panTo(marker.getPosition());

					infobox.setContent(context.data);
					infobox.open(map,marker);

					// if map is small
					var iWidth = 260;
					var iHeight = 300;
					if((mapDiv.width() / 2) < iWidth ){
						var offsetX = iWidth - (mapDiv.width() / 2);
						map.panBy(offsetX,0);
					}
					if((mapDiv.height() / 2) < iHeight ){
						var offsetY = -(iHeight - (mapDiv.height() / 2));
						map.panBy(0,offsetY);
					}

				}
			}
		}
	};

	if(geoloc){
		if(ajaxGeo){
			var inputRadius = geoInputRadius.val();
			if(!isNaN(inputRadius)){
				var radiusInM = parseInt(geoInputRadius.val()) * 1000;
			} else {
				var radiusInM = parseInt(geoInputRadius.data('default-value')) * 1000;
			}
			// autofit by circle
			mapObj.circle = {
				options: {
					center: geoloc,
					radius : radiusInM,
					visible : {ifset $themeOptions->search->showAdvancedSearchRadius}true{else}false{/ifset},
					fillOpacity : 0.15,
					fillColor : "#2c82be",
					strokeColor : "#2c82be"
				}
			}
		} else {
			var radiusInM = parseInt({ifset $geolocationRadius}{$geolocationRadius}{else}100{/ifset}) * 1000;
			// autofit by circle
			mapObj.circle = {
				options: {
					center: geoloc,
					radius : radiusInM,
					visible : {ifset $geolocationCircle}true{else}false{/ifset},
					fillOpacity : 0.15,
					fillColor : "#2c82be",
					strokeColor : "#2c82be"
				}
			}
		}
	}

	hideLoading();

	mapDiv.gmap3( mapObj, "autofit" );

	if(len == 1 && !geoloc){
		map.setZoom({!$themeOptions->directory->setZoomIfOne});
	}

}

function generateOnlyGeo(lat,lng,radius) {
	var geoloc = new google.maps.LatLng(parseFloat(lat),parseFloat(lng));
	// generate geo pin
	mapDiv.gmap3({
		marker: {
			latLng: geoloc,
			options: {
				animation: google.maps.Animation.DROP,
				zIndex: 1000,
				icon: "{$themeImgUrl}/geolocation-pin.png"
			}
		}
	});
	// generate and autofit by circle
	var mapObj = {};
	var radiusInM = parseInt(radius) * 1000;
	// autofit by circle
	mapObj.circle = {
		options: {
			center: geoloc,
			radius : radiusInM,
			visible : {ifset $themeOptions->search->showAdvancedSearchRadius}true{else}false{/ifset},
			fillOpacity : 0.15,
			fillColor : "#2c82be",
			strokeColor : "#2c82be"
		}
	}
	mapDiv.gmap3( mapObj, "autofit" );
}

var contentDiv = $('#main #content');
var currContent = contentDiv.html();
var ajaxContent;

function generateContent(data) {

	var length = $.map(data, function(n, i) { return i; }).length;

	contentDiv.find('.ajax-content').remove();
	var title;
	if(length == 0){
		title = $('<header class="entry-header"><h1 class="entry-title"><span>{__ 'No result found'}</span></h1></header>');
	} else {
		title = $('<header class="entry-header"><h1 class="entry-title"><span>{__ 'Search result'}</span></h1></header>');
	}

	var html;
	if(length > 0){
		html = $('<ul class="items"></ul>');
	}
	var limit = {ifset $themeOptions->search->interactiveContentMaxItems}{!$themeOptions->search->interactiveContentMaxItems}{else}30{/ifset};
	if(limit > length) {
		limit = length;
	}
	var i = 0;
	for(var key in data){
		var thumbnailHtml;
		if(data[key].timthumbUrlContent){
			var thumbnailHtml = '<div class="thumbnail"><img src="'+data[key].timthumbUrlContent+'" alt="Item thumbnail"><div class="comment-count">'+data[key].comment_count+'</div></div>';
		} else {
			thumbnailHtml = '';
		}
		var rating = '';
		if(data[key].rating){
			rating += '<span class="rating">';
			for (var i = 1; i <= data[key].rating['max']; i++) {
				rating += '<span class="star';
				if(i <= data[key].rating['val']) {
					rating += ' active';
				}
				rating += '"></span>';
			}
			rating += '</span>';
		}
		var descriptionHtml = '<div class="description"><h3><a href="'+data[key].link+'">'+data[key].post_title+'</a>'+rating+'</h3>'+data[key].excerptDir+'</div>';
		html.append('<li class="item clear">'+thumbnailHtml+descriptionHtml+'</li>');
		if(i <= limit){
			i++;
		} else {
			break;
		}
	};
	ajaxContent = $('<div class="ajax-content"></div>').html(title).append(html);
	contentDiv.find('>').hide();
	contentDiv.append(ajaxContent);
}

// reset search ajax values
$('#directory-search .reset-ajax').click(function () {

	// get default values
	ajaxGetMarkers(false,false,false,false,true);

	{if isset($themeOptions->search->interactiveReplaceContent) && ($themeOptions->search->interactiveReplaceContent == 'enabled') }
	contentDiv.find('.ajax-content').remove();
	contentDiv.find('>').show();
	{/if}

	$('#dir-searchinput-text').val("");
	// for IE
	$('span.for-dir-searchinput-text label').show();

	$('#dir-searchinput-location').val("");
	$('#dir-searchinput-location-id').val("0");
	// for IE
	$('span.for-dir-searchinput-category label').show();

	$('#dir-searchinput-category').val("");
	$('#dir-searchinput-category-id').val("0");
	// for IE
	$('span.for-dir-searchinput-location label').show();

	$('#dir-searchinput-geo').attr('checked',false);
	$('div.iphone-style[rel=dir-searchinput-geo]').removeClass('on').addClass('off');

	//geoInputRadius.val(geoInputRadius.data('default-value'));

	// hide close icon
	$(this).hide();
});

