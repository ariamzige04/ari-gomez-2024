<main class="auth ">
    <div class="auth__contenedor">

        <h1 class="auth__titulo">Registrarse </h1>
        <p class="auth__texto">¡Bienvenido! Ingrese sus datos para comprar</p> 
    
        <?php 
            require_once __DIR__ . '/../templates/alertas.php';
        ?>
    
        <form method="POST" action="/registro" class="formulario" id="formulario__recapcha">
    
            <div class="formulario__campo">
                <input 
                    type="text"
                    class="formulario__input"
                    name="nombre"
                    id="nombre"
                    placeholder="Su nombre"
                    value="<?php echo $usuario->nombre; ?>"
                    require
                >
                <label class="formulario__label" for="nombre">Su Nombre</label>
                <div class="formulario__error">
                    <i class="fa-solid fa-circle-exclamation"></i>
                    Introduzca su Nombre, mínimo de tres caracteres
                </div>
            </div>

            <div class="formulario__campo">
                <input 
                    type="text"
                    class="formulario__input"
                    name="apellido"
                    id="apellido"
                    placeholder="Su Apellido"
                    value="<?php echo $usuario->apellido; ?>"
                    require
                >
                <label class="formulario__label" for="apellido">Su Apellido</label>
                <div class="formulario__error">
                    <i class="fa-solid fa-circle-exclamation"></i>
                    Introduzca su Apellido, mínimo de tres caracteres
                </div>
            </div>

            <div class="formulario__campo">
                <input 
                    type="tel"
                    class="formulario__input"
                    name="telefono"
                    id="telefono"
                    placeholder="Su Teléfono"
                    value="<?php echo $usuario->telefono; ?>"
                    require
                >
                <label class="formulario__label" for="telefono">Su Teléfono</label>
                <div class="formulario__error">
                    <i class="fa-solid fa-circle-exclamation"></i>
                    Introduzca su Teléfono de 10 números
                </div>
            </div>

            <div class="formulario__campo">
                <input 
                    type="email"
                    class="formulario__input"
                    name="email"
                    id="email"
                    placeholder="Su email"
                    value="<?php echo $usuario->email; ?>"
                    require
                >
                <label class="formulario__label" for="email">Su Correo</label>
                <div class="formulario__error">
                    <i class="fa-solid fa-circle-exclamation"></i>
                    Introduzca un Correo válido
                </div>
            </div>
    
            <div class="formulario__campo">
                <input 
                    type="password"
                    class="formulario__input"
                    name="password"
                    id="password"
                    placeholder="Su password"
                    require
                >
                <label class="formulario__label" for="password">Su Contraseña</label>
                <div class="formulario__error">
                    <i class="fa-solid fa-circle-exclamation"></i>
                    Introduzca una contraseña válido, minimo de 6 caracteres
                </div>
            </div>

            <div class="formulario__campo">
                <input 
                    type="password"
                    class="formulario__input"
                    name="password2"
                    id="password2"
                    placeholder="Su password"
                    require
                >
                <label class="formulario__label" for="password2">Repita su Contraseña</label>
                <div class="formulario__error">
                    <i class="fa-solid fa-circle-exclamation"></i>
                    Introduzca una contraseña válido, minimo de 6 caracteres
                </div>
            </div>
            
            <!-- input de recapcha -->
            <!-- <input type="hidden" name="token_recaptcha" id="token_recaptcha"> -->

            <input type="submit" class="formulario__boton-principal" value="Registrarse gratis">
        </form>
    
        <div class="acciones">
            <a href="/login" class="acciones__enlace">¿Ya tienes cuenta? Iniciar Sesión</a>
        </div>

    </div>

    <!-- imagen -->
    <div class="auth__imagen auth__imagen--registro">

    </div>

</main>

