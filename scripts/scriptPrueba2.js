//codigo2
//este funciona bien
let epp = document.querySelectorAll(".epp");
let ini = 0;
positionX = 227;
positionY = 125.8;
epp.forEach((e) => {
  if (e.checked) {
    console.log(ini);
    if (ini == 19) {
      positionX += 60;
      positionY = 125.8;
    } else if (ini == 38) {
      positionX += 60;
      positionY = 125.8;
    } else if (ini == 57) {
      positionX += 60;
      positionY = 125.8;
    } else if (ini == 76) {
      positionX += 60;
      positionY = 125.8;
    }
    doc.text(e.value, positionX, positionY);
    positionY += 10.3;
    ini += 1;
  }
});
