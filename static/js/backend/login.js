function setup_login(){
	$(".form-signin").on("submit", ajax_login);
}

function ajax_login(e){

	e.preventDefault();

	var data = {};

	data.email = $.trim($("#admin-mail").val());
	data.pass = $.trim($("#admin-pass").val());
	data.save = ($("#admin-save").is(':checked')) ? 1 : 0;

	$.ajax({
		url : 'admin/login'
	});
}