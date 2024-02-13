<main class="auth auth__seccion--principal">
    <div class="auth__contenedor-chico">
        <h1 class="auth__titulo">Confirmación de 
            <span class="auth__titulo--resaltar">
                Registro
            </span>
        </h1>
        <?php if(isset($alertas['exito'])) { ?>
        <h2 class="auth__titulo--exito">
            Comprobada exitosamente
        </h2>
        <?php } else { ?>
        <h2 class="auth__titulo--error">
            Hubo un problema
        </h2>
        <?php } ?>

        <?php 
            require_once __DIR__ . '/../templates/alertas.php';
        ?>

        <?php if(isset($alertas['exito'])) { ?>
            <div class="acciones--centrar">
                <a href="/contactanos" class="auth__boton--naranja" id="btn-login">Iniciar Sesión
                <i class="bi bi-arrow-right"></i>
                </a>
            </div>
        <?php } else { ?>
            <div class="acciones--centrar">
                <a href="/contactanos" class="auth__boton--naranja" id="btn-registrar">Registrarse
                <i class="bi bi-arrow-right"></i>
                </a>
            </div>
        <?php } ?>


    </div>

</main>


