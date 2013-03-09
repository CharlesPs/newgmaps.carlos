$(document).on("ready", init);

function init(){

	//control
	if($(".content-control").length){
		$.getScript(base_url + "static/js/backend/login.js", function(){
			setup_login();
		});
	}

	setup_interface();
}

function setup_interface(){
	$(".toggle-sidebar").on("click", function(){

		$('.column-sidebar').toggleClass('span1')
		$('.column-sidebar').toggleClass('span3')

		$('.column-hero').toggleClass('span9')
		$('.column-hero').toggleClass('span11')
	});
}

