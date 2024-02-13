<main class="admin admin__seccion--principal">
    <div class="admin__contenedor-chico">
        <h1 class="admin__titulo">
            Panel de Administración
        </h1>
        <p class="admin__parrafo">
        Aquí aparecerá las personas que se registraron dependiendo la fecha.
        </p>

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
                <form method="post" action="/admin/dashboard" class="admin__fecha">
                    <!-- <label for="fecha">Filtrar por fecha:</label> -->
                    <input type="date" id="fecha" name="fecha" value="<?php echo isset($_POST['fecha']) ? $_POST['fecha'] : date('Y-m-d'); ?>" max="<?php echo date('Y-m-d'); ?>">

                    <button class="admin__fecha--boton" type="submit" name="filtro_fecha">
                        Filtrar
                    </button>
                </form>
            <!-- </div> -->

            <form method="post" action="/admin/dashboard">
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
                    <th class="admin__th">Correo</th>
                    <th class="admin__th">Teléfono</th>
                    <th class="admin__th">Confirmado</th>
                    <th class="admin__th">Registrado</th>
                    <th class="admin__th">Acción</th>
                </tr>
            </thead>

            <tbody class="admin__tbody">
                <?php if (empty($usuarios)): ?>
                    <tr class="admin__tr">
                        <td class="admin__td" colspan="7">No hay usuarios registrados.</td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($usuarios as $usuario): ?>
                        <tr class="admin__tr">
                            <td class="admin__td"><?= $usuario->id; ?></td>
                            <td class="admin__td"><?= $usuario->nombre; ?></td>
                            <td class="admin__td"><?= $usuario->email; ?></td>
                            <td class="admin__td"><?= $usuario->telefono; ?></td>
                            <td class="admin__td"><?= $usuario->confirmado == '1' ? '<i class="bi bi-check2 admin__icono admin__icono--correcto"></i>' : '<i class="bi bi-x-lg admin__icono admin__icono--error"></i>'; ?></td>
                            <td class="admin__td"><?= $usuario->registrado; ?></td>
                            <td class="admin__td">
                                <a href="/admin/usuario?id=<?= $usuario->id; ?>" class="admin__ver">
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
