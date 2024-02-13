<?php

namespace Controllers;

use MVC\Router;
use Model\Usuario;
use Model\Portafolio;
use Model\Requerimientos;
// use Intervention\Image\Image;
use Intervention\Image\ImageManagerStatic as Image;

// use Intervention\Image\Image;


class AdminController {
   

    public static function admin(Router $router) {

        if(!is_admin()) {
            header('Location: /contactanos');
            return;
        }

        $usuarios = Usuario::all('DESC');
        // debuguear($usuarios);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                // debuguear($_POST);
            
            // $usuarios = Usuario::all('ASC');
            
            if (isset($_POST['filtro_fecha'])) {
                // Filtrar por fecha si se ha presionado el botón de filtrar por fecha
                $fechaSeleccionada = $_POST['fecha'];
                $usuarios = array_filter($usuarios, function ($usuario) use ($fechaSeleccionada) {
                    $fechaUsuario = date('Y-m-d', strtotime($usuario->registrado));
                    // debuguear($fechaUsuario);
                    return $fechaUsuario === $fechaSeleccionada;
                });
            }
            
            // debuguear($usuarios);

            
        }
        

        // Muestra la vista
        $router->render('admin/index', [
            'titulo' => 'Admin',
            'description' => '',
            'keywords' => '',
            'usuarios' => $usuarios,


        ]);
    }


    public static function usuario(Router $router) {

        if(!is_admin()) {
            header('Location: /contactanos');
            return;
        }


        // id del usuario
        $id = s($_GET['id']);
        $usuario = Usuario::where('id', $id);
        if(!$usuario) {
            header('Location: /admin/dashboard');
            return;
        }
        // debuguear($usuario);
        $requerimiento = Requerimientos::where('locked', $usuario->locked);
        // debuguear($requerimiento);

        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            if(!is_admin()) {
                header('Location: /contactanos');
                return;
            }

            
            // $id_post = $_POST['id'];
            // debuguear($requerimiento);

            $nombreColumna = "locked"; // Reemplaza con el nombre de la columna que deseas modificar
            $requerimiento_vacio = $requerimiento->locked;
            if(!$requerimiento_vacio == null) {
                // si NO esta como null
                $resultado = $requerimiento->eliminarContenidoColumna($nombreColumna);
            } 
            // else {
            //     // si esta null o sea si tiene un requerimiento
                
            // }
            
            $usuario->descripcion = null;//se quita el requerimiento que lleno e cliente por primera vez para que pueda llenar otro
            $usuario->new_requerimiento = 1;//para que pueda crear en el futruo un nuevo sitio web
            // debuguear($usuario);
            $usuario->guardar();

            // debuguear($resultado);
            if($resultado) {
                header("Location: /admin/usuario?id=$id");//aqui falta el id
                return;
            }


        }
        

        // Muestra la vista
        $router->render('admin/usuario', [
            'titulo' => 'Usuario',
            'description' => '',
            'keywords' => '',
            'usuario' => $usuario,
            'requerimiento' => $requerimiento,
        ]);
    }

    public static function usuario_requerimiento(Router $router) {

        if(!is_admin()) {
            header('Location: /contactanos');
            return;
        }

        $alertas = [];

        $id = $_GET['id'];//este es el id de la tabla usuario
        $id = filter_var($id, FILTER_VALIDATE_INT);


        $usuario = Usuario::find($id);
        // debuguear($usuario->locked);

        // $requerimiento = Requerimientos::where('locked', $usuario->locked);

        $requerimiento_comprobar = Requerimientos::where('locked', $usuario->locked);
        if(!$requerimiento_comprobar && $requerimiento_comprobar === null) {
            // primera vez
            $requerimiento = new Requerimientos;
        } else {
            $requerimiento = Requerimientos::where('locked', $usuario->locked);
        }
        // $usuario->locked;
        // debuguear($requerimiento);
        
        // debuguear($requerimiento);
       

        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            if(!is_admin()) {
                header('Location: /contactanos');
                return;
            }

            if($requerimiento->id === null) {
                // debuguear("no tiene ningun requerimiento, empezar a escribirlo");
                $requerimiento->sincronizar($_POST);
                // debuguear($requerimiento);
                // si tiene un id se asigna si no se queda vacio
                $requerimiento->id_usuarios = $id ?? '';
    
                $alertas = $requerimiento->validar();
                // debuguear($alertas);
                
                if(empty($alertas)) {

                    if($requerimiento->extras === "") {
                        $requerimiento->extras = -1;
                    }
                    $requerimiento->locked = $usuario->locked;

                    // debuguear($requerimiento);

                    $resultado = $requerimiento->guardar();
                    // debuguear($resultado);
    
                    if($resultado) {
                        header("Location: /admin/usuario?id=$id");//aqui falta el id
                        return;
                    }
                }
    
            } else {
                // debuguear("tiene un requerimiento, puedes editarlo");
                $requerimiento->sincronizar($_POST);
        
                $alertas = $requerimiento->validar();
                
                if(empty($alertas)) {
                    if($requerimiento->extras === "") {
                        $requerimiento->extras = -1;
                    }
                    $resultado = $requerimiento->guardar();
    
                    if($resultado) {
                        header("Location: /admin/usuario?id=$id");//aqui falta el id
                        return;
                    }
                }
            }
        }
       
        

        // Muestra la vista
        $router->render('admin/requerimiento', [
            'titulo' => 'Requerimientos',
            'description' => '',
            'keywords' => '',
            'usuario' => $usuario,
            'requerimiento' => $requerimiento,
            'alertas' => $alertas

        ]);
    }


    public static function requerimientos(Router $router) {

        if(!is_admin()) {
            header('Location: /contactanos');
            return;
        }

        // $usuarios = Usuario::all('DESC');
        $requerimientos = Requerimientos::all('DESC');

        // Copia el ID de usuario a una nueva variable para mantenerlo
        $requerimientos = Requerimientos::all('DESC');

        foreach ($requerimientos as $requerimiento) {
            $id_usuario = $requerimiento->id_usuarios;
            
            // Obtén el nombre del usuario asociado a través del ID de usuario
            $usuario = Usuario::find($id_usuario);
            
            // Almacena el nombre del usuario en una nueva variable
            $requerimiento->nombre_usuario = $usuario ? $usuario->nombre : "Usuario no encontrado";
            
            // Mantén el ID de usuario en la lista de requerimientos
            $requerimiento->id_usuarios = $id_usuario;
        }
        
        
        // debuguear($requerimientos);


        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                // debuguear($_POST);
            
            // $usuarios = Usuario::all('ASC');
            
            if (isset($_POST['filtro_fecha'])) {
                // Filtrar por fecha si se ha presionado el botón de filtrar por fecha
                $fechaSeleccionada = $_POST['fecha'];
                $requerimientos = array_filter($requerimientos, function ($dato) use ($fechaSeleccionada) {
                    $fechaDato = date('Y-m-d', strtotime($dato->fecha));
                    // debuguear($fechaUsuario);
                    return $fechaDato === $fechaSeleccionada;
                });
            }
            
            // debuguear($requerimientos);

            
        }
        

        // Muestra la vista
        $router->render('admin/requerimientos', [
            'titulo' => 'Clientes',
            'description' => '',
            'keywords' => '',
            'requerimientos' => $requerimientos,
            // 'id_usuario' => $id_usuario,


        ]);
    }


    public static function clientes_frecuentes(Router $router) {

        
        if(!is_admin()) {
            header('Location: /contactanos');
            return;
        }

        //        error_reporting(E_ALL);
        // ini_set('display_errors', 1); 

        // Copia el ID de usuario a una nueva variable para mantenerlo
        $requerimientos = Requerimientos::all('DESC');
        $usuarios = Usuario::all('DESC');
        $usuariosFiltrados = array_filter($usuarios, function ($usuario) {
            return isset($usuario->new_time_requerimiento) && !empty(trim($usuario->new_time_requerimiento))
                && $usuario->new_requerimiento === "0";
        });
        

        // Verifica si hay usuarios filtrados antes de ordenarlos
        if (!empty($usuariosFiltrados)) {
            // Ordena el array de usuarios filtrados usando usort
            usort($usuariosFiltrados, function ($usuario1, $usuario2) {
                $fecha1 = \DateTime::createFromFormat('Y/m/d H:i:s', $usuario1->new_time_requerimiento);
                $fecha2 = \DateTime::createFromFormat('Y/m/d H:i:s', $usuario2->new_time_requerimiento);

                // Verifica si hubo algún problema con la conversión de fechas
                if ($fecha1 === false || $fecha2 === false) {
                    return 0; // Sin cambio en la ordenación
                }

                // Compara las fechas de forma descendente (de más reciente a más antiguo)
                return $fecha2 <=> $fecha1;
            });

            // Debuguea los resultados
            // debuguear($usuariosFiltrados);
            // en esta falta filtrar
            // new_requerimientos
            // debe contener fecha en new_time_requerimientos y el 0 en new_requerimientos
            // si esta en 0, ya tiene una descripcion puesta para poder hacer un presupuesto
            // si esta en 1, no tiene ninguna descripcion, no ha hecho ningun pedido (no nos interesa)
        }
                // debuguear($usuariosFiltrados);


        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Asegúrate de que $usuariosFiltrados esté definido
            $usuariosFiltrados = isset($usuariosFiltrados) ? $usuariosFiltrados : [];
        
            if (isset($_POST['filtro_fecha'])) {
                // Filtrar por fecha si se ha presionado el botón de filtrar por fecha
                $fechaSeleccionada = $_POST['fecha'];
                $usuariosFiltrados = array_filter($usuariosFiltrados, function ($dato) use ($fechaSeleccionada) {
                    // Ajusta el formato de la fecha para que coincida con "Y-m-d"
                    $fechaDato = date('Y-m-d', strtotime($dato->new_time_requerimiento));
                    
                    // Compara las fechas sin tener en cuenta el tiempo
                    return $fechaDato === $fechaSeleccionada;
                });
                // debuguear($usuariosFiltrados);
                // debuguear($usuariosFiltrados);
            }
        }
                
                
                

        // Muestra la vista
        $router->render('admin/clientes-frecuentes', [
            'titulo' => 'Clientes frecuentes',
            'description' => '',
            'keywords' => '',
            'usuariosFiltrados' => $usuariosFiltrados,
            // 'id_usuario' => $id_usuario,


        ]);
    }


    public static function portafolio(Router $router) {

        if(!is_admin()) {
            header('Location: /contactanos');
            return;
        }
        $portafolio = Portafolio::all('DESC');
        $usuarios = Usuario::all('DESC');
                // debuguear($usuarios);

        $router->render('admin/portafolio', [
            'titulo' => 'Portafolio',
            'description' => '',
            'keywords' => '',
            'portafolio' => $portafolio,
            'usuarios' => $usuarios,


        ]);
    }


    public static function portafolio_crear(Router $router) {

        if(!is_admin()) {
            header('Location: /contactanos');
            return;
        }

        $alertas = [];  
        $portafolio = new Portafolio;
        
        $usuarios = Usuario::all('DESC');
                // debuguear($usuarios);
        
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            if(!is_admin()) {
                header('Location: /login');
                return;
            }
            
            if (!empty($_FILES['imagen']['tmp_name'])) {
                $carpeta_imagenes = '../public/build/img/portafolios';
            
                // Crear la carpeta si no existe
                if (!is_dir($carpeta_imagenes)) {
                    mkdir($carpeta_imagenes, 0777, true);
                }
            
                // Generar un nombre único para la imagen
                $token_unico = substr(md5(uniqid(rand(), true)), 0, 10);
            
                if ($_FILES['imagen']['error'] === UPLOAD_ERR_OK && getimagesize($_FILES['imagen']['tmp_name'])) {
                    // Procesar la imagen
                    $imagen_temporal = $_FILES['imagen']['tmp_name'];
                    $imagen = Image::make($imagen_temporal);
            
                    // Definir el tamaño máximo deseado (ancho y alto)
                    $ancho_maximo = 1080;
                    $alto_maximo = 1080; // Establecer la misma restricción en el alto
            
                    // Redimensionar la imagen manteniendo la relación de aspecto
                    $imagen->resize($ancho_maximo, $alto_maximo, function ($constraint) {
                        $constraint->aspectRatio();
                        $constraint->upsize();
                    });
            
                    $imagen_jpg = $imagen->encode('jpg', 80);
                    $imagen_webp = $imagen->encode('webp', 80);
            
                    $_POST['imagen'] = $token_unico;
                }
            
                // Guardar las imágenes si se proporcionaron
                if (!empty($_FILES['imagen']['tmp_name'])) {
                    $imagen_jpg->save($carpeta_imagenes . '/' . $token_unico . ".jpg");
                    $imagen_webp->save($carpeta_imagenes . '/' . $token_unico . ".webp");
                    // $portafolio->imagen = $token_unico;
                }
            
                // Liberar la memoria
                $imagen->destroy();
            }
            
            

            $portafolio->sincronizar($_POST);
            // debuguear($portafolio->sincronizar($_POST));
            $alertas = $portafolio->validar();
            // debuguear($alertas);

            if(empty($alertas)) {


                // Guardar las imagenes
                $imagen_jpg->save($carpeta_imagenes . '/' . $token_unico . ".jpg" );
                
                $imagen_webp->save($carpeta_imagenes . '/' . $token_unico . ".webp" );
                // debuguear($imagen_webp->save($carpeta_imagenes . '/' . $token_unico . ".webp" ));

                $resultado = $portafolio->guardar();
                // debuguear($resultado);
                if($resultado) {
                    header('Location: /admin/portafolio');
                    return;
                }
            }

        }


        $router->render('admin/portafolio-crear', [
            'titulo' => 'Añadir sitio web',
            'description' => '',
            'keywords' => '',
            'alertas' => $alertas,
            'portafolio' => $portafolio,
            'usuarios' => $usuarios,


        ]);
    }


    public static function portafolio_editar(Router $router) {

        if(!is_admin()) {
            header('Location: /contactanos');
            return;
        }


        $alertas = [];

        // Validar el ID del portafolio a editar
        $portafolio_id = s($_GET['id']);
        $portafolio = Portafolio::find($portafolio_id);
        
        if (!$portafolio) {
            header('Location: /admin/portafolio');
            return;
        }
        
        $usuarios = Usuario::all('DESC');
        $portafolio->imagen_actual = $portafolio->imagen; //imagen_actual es la imagen que tiene ese portafolio (es la imagen que ya está guardada)
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!is_admin()) {
                header('Location: /login');
                return;
            }
        
            $portafolio->sincronizar($_POST);
            $alertas = $portafolio->validar();
        
            if (empty($alertas)) {
                // si no hay errores
                // Leer imagen si se ha proporcionado
                if (!empty($_FILES['imagen']['tmp_name'])) {
                    $carpeta_imagenes = '../public/build/img/portafolios';
                
                    // Crear la carpeta si no existe
                    if (!is_dir($carpeta_imagenes)) {
                        mkdir($carpeta_imagenes, 0777, true);
                    }
                
                    // Generar un nombre único para la imagen
                    $token_unico = substr(md5(uniqid(rand(), true)), 0, 10);
                
                    // Verificar si existe una imagen anterior
                    if (!empty($portafolio->imagen_actual)) {
                        // Eliminar la imagen anterior
                        $imagen_anterior = $carpeta_imagenes . '/' . $portafolio->imagen_actual . ".jpg";
                        $webp_anterior = $carpeta_imagenes . '/' . $portafolio->imagen_actual . ".webp";
                
                        if (file_exists($imagen_anterior)) {
                            unlink($imagen_anterior);
                        }
                        if (file_exists($webp_anterior)) {
                            unlink($webp_anterior);
                        }
                    }
                
                    if ($_FILES['imagen']['error'] === UPLOAD_ERR_OK && getimagesize($_FILES['imagen']['tmp_name'])) {
                        // Procesar la imagen
                        $imagen_temporal = $_FILES['imagen']['tmp_name'];
                        $imagen = Image::make($imagen_temporal);
                
                        // Definir el tamaño máximo deseado (ancho y alto)
                        $ancho_maximo = 1080;
                        $alto_maximo = 1080; // Establecer la misma restricción en el alto
                
                        // Redimensionar la imagen manteniendo la relación de aspecto
                        $imagen->resize($ancho_maximo, $alto_maximo, function ($constraint) {
                            $constraint->aspectRatio();
                            $constraint->upsize();
                        });
                
                        $imagen_jpg = $imagen->encode('jpg', 80);
                        $imagen_webp = $imagen->encode('webp', 80);
                
                        $_POST['imagen'] = $token_unico;
                    } else {
                        $_POST['imagen'] = $portafolio->imagen_actual; // si no hay imagen, se recupera el valor que tenía previamente y se vuelve a asignar al Post
                    }
                
                    // Guardar las imágenes si se proporcionaron
                    if (!empty($_FILES['imagen']['tmp_name'])) {
                        $imagen_jpg->save($carpeta_imagenes . '/' . $token_unico . ".jpg");
                        $imagen_webp->save($carpeta_imagenes . '/' . $token_unico . ".webp");
                        $portafolio->imagen = $token_unico;
                    }
                
                    // Liberar la memoria
                    $imagen->destroy();
                }
                
        
                $resultado = $portafolio->guardar();
                if ($resultado) {
                    header('Location: /admin/portafolio');
                    return;
                }
            }
        }
        


        $router->render('admin/portafolio-editar', [
            'titulo' => 'Editar Portafolio',
            'description' => '',
            'keywords' => '',
            'alertas' => $alertas,
            'portafolio' => $portafolio,
            'usuarios' => $usuarios

        ]);
    }


    public static function portafolio_eliminar() {

        if(!is_admin()) {
            header('Location: /contactanos');
            return;
        }

        // Validar el ID del portafolio a editar
        $portafolio_id = s($_POST['id']);
        $portafolio = Portafolio::find($portafolio_id);
        // debuguear($portafolio);
        if (!$portafolio) {
            header('Location: /admin/portafolio');
            return;
        }

        $carpeta_imagenes = '../public/build/img/portafolios';
        $nombre_archivo = basename($portafolio->imagen);
        
        // Eliminar ambos archivos en un solo ciclo
        foreach (['jpg', 'webp'] as $extension) {
            $ruta_archivo = $carpeta_imagenes . '/' . $nombre_archivo . '.' . $extension;
            if (file_exists($ruta_archivo)) {
                unlink($ruta_archivo);
            }
        }
        
        // eliminar la portafolio
        $resultado = $portafolio->eliminar();
        if($resultado) {
            header('Location: /admin/portafolio');
            return;
        }

    }


}