
<section class="contacto contacto__seccion">
    <div class="contacto__contenedor">
        <h2 class="contacto__titulo">
            Trabajemos juntos en tu
            <span class="contacto__titulo--resaltar">
                sitio web 
            </span>
        </h2>
        <p class="contacto__parrafo">
            <span class="contacto__parrafo--negritas">¡Regístrate</span> como usuario nuevo o <span class="contacto__parrafo--negritas">inicie sesión</span> si ya tiene una cuenta! Si tienes un <span class="contacto__parrafo--negritas">sitio web en proceso</span> o deseas <span class="contacto__parrafo--negritas">solicitar uno nuevo</span>, estás en el lugar indicado.
        </p>

        <div class="contacto__grid">
            <img class="contacto__imagen" src="/build/img/cara-feliz.svg" alt="Emoji con cara feliz">

            <div class="contacto__llenar-formulario">
                <!-- <div class="contacto__botones">
                    <button class="contacto__registrarse">
                        Registrarse
                    </button>
                    <button class="contacto__login">
                        Iniciar sesión
                    </button>
                </div> -->
                <div class="contacto__acciones">
                    <h3 class="contacto__titulo-acciones">Registrarse</h3><!-- no poner ningun espacio -->
                    <button class="contacto__enlace">
                        ¿Ya tienes cuenta? Iniciar sesión 
                    </button>
                </div>

                <?php if (!empty($alertas['error']['usuarioNoExisteConfirmada'])) { ?>
                    <span class="formulario__error-validacion">
                        <i class="bi bi-exclamation-octagon"></i>
                        <?php echo $alertas['error']['usuarioNoExisteConfirmada']; ?>
                    </span>
                <?php } ?>

                <?php if (!empty($alertas['error']['passwordIncorrecto'])) { ?>
                    <span class="formulario__error-validacion">
                        <i class="bi bi-exclamation-octagon"></i>
                        <?php echo $alertas['error']['passwordIncorrecto']; ?>
                    </span>
                <?php } ?>

                <?php if (!empty($alertas['error']['usuarioRegistrado'])) { ?>
                    <span class="formulario__error-validacion">
                        <i class="bi bi-exclamation-octagon"></i>
                        <?php echo $alertas['error']['usuarioRegistrado']; ?>
                    </span>
                <?php } ?>


                <form class="formulario" id="formulario" method="POST" action="/contactanos">
                    <div class="formulario__campo">
                        <label 
                        class="formulario__label" 
                        for="nombre">Nombre:
                        </label>
                        <input 
                        class="formulario__input" 
                        type="text" 
                        id="nombre" 
                        name="nombre" 
                        placeholder="Ej. Francisco Sánchez" 
                        value="<?php echo isset($usuario) ? s($usuario->nombre) : ''; ?>">
                        <span class="formulario__error">
                        <i class="bi bi-exclamation-octagon"></i>
                        Ingresa tu nombre.
                        </span>
                        <?php if (!empty($alertas['error']['nombre'])) { ?>
                            <span class="formulario__error-validacion">
                                <i class="bi bi-exclamation-octagon"></i>
                                <?php echo $alertas['error']['nombre']; ?>
                            </span>
                        <?php } ?>
                    </div>

                    <div class="formulario__campo">
                        <label 
                        class="formulario__label" 
                        for="telefono">Teléfono:
                        </label>
                        <input 
                        class="formulario__input" 
                        type="tel" 
                        id="telefono" 
                        name="telefono" 
                        placeholder="Ej. 8113257604" 
                        value="<?php echo isset($usuario) ? s($usuario->telefono) : ''; ?>">
                        <span class="formulario__error">
                        <i class="bi bi-exclamation-octagon"></i>
                        Ingresa un número de teléfono válido.
                        </span>
                        <?php if (!empty($alertas['error']['telefono'])) { ?>
                            <span class="formulario__error-validacion">
                                <i class="bi bi-exclamation-octagon"></i>
                                <?php echo $alertas['error']['telefono']; ?>
                            </span>
                        <?php } ?>
                    </div>

                    <div class="formulario__campo">
                        <label 
                        class="formulario__label" 
                        for="correo">Correo electrónico:
                        </label>
                        <input 
                        class="formulario__input" 
                        type="email" 
                        id="correo" 
                        name="email" 
                        placeholder="correo@ejemplo.com" 
                        value="<?php echo isset($usuario) ? s($usuario->email) : ''; ?>">
                        <span class="formulario__error">
                        <i class="bi bi-exclamation-octagon"></i>
                        Ingresa un correo electrónico válido.
                        </span>
                        <?php if (!empty($alertas['error']['email'])) { ?>
                            <span class="formulario__error-validacion">
                                <i class="bi bi-exclamation-octagon"></i>
                                <?php echo $alertas['error']['email']; ?>
                            </span>
                        <?php } ?>
                    </div>

                    <div class="formulario__campo">
                        <label 
                        class="formulario__label" 
                        for="password">Contraseña:
                        </label>
                        <input 
                        class="formulario__input" 
                        type="password" 
                        id="password" 
                        name="password" 
                        placeholder="Ingresar contraseña">
                        <span class="formulario__error">
                        <i class="bi bi-exclamation-octagon"></i>
                        La contraseña debe tener al menos 6 caracteres.
                        </span>
                        <?php if (!empty($alertas['error']['password'])) { ?>
                            <span class="formulario__error-validacion">
                                <i class="bi bi-exclamation-octagon"></i>
                                <?php echo $alertas['error']['password']; ?>
                            </span>
                        <?php } ?>
                    </div>

                    <div class="formulario__campo">
                        <label 
                        class="formulario__label" 
                        for="descripcion">Describe cómo quieres tu sitio web:
                        </label>
                        <textarea 
                        class="formulario__textarea" 
                        id="descripcion" 
                        name="descripcion" 
                        placeholder="Cuéntanos tus ideas y requerimientos"><?php echo isset($usuario) ? s($usuario->descripcion) : ''; ?></textarea>
                        <span class="formulario__error">
                        <i class="bi bi-exclamation-octagon"></i>
                        Describe cómo deseas tu sitio web.
                        </span>
                        <?php if (!empty($alertas['error']['descripcion'])) { ?>
                            <span class="formulario__error-validacion">
                                <i class="bi bi-exclamation-octagon"></i>
                                <?php echo $alertas['error']['descripcion']; ?>
                            </span>
                        <?php } ?>
                    </div>

                    <div class="formulario__campo formulario__terminos">
                        <input 
                        class="formulario__input--terminos" 
                        type="checkbox" 
                        name="terminos" 
                        id="terminos"
                        <?php echo isset($usuario) && $usuario->terminos ? 'checked' : ''; ?>>
                        <label 
                        class="formulario__label--terminos" 
                        for="terminos">
                        Al registrarme, he leído y acepto los <a href="/terminos-condiciones" class="formulario__enlace--terminos">Términos y Condiciones, </a> y la <a href="/politica-privacidad" class="formulario__enlace--terminos">Política de privacidad</a> de AriWeb.
                        </label>
                        
                        <span class="formulario__error">
                            <i class="bi bi-exclamation-octagon"></i>
                            Debes aceptar los Términos y Condiciones, y la Política de privacidad para continuar.
                        </span>
                        <?php if (!empty($alertas['error']['terminos'])) { ?>
                            <span class="formulario__error-validacion">
                                <i class="bi bi-exclamation-octagon"></i>
                                <?php echo $alertas['error']['terminos']; ?>
                            </span>
                        <?php } ?>
                    </div>

                    <!-- input para saber si va a iniciar sesion o registrarse -->
                    <input type="hidden" name="accion" value="iniciar_sesion" id="accion">

                    <button class="formulario__boton--naranja" type="submit">
                        Crear cuenta
                        <i class="bi bi-arrow-right"></i>
                    </button>
                </form>

            </div>
        </div>

    </div>
</section>
