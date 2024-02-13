<main class="portafolio-inicio portafolio-inicio__cabecera">
    <div class="portafolio-inicio__contenedor">
        <div class="portafolio-inicio__parte-1">
            <h1 class="portafolio-inicio__titulo">
                Nuestro
                <span class="portafolio-inicio__titulo--resaltar">
                    portafolio
                </span>
            </h1>
            <?php require_once __DIR__ . '/../templates/redes-sociales.php';?>
        </div>

        <div class="portafolio-inicio__parte-2">
        <p class="portafolio-inicio__parrafo-inicial">
            Descubre nuestros sitios web destacados con <span class="portafolio-inicio__parrafo-inicial--negritas">diseños atractivos</span> y <span class="portafolio-inicio__parrafo-inicial--negritas">funcionalidades excepcionales</span>. <span class="portafolio-inicio__parrafo-inicial--negritas">Potenciamos tu presencia en línea</span> para impulsar tu éxito digital. Encuentra la <span class="portafolio-inicio__parrafo-inicial--negritas">solución perfecta</span> en nuestro portafolio.
        </p>



        </div>
    </div>
</main>

<section class="trabajos trabajos__seccion">
    <div class="trabajos__contenedor">
        <h2 class="trabajos__titulo">
            Trabajos
            <span class="trabajos__titulo--resaltar">
                realizados
            </span>
        </h2>

        <div class="trabajos__grid">
            <?php if (!empty($portafolio)): ?>
                <?php foreach ($portafolio as $item): ?>
                    <div class="trabajos__sitio-web">
                        <picture>
                            <source type="image/webp" srcset="/build/img/portafolios/<?= $item->imagen ?>.webp">
                            <img loading="lazy" src="/build/img/portafolios/<?= $item->imagen ?>.jpg" width="300" height="200" alt="<?= $item->nombre ?>" class="trabajos__imagen">
                        </picture>
                        <div class="trabajos__contenido">
                            <h3 class="trabajos__nombre">
                                <?= $item->nombre ?>
                            </h3>
                            <p class="trabajos__parrafo">
                                <?= $item->descripcion ?>
                            </p>
                            <a href="<?= $item->url ?>" class="trabajos__boton--naranja">
                                Ver sitio web
                                <i class="bi bi-arrow-right"></i>
                            </a>
                        </div>
                    </div><!-- Fin de sitio web -->
                <?php endforeach; ?>
            <?php endif; ?>

        </div>

    </div>
</section>