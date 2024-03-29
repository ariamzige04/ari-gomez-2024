<?php

namespace MVC;

class Router
{
    public array $getRoutes = [];
    public array $postRoutes = [];

    public function get($url, $fn)
    {
        $this->getRoutes[$url] = $fn;
    }

    public function post($url, $fn)
    {
        $this->postRoutes[$url] = $fn;
    }

    public function comprobarRutas()
    {

        $url_actual = $_SERVER['PATH_INFO'] ?? '/';
        $method = $_SERVER['REQUEST_METHOD'];

        if ($method === 'GET') {
            $fn = $this->getRoutes[$url_actual] ?? null;
        } else {
            $fn = $this->postRoutes[$url_actual] ?? null;
        }

        if ( $fn ) {
            call_user_func($fn, $this);
        } else {
            header('Location: /404');
            // echo "Página No Encontrada o Ruta no válida";
        }
    }

    public function render($view, $datos = [])
    {
        foreach ($datos as $key => $value) {
            $$key = $value; 
        }

        ob_start(); 

        include_once __DIR__ . "/views/$view.php";

        $contenido = ob_get_clean(); // Limpia el Buffer

        // Utilizar el Layout de acuerdo a la URL
        $url_actual = $_SERVER['PATH_INFO'] ?? '/';

        //if(isset($_SERVER['PATH_INFO'])) {
        //     $currentUrl = $_SERVER['PATH_INFO'] ?? '/';
        // } else {
        //     $currentUrl = strtok($_SERVER['REQUEST_URI'], '?') ?? '/';
        //     // $currentUrl = $_SERVER['REQUEST_URI'] === '' ? '/' : $_SERVER['REQUEST_URI'];

        // }
// commit 

// se crea una nueva rama en git
        //video 693 udemy
        //str_contains es de PHP8
        //strpos tiene mas soporte
        //aqui esta verificando si la url contiene un /admin
        if(str_contains($url_actual, '/admin')) {
            include_once __DIR__ . '/views/layout.php';//este es el layout de admin que toma un contenido
        } else {
            include_once __DIR__ . '/views/layout.php';//este es el layout principal que toma un contenido
        }

        
    }
}
