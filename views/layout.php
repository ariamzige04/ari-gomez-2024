<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $titulo ?? '';?> | AriWeb</title>

    <meta name="description" content="<?php echo $description ?? '';?>">
    <meta name="keywords" content="<?php echo $keywords ?? '';?>">

    <link rel="icon" href="/build/img/icono-ariweb.svg" type="image/x-icon">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Mulish:wght@400;700;800&family=Open+Sans:wght@800&display=swap" rel="stylesheet">
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css"  /> -->
    <!-- <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet"> -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.9.0/dist/sweetalert2.min.css">
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css"> -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="/build/css/app.css">
    <!-- <link rel="stylesheet" href="https://unpkg.com/leaflet@1.8.0/dist/leaflet.css" /> -->
    <!-- <script src="https://unpkg.com/leaflet@1.8.0/dist/leaflet.js" defer></script> -->

    <meta name="google-site-verification" content="V49P4vXRz-_W9K2ev-fJJVLBs8eJ4iN6CYgJv4xRfs4" />

    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-S73TS1Y08W"></script>
    <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'G-S73TS1Y08W');
    </script>

</head>
<body>


    <?php 
        include_once __DIR__ .'/templates/header.php';


        if(!is_admin()) {
            if(is_auth()) {//si esta autenticado y no es admin se muestra
                include_once __DIR__ .'/templates/navegacion-registro.php';
            }
        }

        if(is_admin()) {
            include_once __DIR__ .'/templates/navegacion-admin.php';
        }
        echo $contenido;
        include_once __DIR__ .'/templates/footer.php'; 
    ?>



    <!-- <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({
            once: true//esto hace que solo se dispare una vez las animaciones
        });
    </script> -->

    <!-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> -->
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js" integrity="sha512-ElRFoEQdI5Ht6kZvyzXhYG9NqjtkmlkfYk0wr6wHxU9JEHakS7UJZNeml5ALk+8IKlU6jDgMabC3vkumRokgJA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script> -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.9.0/dist/sweetalert2.all.min.js"></script>
    <script src="/build/js/main.min.js" defer></script>
    <?php echo $script ?? ''; ?>

</body>
</html>