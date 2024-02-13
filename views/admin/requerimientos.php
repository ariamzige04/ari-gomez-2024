<main class="admin admin__seccion--principal">
    <div class="admin__contenedor-chico">
        <h1 class="admin__titulo">
            Requerimientos
        </h1>
        <!-- <p class="admin__parrafo">
        Aquí aparecerá las personas que se registraron dependiendo la fecha.
        </p> -->

        <div class="admin__filtros">
            <div class="admin__buscar">
                <i class="bi bi-search"></i>
                <input type="text" placeholder="Buscar">
            </div>


            <!-- <div class="admin__fecha">
                <input type="date" value="<?php echo date('Y-m-d'); ?>">
                <button class="admin__fecha--boton">
                    Filtrar
                </button>
            </div>

            <button class="admin__filtrar-todos">
                Todos
            </button> -->

            <!-- botones para filtrar -->
            <!-- <div class=""> -->
                <form method="post" action="/admin/requerimientos" class="admin__fecha">
                    <!-- <label for="fecha">Filtrar por fecha:</label> -->
                    <input type="date" id="fecha" name="fecha" value="<?php echo isset($_POST['fecha']) ? $_POST['fecha'] : date('Y-m-d'); ?>" max="<?php echo date('Y-m-d'); ?>">

                    <button class="admin__fecha--boton" type="submit" name="filtro_fecha">
                        Filtrar
                    </button>
                </form>
            <!-- </div> -->

            <form method="post" action="/admin/requerimientos">
                <button type="submit" class="admin__filtrar-todos" name="filtro_todos">
                    Todos
                </button>
            </form>
            <!-- fin de botones -->

        </div>

    </div>

</main>


<section class="admin__usuarios admin__usuarios__seccion">
    <div class="admin__contenedor-tabla admin__contenedor">
        <table class="admin__tabla">
            <thead class="admin__thead">
                <tr class="admin__tr">
                    <th class="admin__th">ID</th>
                    <th class="admin__th">Nombre</th>
                    <th class="admin__th">Titulo</th>
                    <th class="admin__th">#1 Pago</th>
                    <th class="admin__th">#2 Pago</th>
                    <th class="admin__th">Extras</th>
                    <th class="admin__th">Total</th>
                    <th class="admin__th">Fecha</th>
                    <th class="admin__th">Ver</th>
                </tr>
            </thead>

            <tbody class="admin__tbody">
                <?php if (empty($requerimientos)): ?>
                    <tr class="admin__tr">
                        <td class="admin__td" colspan="7">No hay requerimientos para esta fecha.</td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($requerimientos as $requerimiento): ?>
                        <tr class="admin__tr">
                            <td class="admin__td"><?= $requerimiento->id; ?></td>
                            <td class="admin__td"><?= $requerimiento->nombre_usuario; ?></td>
                            <td class="admin__td"><?= $requerimiento->titulo; ?></td>
                            <td class="admin__td">$ <?= number_format($requerimiento->primer_pago, 2, '.', ','); ?></td>
                            <td class="admin__td">$ <?= number_format($requerimiento->final_pago, 2, '.', ','); ?></td>
                            <td class="admin__td">
                                <?php if ($requerimiento->extras <= -1): ?>
                                    No
                                <?php else: ?>
                                    $<?= abs($requerimiento->extras); ?>
                                <?php endif; ?>
                            </td>

                            <td class="admin__td">$ <?= number_format($requerimiento->primer_pago + $requerimiento->final_pago, 2, '.', ','); ?></td>
                            <td class="admin__td"><?= $requerimiento->fecha; ?></td>

                            <td class="admin__td">
                                <a href="/admin/usuario?id=<?= $requerimiento->id_usuarios; ?>" class="admin__ver">
                                    <i class="bi bi-eye-fill"></i>
                                    Ver más
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>

            </tbody>
        </table>
    </div>
</section>
