<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
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
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.

$session=session(); //INICIALIZAMOS LA SESSION PARA TODOAS LAS RUTAS

//MIS RUTAS
$routes->get('/', 'LoginController::index');
$routes->get('/usuario', 'UsuarioController::index');
$routes->get('/roles', 'RolController::index');
$routes->get('/permisos', 'PermisosController::index');
$routes->get('/dashboard', 'DashboardController::index');
$routes->get('/logout', 'LoginController::logout');

//PACIENTE
//$routes->get('/paciente', 'PacienteController::index');
//RUTAS AGRUPADAS
//$routes->get('/paciente', 'PacienteController::index');

$routes->group('paciente',[],function($routes){
    
    //$routes->get('/', 'PacienteController::index');
    $routes->get('/', 'PacienteController::solicitud_copia_hc');
    $routes->get('solicitud_copia_hc', 'PacienteController::solicitud_copia_hc');
    $routes->get('visualizacion_copia_hc', 'PacienteController::visualizacion_copia_hc');
});

$routes->get('/mesapartes', 'MesaController::index');
$routes->get('/fedateo', 'FedateoController::index');
$routes->get('/admision', 'AdmisionController::index');
$routes->get('/reporte', 'AdmisionController::generacionReporteHC');
$routes->get('/enfermeria', 'EnfermeriaController::index');
$routes->get('/medico', 'MedicoController::index');

$routes->get('/test', 'TestController::index');
// $routes->get('/hola', 'UsuarioController::index');

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
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
