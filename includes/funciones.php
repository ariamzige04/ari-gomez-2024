<?php

function debuguear($variable) : string {
    echo "<pre>";
    var_dump($variable);
    echo "</pre>";
    exit;
}
// $s = preg_replace('/\s+/', ' ', $s);
function s($html): string {
    $s = htmlspecialchars(trim($html));
    return $s;
}


// Muestra los mensajes
function mostrarNotificacion($codigo) {
    $mensaje = '';

    switch ($codigo) {
        case 1:
            $mensaje = 'Creada Correctamente';
            break;
        case 2:
            $mensaje = 'Actualizada Correctamente';
            break;
        case 3:
            $mensaje = 'Eliminada Correctamente';
            break;
        default:
            $mensaje = false;
            break;
    }
    return $mensaje;
}

function reemplazar($cadena) {
    $cadena = preg_replace('/\s+/', ' ', trim($cadena));
    return str_replace(" ", "-", $cadena);
}

function pagina_actual($path ) : bool {
    return str_contains( $_SERVER['PATH_INFO'] ?? '/', $path  ) ? true : false;
}

function getMarcaNombre($marcas, $marca_id) {
    foreach($marcas as $marca) {
      if ($marca['id'] == $marca_id) {
        return $marca['nombre'];
      }
    }
    return "Marca no encontrada";
  }

function is_auth() : bool {
    if(!isset($_SESSION)) {
        session_start();
    }
    return isset($_SESSION['nombre']) && !empty($_SESSION);//si existe la Session con el nombre y tiene Algo la session
}

function is_admin() : bool {
    if(!isset($_SESSION)) {
        session_start();
    }
    return isset($_SESSION['admin']) && !empty($_SESSION['admin']);
}

function aos_animacion() : void {
    $efectos = ['fade-up', 'fade-down', 'fade-left', 'fade-right', 'flip-left', 'flip-right', 'zoom-in', 'zoom-in-up', 'zoom-in-down', 'zoom-out'];//estos son loe efectos de AOS
    $efecto = array_rand($efectos, 1);//array rend retorna una posicion, toma el array y retorna el valor
    echo ' data-aos="' . $efectos[$efecto] . '" ';//agarra el array de efectos y trae la ubicason aleatria o sea el valor
}
