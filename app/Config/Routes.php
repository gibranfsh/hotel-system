<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/reservations', 'Reservations::index');
$routes->put('/reservations/update/(:num)', 'Reservations::update/$1');
$routes->get('/rooms', 'Rooms::index');
$routes->put('/rooms/update/(:num)', 'Rooms::update/$1');
$routes->get('/reports', 'Reports::index');
$routes->get('/login', 'Login::index');
$routes->post('/login', 'Login::loginAction');
$routes->get('/logout', 'Login::logout');
