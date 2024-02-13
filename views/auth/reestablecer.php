
<main class="auth auth__seccion--principal">
    <div class="auth__contenedor-chico">
        <h1 class="auth__titulo">Reestablecer nueva  
            <span class="auth__titulo--resaltar">
                constraseña
            </span>
        </h1>
        
        <?php 
        require_once __DIR__ . '/../templates/alertas.php';
        ?>

        <?php if(!$constraseña_cambiada) { ?>

            <?php if($token_valido) { ?>
                <p>
                    Coloca tu nueva contraseña
                </p> 
            <?php } ?>

            <?php if($token_valido) { ?>
                <form method="POST" class="formulario" >
            
                <div class="formulario__campo">
                    <label class="formulario__label" for="password">Su Contraseña</label>
                    <input 
                        type="password"
                        class="formulario__input"
                        name="password"
                        id="password"
                        placeholder="Ingresar contraseña"
                        
                    >
                </div>
                    <button class="formulario__boton--naranja" type="submit" >
                    Guardar contraseña
                        <i class="bi bi-arrow-right"></i>
                    </button>
                </form>
            <?php } ?>

            <div class="acciones">
                <a href="/contactanos" class="acciones__enlace" id="btn-login">¿Ya tienes cuenta? Iniciar Sesión</a>
                <a href="/contactanos" class="acciones__enlace" id="btn-registrar">¿Aún no tienes una cuenta? Obtener una</a>
            </div>
        <?php } ?>

        <?php if($constraseña_cambiada) { ?>
            <a href="/contactanos" class="auth__boton--naranja" id="btn-login" style="margin-bottom: 3rem;">Iniciar Sesión
            <i class="bi bi-arrow-right"></i>
            </a>
        <?php } ?>

    </div>

</main>


