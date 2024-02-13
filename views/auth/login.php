<main class="auth ">
    <div class="auth__contenedor">

        <h1 class="auth__titulo">Iniciar Sesión </h1>
        <p class="auth__texto">¡Bienvenido de nuevo! Por favor, introduzca sus datos</p> 
    
        <?php 
            require_once __DIR__ . '/../templates/alertas.php';
        ?>
    
        <form method="POST" action="/login" class="formulario" id="formulario__recapcha">
    
            <div class="formulario__campo">
                <input 
                    type="email"
                    class="formulario__input"
                    name="email"
                    id="email"
                    placeholder="Su email"
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
    
            <!-- input de recapcha -->
            <!-- <input type="hidden" name="token_recaptcha" id="token_recaptcha"> -->

            <input type="submit" class="formulario__boton-principal" value="Iniciar Sesión">
        </form>
    
        <div class="acciones">
            <a href="/registro" class="acciones__enlace">¿Aún no tienes una cuenta? Obtener una</a>
            <a href="/olvide" class="acciones__enlace">¿Olvidaste tu Password?</a>
        </div>

    </div>

    <!-- imagen -->
    <div class="auth__imagen auth__imagen--login">

    </div>

</main>

