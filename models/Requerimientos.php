<?php

namespace Model;

class Requerimientos extends ActiveRecord {
    protected static $tabla = 'requerimientos';
    protected static $columnasDB = ['id', 'titulo', 'id_usuarios', 'requerimientos', 'primer_pago', 'final_pago', 'extras', 'fecha', 'completado', 'pago_id_pri', 'pago_id_fin', 'pago_id_ex', 'locked'];


    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->titulo = $args['titulo'] ?? '';
        $this->id_usuarios = $args['id_usuarios'] ?? '';
        $this->requerimientos = $args['requerimientos'] ?? '';
        $this->primer_pago = $args['primer_pago'] ?? '';
        $this->final_pago = $args['final_pago'] ?? '';
        $this->extras = $args['extras'] ?? '';
        $this->fecha = date('Y/m/d H:i:s');
        $this->completado = $args['completado'] ?? 1;
        $this->pago_id_pri = $args['pago_id_pri'] ?? '';
        $this->pago_id_fin = $args['pago_id_fin'] ?? '';
        $this->pago_id_ex = $args['pago_id_ex'] ?? '';
        $this->locked = $args['locked'] ?? '';


    }

    // Mensajes de validación para la creación de un evento
    public function validar() {


        // if(!$this->id || !filter_var($this->id, FILTER_VALIDATE_INT)) {
        //     self::$alertas['error'][] = 'Error con su id';
        // }

        if(!$this->titulo) {
            self::$alertas['error'][] = 'Ingrese el titulo';
        }

        // if(!$this->id_usuarios) {
        //     self::$alertas['error'][] = 'Error con su usuario';
        // }

        if(!$this->requerimientos) {
            self::$alertas['error'][] = 'Ingrese los requerimientos';
        }

        if(!$this->primer_pago) {
            self::$alertas['error'][] = 'Proporcione el primer costo del sitio web';
        }

        if(!$this->final_pago) {
            self::$alertas['error'][] = 'Proporcione el segundo costo del sitio web';
        }

        // if(!$this->extras) {
        //     self::$alertas['error'][] = 'Proporcione el costo extra';
        // }



        return self::$alertas;
    }
}