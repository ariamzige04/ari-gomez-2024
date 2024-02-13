<main class="inicio">
    <div class="inicio__contenedor">
        <div class="inicio__contenido">
            <h1 class="inicio__titulo">
                Expande tu presencia en línea con un 
                <span class="inicio__titulo--resaltar">
                    sitio web
                </span>
            </h1>
            <!-- Trabajamos en estrecha colaboración contigo para diseñar un sitio web que refleje la personalidad de tu marca y atraiga  a tu público objetivo.  -->
            <p class="inicio__parrafo">
            Desde la <span class="inicio__parrafo--negritas">creación de un sitio web desde cero</span> hasta la <span class="inicio__parrafo--negritas">renovación de un sitio existente</span>, estamos aquí para ayudarte a <span class="inicio__parrafo--negritas">alcanzar tus objetivos en línea</span>.
            </p>
            <a href="/contactanos" class="inicio__boton--morado">
                ¡Comienza ahora!
                <i class="bi bi-arrow-right"></i>
            </a>
        </div>

        <?php require_once __DIR__ . '/../templates/redes-sociales.php';?>

        <!-- Imagen de persona -->
        <div class="inicio__imagen-contenedor">
            <picture>
                <source media="(min-width: 768px)" type="image/avif" srcset="/build/img/persona 1.avif">
                <source media="(min-width: 768px)" type="image/webp" srcset="/build/img/persona 1.webp">
                <img loading="lazy" src="/build/img/persona 1.png" alt="Persona feliz por tener un sitio web">
            </picture>
        </div>
    </div>

</main>


<!-- servicios que te ayudaran -->
<section class="servicios servicios__seccion">
    <div class="servicios__contenedor">
        <h2 class="servicios__titulo">
            <span class="servicios__titulo--resaltar">
                Servicios
            </span> que te ayudaran
        </h2>

        <div class="servicios__sitios-web">

            <!-- opcion 1 -->
            <div class="servicios__opcion">
                <p class="servicios__numero">1</p>
                <div class="servicios__contenido"><!-- contenido del sitio web -->
                    <h3 class="servicios__nombre">Landing Page</h3>
                    <ul class="servicios__caracteristicas">
                        <li class="servicios__descripcion">Diseño personalizado</li>
                        <li class="servicios__descripcion">Mensaje claro y conciso</li>
                        <li class="servicios__descripcion">Diseño optimizado para todo tipo de dispositivos</li>
                        <li class="servicios__descripcion">Formulario de contacto</li>
                        <li class="servicios__descripcion">Optimización para una carga rápida</li>
                    </ul>
                    <a href="/contactanos" class="servicios__boton--naranja">
                        ¡Quiero este!
                        <i class="bi bi-arrow-right"></i>
                    </a>
                </div>
            </div>

            <!-- opcion 2 -->
            <div class="servicios__opcion">
                <p class="servicios__numero">2</p>
                <div class="servicios__contenido"><!-- contenido del sitio web -->
                    <h3 class="servicios__nombre">Sitio web completo</h3>
                    <ul class="servicios__caracteristicas">
                        <li class="servicios__descripcion servicios__descripcion--modificador">Todos los servicios de la opción 1</li>
                        <li class="servicios__descripcion">Integración de Google Maps</li>
                        <li class="servicios__descripcion">Optimización para motores de búsqueda (SEO)</li>
                        <li class="servicios__descripcion">Incorporación de Google Analytics</li>
                        <li class="servicios__descripcion">Ajuste de Google Search Console</li>
                    </ul>
                    <a href="/contactanos" class="servicios__boton--naranja">
                        ¡Quiero este!
                        <i class="bi bi-arrow-right"></i>
                    </a>
                </div>
            </div>

            <!-- opcion 3 -->
            <div class="servicios__opcion">
                <p class="servicios__numero">3</p>
                <div class="servicios__contenido"><!-- contenido del sitio web -->
                    <h3 class="servicios__nombre">Tienda en línea</h3>
                    <ul class="servicios__caracteristicas">
                        <li class="servicios__descripcion servicios__descripcion--modificador">Todos los servicios de la opción 2</li>
                        <li class="servicios__descripcion">Catálogo de productos organizados</li>
                        <li class="servicios__descripcion">Panel de administración</li>
                        <li class="servicios__descripcion">Integración de PayPal</li>
                    </ul>
                    <a href="/contactanos" class="servicios__boton--naranja">
                        ¡Quiero este!
                        <i class="bi bi-arrow-right"></i>
                    </a>
                </div>
            </div>

        </div>
    </div>
    
</section>


<section class="portafolio">
    <div class="portafolio__contenedor">
        <div class="portafolio__contenido">
            <h2 class="portafolio__titulo">
               <span class="portafolio__titulo--resaltar"> Trabajos</span> exitosos
            </h2>
            <p class="portafolio__parrafo">
            En nuestro <span class="portafolio__parrafo--negritas"> portafolio</span> podrás encontrar una <span class="portafolio__parrafo--negritas">muestra de nuestro trabajo </span> y el <span class="portafolio__parrafo--negritas">enfoque </span> que le damos a <span class="portafolio__parrafo--negritas">cada proyecto</span>. Cada <span class="portafolio__parrafo--negritas">diseño es único</span> y esta <span class="portafolio__parrafo--negritas">hecho a medida</span> según las <span class="portafolio__parrafo--negritas">necesidades</span> y <span class="portafolio__parrafo--negritas">objetivos</span> de cada cliente.
            </p>
            <a class="portafolio__boton--morado" href="/nuestro-portafolio">
                Explorar portafolio
                <i class="bi bi-arrow-right"></i>
            </a>
        </div>

        <!-- swiper de nuestro portafolio -->
        <div class="swiper-container portafolio__sitios-web">
            <div class="swiper-wrapper">

            <?php if (!empty($portafolio)): ?>
                <?php foreach ($portafolio as $item): ?>
                    <div class="swiper-slide">
                        <picture>
                            <source type="image/webp" srcset="/build/img/portafolios/<?= $item->imagen ?>.webp">
                            <img loading="lazy" src="/build/img/portafolios/<?= $item->imagen ?>.png" alt="<?= $item->nombre ?>">
                        </picture>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>


            </div>

            <!-- <div class="swiper-pagination"></div>
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div> -->
        </div>


    </div><!-- contenedor -->
</section>


<section class="testimoniales">
    <div class="testimoniales__contenedor">
        <div class="testimoniales__contenido">
            <i class="bi bi-quote testimoniales__quote"></i><i class="bi bi-quote testimoniales__quote"></i>
            <div class="testimoniales__textos">
                <h2 class="testimoniales__titulo">
                    <span class="testimoniales__titulo--resaltar">
                        Historias
                    </span>
                    destacadas
                </h2>
                <p class="testimoniales__parrafo">
                    Nuestros clientes han logrado <span class="testimoniales__parrafo--negritas">grandes resultados</span> gracias a su <span class="testimoniales__parrafo--negritas">nuevo sitio web</span>. Descubre <span class="testimoniales__parrafo--negritas">cómo hemos superado</span> sus <span class="testimoniales__parrafo--negritas">expectativas</span>.
                </p>
            </div>
        </div>

        <div class="testimoniales__grid">
        <blockquote class="testimoniales__personas">
            <cite class="testimoniales__cita">
                <h3 class="testimoniales__nombre">
                    Martin Gomez
                </h3>
                <p class="testimoniales__empresa">
                    Ecutronic C. A.
                </p>
            </cite>
            <p class="testimoniales__historia">
            Nuestra colaboración con este equipo web fue excepcional. Desarrollaron una tienda en línea de calidad en tiempo récord. Su profesionalismo y eficiencia nos dejaron impresionados. ¡Los recomiendo encarecidamente!
            </p>
        </blockquote>
        <blockquote class="testimoniales__personas">
            <cite class="testimoniales__cita">
                <h3 class="testimoniales__nombre">
                    María Rodríguez
                </h3>
                <p class="testimoniales__empresa">
                    DigitalPeak
                </p>
            </cite>
            <p class="testimoniales__historia">
                Experiencia sobresaliente con este equipo de desarrollo web. La landing page que diseñaron fue impactante, elevando nuestra presencia online. Su enfoque único es incomparable y marcó la diferencia.
            </p>
        </blockquote>
        <blockquote class="testimoniales__personas">
            <cite class="testimoniales__cita">
                <h3 class="testimoniales__nombre">
                    Laura Pérez
                </h3>
                <p class="testimoniales__empresa">
                    QuantumForge 
                </p>
            </cite>
            <p class="testimoniales__historia">
            El trabajo en nuestro sitio web fue increíble. Cumplieron meticulosamente con cada detalle, desde el diseño hasta la funcionalidad. Su compromiso con la excelencia y la rapidez nos dejó verdaderamente impresionados.
            </p>
        </blockquote>

        </div>
    </div>
</section>


<section class="preguntas">
    <div class="preguntas__contenedor">
        <h2 class="preguntas__titulos">
            <span class="preguntas__titulos--resaltar">
                Preguntas
            </span>
            frecuentes
        </h2>

        <div class="preguntas__frecuentes">

            <div class="preguntas__acordeon">
                <div class="preguntas__vista">
                    <h3 class="preguntas__duda">
                        ¿Cuánto tiempo tarda en crearse mi sitio web?
                    </h3>
                    <div class="preguntas__icono">
                        <span class="preguntas__linea"></span>
                        <span class="preguntas__linea"></span>
                    </div>
                </div>
                <div class="preguntas__altura">
                    <p class="preguntas__respuesta"><!--aqui es donde se modifica la altura-->
                    El tiempo de creación de un sitio web depende del tipo de proyecto que tengas en mente. En general, una landing page puede tardar entre 1 a 2 semanas, mientras que un sitio web completo puede tardar entre 2 a 4 semanas. Una tienda en línea puede tomar entre 4 a 6 semanas. Sin embargo, todo depende de la complejidad del proyecto y la rapidez con la que recibamos la información necesaria.
                    </p>
                </div>
                
            </div>

            <div class="preguntas__acordeon">
                <div class="preguntas__vista">
                    <h3 class="preguntas__duda">
                        ¿Cuál es el proceso de trabajo que siguen?
                    </h3>
                    <div class="preguntas__icono">
                        <span class="preguntas__linea"></span>
                        <span class="preguntas__linea"></span>
                    </div>
                </div>
                <div class="preguntas__altura">
                    <p class="preguntas__respuesta">
                    El proceso de trabajo que seguimos incluye una reunión inicial ya sea por videollamada o por teléfono para entender tus necesidades y objetivos, una fase de investigación y planificación, el diseño y desarrollo del sitio web y una fase de pruebas y correcciones. Además, te mantendremos informado en todo momento sobre el progreso del proyecto.
                    </p>
                </div>
                
            </div>

            <div class="preguntas__acordeon">
                <div class="preguntas__vista">
                    <h3 class="preguntas__duda">
                        ¿Ofrecen servicios de hosting y dominio?
                    </h3>
                    <div class="preguntas__icono">
                        <span class="preguntas__linea"></span>
                        <span class="preguntas__linea"></span>
                    </div>
                </div>
                <div class="preguntas__altura">
                    <p class="preguntas__respuesta">
                    Sí, ofrecemos servicios de hosting y dominio a un precio competitivo. También podemos ayudarte a transferir un dominio existente si ya lo tienes.
                    </p>
                </div>
                
            </div>

            <div class="preguntas__acordeon">
                <div class="preguntas__vista">
                    <h3 class="preguntas__duda">
                        ¿Cómo puedo actualizar mi sitio web después de que este creado?
                    </h3>
                    <div class="preguntas__icono">
                        <span class="preguntas__linea"></span>
                        <span class="preguntas__linea"></span>
                    </div>
                </div>
                <div class="preguntas__altura">
                    <p class="preguntas__respuesta">
                    Ofrecemos servicios de mantenimiento y actualización de sitios web a un precio adicional. Si deseas actualizar tu sitio web, simplemente contáctanos y te proporcionaremos un presupuesto.
                    </p>
                </div>
                
            </div>

            <div class="preguntas__acordeon">
                <div class="preguntas__vista">
                    <h3 class="preguntas__duda">
                        ¿Qué pasa si no estoy satisfecho con el resultado final?
                    </h3>
                    <div class="preguntas__icono">
                        <span class="preguntas__linea"></span>
                        <span class="preguntas__linea"></span>
                    </div>
                </div>
                <div class="preguntas__altura">
                    <p class="preguntas__respuesta">
                    Siempre trabajamos en estrecha colaboración con nuestros clientes para garantizar su satisfacción con el resultado final. Si por alguna razón no estás satisfecho con el resultado final, haremos todo lo posible para solucionarlo y asegurarnos de que estés completamente satisfecho con nuestro trabajo.
                    </p>
                </div>
                
            </div>

        </div>

    </div>

</section>


<!-- Formulario de contacto -->
<?php require_once __DIR__ . '/../templates/formulario-contacto.php';?>
<!-- Fin de Formulario de contacto -->
