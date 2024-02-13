(function(){

    const botonRegistroNavegacion = document.querySelector('.navegacion-registro__boton');
    if (botonRegistroNavegacion) {
        
        botonRegistroNavegacion.addEventListener('click', function(event) {
            const navegacionRegistro = document.querySelector('.navegacion-registro');
            navegacionRegistro.classList.toggle('navegacion-registro--mostrar');
            event.stopPropagation(); // Evita que el clic se propague al documento.
        });

    }

    // Agregar event listener para el documento
    document.addEventListener('click', function(event) {
        const navegacionRegistro = document.querySelector('.navegacion-registro');
        const target = event.target;

        // Verificar si el clic fue fuera del elemento .navegacion-registro
        if (navegacionRegistro && !navegacionRegistro.contains(target)) {
            navegacionRegistro.classList.remove('navegacion-registro--mostrar');
        }
    });

})();
