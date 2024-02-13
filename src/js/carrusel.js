document.addEventListener('DOMContentLoaded', function() {
  const portafolioSitiosWeb = document.querySelector('.portafolio__sitios-web');

  if (portafolioSitiosWeb) {
    let swiper = new Swiper(portafolioSitiosWeb, {
      slidesPerView: 1, // Muestra 1 slide en dispositivos móviles
      breakpoints: {
        768: {
          slidesPerView: 2, // Muestra 2 slides en dispositivos más grandes (a partir de 768px de ancho)
        }
      },
      spaceBetween: 20,
      navigation: false, // Desactivar flechas de navegación
      pagination: false, // Desactivar paginación
      autoplay: {
        delay: 2500,
        disableOnInteraction: false,
      },
    });
  }
});
