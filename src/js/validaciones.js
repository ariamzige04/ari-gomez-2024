document.addEventListener("DOMContentLoaded", function() {
  const formulario = document.getElementById("formulario");
  if (formulario) {
    // Obtener referencias a los elementos del formulario
    const nombreInput = document.getElementById("nombre");
    const telefonoInput = document.getElementById("telefono");
    const correoInput = document.getElementById("correo");
    const contrasenaInput = document.getElementById("password");
    const descripcionInput = document.getElementById("descripcion");
    const terminosCheckbox = document.getElementById("terminos");

    // Obtener referencias a otros elementos del DOM
    const tituloAcciones = document.querySelector(".contacto__titulo-acciones");
    const botonEnlace = document.querySelector(".contacto__enlace");
    const camposFormulario = Array.from(document.querySelectorAll(".formulario__campo"));
    const camposIniciarSesion = camposFormulario.slice(2, 4); // Campos a mostrar al iniciar sesión
    const campoDescripcion = document.querySelector(".formulario__campo:nth-child(5)"); // Campo de descripción
    const camposTerminos = document.querySelector(".formulario__terminos");
    let camposRegistrarse = camposFormulario.slice(0, 2); // Almacena los campos del formulario originalmente
    // Obtener referencia al input oculto de acción
    const accionInput = document.getElementById("accion");

    function cambiarModoRegistro() {
      tituloAcciones.textContent = "Registrarse";
      botonEnlace.textContent = "¿Ya tienes cuenta? Iniciar sesión";
      mostrarCamposRegistrarse();
      actualizarTextoBoton("Crear cuenta");
      mostrarCampos(camposFormulario);
      accionInput.value = "registrarse"; // Cambiar el valor del input a "registrarse"

      const enlaceOlvide = document.querySelector(".formulario__enlace-olvide");
      if (enlaceOlvide) {
        enlaceOlvide.remove();
      }

    }
    
    function cambiarModoInicioSesion() {
      tituloAcciones.textContent = "Iniciar sesión";
      botonEnlace.textContent = "¿No tienes cuenta? Registrarse";
      mostrarCamposIniciarSesion();
      actualizarTextoBoton("Iniciar sesión");
      ocultarCampos([campoDescripcion, camposTerminos]);
      accionInput.value = "iniciar_sesion"; // Cambiar el valor del input a "iniciar_sesion"

      const enlaceOlvide = document.createElement("a");
      enlaceOlvide.setAttribute("href", "/olvide");
      enlaceOlvide.classList.add("formulario__enlace-olvide");
      enlaceOlvide.textContent = "¿Olvidaste tu contraseña?";
      const campoContrasena = document.querySelector("#password").closest(".formulario__campo");
      campoContrasena.insertAdjacentElement("afterend", enlaceOlvide);


    }
    
    function guardarModoEnLocalStorage(modo) {
      localStorage.setItem("modo", modo); // Guardar en localStorage
    }
    
    function botonEnlaceClickHandler() {
      const modoGuardado = localStorage.getItem("modo");
    
      if (modoGuardado === "iniciar_sesion") {
        cambiarModoRegistro();
        guardarModoEnLocalStorage("registrarse");
      } else {
        cambiarModoInicioSesion();
        guardarModoEnLocalStorage("iniciar_sesion");
      }
    }
    
    // Desvincular el evento click antes de agregarlo nuevamente
    botonEnlace.removeEventListener("click", botonEnlaceClickHandler);
    
    // Agregar el evento click al botón de enlace
    botonEnlace.addEventListener("click", botonEnlaceClickHandler);
    
    // Obtener el modo guardado en localStorage
    const modoGuardado = localStorage.getItem("modo");
    
    if (modoGuardado === "iniciar_sesion") {
      cambiarModoInicioSesion();
    } else {
      cambiarModoRegistro();
    }

    formulario.addEventListener("submit", function(event) {
      event.preventDefault();
      validarFormulario();
    });

    function mostrarCamposIniciarSesion() {
      // Mostrar campos específicos para el inicio de sesión
      ocultarCampos(camposRegistrarse);
      mostrarCampos(camposIniciarSesion);
    }

    function mostrarCamposRegistrarse() {
      // Mostrar campos específicos para el registro
      ocultarCampos(camposIniciarSesion);
      mostrarCamposRegistrados();
    }

    function ocultarCampos(campos) {
      // Ocultar una lista de campos del formulario
      campos.forEach(function(campo) {
        campo.remove();
      });
    }

    function mostrarCampos(campos) {
      // Mostrar una lista de campos en el formulario
      campos.forEach(function(campo) {
        formulario.insertBefore(campo, formulario.lastElementChild);
      });
    }

    function mostrarCamposRegistrados() {
      // Mostrar los campos originales del registro
      if (camposRegistrarse === null) {
        camposRegistrarse = camposFormulario.slice(0, 2);
      }
      mostrarCampos(camposRegistrarse);
    }

    function actualizarTextoBoton(texto) {
      // Actualizar el texto del botón de envío del formulario
      const boton = formulario.querySelector(".formulario__boton--naranja");
      const icono = boton.querySelector("i");
      boton.innerHTML = texto + icono.outerHTML;
    }

    function validarFormulario() {
      // Realizar validaciones de formulario antes del envío
      reiniciarEstilos();

      let correoValido = validarCorreo();
      let contrasenaValida = validarContrasena();

      if (tituloAcciones.textContent.toLowerCase() === "registrarse") {
        // console.log('aqui deberia de funcionan las validaciones cuando das submit al form')
        let nombreValido = validarNombre();
        let telefonoValido = validarTelefono();
        let descripcionValida = validarDescripcion();
        let terminosAceptados = validarTerminos();

        // Enfocar el primer campo inválido encontrado
        if (!nombreValido) {
          nombreInput.focus();
        } else if (!telefonoValido) {
          telefonoInput.focus();
        } else if (!correoValido) {
          correoInput.focus();
        } else if (!contrasenaValida) {
          contrasenaInput.focus();
        } else if (!descripcionValida) {
          descripcionInput.focus();
        } else if (!terminosAceptados) {
          terminosCheckbox.focus();
        }

        // Enviar el formulario si todos los campos son válidos
        if (
          nombreValido &&
          telefonoValido &&
          correoValido &&
          contrasenaValida &&
          descripcionValida &&
          terminosAceptados
        ) {
          formulario.submit();
        }
      } else { //Aqui esta en iniciar sesion 
        if (!correoValido) {
          correoInput.focus();
        } else if (!contrasenaValida) {
          contrasenaInput.focus();
        }

        // Enviar el formulario si los campos son válidos
        if (correoValido && contrasenaValida) {
          formulario.submit();
        }
      }
    }

    function reiniciarEstilos() {
      // Restablecer estilos de los mensajes de error
      const errores = document.querySelectorAll(".formulario__error");
      errores.forEach(function(error) {
        error.style.display = "";
        error.textContent = "";
      });
    }

    function mostrarError(input, mensaje) {
      // Mostrar un mensaje de error debajo del campo correspondiente
      const campo = input.parentElement;
      const error = campo.querySelector(".formulario__error");

      // Verificar si el mensaje de error ya contiene el icono
      let iconoError = error.querySelector("i");
      if (!iconoError) {
        iconoError = document.createElement("i");
        iconoError.classList.add("bi", "bi-exclamation-octagon");
        error.insertBefore(iconoError, error.firstChild);
      }

      // Establecer el mensaje de error y mostrarlo
      error.innerHTML = "";
      error.appendChild(iconoError);
      error.appendChild(document.createTextNode(mensaje));
      error.style.display = "block";
    }

    // Funciones de validación de campos individuales

    function validarNombre() {
      // Validar el campo de nombre
      const nombre = nombreInput.value.trim();
      if (nombre === "") {
        mostrarError(nombreInput, "Ingresa tu nombre.");
        return false;
      } else if (!/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/.test(nombre)) {
        mostrarError(nombreInput, "El nombre solo puede contener letras y espacios.");
        return false;
      } else if (nombre.length > 30) {
        mostrarError(nombreInput, "El nombre debe tener máximo 30 caracteres.");
        return false;
      }
      return true;
    }

    function validarTelefono() {
      // Validar el campo de teléfono
      const telefono = telefonoInput.value.trim();
      if (telefono === "") {
        mostrarError(telefonoInput, "Ingresa un número de teléfono válido.");
        return false;
      } else if (!/^\d+$/.test(telefono)) {
        mostrarError(telefonoInput, "El teléfono solo puede contener números.");
        return false;
      } else if (telefono.length > 15) {
        mostrarError(telefonoInput, "El teléfono debe tener máximo 15 caracteres.");
        return false;
      }
      return true;
    }

    function validarCorreo() {
      // Validar el campo de correo electrónico
      const correo = correoInput.value.trim();
      if (correo === "") {
        mostrarError(correoInput, "Ingresa un correo electrónico válido.");
        return false;
      } else if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(correo)) {
        mostrarError(correoInput, "Ingresa un correo electrónico válido.");
        return false;
      } else if (correo.length > 100) {
        mostrarError(correoInput, "El correo electrónico debe tener máximo 100 caracteres.");
        return false;
      }
      return true;
    }

    function validarContrasena() {
      // Validar el campo de contraseña
      const contrasena = contrasenaInput.value.trim();
      if (contrasena === "") {
        mostrarError(contrasenaInput, "Ingresa una contraseña segura.");
        return false;
      } else if (contrasena.length < 6) {
        mostrarError(contrasenaInput, "La contraseña debe tener al menos 6 caracteres.");
        return false;
      }
      return true;
    }

    function validarDescripcion() {
      // Validar el campo de descripción
      const descripcion = descripcionInput.value.trim();
      if (descripcion === "") {
        mostrarError(descripcionInput, "Describe cómo deseas tu sitio web.");
        return false;
      } else if (descripcion.length > 1000) {
        mostrarError(descripcionInput, "La descripción debe tener máximo 1000 caracteres.");
        return false;
      }
      return true;
    }

    function validarTerminos() {
      // Validar la aceptación de los términos y condiciones
      if (!terminosCheckbox.checked) {
        mostrarError(terminosCheckbox, "Debes aceptar los términos y condiciones para continuar.");
        return false;
      }
      return true;
    }
  }
});
