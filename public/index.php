<?php

require_once __DIR__ . './../vendor/autoload.php';

session_start();


$router = new Bramus\Router\Router();

$router->get('/', 'Mvc\Controllers\PageController@base');
$router->all('/register', 'Mvc\Controllers\UserController@register');
$router->all('/login', 'Mvc\Controllers\UserController@login');
$router->get('/logout', 'Mvc\Controllers\UserController@logout');
$router->get('/admin/location/delete/{id}', 'Mvc\Controllers\LocationController@locationDelete');
$router->all('/admin/location/create', 'Mvc\Controllers\LocationController@locationCreate');
$router->get('/admin/location', 'Mvc\Controllers\LocationController@locationList');
$router->get('/admin/marketplace/delete/{id}', 'Mvc\Controllers\MarketplaceController@marketplaceDelete');
$router->all('/admin/marketplace/create', 'Mvc\Controllers\MarketplaceController@marketplaceCreate');
$router->get('/admin/marketplace', 'Mvc\Controllers\MarketplaceController@marketplaceList');
$router->get('/admin/marketplace/category/delete/{id}', 'Mvc\Controllers\MarketplaceController@marketplaceCategoryDelete');
$router->all('/admin/marketplace/category/create', 'Mvc\Controllers\MarketplaceController@marketplaceCategoryCreate');
$router->get('/admin/marketplace/category', 'Mvc\Controllers\MarketplaceController@marketplaceCategoryList');

$router->run();