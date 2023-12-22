//1. Manipulación de estructura

/*colocar fecha start*/
function cargarFecha(){
    let inputFecha = document.getElementById("fecha")
    let dia = new Date
    inputFecha.value = dia.toLocaleDateString()
}
cargarFecha()
/*colocar fecha end*/

/*Sección de los radio button y preguntas*/
let respuesta1 = ""
let opcionesPreguntas = document.querySelectorAll(".op1")
    opcionesPreguntas.forEach(e=>{
        e.addEventListener("click", ()=>{
                respuesta1 = e.id
        })
    })

let respuesta2 = ""
let opcionesPreguntas2 = document.querySelectorAll(".op2")
    opcionesPreguntas2.forEach(e=>{
        e.addEventListener("click", ()=>{
            respuesta2 = e.id
        })
})

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
    llenarSelectPersonal(document.querySelector(".participante-nombre"));
    //auocompleta los campos relacionados al primer select, que aparece por defecto
    autocompletarCamposPersonal(document.querySelector(".participante-nombre"), document.querySelector(".participante-datos"));


    //expositor
    llenarSelectExpositor(document.getElementById("expositor-nombre"))
    llenarSelectExpositor(document.getElementById("responsable-nombre"))
    autocompletarCamposExpositor(document.getElementById("expositor-nombre"), document.getElementById("expositor-firma"))


    funcionalidadesPersonal();
  })
  .catch((error) => console.error("Error al cargar los datos:", error));

// Función para llenar el select con opciones de nombres de los técnicos
function llenarSelectPersonal(elementoSelect) {
    //una vez con la data 'users' obtenida se podrá acceder a cada uno de los elementos dentro de ella
    users.tecnico.forEach((tecnico) => {
      const option = document.createElement("option");
      option.value = tecnico.name;
      option.textContent = tecnico.name;
      elementoSelect.appendChild(option);
    });
  }

  function llenarSelectExpositor(elementoSelect){
    users.supervisor.forEach((supervisor)=>{
        const opcion = document.createElement("option")
        opcion.value = supervisor.name
        opcion.textContent = supervisor.name
        elementoSelect.appendChild(opcion)
    })
  }

/*Autocompletado de los técnicos*/
//función para autocompletar los campos al seleccionar un nombre 
//parámetros, (select, elemento que será actualizado usando su .value)
function autocompletarCamposPersonal(elementoSelect, datosParticipante) {
    elementoSelect.addEventListener("change", function () {
        const nombreSeleccionado = elementoSelect.value;
        const usuarioSeleccionado = users.tecnico.find(
            (tecnico) => tecnico.name === nombreSeleccionado
        );
        //autocompletar los campos correspondientes
        //datosParticipante.querySelector(".participante-dni"), //obviamente hace referencia al elemento html
        datosParticipante.querySelector(".participante-dni").value =
        usuarioSeleccionado.dni;
        datosParticipante.querySelector(".participante-firma").value =
        usuarioSeleccionado.firma;
    });
}

/*Autocompletado del expositor*/
function autocompletarCamposExpositor(elementoSelect, datosSupervisor) {
    elementoSelect.addEventListener("change", function () {
        const nombreSeleccionado = elementoSelect.value;
        const supervisorSeleccionado = users.supervisor.find(
            (supervisor) => supervisor.name === nombreSeleccionado
        );
        //autocompletar los campos correspondientes
        datosSupervisor.value =
        supervisorSeleccionado.firma;
    });
}

  
/*añadir participante start*/
let btnAniadir = document.getElementById("btn-aniadir")
let contInputs = document.getElementById("contenedor-inputs")

/*Funcionalidades para el Personal*/
function funcionalidadesPersonal() {
    function eliminarParticipante(contenedor) {
        //contenedorParticipante es una variable declarada con un elemento del dom, muchas líneas atrás
        contInputs.removeChild(contenedor);
    }
    /*Función para añadir inputs al DOM*/
    function aniadirParticipante(){
        //div para contener a los inputs
        let datosParticipante = document.createElement("div")
        datosParticipante.classList.add("participante-datos")

        // Crear un select para los nombres
        let nombreParticipante = document.createElement("select");
        let option0 = document.createElement("option");
        option0.value = "Seleccionar";
        option0.textContent = "--Seleccionar Nombre--";
        nombreParticipante.appendChild(option0);
        nombreParticipante.classList.add("participante-nombre");
        //se completan las opciones con los nombres de los usuarios obtenidos para que luego pueda realizar su respectivo autocompletado
        llenarSelectPersonal(nombreParticipante);

        //creación de input
        let dniParticipante = document.createElement("input")
        dniParticipante.classList.add("participante-dni")
        dniParticipante.readOnly = true
        dniParticipante.placeholder = "DNI."

        //creación de input
        let firmaParticipante = document.createElement("input")
        firmaParticipante.classList.add("participante-firma")
        firmaParticipante.readOnly = true
        firmaParticipante.placeholder = "Firma."

        //creacion del btn-remover
        let btnRemoverParticipante = document.createElement("div")
        btnRemoverParticipante.classList.add("btn-remover-participante")
        let iconTrash = document.createElement("i")
        iconTrash.classList.add("fa-solid")
        iconTrash.classList.add("fa-trash")
        btnRemoverParticipante.appendChild(iconTrash)

        //función creada con anterioridad para el autocompletado en base al nombre seleccionado
        //param 'nombreParticipante' es el dato que se obtiene desde el select
        //param 'datosParticipante' se usará para los elementos html a modificar
        autocompletarCamposPersonal(nombreParticipante, datosParticipante);

        //añadiendo los input creados al div
        datosParticipante.append(nombreParticipante, dniParticipante, firmaParticipante, btnRemoverParticipante)

        //añadir el div con los input dentro al DOM
        contInputs.appendChild(datosParticipante)
    }

    //acción para añadir los cuadros para un participante adicional
    btnAniadir.addEventListener("click", function(e){
        e.preventDefault()
        aniadirParticipante()
    })

    //el manejo de los click están delegados al un contenedor de participante en específico
    contInputs.addEventListener("click", function (ev) {
        //condición, si el evento causado es por alguien que contiene esa clase
        if (ev.target.classList.contains("btn-remover-participante") || ev.target.classList.contains("fa-trash")) {
        //se guarda dentro de participanteContainer el div en cuestión 'participante-datos que haya tenido dicho evento'
        //debido al método closest
        const participanteContainer = ev.target.closest(".participante-datos");
        //se ejecuta la función eliminarParticipante llevando como argumento el contenedor guardado
        eliminarParticipante(participanteContainer);
        }
    });
}


/*añadir participante end*/

//Constante importante para poder usar el objeto jsPDF
const jsPDF = window.jspdf.jsPDF;

//creación de los tamaños para el texto en el documento
//fontSizeTexo es importante definirla porque es el tamaño de fuente que aarecereá en el pdf
const fontSizeTexto = 10

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

//Se obtiene el boton generar, para generar el pdf
//2. Generar PDF
btnGenerar= document.getElementById("btn-generar");

btnGenerar.addEventListener("click", async function generarPDF(e) {
    e.preventDefault()
    //doc, objeto
    var doc = new jsPDF()
    //imagen del documento vacía
    const image = await loadImage("../recursos/formatoCharla.png")
    //colocar la imagen
    doc.addImage(image, "PNG", 0, 0, 200, 300)
    //variables con la información obtenida del formulario
    
    let evaluarDatosPrincipales = ()=>{
        let fecha = document.getElementById("fecha").value
        let tema = document.getElementById("tema").value
        let lugar = document.getElementById("lugar").value
        let responsable = document.getElementById("responsable-nombre").value
        //condicional para determminar si los campos del formulario han sido completados
        if(tema!="" && lugar!="" && responsable!=""){
            doc.setFontSize(9)
            //rellenar campo tema
            doc.text(tema, 50, 54)
            //rellenar campo lugar
            doc.text(lugar, 50, 60)
            //rellenar campo fecha
            doc.text(fecha, 50, 64)
            //rellenar campo responsable
            doc.text(responsable, 142 , 61, {maxWidth: 45})
            return true
        }else{
            alert("Complete los campos superiores del formulario")
            return false
        }
    }

    /*Seleccionar empresa*/
    let evaluarEmpresa = ()=>{
        let empresa = document.getElementById("empresa")
        doc.setFontSize(9)
        switch(empresa.value){
            case "- Seleccionar -":
                return false
            case "TECHING":
                doc.text("x", 38.7, 43)
                break;
            case "CONTRATISTA1":
                doc.text("x", 75.8, 43)
                doc.text(empresa.value, 90, 43)
                break;
            case "CONTRATISTA2":
                doc.text("x", 75.8, 43)
                doc.text(empresa.value, 90, 43)
                break;
        }
        return true

    }
    
    /*Opciones para preguntas sobre la charla*/
    let evaluarMarcadoOpciones = ()=>{
        //condicional para el marcado de opciones pregunta 1
        switch(respuesta1){
            case "":
                alert("Responda la pregunta 1")
                return false
            case "nada":
                doc.text("x", 36.5, 89)
                break;
            case "poco":
                doc.text("x", 87.5, 89)
                break;
            case "mucho":
                doc.text("x", 120.2, 89)
                break;
            case "otro":
                doc.text("x", 152, 89)
                break;
        }
        //condicional para el marcado de opciones pregunta 2
        switch(respuesta2){
            case "":
                alert("Responda la pregunta 2")
                return false
            case "muyInteresante":
                doc.text("x", 51, 110)
                break;
            case "interesante":
                doc.text("x", 96, 110)
                break;
            case "pocoInteresante":
                doc.text("x", 132, 110)
                break;
            case "otro2":
                doc.text("x", 151, 110)
                break;
        }
        return true
    }
    
    let evaluarNombres = ()=>{
        let resEvalNombres = true
        nombresX = 17
        nombresY = 138.5
        dniX = 108.5
        dniY = 138.5
        firmasX = 144
        firmasY = 130.5

        nombres = document.querySelectorAll(".participante-nombre")
        nombres.forEach((nombre)=>{
            if(nombre.value != "" && nombre.value != "Seleccionar"){
                doc.text(nombre.value, nombresX, nombresY)
                nombresY+=10
            }else{
                alert("Seleccionar un nombre de participante")
                resEvalNombres = false
                return
            }   
        })

        dnis = document.querySelectorAll(".participante-dni")
        dnis.forEach((dni)=>{
            if(dni.value != ""){
                doc.text(dni.value, dniX, dniY)
                dniY+=10
            }else{
                alert("Campo DNI vacío")
                resEvalNombres = false
                return
            }
        })

        firmas = document.querySelectorAll(".participante-firma")
        //este bucle será para cargar las imágenes
        firmas.forEach((firma)=>{
            if(firma.value != ""){
                doc.addImage(firma.value, "PNG", firmasX, firmasY, 47, 8.2)
                firmasY+=10
            }else{
                alert("Campo Firma vacío")
                resEvalNombres = false
                return
            }
        })

        if(resEvalNombres){
            return true
        }else{
            return false
        }
    }

    /*--- ESTO DEBE EVALUARSE PARA COLOCAR LAS FIRMAS COMO IMÁGENES ---*/
    /*inicia datos para el registro de participantes*/
    /*probando los espacios para las firmas*/
    //let f1 = "../recursos/firma1.png"
    //let f2 = "../recursos/firma2.png"
    /*coordenadas para añadir las firmas*/
    /*Argumentos para añadir imágnes*/
    /*(imagen, formato, posicionX, posicionY, width, height)*/
    //Posicion para la firma1
    //doc.addImage(f1, "PNG", 144, 130.5, 47, 8.2)
    //Posicion para la firma2
    //doc.addImage(f2, "PNG", 144, 141, 47, 8.2)
    /*termina datos para el registro de participantes*/

    let evaluarExpositor = ()=>{
        let expNombre = document.getElementById("expositor-nombre").value
        //imagen de la firma cargada con transparencia
        //let firmaExpositor = document.getElementById("expositor-firma").value
        //doc.addImage(firmaExpositor, "PNG", 35, 275, 58, 11)
        doc.addImage("../recursos/firma12.png", "PNG", 35, 275, 58, 11)
        doc.text(expNombre, 112, 283)
        return true
    }

    // evaluarDatosPrincipales()
    // evaluarEmpresa()
    // evaluarMarcadoOpciones()
    // evaluarNombres()
    // evaluarExpositor()
    if(evaluarDatosPrincipales() && evaluarEmpresa() && evaluarMarcadoOpciones() && evaluarNombres() && evaluarExpositor()){
        alert("Correcto")
        //hacer previsualización
        var blob = doc.output("blob");
        window.open(URL.createObjectURL(blob))
    }else{
        alert("Complete todos los campos")
    }
})