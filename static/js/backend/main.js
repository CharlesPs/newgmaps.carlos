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

	setup_table_checkbox();

	setup_row_activable();
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
}

function setup_table_checkbox(){
	$(".check-select-all").on("click", function(){

		var ischecked = $(this).is(':checked');

		//var all_checked = are_all_checked();

		if(ischecked){
			table_set_actives(true);
		}else{
			table_set_actives(false);
		}
	})

	$(".table").find("tbody").find('input[type="checkbox"]').on("click", function(){
		var all_checked = are_all_checked();

		if(all_checked){
			$(".check-select-all").prop("checked", true);
		}else{
			$(".check-select-all").prop("checked", false);
		}
	});
}

function are_all_checked(){
	var todos = $(".table").find("tbody").find('input[type="checkbox"]');

	var all_checked = false;

	$(".table").find("tbody").find('input[type="checkbox"]').each(function(index){
		var checked = $(this).is(':checked');
		if(!checked){

			all_checked = false;
			return false; // sale del each y no de la funcion por lo tanto sigue corriendo
		}
		all_checked = true;
	});

	return all_checked;
}

function table_set_actives(true_or_false){

	$(".table").find("tbody").find('input[type="checkbox"]').prop("checked", true_or_false);
}

function setup_row_activable(){

	var active = $("#row-active").val();

	$(".button-activable").on("click", function(){

		var val = $(".button-activable").find('input[type="hidden"]').val();

		if(val){

		}else{

		}

		$(this).find(".row-activable").toggleClass("icon-ok");
		$(this).find(".row-activable").toggleClass("icon-remove");
	})

	if(active){
		$(".button-activable").trigger("click");
	}
}
