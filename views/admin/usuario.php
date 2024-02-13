<main class="admin-usuario admin-usuario__seccion--principal">
    <div class="admin-usuario__contenedor-chico">
        <h1 class="admin-usuario__titulo">
            Usuario <?php echo s($usuario->id); ?>: <?php echo s($usuario->nombre); ?>
        </h1>

        <p class="admin-usuario__parrafo">
            Se registró el <span class="admin-usuario__parrafo--negritas"><?php echo s($usuario->registrado); ?></span></p>


        <h2 class="admin-usuario__titulo--secundario">
            Datos personales
        </h2>
        <p class="admin-usuario__enlace">
            Telefono: 
            
            <a class="admin-usuario__enlace--dato" href="tel:<?php echo s($usuario->telefono); ?> " target="_blank" rel="noopener noreferrer">
            <?php echo s($usuario->telefono); ?>
            </a>
        </p>

        <p class="admin-usuario__enlace">
            Correo: 
            <a class="admin-usuario__enlace--dato" href="mailto:<?php echo s($usuario->email); ?>" target="_blank" rel="noopener noreferrer">
            <?php echo s($usuario->email); ?>
            </a>
        </p>

        <h2 class="admin-usuario__titulo--secundario">
            Datos para su sitio web
        </h2>

        <p class="admin-usuario__parrafo--negritas">
            Descripción del cliente:
        </p>
        <p class="admin-usuario__parrafo admin-usuario__parrafo--pre"><?php echo empty(s($usuario->descripcion)) ? 'No hay descripción del sitio web o se eliminó' : s($usuario->descripcion); ?></p>

        <p class="admin-usuario__parrafo--negritas">
            Requerimiento hablado:
        </p>
        <p class="admin-usuario__parrafo admin-usuario__parrafo--pre"><?php echo empty(s($requerimiento->requerimientos)) ? 'No hay requerimiento hablado' : s($requerimiento->requerimientos); ?></p>

        <p class="admin-usuario__parrafo--negritas">
            Primer pago:
        </p>
        <p class="admin-usuario__parrafo">
        $ <?php echo empty(s($requerimiento->primer_pago)) ? '...' : s($requerimiento->primer_pago); ?>
        </p>

        <p class="admin-usuario__parrafo--negritas">
            Pago final:
        </p>
        <p class="admin-usuario__parrafo">
        $ <?php echo empty(s($requerimiento->final_pago)) ? '...' : s($requerimiento->final_pago); ?>
        </p>

        <p class="admin-usuario__parrafo--negritas">
            Pagos extras:
        </p>
        <p class="admin-usuario__parrafo">
        $ <?php echo (s($requerimiento->extras) == -1.00) ? '...' : (empty(s($requerimiento->extras)) ? '...' : s($requerimiento->extras)); ?>
        </p>

        <p class="admin-usuario__parrafo--negritas">
            Fecha del requerimiento:
        </p>
        <p class="admin-usuario__parrafo">
        <?php echo empty(s($requerimiento->fecha)) ? 'No hay fecha' : s($requerimiento->fecha); ?>
        </p>

        <p class="admin-usuario__parrafo--negritas">
            ID Primer pago:
        </p>
        <p class="admin-usuario__parrafo">
        <?php echo empty(s($requerimiento->pago_id_pri)) ? 'No hay ID de PayPal' : s($requerimiento->pago_id_pri); ?>
        </p>

        <p class="admin-usuario__parrafo--negritas">
            ID Pago final:
        </p>
        <p class "admin-usuario__parrafo">
        <?php echo empty(s($requerimiento->pago_id_fin)) ? 'No hay ID de PayPal' : s($requerimiento->pago_id_fin); ?>
        </p>

        <p class="admin-usuario__parrafo--negritas">
            ID Pago extra:
        </p>
        <p class="admin-usuario__parrafo">
        <?php echo empty($requerimiento->pago_id_ex) ? 'No hay ID de PayPal' : $requerimiento->pago_id_ex; ?>
        </p>


        <a href="/admin/usuario/requerimiento?id=<?php echo s($usuario->id); ?>" class="admin-usuario__boton--naranja">
        Complementar requerimientos
        <i class="bi bi-arrow-right"></i>
        </a>



        <!-- <a href="/admin/usuario/requerimiento?id=<?php echo $usuario->id; ?>" class="admin-usuario__boton--naranja">
        Complementar requerimientos
        <i class="bi bi-arrow-right"></i>
        </a> -->

        <form method="POST">
            <input type="hidden" name="id" value="<?php echo $usuario->id; ?>">
            <button type="submit" class="admin-usuario__boton--rojo">
                Resetear usuario
                <i class="bi bi-arrow-right"></i>
            </button>
        </form>


    </div>

</main>