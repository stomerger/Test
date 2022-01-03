<?php 
require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../includes/app.php';


use MVC\Router;
use Controllers\PropiedadController;

use Controllers\LoginController;

$router = new Router();

$router->get('/admin', [PropiedadController::class, 'index']);

$router->get('/propiedades/actualizar', [PropiedadController::class, 'actualizar']);
$router->post('/propiedades/actualizar', [PropiedadController::class, 'actualizar']);
$router->post('/propiedades/eliminar', [PropiedadController::class, 'eliminar']);

$router->get('/crear', [PropiedadController::class, 'crear']);
$router->post('/crear', [PropiedadController::class, 'crear']);

$router->get('/login', [LoginController::class, 'login']);
$router->post('/login', [LoginController::class, 'login']);
$router->get('/logout', [LoginController::class, 'logout']);


// Comprueba y valida las rutas, que existan y les asigna las funciones del Controlador
$router->comprobarRutas();