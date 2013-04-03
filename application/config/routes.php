<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$route['default_controller'] = "home";
$route['404_override'] = '';


$route['admin'] 				= "admin_home";
$route['admin/home'] 			= "admin_home";

$route['admin/control'] 		= "admin_control";
$route['admin/control/login'] 	= "admin_control/login";
$route['admin/control/logout'] 	= "admin_control/logout";

$route['admin/provincias'] 					= "admin_provincias";
$route['admin/provincias/:num'] 			= "admin_provincias";
$route['admin/provincias/view/:num'] 		= "admin_provincias/view";
$route['admin/provincias/save'] 			= "admin_provincias/save";

$route['admin/distritos'] 					= "admin_distritos";
$route['admin/distritos/:num'] 				= "admin_distritos";
$route['admin/distritos/view/:num'] 		= "admin_distritos/view";
$route['admin/distritos/save'] 				= "admin_distritos/save";

$route['admin/ecologico'] 					= "admin_ecologico";
$route['admin/ecologico/:num'] 				= "admin_ecologico";
$route['admin/ecologico/view/:num'] 		= "admin_ecologico/view";
$route['admin/ecologico/save'] 				= "admin_ecologico/save";

$route['admin/forestal'] 					= "admin_forestal";
$route['admin/forestal/:num'] 				= "admin_forestal";
$route['admin/forestal/view/:num'] 			= "admin_forestal/view";
$route['admin/forestal/save'] 				= "admin_forestal/save";

/* End of file routes.php */
/* Location: ./application/config/routes.php */