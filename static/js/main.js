
var gmaps_frame_name = "#gmaps";

var mapa;

var lambayeque = {
	lat: -6.37,
	lng: -79.78,
	zoom: 9
};

var pos_inicio;

var svg = {
	lat: -5.55,
	lng: -80.88
};

var comunidades_array = [];
var provincias_array = [];
var distritos_array = [];
var hidrografia_array = [];
var vias_array = [];
var ecologico_array = [];
var bosques_01_array = [];

var loading_active = false;

var showing_comunidades = false;
var capa_comunidades;

var showing_rios = false;
var capa_rios;

var showing_provincias = false;
var capa_provincias;

var showing_distritos = false;
var capa_distritos;

var showing_hidrografia = false;
var capa_hidrografia;

var showing_vias = false;
var capa_vias;

var showing_ecologico = false;
var capa_ecologico;

// INIT

$(document).on("ready", init_gmaps);

function init_gmaps(){

	initialize();
	
	resize_frame();

	$(window).on("resize", resize_frame);
}

function initialize(){
  pos_inicio = new google.maps.LatLng(lambayeque.lat, lambayeque.lng);
  var myOptions = {
	zoom: lambayeque.zoom,
    center: pos_inicio,
    disableDefaultUI: true,
    mapTypeId: google.maps.MapTypeId.HYBRID,
	panControl: true,
	zoomControl: true,
	scaleControl: true,
	mapTypeControl: false,
	overviewMapControl: false
  }
  mapa = new google.maps.Map(document.getElementById("gmaps"), myOptions);

  var homeControl = new addControl({
  	id: "home-control",
  	content: "Inicio",
  	title: "Volver al inicio",
  	position: "top_left",
  	clases: "home-button control",
  	on_click: function() {
	    mapa.setCenter(pos_inicio);
	    mapa.setZoom(lambayeque.zoom);
	}
  }, mapa);

var minimapa = new addControl({
	id: "minimapa",
	content: '<img src="static/img/minimapa.png" width="172" height="232" />',
	title: "Mini Mapa",
	position: "left_bottom",
	clases: "minimapa",
	on_click: function() {}
}, mapa);

	var info_panel = new addControl({
		id: "info_panel",
		content: '<div class="panel_close"></div><h1 class="panel_title">Title</h1><div class="panel_content">Content</div>',
		title: "",
		position: "right_top",
		clases: "info_panel panel",
		on_click: function() {}
	}, mapa);

	var georssLayer = new google.maps.KmlLayer('http://mapas.apfeldor.com/static/kml/perimetro-lambayeque.kml');
	georssLayer.setMap(mapa);

	create_bottom_buttons_container();

	// Menu Capas
	var lista_combo_capas = $('<div id="lista_combo_capas" class="lista_combo lista_combo_capas"></div>');
	lista_combo_capas.append($('<ul></ul>'));
	lista_combo_capas.find("ul").append($('<li class="capa_mapa_ecologico">Mapa Ecológico</li>'));
	lista_combo_capas.find("ul").append($('<li class="capa_comunidades">Comunidades</li>'));
	lista_combo_capas.find("ul").append($('<li class="capa_hidrografia">Hidrografia</li>'));
	lista_combo_capas.find("ul").append($('<li class="capa_provincias">Provincias</li>'));
	lista_combo_capas.find("ul").append($('<li class="capa_distritos">Distritos</li>'));
	lista_combo_capas.find("ul").append($('<li class="capa_vias">Vías</li>'));

	var lista_combo_capas_created = false;

	var combo_capas = new addControl({
	  	id: "combo-capas",
	  	content: '<img class="loading-image" src="static/img/animated_loading.gif" width="16" height="16" alt="loading" />Capas',
	  	title: "Seleccionar las capas que desea inspeccionar",
	  	position: "top_left",
	  	clases: "control-combo combo_capas control",
	  	on_click: function() {

				if(!lista_combo_capas_created){
					$("#combo-capas").append(lista_combo_capas);
					lista_combo_capas_created = true;

					// setup menu mostrar por
					$("#combo-capas .capa_mapa_forestal").on("click", function(){
						
						// oculta todos los submenus
						$(".submenu").hide();

						$("#combo-mostrar-por").show();
					});

					$("#combo-capas .capa_comunidades").on("click", function(){
						// oculta todos los submenus
						$(".submenu").hide();

						if(comunidades_array.length){
							if(showing_comunidades){
								comunidades_hide();
							}else{
								comunidades_show();
							}
						}else{
							comunidades_load();
						}
					});

					$("#combo-capas .capa_mapa_ecologico").on("click", function(){
						// oculta todos los submenus
						$(".submenu").hide();

						if(ecologico_array.length){
							if(showing_ecologico){
								ecologico_hide();
							}else{
								ecologico_show();
							}
						}else{
							ecologico_load();
						}
					});

					$("#combo-capas .capa_provincias").on("click", function(){
						// oculta todos los submenus
						$(".submenu").hide();

						if(provincias_array.length){
							if(showing_provincias){
								provincias_hide();
							}else{
								provincias_show();
							}
						}else{
							provincias_load();
						}
					});

					$("#combo-capas .capa_distritos").on("click", function(){
						// oculta todos los submenus
						$(".submenu").hide();

						if(distritos_array.length){
							if(showing_distritos){
								distritos_hide();
							}else{
								distritos_show();
							}
						}else{
							distritos_load();
						}
					});

					$("#combo-capas .capa_hidrografia").on("click", function(){
						// oculta todos los submenus
						$(".submenu").hide();

						if(hidrografia_array.length){
							if(showing_hidrografia){
								hidrografia_hide();
							}else{
								hidrografia_show();
							}
						}else{
							hidrografia_load();
						}
					});

					$("#combo-capas .capa_vias").on("click", function(){
						// oculta todos los submenus
						$(".submenu").hide();

						if(vias_array.length){
							if(showing_vias){
								vias_hide();
							}else{
								vias_show();
							}
						}else{
							vias_load();
						}
					});
				}

				lista_combo_capas.toggle();
	  	}
	});

}

/*
UI - functions
*/

function resize_frame(){

	var window_w = $(window).width();
	var window_h = $(window).height();

	/*var window_w = "841mm";
	var window_h = "594mm";*/

	$(gmaps_frame_name).css("width", window_w);
	$(gmaps_frame_name).css("height", window_h);
}

function addControl(options, map) {

	var controlItem = document.createElement('DIV');
	controlItem.id = options.id;
	controlItem.className = options.clases;
	controlItem.innerHTML = options.content;
	controlItem.title = options.title;

	google.maps.event.addDomListener(controlItem, 'click', options.on_click);

	var position = google.maps.ControlPosition[options.position.toUpperCase()];

	if(options.on_ready){
		options.on_ready;
	}

	mapa.controls[position].push(controlItem);
}

function addMarker(lat_lng, title) {
	marker = new google.maps.Marker({
		position: lat_lng,
		map: mapa
	});
	comunidades_array.push(marker);
}

function show_info_panel(data){
	$("#info_panel").find(".panel_title").html(data.nombre);
	$("#info_panel").find(".panel_content").html(data.content);

	$("#info_panel").show();

	$("#info_panel").find(".panel_close").live("click", hide_info_panel)
}

function hide_info_panel(){
	$("#info_panel").find(".panel_close").on("click", function(){
		$("#info_panel .panel_title").html("");
		$("#info_panel .panel_content").html("");

		$("#info_panel").hide();
	});
}

function create_bottom_buttons_container(){
  var comunidadesBtn = new addControl({
  	id: "bottom_buttons_container",
  	content: '',
  	title: "",
  	position: "bottom_left",
  	clases: "bottom-container",
  	on_click: function() {}
  }, mapa);
}

function bottom_btn_create(clase, texto, onclick){
	var hide_button = $('<div id="hide-' + clase + '"></div>');
	hide_button.addClass("bottom-button");
	hide_button.html('<span>' + texto + '</span><img src="static/img/bottom_close.png" width="16" height="16" alt="" />');

	hide_button.on("click", onclick);

	$("#bottom_buttons_container").append(hide_button);
}

function bottom_btn_delete(clase){
	$("#hide-" + clase).fadeOut();
	$("#hide-" + clase).remove();
}

/*
Comunidades
*/

function comunidades_load(){

	//loading_active = true;
	$(".loading-image").fadeIn();

	$.ajax({
		url : 'capas/comunidades',
		dataType : 'json',
		error : function(){},
		success : function(ret){
			$.each(ret, function(index, coord){

				var lat_lng = new google.maps.LatLng(coord.lat, coord.lng);
				var marker = new google.maps.Marker({
					position: lat_lng,
					map: null
				});
				comunidades_array.push(marker);
			});
			comunidades_show();
			$(".loading-image").fadeOut();
		}
	});
}

function comunidades_show(){
	if (comunidades_array) {
		for (i in comunidades_array) {
			comunidades_array[i].setMap(mapa);
		}
	}
	bottom_btn_create("comunidades", "Comunidades", function(){
		comunidades_hide();
	});
	showing_comunidades = true;
}

function comunidades_hide(){
	if (comunidades_array) {
		for (i in comunidades_array) {
			comunidades_array[i].setMap(null);
		}
	}
	bottom_btn_delete("comunidades");
	showing_comunidades = false;
}

/*
Provincias
*/

function provincias_load(){

	//loading_active = true;
	$(".loading-image").fadeIn();

	$.ajax({
		url : 'capas/provincias',
		dataType : 'json',
		error : function(){},
		success : function(ret){
			$.each(ret, function(index, value){

				var poligono_coords = [];

				var puntos = ret[index].points;
				
				$.each(puntos, function(index2, value2){

					var coordenadas = new google.maps.LatLng(value2.latitude, value2.longitude);

					poligono_coords.push(coordenadas);

				});
				
				var poligono = new google.maps.Polygon({
					paths: poligono_coords,
					strokeColor: ret[index].color,
					strokeOpacity: 1,
					strokeWeight: 2,
					fillColor: ret[index].color,
					fillOpacity: 0.2
				});

				//poligono.setMap(mapa);

				// Add a listener for the click event
				google.maps.event.addListener(poligono, 'click', function(){

					var data = {
						nombre : ret[index].nombre,
						content : ret[index].content
					};
					show_info_panel(data);
				});

				provincias_array.push(poligono);
			});
			provincias_show();
			$(".loading-image").fadeOut();
		}
	});
}

function provincias_show(){
	if (provincias_array) {
		for (i in provincias_array) {
			provincias_array[i].setMap(mapa);
		}
	}
	bottom_btn_create("provincias", "Provincias", function(){
		provincias_hide();
	});
	showing_provincias = true;
}

function provincias_hide(){
	if (provincias_array) {
		for (i in provincias_array) {
			provincias_array[i].setMap(null);
		}
	}
	bottom_btn_delete("provincias");
	showing_provincias = false;
}

/*
Distritos
*/

function distritos_load(){

	//loading_active = true;
	$(".loading-image").fadeIn();

	$.ajax({
		url : 'capas/distritos',
		dataType : 'json',
		error : function(){},
		success : function(ret){
			$.each(ret, function(index, value){

				var poligono_coords = [];

				var puntos = ret[index].points;
				
				$.each(puntos, function(index2, value2){

					var coordenadas = new google.maps.LatLng(value2.latitude, value2.longitude);

					poligono_coords.push(coordenadas);

				});

				var color = (ret[index].color.length == 6) ? "#" + ret[index].color : ret[index].color;
				
				var poligono = new google.maps.Polygon({
					paths: poligono_coords,
					strokeColor: color,
					strokeOpacity: 1,
					strokeWeight: 2,
					fillColor: color,
					fillOpacity: 0.2
				});

				google.maps.event.addListener(poligono, 'click', function(){

					var data = {
						nombre : ret[index].nombre,
						content : ret[index].content
					};
					show_info_panel(data);
				});

				distritos_array.push(poligono);
			});
			distritos_show();
			$(".loading-image").fadeOut();
		}
	});
}

function distritos_show(){
	if (distritos_array) {
		for (i in distritos_array) {
			distritos_array[i].setMap(mapa);
		}
	}
	bottom_btn_create("distritos", "Distritos", function(){
		distritos_hide();
	});
	showing_distritos = true;
}

function distritos_hide(){
	if (distritos_array) {
		for (i in distritos_array) {
			distritos_array[i].setMap(null);
		}
	}
	bottom_btn_delete("distritos");
	showing_distritos = false;
}

/*
Vias
*/

function vias_load(){

	//loading_active = true;
	$(".loading-image").fadeIn();

	$.ajax({
		url : 'capas/vias',
		dataType : 'json',
		error : function(){},
		success : function(ret){
			$.each(ret, function(index, value){

				var polilinea_coords = [];

				var puntos = ret[index].coordinates;
				
				$.each(puntos, function(index2, value2){

					var latitude = value2[1] * 1;
					var longitude = value2[0] * 1;

					var coordenadas = new google.maps.LatLng(latitude, longitude);

					polilinea_coords.push(coordenadas);

				});
				
				var polilinea = new google.maps.Polyline({
					path: polilinea_coords,
					strokeColor: "#F9DE2F",
					strokeOpacity: 1,
					strokeWeight: 2
				});

				vias_array.push(polilinea);
			});
			vias_show();
			$(".loading-image").fadeOut();
		}
	});
}

function vias_show(){
	if (vias_array) {
		for (i in vias_array) {
			vias_array[i].setMap(mapa);
		}
	}
	bottom_btn_create("vias", "Vías", function(){
		vias_hide();
	});
	showing_vias = true;
}

function vias_hide(){
	if (vias_array) {
		for (i in vias_array) {
			vias_array[i].setMap(null);
		}
	}
	bottom_btn_delete("vias");
	showing_vias = false;
}

/*
Hidrografia
*/

function hidrografia_load(){

	//loading_active = true;
	$(".loading-image").fadeIn();

	$.ajax({
		url : 'capas/hidrografia',
		dataType : 'json',
		error : function(){},
		success : function(ret){
			$.each(ret, function(index, value){

				var polilinea_coords = [];

				var puntos = ret[index].points;

				$.each(puntos, function(index2, value2){

					var latitude = value2[1];
					var longitude = value2[0];

					var coordenadas = new google.maps.LatLng(latitude, longitude);

					polilinea_coords.push(coordenadas);

				});
				
				var polilinea = new google.maps.Polyline({
					path: polilinea_coords,
					strokeColor: "#0000FF",
					strokeOpacity: 1,
					strokeWeight: 2
				});

				hidrografia_array.push(polilinea);
			});
			hidrografia_show();
			$(".loading-image").fadeOut();
		}
	});
}

function hidrografia_show(){
	if (hidrografia_array) {
		for (i in hidrografia_array) {
			hidrografia_array[i].setMap(mapa);
		}
	}
	bottom_btn_create("hidrografia", "Hidrografía", function(){
		hidrografia_hide();
	});
	showing_hidrografia = true;
}

function hidrografia_hide(){
	if (hidrografia_array) {
		for (i in hidrografia_array) {
			hidrografia_array[i].setMap(null);
		}
	}
	bottom_btn_delete("hidrografia");
	showing_hidrografia = false;
}

/*
Ecologico
*/

function ecologico_load(){

	//loading_active = true;
	$(".loading-image").fadeIn();

	$.ajax({
		url : 'capas/ecologico',
		dataType : 'json',
		error : function(){},
		success : function(ret){
			$.each(ret, function(index, value){

				var poligono_coords = [];

				var puntos = ret[index].points;
				
				$.each(puntos, function(index2, value2){

					var coordenadas = new google.maps.LatLng(value2.latitude, value2.longitude);

					poligono_coords.push(coordenadas);
				});
				
				var poligono = new google.maps.Polygon({
					paths: poligono_coords,
					strokeColor: ret[index].color,
					strokeOpacity: 1,
					strokeWeight: 2,
					fillColor: ret[index].color,
					fillOpacity: 0.2
				});

				// Add a listener for the click event
				google.maps.event.addListener(poligono, 'click', function(){

					var data = {
						nombre : ret[index].nombre,
						content : ret[index].content
					};
					show_info_panel(data);
				});

				ecologico_array.push(poligono);
			});

			ecologico_show();
			$(".loading-image").fadeOut();
		}
	});
}

function ecologico_show(){
	if (ecologico_array) {
		for (i in ecologico_array) {
			ecologico_array[i].setMap(mapa);
		}
	}
	bottom_btn_create("ecologico", "Mapa Ecológico", function(){
		ecologico_hide();
	});
	showing_ecologico = true;
}

function ecologico_hide(){
	if (ecologico_array) {
		for (i in ecologico_array) {
			ecologico_array[i].setMap(null);
		}
	}
	bottom_btn_delete("ecologico");
	showing_ecologico = false;
}
