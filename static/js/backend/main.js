$(document).on("ready", init);

function init(){

	//control
	if($(".content-control").length){
		$.getScript(base_url + "static/js/backend/login.js", function(){
			setup_login();
		});
	}

	setup_interface();

	set_leftactive();
}

function setup_interface(){
	$(".toggle-sidebar").on("click", function(){

		$('.column-sidebar').toggleClass('span1')
		$('.column-sidebar').toggleClass('span3')

		$('.column-hero').toggleClass('span9')
		$('.column-hero').toggleClass('span11')
	});
}

function set_leftactive(){

	var leftactive = $("ul.nav-list").attr("data-active");

	$("ul.nav-list li").eq(leftactive).addClass("active");

	/*$("ul.nav-list li").each(function(){
		var active = parseInt($(this).attr("data-active"));

		$(this).val(active);
	});*/
}