<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

// Grouping routes for reservations
$routes->group('reservations', function ($routes) {
    $routes->get('/', 'Reservations::index');
    $routes->put('update/(:num)', 'Reservations::update/$1');
    $routes->delete('delete/(:num)', 'Reservations::delete/$1');
});

// Grouping routes for rooms
$routes->group('rooms', function ($routes) {
    $routes->get('/', 'Rooms::index');
    $routes->put('update/(:num)', 'Rooms::update/$1');
});

$routes->get('/reports', 'Reports::index');
$routes->get('/login', 'Login::index');
$routes->post('/login', 'Login::loginAction');
$routes->get('/logout', 'Login::logout');

// Grouping API routes for hotel providers
$routes->group('api', function ($routes) {
    $routes->get('rooms', 'Rooms::getRooms');
    $routes->post('login', 'Login::loginActionProvider');
    $routes->post('reservations', 'Reservations::create');
});
