<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (is_file(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
// $routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index');

//manajemen quiz
$routes->group('manquiz', function($routes){
	$routes->add('/', 'QuizMan');	
    $routes->add('new', 'QuizMan::create');	
    $routes->add('edit/(:segment)', 'QuizMan::edit/$1');	
    $routes->get('delete/(:segment)', 'QuizMan::delete/$1');	
});

//manajemen matapelajaran
$routes->group('mancategory', function($routes){
	$routes->get('/', 'QCategoryMan');	
    $routes->add('new', 'QCategoryMan::create');	
    $routes->add('edit/(:segment)', 'QCategoryMan::edit/$1');	
    $routes->get('delete/(:segment)', 'QCategoryMan::delete/$1');	
});



//API
$routes->resource('product');
$routes->resource('todo');
$routes->resource('quiz');
$routes->resource('category');

/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
