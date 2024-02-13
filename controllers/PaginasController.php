<?php

namespace Controllers;


use MVC\Router;
use Classes\Email;
use Model\Usuario;
use Model\Portafolio;


class PaginasController {
    public static function index(Router $router) {
        
        $alertas = [];
        // $portafolio =
        $portafolio = Portafolio::all('ASC');
        // debuguear($portafolio);

        $router->render('paginas/index', [
            'titulo' => 'Tu Socio para Tener un Sitio Web Impresionante',
            'description' => 'Creamos sitios web impactantes, landing pages personalizadas y tiendas online vibrantes para negocios en México, Nuevo León, Monterrey. Desde la idea hasta la realidad, estamos aquí para hacer tu presencia en línea única y exitosa. Explora nuestros servicios hoy y construye tu sitio web a medida con AriWeb',
            'keywords' => 'diseño web, desarrollo web, tienda online, sitios web, páginas web Monterrey, ariweb',
            'alertas' => $alertas,
            'portafolio' => $portafolio,


        ]);
    }


    public static function nosotros(Router $router) {

        $router->render('paginas/nosotros', [
            'titulo' => '¿Quiénes somos?',
            'description' => 'Descubre nuestra pasión por la excelencia y la creatividad en cada proyecto. Conéctate con nosotros para maximizar tu presencia en línea y marcar la diferencia en el mundo digital. Transformamos tu visión en realidad con soluciones digitales personalizadas.',
            'keywords' => 'creatividad web, misión ariweb, servicio excepcional'
        ]);
    }
    
    public static function portafolio(Router $router) {

        
        $portafolio = Portafolio::all('ASC');

        $router->render('paginas/portafolio', [
            'titulo' => 'Nuestro portafolio',
            'description' => 'Explora el Portafolio de AriWeb. Descubre diseños web cautivadores y funcionalidades excepcionales que potencian tu éxito digital. Encuentra la inspiración perfecta para tu próxima aventura en línea. ¡Descúbrelo ahora!',
            'keywords' => 'portafolio de sitios web, diseños web cautivadores, inspiración para sitios web, sitios web empresas',
            'portafolio' => $portafolio,

        ]);
    }

    public static function contacto(Router $router) {


        $alertas = [];
        $usuario = null;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $accion = s($_POST['accion']) ?? '';
    
            if ($accion === 'iniciar_sesion') {
                // Lógica para iniciar sesión
                $usuario = new Usuario($_POST);
                // debuguear($usuario);

                $alertas = $usuario->validarLogin();
                
                if(empty($alertas)) {
                    // Verificar quel el usuario exista
                    $usuario = Usuario::where('email', $usuario->email);
                    if(!$usuario || !$usuario->confirmado ) {
                        // Usuario::setAlerta('error', 'El Usuario No Existe o no esta confirmado', array('usuarioNoExisteConfirmada'));
                        Usuario::setAlerta('error', 'El Usuario No Existe o no está confirmado', 'usuarioNoExisteConfirmada');
                    } else {
                        // El Usuario existe
                        if( password_verify($_POST['password'], $usuario->password) ) {
                            
                            // Iniciar la sesión
                            session_start();    
                            $_SESSION['id'] = $usuario->id;
                            $_SESSION['nombre'] = $usuario->nombre;
                            // $_SESSION['apellido'] = $usuario->apellido;
                            $_SESSION['email'] = $usuario->email;
                            $_SESSION['locked'] = $usuario->locked;
                            $_SESSION['admin'] = $usuario->admin ?? null;

                            // Redirección 
                            if($usuario->admin) {
                                header('Location: /admin/dashboard');//para admin
                            } else {
                                header('Location: /requisitos-informacion');//para usuarios 
                            }
                            
                        } else {
                            // Usuario::setAlerta('error', 'Password Incorrecto', array('passwordIncorrecto'));
                            Usuario::setAlerta('error', 'Contraseña Incorrecta', 'passwordIncorrecto');
                        }
                    }
                }

                $alertas = Usuario::getAlertas();

            } elseif ($accion === 'registrarse') {
                // Lógica para registrarse
                $alertas = [];
                $usuario = new Usuario;
                // debuguear($usuario);

                if($_SERVER['REQUEST_METHOD'] === 'POST') {

                    $datos = array_map('s', $_POST);
                    $usuario->sincronizar($datos);

                    // debuguear($usuario);
                    
                    $alertas = $usuario->validar_cuenta();

                    // debuguear($alertas);
                    if(empty($alertas)) {
                        $existeUsuario = Usuario::where('email', $usuario->email);

                        if($existeUsuario) {
                            // Usuario::setAlerta('error', 'El Usuario ya esta registrado', array('usuarioRegistrado'));
                            Usuario::setAlerta('error', 'El Usuario ya está registrado', 'usuarioRegistrado');
                            $alertas = Usuario::getAlertas();
                            // debuguear('aqui van las alertas');
                            
                        } else {
                            // Hashear el password
                            $usuario->hashPassword();

                            // Eliminar password2
                            // unset($usuario->password2);

                            // Generar el Token
                            $usuario->crearToken();

                            // Generar un token y asignarlo a la propiedad $usuario->locked
                            $usuario->token();


                            // Crear un nuevo usuario
                            $resultado = $usuario->guardar();
                            // debuguear($resultado);

                            // Enviar email
                            $email = new Email($usuario->email, $usuario->nombre, $usuario->token);
                            $email->enviarConfirmacion();
                            

                            if($resultado) {
                                header('Location: /mensaje');
                            }
                        }
                    }
                }
            }
        }
        


        $router->render('paginas/contacto', [
            'titulo' => 'Contáctanos y obtén tu sitio web',
            'description' => 'Ponte en contacto con AriWeb para iniciar tu viaje hacia un sitio web excepcional. Explora tus necesidades y objetivos con nosotros, fusionando experiencia y enfoque personalizado para alcanzar el éxito en línea que mereces. ¡Trabajemos juntos para hacer realidad tu visión digital!',
            'keywords' => 'asesoramiento digital, servicios de desarrollo web, soporte web',
            'alertas' => $alertas,
            'usuario' => $usuario

        ]);
    }



    public static function terminos_condiciones(Router $router) {

        $router->render('paginas/terminos-condiciones', [
            'titulo' => 'Términos y Condiciones',
            'description' => 'Nuestro compromiso para brindarte una experiencia digital transparente y segura. Conoce tus derechos y responsabilidades al interactuar con nuestros servicios. ¡Navega con confianza!',
            'keywords' => 'términos y condiciones del sitio web, transparencia digital'
        ]);
    }

    public static function politica_privacidad(Router $router) {

        $router->render('paginas/politica-privacidad', [
            'titulo' => 'Política de Privacidad',
            'description' => 'Descubre nuestra Política de Privacidad, donde tu seguridad en línea es nuestra prioridad. Aprende cómo manejamos tus datos y garantizamos una experiencia digital confiable. Tu confianza es nuestro compromiso.',
            'keywords' => 'política de privacidad del sitio web, manejo de datos en línea'
        ]);
    }
}


