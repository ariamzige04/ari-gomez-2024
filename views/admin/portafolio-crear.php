<main class="admin admin__seccion--principal">
    <div class="admin__contenedor-chico">
        <h1 class="admin__titulo">
            Portafolio
        </h1>




        <form method="POST" action="/admin/portafolio/crear" class="formulario" enctype="multipart/form-data" autocomplete="off">
            <?php include_once __DIR__ . '../../templates/formulario-portafolio.php'; ?>

            <input class="formulario__boton--naranja" type="submit" value="Subir Sitio Web">
        </form>
    </div>

</main>