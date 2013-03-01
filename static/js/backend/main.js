$(document).on("ready", init);

function init(){

	//control
	if($(".content-control").length){
		$.getScript(base_url + "static/js/backend/login.js", function(){
			setup_login();
		});
	}
}
