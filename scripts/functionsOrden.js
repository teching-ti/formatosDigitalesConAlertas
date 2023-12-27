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

    llenarSelect(document.getElementById("solicitado"))
    completarFirmaSolicitante(document.getElementById("solicitado") ,document.getElementById("firma-solicitado"))
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
      datosParticipante.querySelector(".firma").value =
      usuarioSeleccionado.firma;
    });
  }

  //autocompletarFirmaSolicitante
  function completarFirmaSolicitante(elementoSelect, solicitante){
    elementoSelect.addEventListener("change", function(){
      const nombreSeleccionado = elementoSelect.value;
      const usuarioSeleccionado = users.tecnico.find(
        (tecnico) => tecnico.name === nombreSeleccionado
      );
      solicitante.value = usuarioSeleccionado.firma
    })
  }

  /*Nuevos EQUIPOS/MATERIALES START*/
  /*Agregar Equipo/Material*/
  let btnAgregarEquipo = document.querySelector(".agregar-equipo")
  //Solo se podrán agregar 3 equipos/materiales adicionales
  let numEquipment = 1;
  btnAgregarEquipo.addEventListener("click", function(){
    if(numEquipment<3){
      agregarEquipo()
      numEquipment+=1
    }else{
      alert("Se ha alcanzado el máximo número permitido")
    }
  })

  function agregarEquipo(){
    alert("Se añadió nuevo equipo/material, completar sus datos correctamente");
    // Clona el contenedor-equipos
    const contenedorEquipo = document.querySelector(".contenedor-equipos");
    const nuevoContenedor = contenedorEquipo.cloneNode(true);

    nuevoContenedor.querySelectorAll("input").forEach((input)=>{
      input.value=""
    })
  
    nuevoContenedor.querySelectorAll(".observaciones-e").forEach((texta)=>{
      texta.value=""
    })
    document.querySelector(".equipos").appendChild(nuevoContenedor);
  }

/*Nuevas Herramientas START*/
/*Agregar Herramienta*/
let btnAgregarHerramienta = document.querySelector(".agregar-herramienta")
//Solo se podrán agregar 4 herramientas adicionales
let numTool = 1;
btnAgregarHerramienta.addEventListener("click", function(){
  if(numTool<4){
    agregarHerramienta()
    numTool+=1
  }else{
    alert("Se ha alcanzado el máximo número permitido")
  }
})

function agregarHerramienta(numTool){
  alert("Se añadió nueva herramienta, completar sus datos correctamente");
  // Clona el contenedor-herramientas
  const contenedorHerramienta = document.querySelector(".contenedor-herramientas");
  const nuevoContenedor = contenedorHerramienta.cloneNode(true);

  nuevoContenedor.querySelectorAll("input").forEach((input)=>{
    input.value=""
  })

  nuevoContenedor.querySelectorAll(".observaciones").forEach((texta)=>{
    texta.value=""
  })
  document.querySelector(".herramientas").appendChild(nuevoContenedor);
}

/*Remover Herramienta*/
let contenedorPrincipalHerramientas = document.querySelector(".herramientas")
//el manejo de los click están delegados al un contenedor de una actividad en específico
contenedorPrincipalHerramientas.addEventListener("click", function (ev) {
  //condición, si el evento causado es por alguien que contiene esa clase
  if (ev.target.classList.contains("btn-remover-herramienta")) {
    const contenedorHerramienta = ev.target.closest(".contenedor-herramientas");
    //se ejecuta la función eliminarActividad llevando como argumento el contenedor guardado
    eliminarHerramienta(contenedorHerramienta);
  }
});

function eliminarHerramienta(contenedor) {
  //contenedorActividades es una variable declarada con un elemento del dom, muchas líneas atrás
  contenedorPrincipalHerramientas.removeChild(contenedor);
}


/*Nuevas Herramientas END*/

/*Agregar Persona*/
let btnAgregarPersonal = document.querySelector(".agregar-personal");

/*el btnAgregarPersonal ejecutará la función respectiva y al mismo tiempo también posee un contador
, este servirá para evitar que los radio button creados tengan el mismo nombre que los anteriores*/
let numUser = 1;
btnAgregarPersonal.addEventListener("click", function () {
  //solo permitirá la creación de  usuarios
  if (numUser < 6) {
    agregarContenedorPersona(numUser);
    // todo lo correspondiente a selectores sirve como autocompletado para todos los selects clonados
    // ya que la función normal de autocompletado solo se ejecuta con los elementos creados por default
    let selectores = document.querySelectorAll(".nombre-participante");
    //Importante para el autocompletado de los participantes clonados
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
          contenedor.querySelector(".firma").value =
          usuarioSeleccionado.firma;
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
  //nuevoContenedor.classList.add("clon");
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

let btnGenerar = document.getElementById("btnGenerar")

btnGenerar.addEventListener("click", async function generarPDF(e) {
  e.preventDefault();
  //doc, objeto}
   //dimensiones del documento pdf
   var doc = new jsPDF("p", "mm", [666, 943]);
   //imagen del documento vacía
   const image = await loadImage("../recursos/formatoOrden3.png");
   //colocar la imagen
   //colocar imagen desde una posicion en especifico, con las dimensiones especificas
   doc.addImage(image, "PNG", 0, 0, 666, 943);
    doc.setFontSize(16.5) //es el tamaño por defecto
    //Importante para resolver lo de tareas y personal
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

   //Datos Generales
   function evaluarDatosGenerales(){
    let fecha = document.getElementById("fecha").value
    let proyecto = document.getElementById("proyecto").value
    let nproyecto = document.getElementById("nproyecto").value
    let ot = document.getElementById("ot").value
    let actividad = document.getElementById("actividad").value
    let contacto = document.getElementById("contacto").value
    let telefono = document.getElementById("telefono").value
    let direccion = document.getElementById("direccion").value
    let referencia = document.getElementById("referencia").value
    let ceco = document.getElementById("ceco").value

    doc.text(fecha, 118, 80)
    doc.text(proyecto, 270,80)
    doc.text(nproyecto, 465, 80)
    doc.text(ot, 575, 80)
    doc.text(actividad, 118, 118)
    doc.text(contacto, 118, 92)
    doc.text(telefono, 118, 105)
    doc.text(direccion, 410, 92)
    doc.text(referencia, 410, 105)
    doc.text(ceco, 575, 105)
   }

   evaluarDatosGenerales()

   //Nombres y Firmas para solicitud y autorizacion
   function evaluarSolicitudAutorizacion(){
    let solicitanteNombre = document.getElementById("solicitado").value
    let solicitanteFirma = document.getElementById("firma-solicitado").value
    let autorizaNombre = document.getElementById("autorizado").value
    let autorizaFirma = document.getElementById("firma-autorizado").value



    doc.text(solicitanteNombre, 115, 160,{align: "center"})
    doc.addImage(solicitanteFirma, 230, 145)

    doc.text(autorizaNombre, 420, 160,{align: "center"})
    doc.addImage(autorizaFirma, 540, 145)

   }

   evaluarSolicitudAutorizacion()

    /*Tareas a Ejecutar*/
    //9 tareas planificadas, considerar las observaciones, tema del tiempo estimado y del tiempo real ára sumarlos
    //y colocar lo que sería la duración total del MO

    /*Observaciones Tareas Iniciales*/
    let obsTareasIniciales = document.querySelectorAll(".obs-tarea-inicial")
    let obiY = 191.3
    obsTareasIniciales.forEach(oti=>{
      doc.setFontSize(13.5)
      doc.text(oti.value, 525, obiY, {
        maxWidth: 110,
        lineHeightFactor: 0.9
      })
      obiY+=12.3
    })
    doc.setFontSize(16.5)


    /*EQUIPOS Y MATERIALES*/
    let codigosEquiposMateriales = ["1", "2", "3", "4", "5", "6", "7", "8", "9", "10", "11", "12", "13", "14", "15", "16", "17", "18"]
    let codEmY = 384
   codigosEquiposMateriales.forEach(c=>{
    doc.text(c, 65, codEmY, {align: "center"})
    codEmY+=12.3
   })

   //inputs, correspondientes a los equipos iniciales
   let obsEquiposIniciales = document.querySelectorAll(".obs-equip-inicial")
   let eiy = 384
   obsEquiposIniciales.forEach(oei=>{

     doc.text(oei.value, 466, eiy)
     eiy+=12.3
   })

   /*Equipos y materiales agregados*/
   function evaluarEquiposAdicionales(){
    let descripcionEquipo = document.querySelectorAll(".descripcion-equipo")
    let unidadEquipo = document.querySelectorAll(".unidad")
    let cantidadEquipo = document.querySelectorAll(".cantidad-e")
    let observacionesEquipo = document.querySelectorAll(".observaciones-e")

    let equipoY = 568.5
    descripcionEquipo.forEach(des=>{
      doc.text(des.value, 220, equipoY,{
        align: "center"
      })
      equipoY+=12.3
    })

    equipoY = 568.5
    unidadEquipo.forEach(uni=>{
      doc.text(uni.value, 365, equipoY, {
        align: "center"
      })
      equipoY+=12.3
    })

    equipoY = 568.5
    cantidadEquipo.forEach(cantE=>{
      doc.text(cantE.value, 430, equipoY)
      equipoY+=12.3
    })

    equipoY = 568.5
    observacionesEquipo.forEach(obsE=>{
      doc.text(obsE.value, 466, equipoY)
      equipoY+=12.3
    })

   }

   evaluarEquiposAdicionales()


    //herramientas iniciales
    //añadir codigos a herramientas
    let codigosHerramientas = new Array("1","2","3","4","5","6","7")
    let codY = 635
    codigosHerramientas.forEach(c=>{
      doc.text(c, 65, codY)
      codY+=12
    })

    //inputs, correspondientes a las herramientas iniciales
    let obsHerramientasIniciales = document.querySelectorAll(".obs-herr-inicial")
    let hiy = 635
    obsHerramientasIniciales.forEach(ohi=>{

      doc.text(ohi.value, 466, hiy)
      hiy+=12
    })

   function evaluarHerrammientasAdicionales(){
    let descripcionHerramienta = document.querySelectorAll(".descripcion-herramienta")
    let cantidadPlanificada = document.querySelectorAll(".cantidad-p")
    let cantidadUtilizada = document.querySelectorAll(".cantidad-u")
    let observaciones = document.querySelectorAll(".observaciones")

    let herramientasY = 672.5
    descripcionHerramienta.forEach(descripcion=>{
      doc.text(descripcion.value, 220, herramientasY,{
        align: "center"
      })
      herramientasY+=12
    })

    herramientasY = 672.5
    cantidadPlanificada.forEach(cant1=>{
      doc.text(cant1.value, 365, herramientasY)
      herramientasY+=12
    })

    herramientasY = 672.5
    cantidadUtilizada.forEach(cant2=>{
      doc.text(cant2.value, 430, herramientasY)
      herramientasY+=12
    })

    herramientasY = 672.5
    observaciones.forEach(obs=>{
      doc.text(obs.value, 466, herramientasY)
      herramientasY+=12
    })

   }

   evaluarHerrammientasAdicionales()

   /*INTEGRANTES DE TRABAJO*/
   let nombresParticipantes = document.querySelectorAll(".nombre-participante")
   let dniParticipantes = document.querySelectorAll(".dni")
   let cargoParticipantes = document.querySelectorAll(".cargo")
   let hsInicio = document.querySelectorAll(".h-ingreso")
   let hsFin = document.querySelectorAll(".h-salida")
   let firmasParticipantes = document.querySelectorAll(".firma")

   let nombreParticipanteY = 752
   nombresParticipantes.forEach(nombreP=>{
    doc.text(nombreP.value, 220, nombreParticipanteY,{
      align: "center"
    })
    nombreParticipanteY+=16.8
   })

   let dniParticipanteY = 752
   dniParticipantes.forEach(dniP=>{
    doc.text(dniP.value, 65, dniParticipanteY,{
      align: "center"
    })
    dniParticipanteY+=16.8
   })
   
   doc.setFontSize(14)
   let cargoParticipanteY = 752
   cargoParticipantes.forEach(cargoP=>{
    doc.text(cargoP.value, 365, cargoParticipanteY, {
      align: "center"
    })
    cargoParticipanteY+=16.8
   })

   doc.setFontSize(16.5)
   let hInicioY = 752
   hsInicio.forEach(hi=>{
    doc.text(hi.value, 430, hInicioY, {
      align:"center"
    })
    hInicioY+=16.8
   })

   let hFinY = 752
   hsFin.forEach(hf=>{
    doc.text(hf.value, 495, hFinY, {
      align:"center"
    })
    hFinY+=16.8
   })

   let firmasY = 742
   firmasParticipantes.forEach(fp=>{
    doc.addImage(fp.value, "PNG", 540, firmasY)
    firmasY+=16
   })


   function evaluarObservacioProyecto(){
    let comentarioProyecto = document.getElementById("comentario").value
    doc.setFontSize(17)
    doc.text(comentarioProyecto, 38, 855,{
        maxWidth: 600,
        lineHeightFactor: 0.9,
    })
   }

   evaluarObservacioProyecto()



  var blob = doc.output("blob");
  window.open(URL.createObjectURL(blob));
})