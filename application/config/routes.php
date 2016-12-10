<?php
defined('BASEPATH') OR exit('No direct script access allowed');


// $route['request_dropbox'] = 'welcome/request_dropbox';
// $route['access_dropbox'] = 'welcome/access_dropbox';






$route['admin'] = 'seller/SellerController';
$route['admin/notify'] = 'seller/SellerController/getNotify';
$route['admin/login'] = 'seller/SellerController/login';
$route['admin/logout'] = 'seller/SellerController/logout';
$route['admin/uploadimage'] = 'seller/SellerController/handleUploadImage';

// blog
$route['admin/blogs'] = 'seller/BlogController';
$route['admin/blogs/(:any)'] = 'seller/BlogController/$1';

// article
$route['admin/articles'] = 'seller/ArticleController';
$route['admin/articles/(:any)'] = 'seller/ArticleController/$1';

// link
$route['admin/links'] = 'seller/LinkController';
$route['admin/links/(:any)'] = 'seller/LinkController/$1';

// profile
$route['admin/profile'] = 'seller/ProfileController';



// reward
$route['admin/reward'] = 'seller/RewardController';
$route['admin/reward/filter'] = 'seller/RewardController/filter';



$route['default_controller'] = 'welcome';
$route['order'] = '/buyer/BuyerController/create';
$route['order/(:any)'] = '/buyer/BuyerController/$1';


$route['asset'] = 'seller/AssetController';
$route['asset/preview'] = 'seller/AssetController/preview';
$route['asset/download'] = 'seller/AssetController/download';


$route['404_override'] = '_404';
$route['403_override'] = '_404';
$route['500_override'] = '_404';
$route['translate_uri_dashes'] = FALSE;
