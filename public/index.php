<?php

require_once __DIR__ . './../vendor/autoload.php';

session_start();

$router = new Bramus\Router\Router();

$router->get('/', 'Mvc\Controllers\PageController@base');
$router->get('/register', 'Mvc\Controller\UserController@register');
$router->post('/register', 'Mvc\Controller\UserController@register');
$router->get('/login', 'Mvc\Controllers\UserController@login');

$router->run();