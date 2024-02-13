<?php

namespace Model;

class Usuario extends ActiveRecord {
    protected static $tabla = 'usuarios';
    protected static $columnasDB = ['id', 'nombre', 'telefono', 'email', 'password', 'descripcion', 'confirmado', 'token', 'admin', 'registrado', 'locked', 'new_requerimiento', 'new_time_requerimiento'];


    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->nombre = $args['nombre'] ?? '';
        $this->telefono = $args['telefono'] ?? '';
        $this->email = $args['email'] ?? '';
        $this->password = $args['password'] ?? '';
        $this->password2 = $args['password2'] ?? '';
        $this->descripcion = $args['descripcion'] ?? '';
        $this->confirmado = $args['confirmado'] ?? 0;
        $this->token = $args['token'] ?? '';
        $this->admin = $args['admin'] ?? 0;
        $this->registrado = date('Y/m/d H:i:s');
        $this->terminos = $args['terminos'] ?? '';
        $this->locked = $args['locked'] ?? '';//0 SIGNIFICA QUE ESTA BLOQUEADO Y 1 QUE ESTA DESBLOQUEDO Y PUEDE HACER MAS PEDIDOS DE WEBS
        $this->new_requerimiento = $args['new_requerimiento'] ?? 0;//esta en cero si ya tiene un requerimiento puesto, y cuando se recetea el cliente vuelve a 0, pero si es 1 puede crear o agregar un requerimiento nuevo
        $this->new_time_requerimiento = $args['new_time_requerimiento'] ?? NULL;
    }

    // Validar el Login de Usuarios
    public function validarLogin() {
        if(empty($this->email)) {
            self::$alertas['error']['email'] = 'Ingresa un correo electrónico válido.';
        } else if(!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            self::$alertas['error']['email'] = 'Ingresa un correo electrónico válido.';
        } else if(strlen($this->email) > 50) {
            self::$alertas['error']['email'] = 'El correo electrónico debe tener máximo 50 caracteres.';
        }

        if(empty($this->password)) {
            self::$alertas['error']['password'] = 'Ingresa una contraseña segura.';
        } else if(strlen($this->password) < 6) {
            self::$alertas['error']['password'] = 'La contraseña debe tener al menos 6 caracteres.';
        }

        return self::$alertas;

    }

    public function validar_cuenta() {
        if(empty($this->nombre)) {
            self::$alertas['error']['nombre'] = 'Ingresa tu nombre.';
        } else if(!preg_match('/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/', $this->nombre)) {
            self::$alertas['error']['nombre'] = 'El nombre solo puede contener letras y espacios.';
        } else if(strlen($this->nombre) > 30) {
            self::$alertas['error']['nombre'] = 'El nombre debe tener máximo 30 caracteres.';
        }
    
        if(empty($this->telefono)) {
            self::$alertas['error']['telefono'] = 'Ingresa un número de teléfono válido.';
        } else if(!preg_match('/^\d+$/', $this->telefono)) {
            self::$alertas['error']['telefono'] = 'El teléfono solo puede contener números.';
        } else if(strlen($this->telefono) > 15) {
            self::$alertas['error']['telefono'] = 'El teléfono debe tener máximo 15 caracteres.';
        }
    
        if(empty($this->email)) {
            self::$alertas['error']['email'] = 'Ingresa un correo electrónico válido.';
        } else if(!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            self::$alertas['error']['email'] = 'Ingresa un correo electrónico válido.';
        } else if(strlen($this->email) > 50) {
            self::$alertas['error']['email'] = 'El correo electrónico debe tener máximo 100 caracteres.';
        }
    
        if(empty($this->password)) {
            self::$alertas['error']['password'] = 'Ingresa una contraseña segura.';
        } else if(strlen($this->password) < 6) {
            self::$alertas['error']['password'] = 'La contraseña debe tener al menos 6 caracteres.';
        }
    
        if(empty($this->descripcion)) {
            self::$alertas['error']['descripcion'] = 'Describe cómo deseas tu sitio web.';
        } else if(strlen($this->descripcion) > 1000) {
            self::$alertas['error']['descripcion'] = 'La descripción debe tener máximo 1000 caracteres.';
        }
    
        if(empty($this->terminos)) {
            self::$alertas['error']['terminos'] = 'Debes aceptar los Términos y Condiciones, y la Política de privacidad para continuar.';
        }
    
        return self::$alertas;
    }
    

    // Valida un email
    public function validarEmail() {
        if(empty($this->email)) {
            self::$alertas['error']['email'] = 'Ingresa un correo electrónico válido.';
        } else if(!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            self::$alertas['error']['email'] = 'Ingresa un correo electrónico válido.';
        } else if(strlen($this->email) > 50) {
            self::$alertas['error']['email'] = 'El correo electrónico debe tener máximo 50 caracteres.';
        }
        return self::$alertas;
    }

    // Valida el Password 
    public function validarPassword() {
        if(empty($this->password)) {
            self::$alertas['error']['password'] = 'Ingresa una contraseña segura.';
        } else if(strlen($this->password) < 6) {
            self::$alertas['error']['password'] = 'La contraseña debe tener al menos 6 caracteres.';
        }
        
        return self::$alertas;
    }

    public function nuevo_password() : array {
        if(!$this->password_actual) {
            self::$alertas['error'][] = 'El Password Actual no puede ir vacio';
        }
        if(!$this->password_nuevo) {
            self::$alertas['error'][] = 'El Password Nuevo no puede ir vacio';
        }
        if(strlen($this->password_nuevo) < 6) {
            self::$alertas['error'][] = 'El Password debe contener al menos 6 caracteres';
        }
        return self::$alertas;
    }

    // Comprobar el password
    public function comprobar_password() : bool {
        return password_verify($this->password_actual, $this->password );
    }

    // Hashea el password
    public function hashPassword() : void {
        $this->password = password_hash($this->password, PASSWORD_ARGON2ID);
    }

    // Generar un Token
    public function crearToken() : void {
        $this->token = bin2hex(random_bytes(16)); // 16 bytes = 32 caracteres hexadecimales
    }
    

    // Generar un Token
    public function token() : void {
        $this->locked = bin2hex(random_bytes(16)); // 16 bytes = 32 caracteres hexadecimales
    }
    

    //Validacin de formulario para clientes en pagina de Inicio y contacto
     // Validación para cuentas nuevas
    //  public function validar_datos() {
    //     if(!$this->nombre) {
    //         self::$alertas['error']['nombre'] = 'El Nombre es Obligatorio';
    //     }

    //     if(!filter_var($this->telefono, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^\d{10}$/")))) {
    //         self::$alertas['error']['telefono-no-valido'] = 'El Teléfono no es válido';
    //     }

    //     if(!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
    //         self::$alertas['error']['correo'] = 'Correo no válido';
    //     }
        
    //     if(strlen($this->mensaje) < 25) {
    //         self::$alertas['error']['mensaje'] = 'El Mensaje debe contener al menos 25 caracteres';
    //     }

    //     return self::$alertas;
    // }
}