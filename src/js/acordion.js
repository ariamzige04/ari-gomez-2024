(function() {
  const acordeonesVista = document.querySelectorAll(".preguntas__vista");
  const acordeones = document.querySelectorAll(".preguntas__acordeon");

  for (let i = 0; i < acordeonesVista.length; i++) {
    acordeonesVista[i].addEventListener("click", function() {
      const estaAbierto = this.parentElement.classList.contains("preguntas__acordeon--observar");
      const alturaRespuesta = this.parentElement.querySelector(".preguntas__altura").scrollHeight;

      for (let j = 0; j < acordeones.length; j++) {
        acordeones[j].classList.remove("preguntas__acordeon--observar");
        acordeones[j].querySelector(".preguntas__altura").style.maxHeight = "0";
      }

      if (!estaAbierto) {
        this.parentElement.classList.add("preguntas__acordeon--observar");
        this.parentElement.querySelector(".preguntas__altura").style.maxHeight = alturaRespuesta + "px";
      }
    });
  }
})();






// (function() {
//   const acordeones = document.querySelectorAll(".preguntas__acordeon");

//   for (let i = 0; i < acordeones.length; i++) {
//       acordeones[i].addEventListener("click", function() {
//           const estaAbierto = this.classList.contains("preguntas__acordeon--observar");
//           const alturaRespuesta = this.querySelector(".preguntas__respuesta").scrollHeight;

//           for (let j = 0; j < acordeones.length; j++) {
//               acordeones[j].classList.remove("preguntas__acordeon--observar");
//               acordeones[j].querySelector(".preguntas__altura").style.maxHeight = "0";
//           }

//           if (!estaAbierto) {
//               this.classList.add("preguntas__acordeon--observar");
//               this.querySelector(".preguntas__altura").style.maxHeight = alturaRespuesta + "px";
//           }
//       });
//   }
// })();
