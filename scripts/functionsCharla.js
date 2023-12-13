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

/*añadir participante start*/
let btnAniadir = document.getElementById("btn-aniadir")
let contInputs = document.getElementById("contenedor-inputs")
/*Función para añadir inputs al DOM*/
function aniadirParticipante(){
    //div para contener a los inputs
    let datosParticipante = document.createElement("div")
    datosParticipante.classList.add("participante-datos")
    //creación de input
    let nombreParticipante = document.createElement("input")
    nombreParticipante.classList.add("participante-nombre")
    nombreParticipante.placeholder = "Nombres."
    //creación de input
    let dniParticipante = document.createElement("input")
    dniParticipante.classList.add("participante-dni")
    dniParticipante.placeholder = "DNI."
    //creación de input
    let firmaParticipante = document.createElement("input")
    firmaParticipante.classList.add("participante-firma")
    firmaParticipante.placeholder = "Firma."
    //añadiendo los input creados al div
    datosParticipante.append(nombreParticipante, dniParticipante, firmaParticipante)
    //añadir el div con los input dentro al DOM
    contInputs.appendChild(datosParticipante)
}

//acción para añadir los cuadros para un participante adicional
btnAniadir.addEventListener("click", function(e){
    e.preventDefault()
    //reconocerNombres()
    aniadirParticipante()
})
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
        let responsable = document.getElementById("responsable").value
        doc.setFontSize(9)
        //rellenar campo tema
        doc.text(tema, 50, 54)
        //rellenar campo lugar
        doc.text(lugar, 50, 60)
        //rellenar campo fecha
        doc.text(fecha, 50, 64)
        //rellenar campo responsable
        doc.text(responsable, 142 , 61, {maxWidth: 45})
    }

    /*Seleccionar empresa*/
    let evaluarEmpresa = ()=>{
        let empresa = document.getElementById("empresa")

        switch(empresa.value){
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

    }
    
    /*Opciones para preguntas sobre la charla*/
    let evaluarMarcadoOpciones = ()=>{
        //condicional para el marcado de opciones pregunta 1
        switch(respuesta1){
            case "nada":
                doc.text("x", 36.5, 89)
                break;
            case "poco":
                doc.text("x", 87.5, 89)
                break;
            case "mucho":
                doc.text("x", 120, 89)
                break;
            case "otro":
                doc.text("x", 152, 89)
                break;
        }
        //condicional para el marcado de opciones pregunta 2
        switch(respuesta2){
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
    }
    
    let evaluarNombres = ()=>{
        nombresX = 17
        nombresY = 138.5
        dniX = 108.5
        dniY = 138.5

        nombres = document.querySelectorAll(".participante-nombre")
        nombres.forEach((nombre)=>{
            //alert(nombre)
            doc.text(nombre.value, nombresX, nombresY)
            nombresY+=10
        })
        dnis = document.querySelectorAll(".participante-dni")
        dnis.forEach((dni)=>{
            //alert(nombre)
            doc.text(dni.value, dniX, dniY)
            dniY+=10
        })
        /*
        //este bucle será para cargar las imágenes
        nombres.forEach((nombre)=>{
            //alert(nombre)
            doc.text(nombre.value, nombresX, nombresY)
            nombresY+=10
        })*/
    }

    /*--- ESTO DEBE EVALUARSE PARA COLOCAR LAS FIRMAS COMO IMÁGENES ---*/
    /*inicia datos para el registro de participantes*/
    /*probando los espacios para las firmas*/
    let f1 = "../recursos/firma1.png"
    let f2 = "../recursos/firma2.png"
    /*coordenadas para añadir las firmas*/
    /*Argumentos para añadir imágnes*/
    /*(imagen, formato, posicionX, posicionY, width, height)*/
    //Posicion para la firma1
    doc.addImage(f1, "PNG", 144, 130.5, 47, 8.2)
    //Posicion para la firma2
    doc.addImage(f2, "PNG", 144, 141, 47, 8.2)
    /*termina datos para el registro de participantes*/

    let evaluarExpositor = ()=>{
        let expNombre = document.getElementById("expositor-nombre")
        let firmaExpositor = '../recursos/firma12.png'

        doc.addImage(firmaExpositor, "PNG", 35, 275, 58, 11)
        doc.text(expNombre.value, 112, 283)
    }

    evaluarDatosPrincipales()
    evaluarEmpresa()
    evaluarMarcadoOpciones()
    evaluarNombres()
    evaluarExpositor()

    //https://codingpotions.com/input-autocompletado-javascript/
    //Para generar el autocomplete podría ser usando fetch

    // Guardar el PDF
    //doc.save("reporte_charla_05_minutos.pdf");

    //hacer previsualización
    /*var blob = doc.output("blob");
    window.open(URL.createObjectURL(blob))*/
})  