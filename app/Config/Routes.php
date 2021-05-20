<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php'))
{
	require SYSTEMPATH . 'Config/Routes.php';
}

/**
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/logout', 'Users::logout');
// Bisa pake 2 routes ky di bawah ini untuk Login
$routes->get('/', 'Users::index', ['filter' => 'noauth']);
$routes->post('/', 'Users::index', ['filter' => 'noauth']);
// Atau bisa juga ky di bawah ini untuk Login
// $routes->match(['get', 'post'],'/', 'Users::index', ['filter' => 'noauth']);
// Atau bisa 2 routes juga ky di bawah ini untuk register
// $routes->get('/register', 'Users::register');
// $routes->post('/register', 'Users::register');
// Atau bisa juga ky di bawah ini untuk register
$routes->match(['get', 'post'],'/register', 'Users::register', ['filter' => 'noauth']);
// Untuk profile
$routes->match(['get', 'post'],'/profile', 'Users::profile', ['filter' => 'auth']);
$routes->get('/dashboard', 'Dashboard::index', ['filter' => 'auth']);
$routes->get('/Dashboard', 'Dashboard::index', ['filter' => 'auth']);
// Di bawah ini ada rute agar tidak memberi akses ke view dashboard, krn nnti klo tidak , bisa muncul tulisan hello ajh
// Cuman nnti url nya jadi kurang bagus
$routes->get('/Dashboard/index', 'Users::index', ['filter' => 'noauth']);
$routes->get('/dashboard/index', 'Users::index', ['filter' => 'noauth']);

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
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php'))
{
	require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
