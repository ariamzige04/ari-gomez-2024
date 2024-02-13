<?php

namespace Model;

class Portafolio extends ActiveRecord {
    protected static $tabla = 'portafolio';
    protected static $columnasDB = ['id', 'nombre', 'imagen', 'descripcion', 'url', 'id_usuario', 'fecha'];


    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->nombre = $args['nombre'] ?? '';
        $this->imagen = $args['imagen'] ?? '';
        $this->descripcion = $args['descripcion'] ?? '';
        $this->url = $args['url'] ?? '';
        $this->id_usuario = $args['id_usuario'] ?? '';
        $this->fecha = date('Y/m/d H:i:s');
    }

    // Mensajes de validación para la creación de un evento
    public function validar() {


        if(!$this->nombre) {
            self::$alertas['error']['nombre'] = 'Escriba el nombre del proyecto';
        }

        if(!$this->imagen) {
            self::$alertas['error']['imagen'] = 'Seleccione una imagen';
        }

        if(!$this->descripcion) {
            self::$alertas['error']['descripcion'] = 'Ponga una descripción';
        }

        if(!$this->url) {
            self::$alertas['error']['url'] = 'Ingrese la url del sitio web';
        }

        if(!$this->id_usuario || !filter_var($this->id_usuario, FILTER_VALIDATE_INT)) {
            self::$alertas['error']['id_usuario'] = 'Error con el ID de usuario';
        }

        return self::$alertas;
    }
}