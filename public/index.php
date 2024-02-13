<?php 

require_once __DIR__ . '/../includes/app.php';

use MVC\Router;

use Controllers\AuthController;
use Controllers\AdminController;
use Controllers\PaginasController;
use Controllers\RegistroController;




$router = new Router();

// Cerrar sesion
$router->post('/logout', [AuthController::class, 'logout']);

// Formulario de olvide mi password
$router->get('/olvide', [AuthController::class, 'olvide']);
$router->post('/olvide', [AuthController::class, 'olvide']);

// Colocar el nuevo password
$router->get('/reestablecer', [AuthController::class, 'reestablecer']);
$router->post('/reestablecer', [AuthController::class, 'reestablecer']);

// Confirmación de Cuenta
$router->get('/mensaje', [AuthController::class, 'mensaje']);
$router->get('/confirmar-cuenta', [AuthController::class, 'confirmar']);

//Usuario registrado
$router->get('/requisitos-informacion', [RegistroController::class, 'informacion']);
$router->post('/requisitos-informacion', [RegistroController::class, 'informacion']);
// $router->get('/presupuesto', [RegistroController::class, 'presupuesto']);
$router->post('/pagar', [RegistroController::class, 'pagar']);
$router->get('/pagar', [RegistroController::class, 'pagar']);

// Admin
$router->get('/admin/dashboard', [AdminController::class, 'admin']);
$router->post('/admin/dashboard', [AdminController::class, 'admin']);
$router->get('/admin/requerimientos', [AdminController::class, 'requerimientos']);
$router->post('/admin/requerimientos', [AdminController::class, 'requerimientos']);
$router->get('/admin/clientes-frecuentes', [AdminController::class, 'clientes_frecuentes']);
$router->post('/admin/clientes-frecuentes', [AdminController::class, 'clientes_frecuentes']);
$router->get('/admin/usuario', [AdminController::class, 'usuario']);
$router->post('/admin/usuario', [AdminController::class, 'usuario']);
$router->get('/admin/portafolio', [AdminController::class, 'portafolio']);
$router->get('/admin/portafolio/crear', [AdminController::class, 'portafolio_crear']);
$router->post('/admin/portafolio/crear', [AdminController::class, 'portafolio_crear']);
$router->get('/admin/portafolio/editar', [AdminController::class, 'portafolio_editar']);
$router->post('/admin/portafolio/editar', [AdminController::class, 'portafolio_editar']);
$router->post('/admin/portafolio/eliminar', [AdminController::class, 'portafolio_eliminar']);
$router->get('/admin/usuario/requerimiento', [AdminController::class, 'usuario_requerimiento']);
$router->post('/admin/usuario/requerimiento', [AdminController::class, 'usuario_requerimiento']);


// Área Pública
$router->get('/', [PaginasController::class, 'index']);
$router->post('/', [PaginasController::class, 'index']);//iniciar y registrarse
$router->get('/quienes-somos', [PaginasController::class, 'nosotros']);
$router->get('/nuestro-portafolio', [PaginasController::class, 'portafolio']);
$router->get('/contactanos', [PaginasController::class, 'contacto']);
$router->post('/contactanos', [PaginasController::class, 'contacto']);


// Terminos y Politia de privacidad
$router->get('/terminos-condiciones', [PaginasController::class, 'terminos_condiciones']);
$router->get('/politica-privacidad', [PaginasController::class, 'politica_privacidad']);


$router->comprobarRutas();