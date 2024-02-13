
<main class="auth auth__seccion--principal">
    <div class="auth__contenedor-chico">
        <h1 class="auth__titulo">Recupera tu 
            <span class="auth__titulo--resaltar">
                constraseña
            </span>
        </h1>
        
        <?php 
            require_once __DIR__ . '/../templates/alertas.php';
        ?>

        <form method="POST" action="/olvide" class="formulario">
            <div class="formulario__campo">
                <label class="formulario__label" for="email">Su Correo</label>
                <input 
                    type="email"
                    class="formulario__input"
                    name="email"
                    id="email"
                    placeholder="Su email"
                    
                >
                <div class="formulario__error">
                    <i class="fa-solid fa-circle-exclamation"></i>
                    Introduzca un Correo válido
                </div>
            </div>

            <button class="formulario__boton--naranja" type="submit">
            Enviar Instrucciones
                <i class="bi bi-arrow-right"></i>
            </button>
        </form>

        <div class="acciones">
            <a href="/contactanos" class="acciones__enlace" id="btn-login">¿Ya tienes cuenta? Iniciar Sesión</a>
            <a href="/contactanos" class="acciones__enlace" id="btn-registrar">¿Aún no tienes una cuenta? Obtener una</a>
        </div>

    </div>

</main>



