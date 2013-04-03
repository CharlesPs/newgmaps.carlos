
var mapa;

var lambayeque = {
	lat: -6.37,
	lng: -79.78,
	zoom: 9
};

var pos_inicio;

function init_gmaps(){

	initialize();
}

function initialize(){

	// si hay preview data o sino coge datos generales
	if(preview_data.lat && preview_data.lng && preview_data.zoom){
		pos_inicio = new google.maps.LatLng(preview_data.lat, preview_data.lng);
		zoom_inicio = preview_data.zoom;
	}else{
		pos_inicio = new google.maps.LatLng(lambayeque.lat, lambayeque.lng);
		zoom_inicio = lambayeque.zoom;
	}

	var myOptions = {
		zoom: zoom_inicio,
		center: pos_inicio,
		disableDefaultUI: true,
		mapTypeId: google.maps.MapTypeId.HYBRID,
		panControl: false,
		zoomControl: false,
		scaleControl: true,
		mapTypeControl: false,
		overviewMapControl: false
	}
	mapa = new google.maps.Map(document.getElementById("gmaps"), myOptions);

	var poligono_paths = [];
	
	$.each(preview_coords, function(index, value){

		var latitude = value[0];
		var longitude = value[1];

		var coordenadas = new google.maps.LatLng(latitude, longitude);

		poligono_paths.push(coordenadas);

	});
	
	var poligono = new google.maps.Polygon({
		paths: poligono_paths,
		strokeColor: '#FF0000',
		strokeOpacity: 1,
		strokeWeight: 2,
		fillColor: '#FF0000',
		fillOpacity: 0.2
	});

	poligono.setMap(mapa);
}
