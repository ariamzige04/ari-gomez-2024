<main class="admin-usuario admin-usuario__seccion--principal">
    <div class="admin-usuario__contenedor-chico">
        <h1 class="admin-usuario__titulo">
        Complementar requerimientos
        </h1>

        <?php 
            include_once __DIR__ . '../../templates/alertas.php';
        ?>
        
        <form method="POST" >
            <div class="formulario__campo">
                <label for="titulo" class="formulario__label">
                    Titulo
                </label>
                <input 
                id="titulo"
                name="titulo"
                type="text" 
                class="formulario__input"
                placeholder="Ingrese el titulo"
                value="<?php echo s($requerimiento->titulo) ?? ''; ?>"
                >
            </div>

            <div class="formulario__campo">
                <label for="requerimientos" class="formulario__label">
                Ingresar requerimientos
                </label>
                <textarea 
                id="requerimientos" 
                name="requerimientos" 
                class="formulario__input"
                placeholder="Ingrese el titulo" 
                cols="30" 
                rows="10"
                ><?php echo s($requerimiento->requerimientos) ?? ''; ?></textarea>
            </div>

            <legend class="formulario__legend">
                Pago
            </legend>
            <div class="formulario__campo">
                <label for="primer_pago" class="formulario__label">
                    Ingrese primer pago
                </label>
                <input 
                id="primer_pago"
                name="primer_pago"
                type="number" 
                class="formulario__input"
                placeholder="Ingrese el primer pago "
                value="<?php echo s($requerimiento->primer_pago) ?? ''; ?>"

                >
            </div>

            <div class="formulario__campo">
                <label for="final_pago" class="formulario__label">
                    Ingrese primer pago
                </label>
                <input 
                id="final_pago"
                name="final_pago"
                type="number" 
                class="formulario__input"
                placeholder="Ingrese el pago final "
                value="<?php echo s($requerimiento->final_pago) ?? ''; ?>"
                >
            </div>

            <legend class="formulario__legend">
                Extras
            </legend>
            <div class="formulario__campo">
                <label for="extras" class="formulario__label formulario__label--no-obligatorio">
                    Ingrese pago extra
                </label>
                <input 
                id="extras"
                name="extras"
                type="number" 
                class="formulario__input"
                placeholder="Ingrese el pago extra "
                value="<?php echo ($requerimiento->extras == -1.00) ? '' : $requerimiento->extras; ?>"
                >
            </div>

            <!-- <input type="submit" value="Enviar" class="formulario__boton--naranja"> -->

            <button type="submit" class="formulario__boton--naranja">
                Guardar requerimientos
                <i class="bi bi-arrow-right"></i>
            </button>
        </form>

    </div>
</main>