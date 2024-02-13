document.addEventListener("DOMContentLoaded", function() {
    // Obtener referencias a los botones
    const btnLogin = document.getElementById("btn-login");
    const btnRegistrar = document.getElementById("btn-registrar");
  
    if (btnLogin) {
      btnLogin.addEventListener("click", function(event) {
        event.preventDefault(); // Evitar la redirección inmediata
        localStorage.setItem("modo", "iniciar_sesion");
        console.log('localStorage iniciar sesion');
  
        setTimeout(function() {
          const href = event.target.getAttribute('href');
        //   console.log(href);
          window.location.href = href; // Redireccionar después de la demora
        }, 500);
      });
    }
  
    if (btnRegistrar) {
      btnRegistrar.addEventListener("click", function(event) {
        event.preventDefault(); // Evitar la redirección inmediata
        localStorage.setItem("modo", "registrarse");
        // console.log('localStorage registrarse');
        const href = event.target.getAttribute('href');
        // console.log(href);
        setTimeout(function() {
          window.location.href = href; // Redireccionar después de la demora
        }, 500);
      });
    }
  });
  