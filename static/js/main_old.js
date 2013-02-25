
var gmaps_frame_name = "#gmaps";

var mapa;

var lambayeque = {
	lat: -6.37,
	lng: -79.78,
	zoom: 8
};

var svg = {
	lat: -5.55,
	lng: -80.88
};

$(document).ready(function(){
	mapa = new GMaps({
	  div: gmaps_frame_name,
	  lat: lambayeque.lat,
	  lng: lambayeque.lng,
	  zoom: lambayeque.zoom,
	  panControl: false,
	  mapTypeControl: false,
	  overviewMapControl: false
	});

	// TODO - capturar evento de zoom
	/*google.maps.event.addListener(mapa, 'zoom_changed', function() {
		alert("zoom");
	});*/

	// Boton inicio
	mapa.addControl({
		position: 'top_left',
		content: 'Inicio',
		style: {
			margin: '5px',
			padding: '1px 6px',
			border: 'solid 1px #717B87',
			background: '#fff'
		},
		events: {
			click: function(){
				mapa.setCenter(lambayeque.lat, lambayeque.lng);
				mapa.setZoom(lambayeque.zoom);
			}
		}
	});

	// minimapa
	var minimapa = mapa.addControl({
		id : 'minimapa',
		position: 'left_bottom',
		content: '<img src="static/img/minimapa.png" width="172" height="232" />',
		classes: 'minimapa',
		events: {
			click: function(){}
		}
	});

	// Menu Capas
	var lista_combo_capas = $('<div id="lista_combo_capas" class="lista_combo lista_combo_capas"></div>');
	lista_combo_capas.append($('<ul></ul>'));
	lista_combo_capas.find("ul").append($('<li class="capa_mapa_forestal" data-submenu="">Mapa Forestal</li>'));
	lista_combo_capas.find("ul").append($('<li class="capa_fauna">Fauna</li>'));
	lista_combo_capas.find("ul").append($('<li class="capa_suelos">Suelos</li>'));
	lista_combo_capas.find("ul").append($('<li class="capa_socio_economico">Índice Socio-Económico</li>'));
	lista_combo_capas.find("ul").append($('<li class="capa_mapa_ecologico">Mapa Ecológico</li>'));
	lista_combo_capas.find("ul").append($('<li class="capa_comunidades">Comunidades</li>'));
	lista_combo_capas.find("ul").append($('<li class="capa_rios">Ríos</li>'));

	var lista_combo_capas_created = false;

	var combo = mapa.addControl({
		id : 'combo-capas',
		position: 'top_left',
		content: 'Capas',
		classes: 'combo combo_capas',
		events: {
			click: function(){

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

						// 
						$.ajax({
							url : 'capas/comunidades',
							dataType : 'json',
							error : function(){},
							success : function(ret){
								$.each(ret, function(index, coord){

									mapa.addMarker({
										lat: coord.lat,
										lng: coord.lng,
										title: coord.nombre,
										click: function(e) {
											//alert('You clicked in this marker');
										}
									});
									/*mapa.drawOverlay({
										lat: coord.lat,
										lng: coord.lng,
										content: '<div class="overlay">' + coord.nombre + '</div>'
									});*/
								});
							}
						});
					});

					$("#combo-capas .capa_rios").on("click", function(){
						// oculta todos los submenus
						$(".submenu").hide();

						// 

						var map_instance = mapa.map;

						var imageBounds = new google.maps.LatLngBounds(
						    new google.maps.LatLng(-5.541, -6.384),
						    new google.maps.LatLng(-7.172, -79.133)
					    );

					    var capa = new google.maps.GroundOverlay(
					    	"static/img/capas/c-rios.svg",
					    	imageBounds
					    );

					    capa.setMap(map_instance);

					});
				}

				lista_combo_capas.toggle();
			}
		}
	});

	// Menu Mostrar por
	var lista_combo_mostrar_por = $('<div id="lista_combo_mostrar_por" class="lista_combo lista_combo_mostrar_por"></div>');
	lista_combo_mostrar_por.append($('<ul></ul>'));
	lista_combo_mostrar_por.find("ul").append($('<li class="mostrar_por_region">Región</li>'));
	lista_combo_mostrar_por.find("ul").append($('<li class="mostrar_por_provincias">Provincias</li>'));
	lista_combo_mostrar_por.find("ul").append($('<li class="mostrar_por_distritos">Distritos</li>'));
	lista_combo_mostrar_por.find("ul").append($('<li class="mostrar_por_comunidades">Comunidades</li>'));

	var lista_combo_mostrar_por_created = false;

	var combo = mapa.addControl({
		id : 'combo-mostrar-por',
		position: 'top_left',
		content: 'Ubicación',
		classes: 'combo submenu combo_mostrar_por',
		events: {
			click: function(){

				//lista_combo_mostrar_por_active = false;

				if(!lista_combo_mostrar_por_created){
					$("#combo-mostrar-por").append(lista_combo_mostrar_por);
					lista_combo_mostrar_por_created = true;

					// setup menu mostrar por
					$("#combo-mostrar-por li").on("click", function(){
						//

					});
				}

				lista_combo_mostrar_por.toggle();

			}
		}
	});

	resize_frame();

	$(window).on("resize", resize_frame)
});

function resize_frame(){

	var window_w = $(window).width();
	var window_h = $(window).height();


	$(gmaps_frame_name).css("width", window_w);
	$(gmaps_frame_name).css("height", window_h);
}

