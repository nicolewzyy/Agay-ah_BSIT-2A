<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Auth::login');
$routes->get('/login', 'Auth::login');
$routes->post('/login', 'Auth::attemptLogin');
$routes->get('/register', 'Auth::register');
$routes->post('/register', 'Auth::attemptRegister');
$routes->get('/logout', 'Auth::logout');

$routes->group('', ['filter' => 'auth'], function($routes) {
    $routes->get('/dashboard', 'Dashboard::index');
    
    // Inventory
    $routes->get('/inventory', 'Inventory::index');
    $routes->get('/inventory/create', 'Inventory::create');
    $routes->post('/inventory/store', 'Inventory::store');
    $routes->get('/inventory/edit/(:num)', 'Inventory::edit/$1');
    $routes->post('/inventory/update/(:num)', 'Inventory::update/$1');
    $routes->get('/inventory/delete/(:num)', 'Inventory::delete/$1');
    
    // Categories
    $routes->get('/categories', 'Inventory::categories');
    $routes->post('/categories/store', 'Inventory::categoryStore');
    
    // Sales
    $routes->get('/sales', 'Sales::index');
    $routes->post('/sales/process', 'Sales::process');
    
    // Reports
    $routes->get('/reports', 'Reports::index');
});
