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

// auth
$routes->post('/auth/login', 'Auth::login');

/**
 * 
 * TODO: 
 * Implementar filtro auth
 * 
 */

// api
$routes->group('api', ['namespace' => 'App\Controllers\Api'], function ($routes) {
// $routes->group('api', ['namespace' => 'App\Controllers\Api', 'filter' => 'auth'], function ($routes) {

    // roles
    $routes->get('roles', 'Roles::index');
    $routes->post('roles', 'Roles::create');
    $routes->get('roles/(:num)', 'Roles::show/$1');
    $routes->match(['put', 'patch'], 'roles/(:num)', 'Roles::update/$1');
    $routes->delete('roles/(:num)', 'Roles::delete/$1');

    // areas
    $routes->get('areas', 'Areas::index');
    $routes->post('areas', 'Areas::create');
    $routes->get('areas/(:num)', 'Areas::show/$1');
    $routes->match(['put', 'patch'], 'areas/(:num)', 'Areas::update/$1');
    $routes->delete('areas/(:num)', 'Areas::delete/$1');

    // empleados
    $routes->get('empleados', 'Empleados::index');
    $routes->post('empleados', 'Empleados::create');
    $routes->get('empleados/(:num)', 'Empleados::show/$1');
    $routes->match(['put', 'patch'], 'empleados/(:num)', 'Empleados::update/$1');
    $routes->delete('empleados/(:num)', 'Empleados::delete/$1');

    // usuarios
    $routes->get('usuarios', 'Usuarios::index');
    $routes->post('usuarios', 'Usuarios::create');
    $routes->get('usuarios/(:num)', 'Usuarios::show/$1');
    $routes->match(['put', 'patch'], 'usuarios/(:num)', 'Usuarios::update/$1');
    $routes->delete('usuarios/(:num)', 'Usuarios::delete/$1');

    // capacitaciones
    $routes->get('capacitaciones', 'Capacitaciones::index');
    $routes->post('capacitaciones', 'Capacitaciones::create');
    $routes->get('capacitaciones/(:num)', 'Capacitaciones::show/$1');
    $routes->match(['put', 'patch'], 'capacitaciones/(:num)', 'Capacitaciones::update/$1');
    $routes->delete('capacitaciones/(:num)', 'Capacitaciones::delete/$1');

    // patrocinadores
    $routes->get('patrocinadores', 'Patrocinadores::index');
    $routes->post('patrocinadores', 'Patrocinadores::create');
    $routes->get('patrocinadores/(:num)', 'Patrocinadores::show/$1');
    $routes->match(['put', 'patch'], 'patrocinadores/(:num)', 'Patrocinadores::update/$1');
    $routes->delete('patrocinadores/(:num)', 'Patrocinadores::delete/$1');

    // inscripciones
    $routes->get('inscripciones', 'Inscripciones::index');
    $routes->post('inscripciones', 'Inscripciones::create');
    $routes->get('inscripciones/(:num)', 'Inscripciones::show/$1');
    $routes->match(['put', 'patch'], 'inscripciones/(:num)', 'Inscripciones::update/$1');
    $routes->delete('inscripciones/(:num)', 'Inscripciones::delete/$1');

    // sesiones
    $routes->get('sesiones', 'Sesiones::index');
    $routes->post('sesiones', 'Sesiones::create');
    $routes->get('sesiones/(:num)', 'Sesiones::show/$1');
    $routes->match(['put', 'patch'], 'sesiones/(:num)', 'Sesiones::update/$1');
    $routes->delete('sesiones/(:num)', 'Sesiones::delete/$1');
    
    // asistencias
    $routes->get('asistencias', 'Asistencias::index');
    $routes->post('asistencias', 'Asistencias::create');
    $routes->get('asistencias/(:num)', 'Asistencias::show/$1');
    $routes->match(['put', 'patch'], 'asistencias/(:num)', 'Asistencias::update/$1');
    $routes->delete('asistencias/(:num)', 'Asistencias::delete/$1');

    // misiones
    $routes->get('misiones', 'Misiones::index');
    $routes->post('misiones', 'Misiones::create');
    $routes->get('misiones/(:num)', 'Misiones::show/$1');
    $routes->match(['put', 'patch'], 'misiones/(:num)', 'Misiones::update/$1');
    $routes->delete('misiones/(:num)', 'Misiones::delete/$1');

    // participantes
    $routes->get('participantes', 'Participantes::index');
    $routes->post('participantes', 'Participantes::create');
    $routes->get('participantes/(:num)', 'Participantes::show/$1');
    $routes->match(['put', 'patch'], 'participantes/(:num)', 'Participantes::update/$1');
    $routes->delete('participantes/(:num)', 'Participantes::delete/$1');

    // comentarios
    $routes->get('comentarios', 'Comentarios::index');
    $routes->post('comentarios', 'Comentarios::create');
    $routes->get('comentarios/(:num)', 'Comentarios::show/$1');
    $routes->match(['put', 'patch'], 'comentarios/(:num)', 'Comentarios::update/$1');
    $routes->delete('comentarios/(:num)', 'Comentarios::delete/$1');

    // archivos de capacitaciones y misiones
    $routes->get('capacitaciones/(:num)/archivos', 'ArchivosCapacitacion::index/$1');
    $routes->post('capacitaciones/(:num)/archivos', 'ArchivosCapacitacion::create/$1');
    $routes->get('capacitaciones/(:num)/archivos/(:num)', 'ArchivosCapacitacion::show/$1/$2');
    $routes->post('capacitaciones/(:num)/archivos/(:num)', 'ArchivosCapacitacion::update/$1/$2');  // update
    $routes->delete('capacitaciones/(:num)/archivos/(:num)', 'ArchivosCapacitacion::delete/$1/$2');

    $routes->get('misiones/(:num)/archivos', 'ArchivosMision::index/$1');
    $routes->post('misiones/(:num)/archivos', 'ArchivosMision::create/$1');
    $routes->get('misiones/(:num)/archivos/(:num)', 'ArchivosMision::show/$1/$2');
    $routes->post('misiones/(:num)/archivos/(:num)', 'ArchivosMision::update/$1/$2');  // update
    $routes->delete('misiones/(:num)/archivos/(:num)', 'ArchivosMision::delete/$1/$2');

    // reportes
    $routes->get('reporte/capacitaciones/a', 'ReportesCapacitacion::reporteArea');
    $routes->get('reporte/capacitaciones/e', 'ReportesCapacitacion::reporteEmpleado');
    $routes->get('reporte/misiones/a', 'ReportesMision::reporteArea');
    $routes->get('reporte/misiones/e', 'ReportesMision::reporteEmpleado');

});

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
