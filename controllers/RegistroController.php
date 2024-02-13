<?php

namespace Controllers;


use MVC\Router;
// use Classes\Email;
use Model\Usuario;

use Model\Requerimientos;

// use PayPal\Api\Amount;
// use PayPal\Api\Payer;
// use PayPal\Api\Payment;
// use PayPal\Api\RedirectUrls;
// use PayPal\Api\Transaction;
// use PayPal\Rest\ApiContext;

class RegistroController {

    public static function informacion(Router $router) {
        if(!is_auth()) {
            header('Location: /contactanos');
            return;
        }

        if(!isset($_SESSION)) {
            session_start();
        }
        // obtiene el id de usuario de la BD
        $usuario_id = $_SESSION['id'];
        $usuario_nombre = $_SESSION['nombre'];

        $datos_usuario = Usuario::where('id', $usuario_id);
        // debuguear($datos_usuario);
        $requerimientos = Requerimientos::where('locked', $datos_usuario->locked);
        // debuguear($requerimientos);     



        // modifica la vista
        $mostrar_alerta = true;
        $mostrar_requerimiento_cliente = true;
        if($requerimientos) {
            $mostrar_alerta = false;
            $mostrar_requerimiento_cliente = false;
        }

   
        //esta en cero si ya tiene un requerimiento puesto, y cuando se recetea el cliente vuelve a 0, pero si es 1 puede crear o agregar un requerimiento nuevo
        $requerimiento_nuevo = false;

        if($datos_usuario->new_requerimiento == 0) {
            $requerimiento_nuevo = false;
            
        } elseif ($datos_usuario->new_requerimiento == 1) {
            $requerimiento_nuevo = true;
        }

        $precio = 0; // Variable para almacenar el precio

        // if($requerimientos) {

        // }
        if ($requerimientos->completado == 1) {
            $precio = $requerimientos->primer_pago;
            $completado = 1;

        } elseif ($requerimientos->completado == 2) {
            $precio = $requerimientos->final_pago;
            $completado = 2;

        } elseif ($requerimientos->completado == 3) {
            $precio = $requerimientos->extras;
        // debuguear($precio);

            $completado = 3;

            if ($precio == -1) {
                $precio = false;
            } elseif ($precio <= 0) {
                $precio = false;
            }

            if($requerimientos->extras > 0 && !empty($requerimientos->pago_id_ex)) {
                $precio = false;

            }
        } 
        // debuguear($precio);


        // ocultar pago
        $mostrar_pago = true;

        if (!empty($requerimientos->pago_id_pri) && !empty($requerimientos->pago_id_fin)) {
            //  && $requerimientos->extras < 0
            //  && !empty($requerimientos->pago_id_ex)
            $mostrar_pago = false;
        }
        
        if($requerimientos->extras > 0 && empty($requerimientos->pago_id_ex)) {
            // si NO tiene una pago extra y no tiene ningun id en extras
            $mostrar_pago = true;
        }



        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            if(!is_auth()) {
                header('Location: /contactanos');
                return;
            }

            $descripcion = s($_POST['descripcion']);
            $datos_usuario->descripcion = $descripcion;
            $datos_usuario->new_requerimiento = 0;
            $datos_usuario->new_time_requerimiento = date('Y/m/d H:i:s');

            // debuguear($datos_usuario);
            $resultado = $datos_usuario->guardar();

            if($resultado) {
                header('Location: /requisitos-informacion');
                return;
            }
                    // debuguear($descripcion);

        }

        
        // Ahora $precio contiene el valor correspondiente dependiendo del valor de completado.
        // debuguear($precio);


        $router->render('registro/informacion', [
            'titulo' => 'Información de su sitio web',
            'description' => '',
            'keywords' => '',
            'datos_usuario' => $datos_usuario,
            'requerimientos' => $requerimientos,
            'mostrar_alerta' => $mostrar_alerta,
            'mostrar_requerimiento_cliente' => $mostrar_requerimiento_cliente,
            'precio' => $precio,
            'completado' => $completado,
            'requerimiento_nuevo' => $requerimiento_nuevo,
            'mostrar_pago' => $mostrar_pago

        ]);
    }


    public static function pagar() {
        // Router $router
        if(!is_auth()) {
            header('Location: /requisitos-informacion');
            return;
        }


        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            if(!is_auth()) {
                header('Location: /requisitos-informacion');
                return;
            }

            // Validar que Post no venga vacio
            if(empty($_POST)) {//si vine vacio el post manda un array vacio y ya no se ejecuta el siguiente codigo
                echo json_encode([]);
                return;
            }



            // Crear el registro
            $datos = $_POST;//se guardan los datos del post
            $id_requerimientos = $_POST['id_requerimientos'];
            $locked = $_POST['locked'];
            $requerimientos = Requerimientos::where('locked', $locked);//en cantidad se paso como "string" el numero
            $pago_id = $_POST['pago_id'];//id que te da Paypal

            $id_usuario = $_SESSION['id'];
            // debuguear($_SESSION['id']);
            // id del usuario
            $usuario = Usuario::find($id_usuario);

            // el paso de completado
            $completado = $requerimientos->completado;
            if ($completado == 1) {
                $requerimientos->pago_id_pri = $pago_id;
                $requerimientos->completado = 2;

            } elseif ($completado == 2) {
                $requerimientos->pago_id_fin = $pago_id;
                $requerimientos->completado = 3;

            } elseif ($completado == 3) {
                $requerimientos->pago_id_ex = $pago_id;
                // $requerimientos->locked = null;//ya quita ese requerimiento del cliente, por si en algun futuro quiere hacer otra web
                $usuario->descripcion = null;//se quita el requerimiento que lleno e cliente por primera vez para que pueda llenar otro
            }

            try {
                $resultado = $requerimientos->guardar();
                
                echo json_encode($resultado);//se pasa el resultado al sript js de paypal
                // echo json_encode([
                //     'resultado' => 'true'//hubo un error
                // ]);
            } catch (\Throwable $th) {
                echo json_encode([
                    'resultado' => 'error'//hubo un error
                ]);
            }
        }

        // $router->render('registro/pagar', [
        //     'titulo' => 'Información de su sitio web',
        //     'description' => '',
        //     'keywords' => '',
        // ]);
    }


    public static function presupuesto(Router $router) {
        if(!is_auth()) {
            header('Location: /contactanos');
            return;
        }

        $router->render('registro/presupuesto', [
            'titulo' => 'Presupuesto sitio web',
            'description' => '',
            'keywords' => '',

        ]);
    }
}