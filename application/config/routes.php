<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$route['default_controller'] = "home";
$route['404_override'] = '';


$route['admin'] 				= "admin_home";
$route['admin/home'] 			= "admin_home";

$route['admin/control'] 		= "admin_control";
$route['admin/control/login'] 	= "admin_control/login";
$route['admin/control/logout'] 	= "admin_control/logout";

/* End of file routes.php */
/* Location: ./application/config/routes.php */