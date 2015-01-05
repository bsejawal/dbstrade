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
$route['pass'] = 'view/index/pass';
$route['passGen'] = 'view/passGen';
$route['getReadMore'] = 'view/getReadMore';
$route['getBookPanel'] = 'view/getBookPanel';
$route['sendRequest'] = 'view/sendRequest';
//$route['search'] = 'view/search';
//navigation for admin.
$route['admin'] = 'adminHome/index/home';
$route['login'] = 'adminHome/index/login';
$route['admin/logout'] = 'logout/index';
$route['checkLogin'] = 'login/index';
$route['admin/(:any)'] = 'adminHome/index/$1';
$route['admin/editProdInfo'] = 'adminHome/editProdInfo';

$route['admin/contentManagement'] = 'contentManagement/index';
$route['admin/cropImage'] = 'cropImage/index';
$route['admin/uploadImage'] = 'cropImage/uploadImage';
$route['admin/deleteImage'] = 'cropImage/deleteImage';
$route['admin/editSlider'] = 'contentManagement/editSlider';
$route['admin/insertContent'] = 'contentManagement/insertContent';
$route['admin/editInfo'] = 'contentManagement/editInfo';
$route['admin/editContent'] = 'contentManagement/updateContent';
$route['admin/deleteInfo'] = 'contentManagement/deleteInfo';

$route['admin/productManagement'] = 'productManagement/index';
$route['admin/insertProduct'] = 'productManagement/insertProduct';
$route['admin/addProduct'] = 'productManagement/addProduct';
$route['admin/editProduct'] = 'productManagement/updateProduct';
$route['admin/editProdInfo'] = 'productManagement/editProdInfo';
$route['admin/deleteProdInfo'] = 'productManagement/deleteProdInfo';

$route['admin/settings'] = 'settings/index';
$route['admin/editUser'] = 'settings/editUser';
$route['admin/editPassword'] = 'settings/editPassword';
$route['admin/updatePassword'] = 'settings/updatePassword';
$route['admin/updateUser'] = 'settings/updateUser';

$route['admin/category'] = 'category/index';
$route['admin/insertCategory'] = 'category/insertCategory';
$route['admin/editCategory'] = 'category/editCategory';
$route['admin/updateCategory'] = 'category/updateCategory';
$route['admin/deleteCategory'] = 'category/deleteCategory';



$route['404_override'] = ''; // helps to show the error page

//$route['admin/editContent'] = 'editContent/index';
