<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

$route['default_controller'] = "view/index/home"; //searches for default controller if custom is not defined
// navigation for users.
$route['home'] = 'view/index/home';
$route['about'] = 'view/index/about';
$route['contact'] = 'view/index/contact';
$route['products'] = 'view/index/products';
//navigation for admin.
$route['admin'] = 'view/admin/index';
$route['login'] = 'view/admin/login';
$route['admin/logout'] = 'logout/index';
$route['checkLogin'] = 'login/index';
$route['admin/(:any)'] = 'view/admin/$1';
$route['admin/insertContent'] = 'insertContent/index';
$route['admin/insertProduct'] = 'insertProduct/index';
$route['admin/editContent'] = 'editContent/index';
$route['admin/editProduct'] = 'editProduct/index';
$route['404_override'] = ''; // helps to show the error page

