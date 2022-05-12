<?php

require_once __DIR__ . './../vendor/autoload.php';

session_start();

$router = new Bramus\Router\Router();

$router->get('/', 'Mvc\Controllers\PageController@base');
$router->all('/register', 'Mvc\Controllers\UserController@register');
$router->all('/login', 'Mvc\Controllers\UserController@login');
$router->get('/logout', 'Mvc\Controllers\UserController@logout');

$router->run();