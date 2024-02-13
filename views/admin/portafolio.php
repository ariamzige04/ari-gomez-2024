<main class="admin admin__seccion--principal">
    <div class="admin__contenedor-tabla admin__contenedor-chico">
        <h1 class="admin__titulo">
            Portafolio
        </h1>
        <a href="/admin/portafolio/crear" class="admin__boton--naranja">
            Añadir sitio web
            <i class="bi bi-arrow-right"></i>
        </a>

        
    </div>


</main>


<section class="admin admin__seccion">
    <div class="admin__contenedor-tabla admin__contenedor">
        <table class="admin__tabla">
            <thead class="admin__thead">
                <tr class="admin__tr">
                    <th class="admin__th">ID</th>
                    <th class="admin__th">Imagen</th>
                    <th class="admin__th">Titulo</th>
                    <th class="admin__th">Dominio</th>
                    <th class="admin__th">Cliente</th>
                    <th class="admin__th">Acciones</th>
                </tr>
            </thead>

            <tbody class="admin__tbody">
                <?php if (empty($portafolio)): ?>
                    <tr class="admin__tr">
                        <td class="admin__td" colspan="5">No hay sitios web agregados.</td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($portafolio as $web): ?>
                        <tr class="admin__tr">
                            <td class="admin__td"><?= $web->id; ?></td>
                            <td class="admin__td admin__td--imagen">
                            <picture>
                                <source srcset="<?php echo '/build/img/portafolios/' . $web->imagen; ?>.webp" type="image/webp">
                                <source srcset="<?php echo '/build/img/portafolios/' . $web->imagen; ?>.jpg" type="image/jpg">
                                <img class="formulario__imagen" loading="lazy" src="<?php echo '/build/img/portafolios/' . $web->imagen; ?>.jpg" alt="Imagen portafolio">
                            </picture>
                            </td>
                            <td class="admin__td admin__td--titulo"><?= $web->nombre; ?></td>
                            <td class="admin__td admin__td--enlace">
                                <a href="<?= $web->url; ?>" target="_blank" rel="noopener noreferrer"><?= $web->url; ?></a>
                            </td>
                            <!-- <td class="admin__td"></td> -->
                            <td class="admin__td admin__td--enlace">
                                <?php
                                $usuario_id = $web->id_usuario;
                                $nombre_usuario = array_reduce($usuarios, function ($carry, $usuario) use ($usuario_id) {
                                    return ($usuario->id == $usuario_id) ? $usuario->nombre : $carry;
                                }, '');
                                ?>
                                <a href="/admin/usuario?id=<?= $usuario_id ?>">
                                    ID: <?= $usuario_id ?>
                                    <?= $nombre_usuario ?>
                                </a>
                            </td>


                            <td class="admin__td admin__td--acciones">
                                <a href="/admin/portafolio/editar?id=<?= $web->id; ?>" class="admin__ver">
                                    <i class="bi bi-eye-fill"></i>
                                    Editar
                                </a>
                                <form method="POST" action="/admin/portafolio/eliminar" class="">
                                    <input type="hidden" name="id" value="<?php echo $web->id;?>">
                                    <button class="admin__ver admin__ver--eliminar" type="submit">
                                        <i class="bi bi-trash-fill"></i>
                                        Eliminar
                                    </button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>

            </tbody>
        </table>
    </div>
</section>