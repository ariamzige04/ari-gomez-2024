(function(){

    const menuToggle = document.getElementById('menu-toggle');

    menuToggle.addEventListener('click', function() {
      this.classList.toggle('open');
      
      const navegacionEnlaces = document.querySelector('.navegacion__ordenar');
      navegacionEnlaces.classList.toggle('navegacion__mostrar');

      document.body.classList.toggle('overflow-hidden');

      const navegacion = document.querySelector('.navegacion');
      if (!navegacion.classList.contains('navegacion__color-fondo')) {
        navegacion.classList.add('navegacion__color-fondo');
      } 
    
    });


    
    // Verificar si estamos en la página de inicio
    if (window.location.pathname === '/') {
      let isScrollingDown = false; // Variable de control para la dirección del scroll

      function handleScroll() {
        const navegacion = document.querySelector('.navegacion');
        const limiteScroll = 0; // Límite de scroll en píxeles

        if (window.scrollY > limiteScroll) {
          if (!isScrollingDown) {
            isScrollingDown = true;
            navegacion.classList.add('navegacion__color-fondo');
            navegacion.style.backgroundColor = ''; // Elimina el fondo transparente
          }
        } else {
          if (isScrollingDown) {
            isScrollingDown = false;
            navegacion.classList.remove('navegacion__color-fondo');
            navegacion.style.backgroundColor = 'transparent'; // Aplica fondo transparente
          }
        }
      }

      // Función para limitar la frecuencia de ejecución de una función
      function debounce(func, wait) {
        let timeout; // Almacena el identificador del timeout

        // Retorna una función que se ejecutará después de esperar un tiempo determinado
        return function() {
          const context = this; // Guarda el contexto de ejecución
          const args = arguments; // Guarda los argumentos de la función

          const later = function() {
            timeout = null; // Reinicia el identificador del timeout
            func.apply(context, args); // Ejecuta la función original con el contexto y los argumentos guardados
          };

          clearTimeout(timeout); // Cancela el timeout existente
          timeout = setTimeout(later, wait); // Crea un nuevo timeout
        };
      }

      window.addEventListener('scroll', debounce(handleScroll, 100));

      handleScroll(); // Ejecutar la función al cargar la página inicialmente
    } else {
      const navegacion = document.querySelector('.navegacion');
      navegacion.classList.add('navegacion__color-fondo');
      navegacion.style.backgroundColor = ''; // Elimina el fondo transparente en otras páginas
    }


    
})();