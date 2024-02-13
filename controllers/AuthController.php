<?php

namespace Controllers;

use Classes\Email;
use Model\Usuario;
use MVC\Router;

class AuthController {
    // public static function login(Router $router) {

    //     $alertas = [];


    //     if($_SERVER['REQUEST_METHOD'] === 'POST') {
           
    //         $usuario = new Usuario($_POST);

    //         $alertas = $usuario->validarLogin();
            
    //         if(empty($alertas)) {
    //             // Verificar quel el usuario exista
    //             $usuario = Usuario::where('email', $usuario->email);
    //             if(!$usuario || !$usuario->confirmado ) {
    //                 Usuario::setAlerta('error', 'El Usuario No Existe o no esta confirmado');
    //             } else {
    //                 // El Usuario existe
    //                 if( password_verify($_POST['password'], $usuario->password) ) {
                        
    //                     // Iniciar la sesión
    //                     session_start();    
    //                     $_SESSION['id'] = $usuario->id;
    //                     $_SESSION['nombre'] = $usuario->nombre;
    //                     $_SESSION['apellido'] = $usuario->apellido;
    //                     $_SESSION['email'] = $usuario->email;
    //                     $_SESSION['admin'] = $usuario->admin ?? null;

    //                     // Redirección 
    //                     if($usuario->admin) {
    //                         header('Location: /admin/dashboard');
    //                     } else {
    //                         header('Location: /computadoras');
    //                     }
                        
    //                 } else {
    //                     Usuario::setAlerta('error', 'Password Incorrecto');
    //                 }
    //             }
    //         }
    //     }
        

    //     $alertas = Usuario::getAlertas();
    //     // debuguear($alertas);
    //     // Render a la vista 
    //     $router->render('auth/login', [
    //         'titulo' => 'Iniciar Sesión',
    //         'alertas' => $alertas,
    //         'description' => '',
    //         'keywords' => ''
    //     ]);
    // }

    public static function logout() {
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            session_start();
            $_SESSION = [];
            header('Location: /contactanos');
        }
       
    }

    // public static function registro(Router $router) {
    //     $alertas = [];
    //     $usuario = new Usuario;

    //     if($_SERVER['REQUEST_METHOD'] === 'POST') {

    //         $usuario->sincronizar($_POST);
            
    //         $alertas = $usuario->validar_cuenta();

    //         if(empty($alertas)) {
    //             $existeUsuario = Usuario::where('email', $usuario->email);

    //             if($existeUsuario) {
    //                 Usuario::setAlerta('error', 'El Usuario ya esta registrado');
    //                 $alertas = Usuario::getAlertas();
    //             } else {
    //                 // Hashear el password
    //                 $usuario->hashPassword();

    //                 // Eliminar password2
    //                 unset($usuario->password2);

    //                 // Generar el Token
    //                 $usuario->crearToken();

    //                 // Crear un nuevo usuario
    //                 $resultado =  $usuario->guardar();

    //                 // Enviar email
    //                 $email = new Email($usuario->email, $usuario->nombre, $usuario->token, $usuario->telefono, $usuario->mensaje);
    //                 $email->enviarConfirmacion();
                    

    //                 if($resultado) {
    //                     header('Location: /mensaje');
    //                 }
    //             }
    //         }
    //     }

    //     // Render a la vista
    //     $router->render('auth/registro', [
    //         'titulo' => 'Crea tu cuenta',
    //         'usuario' => $usuario, 
    //         'alertas' => $alertas,
    //         'description' => '',
    //         'keywords' => ''
            
    //     ]);
    // }

    public static function olvide(Router $router) {
        $alertas = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            
            $usuario = new Usuario($_POST);
            $alertas = $usuario->validarEmail();

            if (empty($alertas)) {
                
                // Buscar el usuario
                $usuario = Usuario::where('email', $usuario->email);

                if ($usuario && $usuario->confirmado) {
                    // Generar un nuevo token
                    $usuario->crearToken();
                    unset($usuario->password2);

                    // Actualizar el usuario
                    $usuario->guardar();

                    // Enviar el email
                    $email = new Email($usuario->email, $usuario->nombre, $usuario->token);
                    $email->enviarInstrucciones();

                    // Imprimir la alerta
                    $alertas['exito'][] = 'Hemos enviado las instrucciones a tu correo';
                } else {
                    $alertas['error'][] = 'El Usuario no existe o no esta confirmado';
                }
            }

        }
        




        // Muestra la vista
        $router->render('auth/olvide', [
            'titulo' => 'Olvide mi Contraseña',
            'alertas' => $alertas,
            'description' => '¿Olvidaste tu contraseña? No te preocupes. En AriWeb, recuperar el acceso es sencillo. Sigue unos simples pasos para restablecer tu contraseña y regresar a tu experiencia digital sin complicaciones.',
            'keywords' => ''

        ]);
    }

    public static function reestablecer(Router $router) {

        $token = s($_GET['token']);

        $token_valido = true;
        $constraseña_cambiada = false;
        $script = '';

        if(!$token) header('Location: /contactanos');

        // Identificar el usuario con este token
        $usuario = Usuario::where('token', $token);

        if(empty($usuario)) {
            Usuario::setAlerta('error', 'Token No Válido, intenta de nuevo');
            $token_valido = false;
        }


        if($_SERVER['REQUEST_METHOD'] === 'POST') {

            if ($usuario !== null) {
                // Añadir el nuevo password
                $usuario->sincronizar($_POST);
    
                // Validar el password
                $alertas = $usuario->validarPassword();
    
                if (empty($alertas)) {
                    // Hashear el nuevo password
                    $usuario->hashPassword();
    
                    // Eliminar el Token
                    $usuario->token = null;
    
                    // Guardar el usuario en la BD
                    $resultado = $usuario->guardar();
    
                    // Redireccionar
                    if ($resultado) {
                        $constraseña_cambiada = true;
                        Usuario::setAlerta('exito', 'La contraseña se restableció correctamente');
                        $script = '
                            <script>
                                // Establecer el valor en localStorage
                                localStorage.setItem("modo", "iniciar_sesion");
                                setTimeout(function() {
                                    // Redireccionar a la página "/contactanos"
                                    window.location.href = "/contactanos";
                                }, 3000);
                            </script>';
                    }
                }
            }    
        }

        $alertas = Usuario::getAlertas();
        
        // Muestra la vista
        $router->render('auth/reestablecer', [
            'titulo' => 'Reestablecer Contraseña',
            'alertas' => $alertas,
            'token_valido' => $token_valido,
            'description' => 'Restablecer tu contraseña en AriWeb es un proceso seguro y rápido. Sigue los pasos indicados para actualizar tu clave y asegurar el acceso a tu cuenta. En pocos minutos, estarás listo para explorar nuevamente.',
            'keywords' => '',
            'constraseña_cambiada' => $constraseña_cambiada,
            'script' => $script
            
        ]);
    }

    public static function mensaje(Router $router) {

        $router->render('auth/mensaje', [
            'titulo' => 'Cuenta Creada Exitosamente en AriWeb',
            'description' => '¡Felicidades! Tu cuenta en AriWeb se ha creado con éxito. Da el siguiente paso para aprovechar al máximo nuestros servicios. Explora nuestras funcionalidades y comienza tu viaje digital ahora.',
            'keywords' => ''

        ]);
    }

    public static function confirmar(Router $router) {
        
        $token = s($_GET['token']);

        if(!$token) header('Location: /');

        // Encontrar al usuario con este token
        $usuario = Usuario::where('token', $token);

        if(empty($usuario)) {
            // No se encontró un usuario con ese token
            Usuario::setAlerta('error', 'Token No Válido, la cuenta no se confirmó');
        } else {
            // Confirmar la cuenta
            $usuario->confirmado = 1;
            $usuario->token = '';
            unset($usuario->password2);
            
            // Guardar en la BD
            $usuario->guardar();

            Usuario::setAlerta('exito', 'Cuenta Comprobada éxitosamente');
        }

     

        $router->render('auth/confirmar', [
            'titulo' => 'Confirma tu cuenta',
            'alertas' => Usuario::getAlertas(),
            'description' => '¡Casi listo! Confirma tu cuenta en AriWeb para desbloquear todas las funciones y servicios. Sigue el enlace enviado a tu correo electrónico y prepárate para sumergirte en una experiencia digital única.',
            'keywords' => '',
        ]);
    }
}