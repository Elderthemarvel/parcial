<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/paises', 'Home::paises');
$routes->get('/editoriales', 'Home::editoriales');
$routes->get('/libros', 'Home::libros');
$routes->get('/autores', 'Home::autores');

$routes->post('/guardar_pais', 'CreateController::savePais');
$routes->post('/guardar/editorial', 'CreateController::saveEditorial');
$routes->post('/guardar/autor', 'CreateController::saveAutor');
$routes->post('/guardar/libro', 'CreateController::saveLibro');

$routes->get('/eliminar_pais/(:num)', 'DeleteController::eliminar_pais/$1');
$routes->get('/eliminar/editorial/(:num)', 'DeleteController::eliminar_editorial/$1');
$routes->get('/eliminar/autor/(:num)', 'DeleteController::eliminar_autor/$1');
$routes->get('/eliminar/libro/(:num)', 'DeleteController::eliminar_libro/$1');

$routes->get('/editar/libro/(:num)', 'UpdateController::editar_libro/$1');
$routes->get('/editar/autor/(:num)', 'UpdateController::editar_autor/$1');
