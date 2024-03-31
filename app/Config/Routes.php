<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Page::index');
$routes->get('/contact', 'Page::contact');
$routes->get('/about', 'Page::about');
