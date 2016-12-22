<?php
defined('BASEPATH') OR exit('No direct script access allowed');


// $route['request_dropbox'] = 'welcome/request_dropbox';
// $route['access_dropbox'] = 'welcome/access_dropbox';

const SELLER_PATH = 'seller';
const BUYER_PATH = 'buyer';




$route['admin'] = SELLER_PATH . '/SellerController';
$route['admin/notify'] = SELLER_PATH . '/SellerController/getNotify';
$route['admin/login'] = SELLER_PATH . '/SellerController/login';
$route['admin/logout'] = SELLER_PATH . '/SellerController/logout';
$route['admin/uploadimage'] = SELLER_PATH . '/SellerController/handleUploadImage';

// blog
$route['admin/blogs'] = SELLER_PATH . '/BlogController';
$route['admin/blogs/(:any)'] = SELLER_PATH . '/BlogController/$1';

// article
$route['admin/articles'] = SELLER_PATH . '/ArticleController';
$route['admin/articles/(:any)'] = SELLER_PATH . '/ArticleController/$1';

// link
$route['admin/links'] = SELLER_PATH . '/LinkController';
$route['admin/links/(:any)'] = SELLER_PATH . '/LinkController/$1';

// profile
$route['admin/profile'] = SELLER_PATH . '/ProfileController';



// reward
$route['admin/reward'] = SELLER_PATH . '/RewardController';
$route['admin/reward/filter'] = SELLER_PATH . '/RewardController/filter';



// $route['default_controller'] = 'welcome';
$route['default_controller'] = 'HomeController/index';
$route['(:any)/b(:num)'] = BUYER_PATH . '/BlogController/index';
// $route['/'] = BUYER_PATH . '/BuyerController/index';
// $route['/'] = BUYER_PATH . '/BuyerController/index';
// $route['/'] = BUYER_PATH . '/BuyerController/index';



$route['404_override'] = '_404';
$route['403_override'] = '_404';
$route['500_override'] = '_404';
$route['translate_uri_dashes'] = FALSE;
