var colors = {
	primary : [
		{ name : "Green", 		code : "#00FF00"},
		{ name : "Bold blue", 	code : "#5484ed"},
		{ name : "Blue", 		code : "#a4bdfc"},
		{ name : "Turquoise", 	code : "#46d6db"},
		{ name : "Light green", code : "#7ae7bf"},
		{ name : "Bold green", 	code : "#51b749"},
		{ name : "Yellow", 		code : "#fbd75b"},
		{ name : "Orange", 		code : "#ffb878"},
		{ name : "Red", 		code : "#ff887c"},
		{ name : "Bold red", 	code : "#dc2127"},
		{ name : "Purple", 		code : "#dbadff"},
		{ name : "Gray", 		code : "#e1e1e1"}
	],
	secondary : [
		"#ac725e", "#d06b64", "#f83a22", "#fa573c", "#ff7537",
		"#ffad46", "#42d692", "#16a765", "#7bd148", "#b3dc6c",
		"#fbe983", "#fad165", "#92e1c0", "#9fe1e7", "#9fc6e7",
		"#4986e7", "#9a9cff", "#b99aff", "#c2c2c2", "#cabdbf",
		"#cca6ac", "#f691b2", "#cd74e6", "#a47ae2"
	]
};

function init_colors(){
	color_picker();
}


function color_picker(){

	var target = $("#color-picker");

	target.append('<h4>Principales:</h4>');

	var primary = colors.primary;

	var primary_colors = '';
	$.each(primary, function(index, value){
		primary_colors += '<span class="color-btn" style="background-color: ' + value.code + '" title="'+ value.name +'" data-color="' + value.code + '">'+ value.name +'</span>';
	});

	target.append(primary_colors);

	target.append('<h4>Más colores:</h4>');

	var secondary = colors.secondary;

	var secondary_colors = '';
	$.each(secondary, function(index, value){
		secondary_colors += '<span class="color-btn" style="background-color: ' + value + '" title="'+ value +'" data-color="' + value + '">'+ value +'</span>';
	});

	target.append(secondary_colors);

	$(".color-btn").on("click", function(){

		var color_code = $(this).attr("data-color");

		$(".colorpicker").css("background-color", color_code);

		$("#color").val(color_code);

		$('#colorModal').modal('hide')
	});
}