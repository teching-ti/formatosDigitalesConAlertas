/*colocar fecha en base al reloj del sistema, dentro de la casilla 'fecha'*/
let cargarFecha = () => {
  let fecha = document.getElementById("fecha");
  dia = new Date().toLocaleDateString();
  fecha.value = dia;
};
cargarFecha();
/*colocar fecha end*/

//obtener los datos del archivo
//uso de una petición fetch
fetch("../scripts/datos.json")
  .then((response) => response.json())
  .then((data) => {
    //la data obtenida será nombrada como users
    users = data;
    /*Autocompletado y llenado para los técnicos*/
    //llena las opciones de 'participantes tecnicos' del primer select que aparecerá por defecto
    //funcion
    llenarSelect(document.querySelector(".nombre-participante"));
    autocompletarCampos(
      document.querySelector(".nombre-participante"),
      document.querySelector(".contenedor-personal")
    );

  })
  .catch((error) => console.error("Error al cargar los datos:", error));


  // Función para llenar el select con opciones de nombres de los técnicos
function llenarSelect(elementoSelect) {
    //una vez con la data 'users' obtenida se podrá acceder a cada uno de los elementos dentro de ella
    users.tecnico.forEach((tecnico) => {
      const option = document.createElement("option");
      option.value = tecnico.name;
      option.textContent = tecnico.name;
      elementoSelect.appendChild(option);
    });
  }
  
  //autocompletar el select ya creado
  function autocompletarCampos(elementoSelect, datosParticipante) {
    elementoSelect.addEventListener("change", function () {
      const nombreSeleccionado = elementoSelect.value;
      const usuarioSeleccionado = users.tecnico.find(
        (tecnico) => tecnico.name === nombreSeleccionado
      );
      datosParticipante.querySelector(".dni").value =
      usuarioSeleccionado.dni;
      datosParticipante.querySelector(".cargo").value =
      usuarioSeleccionado.cargo;

    });
  }


/*Agregar Persona*/
let btnAgregarPersonal = document.querySelector(".agregar-personal");
let btnGenerar = document.querySelector(".terminar");

/*el btnAgregarPersonal ejecutará la función respectiva y al mismo tiempo también posee un contador
, este servirá para evitar que los radio button creados tengan el mismo nombre que los anteriores*/
let numUser = 1;
btnAgregarPersonal.addEventListener("click", function () {
  //solo permitirá la creación de  usuarios
  if (numUser < 5) {
    agregarContenedorPersona(numUser);
    // todo lo correspondiente a selectores sirve como autocompletado para todos los selects clonados
    // ya que la función normal de autocompletado solo se ejecuta con los elementos creados por default
    let selectores = document.querySelectorAll(".nombre-participante");
    selectores.forEach((selectorNombre) => {
      selectorNombre.addEventListener("change", function (event) {
        const nombreSeleccionado = selectorNombre.value;
        const usuarioSeleccionado = users.tecnico.find(
          (tecnico) => tecnico.name === nombreSeleccionado
        );
        const contenedor = event.target.closest(".contenedor-personal");

        contenedor.querySelector(".dni").value =
          usuarioSeleccionado.dni;
        contenedor.querySelector(".cargo").value =
          usuarioSeleccionado.cargo;
      });
    });
    numUser += 1;
  } else {
    alert("Ha alcanzado el número máximo de participantes");
  }
});

//funcion para agregar personal al listado
function agregarContenedorPersona(numUser) {
  alert("Se añadió un nuevo participante, completar sus datos correctamente");
  // Clona el contenedor-trabajador
  const contenedorTrabajador = document.querySelector(".contenedor-personal");
  const nuevoContenedor = contenedorTrabajador.cloneNode(true);
  nuevoContenedor.classList.add("clon");

  document.querySelector(".section-todo-personal").appendChild(nuevoContenedor);
  /*se debe revisar la manera de hacer que cuando se realice la clonación 
  el resto de contenedores tengan también sus inputs en en NA
  de esta manera se evitará inconvenientes.
  */
}


/*---- PARTE 2 DEL CÓDIGO ----*/
/* cargar documento */
//Constante que permitirá usar el objeto jspdf
const jsPDF = window.jspdf.jsPDF;

/*Función para cargar la imagen pdf que se usará como plantilla para rellenar con datos del formulario*/
async function loadImage(url) {
  return new Promise((resolve) => {
    const xhr = new XMLHttpRequest();
    xhr.open("GET", url, true);
    xhr.responseType = "blob";
    xhr.onload = function (e) {
      const reader = new FileReader();
      reader.onload = function (event) {
        const res = event.target.result;
        resolve(res);
      };
      const file = this.response;
      reader.readAsDataURL(file);
    };
    xhr.send();
  });
}

btnGenerar.addEventListener("click", async function generarPDF(e) {
  e.preventDefault();
  //doc, objeto}
   //dimensiones del documento pdf
   var doc = new jsPDF("p", "mm", [666, 943]);
   //imagen del documento vacía
   const image = await loadImage("../recursos/formatoOrden2.png");
   //colocar la imagen
   //colocar imagen desde una posicion en especifico, con las dimensiones especificas
   doc.addImage(image, "PNG", 0, 0, 666, 943);
    doc.setFontSize(16.5) //es el tamaño por defecto
   //descripcion tarea
   doc.text("Text de Prueba", 29, 310)
   doc.text("Text de Prueba", 29, 321)

   //encargado, justificado y centrado
   doc.text("Técnico de medición / Técnico Auxiliar", 330, 310, {
    align: "center"
   })
   doc.text("Técnico de medición / Técnico Auxiliar123", 328, 321, {
    align: "center"
   })

  var blob = doc.output("blob");
  window.open(URL.createObjectURL(blob));
})