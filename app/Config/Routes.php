<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/reservations', 'Reservations::index');
$routes->get('/rooms', 'Rooms::index');
$routes->get('/reports', 'Reports::index');
$routes->get('/login', 'Login::index');
