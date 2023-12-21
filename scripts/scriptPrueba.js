//codigo1
let personas = document.querySelectorAll(".contenedor-trabajador");

personas.forEach((persona) => {
  const radioButtons = persona.querySelectorAll('input[type="radio"]:checked');

  let ini = 0;
  positionX = 225;
  positionY = 125.8;
  radioButtons.forEach((rb) => {
    if (rb.classList.value == "epp") {
      switch (rb.value) {
        case "Bueno":
          doc.text(rb.value, positionX, positionY);
          break;
        case "Malogrado":
          doc.text(rb.value, positionX, positionY);
          break;
        case "No tiene":
          doc.text(rb.value, positionX, positionY);
          break;
        case "No aplica":
          doc.text(rb.value, positionX, positionY);
          break;
      }
      positionY += 10.3;
    }
  });
});
