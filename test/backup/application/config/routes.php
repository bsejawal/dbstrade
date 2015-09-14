<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

//$route['default_controller'] = "pages/index"; //searches for default controller if custom is not defined
$route['default_controller'] = 'pages/view';
$route['(:any)'] = 'pages/view/$1';
//custom controller route
//$route['(:any)'] = 'pages/index/$1';
//$route['index'] = "pages/index";
//$route['account'] = "pages/account";
$route['404_override'] = ''; // helps to show the error page

