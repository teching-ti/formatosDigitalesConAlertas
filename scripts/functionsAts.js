//1. Manipulación de estructura

/*colocar fecha en base al reloj del sistema, dentro de la casilla 'fecha'*/
function cargarFecha(){
    let inputFecha = document.getElementById("fecha")
    let dia = new Date
    inputFecha.value = dia.toLocaleDateString()
}
cargarFecha()
/*colocar fecha end*/

/*--- AÑADIR ACTIVIDADES START ---*/
//se obtiene el boton aniadir actividad
let btnAniadirActividad = document.getElementById("btn-aniadir-actividad")
let contenedorActividades = document.getElementById("contenedor-actividades")

/*Función para añadir actividades*/
function aniadirActividad(){
    //div para contener a los inputs
    let datosActividad = document.createElement("div")
    datosActividad.classList.add("actividades-datos")
    //creación de input
    let nombreActividad = document.createElement("input")
    nombreActividad.classList.add("actividad-nombre")
    nombreActividad.placeholder = "Actividad."
    //creación de input
    let peligroAspecto = document.createElement("input")
    peligroAspecto.classList.add("peligro-aspecto-nombre")
    peligroAspecto.placeholder = "Peligro/Aspecto."
    //creación de input
    let riesgoImpacto = document.createElement("input")
    riesgoImpacto.classList.add("riesgo-impacto-nombre")
    riesgoImpacto.placeholder = "Riesgo Asociado/ Impacto Ambiental."
    //creación de input
    let accionesRecomendadas = document.createElement("input")
    accionesRecomendadas.classList.add("acciones-nombre")
    accionesRecomendadas.placeholder = "Acciones Recomendadas."
    //añadiendo los input creados al div
    datosActividad.append(nombreActividad, peligroAspecto, riesgoImpacto, accionesRecomendadas)
    //añadir el div con los input dentro al DOM
    contenedorActividades.appendChild(datosActividad)
}

//acción para añadir los cuadros para una actividad adicional
btnAniadirActividad.addEventListener("click", function(e){
    e.preventDefault()
    aniadirActividad()
})
/*--- AÑADIR ACTIVIDADES END ---*/



/*--- AÑADIR PARTICIPANTE O PERSONAL START ---*/
let btnAniadirParticipante = document.getElementById("btn-aniadir")
let contenedorParticipante = document.getElementById("contenedor-inputs")

/*Función para añadir personal*/
function aniadirParticipante(){
    //div para contener a los inputs
    let datosParticipante = document.createElement("div")
    datosParticipante.classList.add("participante-datos")
    //creación de input
    let nombreParticipante = document.createElement("input")
    nombreParticipante.classList.add("participante-nombre")
    nombreParticipante.placeholder = "Nombres."
    //creación de input
    let participanteDNI = document.createElement("input")
    participanteDNI.classList.add("participante-dni")
    participanteDNI.placeholder = "DNI."
    //creación de input
    let participanteFirma = document.createElement("input")
    participanteFirma.classList.add("participante-firma")
    participanteFirma.placeholder = "Firma."
    //creacion de los contenedores para las horas y span

    //contenedor de ingreso
    let contEntrada = document.createElement("div")
    contEntrada.classList.add("contenedor-ingreso")
    //span de ingreso
    let spanEntrada = document.createElement("span")
    spanEntrada.textContent = "Hora de Ingreso"

    //contenedor de salida
    let contSalida = document.createElement("div")
    contSalida.classList.add("contenedor-salida")
    //span de salida
    let spanSalida = document.createElement("span")
    spanSalida.textContent = "Hora de Salida"

    /*creando las horas*/
    //creación de la hora de entrada
    let horaEntrada = document.createElement("input")
    horaEntrada.type = "time"
    horaEntrada.classList.add("h-ingreso")

    //creación de la hora de salida
    let horaSalida = document.createElement("input")
    horaSalida.type = "time"
    horaSalida.classList.add("h-salida")
    /*creando las horas*/

    //añadiendo las horas a sus respectivos contenedores
    contEntrada.append(spanEntrada, horaEntrada)
    contSalida.append(spanSalida, horaSalida)

    //añadiendo los input creados al div
    datosParticipante.append(nombreParticipante, participanteDNI, participanteFirma, contEntrada, contSalida)
    //añadir el div con los input dentro del contenedor
    contenedorParticipante.appendChild(datosParticipante)
}

//acción para añadir los cuadros para un participante adicional
btnAniadirParticipante.addEventListener("click", function(ev){
    ev.preventDefault()
    aniadirParticipante()
})
/*--- AÑADIR PARTICIPANTE O PERSONAL START ---*/




//Constante que permitirá usar el objeto jspdf
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
let btnGenerar = document.getElementById("btn-generar")

btnGenerar.addEventListener("click", async function generarPDF(e){

    e.preventDefault()
    //doc, objeto
    var doc = new jsPDF()
    //imagen del documento vacía
    const image = await loadImage("../recursos/formatoAts.png")
    //colocar la imagen
    doc.addImage(image, "PNG", 0, 0, 200, 300)
    
    //funcion para obtener y colocar datos de la parte superior
    let evaluarDatosPrincipales = ()=>{
        let trabajo = document.getElementById("trabajo").value
        let lugar = document.getElementById("lugar").value
        let fecha = document.getElementById("fecha").value
        let responsable1 = document.getElementById("responsable-nombre").value

        if(trabajo!="" && lugar!="" && responsable1!=""){
            doc.text(trabajo, 58, 32.5)
            doc.text(lugar, 58, 36.8)
            doc.text(fecha, 58, 41)
            doc.setFontSize(8)
            doc.text(responsable1, 143, 41)
            return true;
        }else{
            alert("Complete todos los campos de la parte superior del formulario")
            return false;
        }

        
    }
    
    let evaluarEmpresa = ()=>{
        /*Seleccionar empresa start*/
        let empresa = document.getElementById("empresa")
        /*Seleccionar empresa end*/

        /*EMPRESA SELECCIONADA */
        switch(empresa.value){
            //La validación se da en el primer caso
            //si el valor del input es seleccionar se returna un valor falso
            //esto redirige el flujo al final del código
            case "- Seleccionar -":
                alert("Complete la sección de Empresa")
                return false;
            case "TECHING":
                doc.text("x", 34, 28)
                break;
            case "CONTRATISTA1":
                doc.text("x", 81.3, 28)
                doc.text(empresa.value, 94, 28.3)
                break;
            case "CONTRATISTA2":
                doc.text("x", 81.3, 28)
                doc.text(empresa.value, 94, 28.3)
                break;
        }
        return true;
    }

    //funcion que se usa para colocar las actividades
    let reconocerActividades = ()=>{
        //variables que serán utilizadas para la validación
        let val1
        let val2
        let val3
        let val4

        //la suma de las coordenadas y debe ser de 6.5 para rellenar las actividades
        //definiendo las posiciones iniciales para las actividades
        XnombreActividad = 11.5
        YnombreActividad = 58.5
        XpeligroActividad = 73.5
        YpeligroActividad = 58.5
        XriesgoActividad = 107.5
        YriesgoActividad = 58.5
        XrecomendacionActividad = 142.5
        YrecomendacionActividad = 58.5

        //nombre de las actividades
        nombresActs = document.querySelectorAll(".actividad-nombre")

        nombresActs.forEach((nombreA)=>{
            if(nombreA.value!=""){
                doc.setFontSize(9)
                doc.text(nombreA.value, XnombreActividad, YnombreActividad)
                YnombreActividad+=6.5
                //si no hay campos vacios
                val1="1"
            }else{
                //si hay campos vacios
                alert("Complete el campo 'actividades' ")
                val1="0"
            }
        })
        
        //peligros y aspecto
        peligros = document.querySelectorAll(".peligro-aspecto-nombre")

        peligros.forEach((peligro)=>{
            if(peligro.value!=""){
                doc.setFontSize(9)
                doc.text(peligro.value, XpeligroActividad, YpeligroActividad)
                YpeligroActividad+=6.5
                //si no hay campos vacios
                val2="1"
            }else{
                //si hay campos vacios
                alert("Complete el campo 'peligro actividad' ")
                val2="0"
            }
        })

        //riesgos e impactos
        riesgos = document.querySelectorAll(".riesgo-impacto-nombre")

        riesgos.forEach((riesgo)=>{
            if(riesgo.value!=""){
                doc.setFontSize(9)
                doc.text(riesgo.value, XriesgoActividad, YriesgoActividad)
                YriesgoActividad+=6.5
                //si no hay campos vacios
                val3="1"
            }else{
                //si hay campos vacios
                alert("Complete el campo 'riesgo impacto'")
                val3="0"
            }
        })

        //acciones recomendadas
        recomendaciones = document.querySelectorAll(".acciones-nombre")

        recomendaciones.forEach((recomendacion)=>{
            if(recomendacion.value!=""){
                doc.setFontSize(9)
                doc.text(recomendacion.value, XrecomendacionActividad, YrecomendacionActividad)
                YrecomendacionActividad+=6.5
                //si no hay campos vacios
                val4="1"
            }else{
                //si hay campos vacios
                alert("Complete el campo 'recomendaciones' ")
                val4="0"
            }
        })
        //si todos los campos tienen datos, sus variables tendrán un número asignado, diferente a a0
        if(val1!="0" && val2!="0" && val3!="0" && val4!="0"){
            //si los valores son diferentes a 0, esta función retornará un true
            return true;
        }else{
            //si al menos uno de los valores es 0, esta función retornará un false
            return false;
        }
    }

    //función para evaluar las casillas marcadas
    let evaluarCheckbox = () => {
        let check1 = document.getElementById("proc1")
        let check2 = document.getElementById("proc2")
        let check3 = document.getElementById("proc3")
        let check4 = document.getElementById("proc4")
        let check5 = document.getElementById("proc5")
        let check6 = document.getElementById("proc6")
        let check7 = document.getElementById("proc7")
        let check8 = document.getElementById("proc8")

        let listaCheckbox = [check1, check2, check3, check4, check5, check6, check7, check8]

        //column 1 SI
        //doc.text("x", 89.4,200.5)
        //column1 NO
        //doc.text("x", 100.4, 200.5)
        //la diferencia entre las y es de 3.5
        //para la primera columna la diferencia de las x es de 11
        //Para la segunda columa la diferencia de las x es de 13
        //column 2 SI
        //doc.text("z", 170,207.5)
        //column2 NO
        //doc.text("o", 183, 207.5)
        let contador = 1
        let colum1Y = 200.5
        let colum2Y = 200.5
        listaCheckbox.forEach(el => {
            if(contador<=4){
                if(el.checked){
                    doc.text("x", 89.4, colum1Y)
                    colum1Y+=3.5
                }else{
                    doc.text("x", 100.4, colum1Y)
                    colum1Y+=3.5
                }
            
            }else if(contador>=4){
                if(el.checked){
                    doc.text("x", 170, colum2Y)
                    colum2Y+=3.5
                }else{
                    doc.text("x", 183, colum2Y)
                    colum2Y+=3.5
                }

            }
            contador+=1
        });
        return true;
    }

    //funcion para evaluar los datos de clinica
    let evaluarClinica = () => {
        let clincaNombre = document.getElementById("clinica-nombre").value
        let clinicaDireccion = document.getElementById("clinica-direccion").value
        doc.text(clincaNombre, 44.5, 225.2)
        doc.text(clinicaDireccion, 29.5, 229)
        return true;
    }
    
    //funcion para evaluar datos de trabajadores
    let evaluarPersonas = () => {
        let vl1
        let vl2
        let vl3

        //Colocar nombres
        let nombreY = 241
        let nombresPersonas = document.querySelectorAll(".participante-nombre")
        nombresPersonas.forEach((persona)=>{
            if(persona.value!=""){
                doc.setFontSize(9)
                doc.text(persona.value, 27, nombreY)
                nombreY+=5.2
                //si persona es diferennte de vacio
                vl1="1"
            }else{
                alert("complete los datos de los participantes")
                vl1="0"
            }
        })

        //ColocarDNI
        let dniY = 241
        let dniPersonas = document.querySelectorAll(".participante-dni")
        dniPersonas.forEach((dniPersona)=>{
            if(dniPersona.value!=""){
                doc.text(dniPersona.value, 110, dniY)
                dniY+=5.2
                //si dni es diferennte de vacio
                vl2="1"
            }else{
                alert("Campo DNI vacío")
                vl2="0"
            }
        })

        //ColocarFirma
        let firmaY = 241
        let firmasPersonas = document.querySelectorAll(".participante-firma")
        firmasPersonas.forEach((firmaPersona)=>{
            if(firmaPersona.value!=""){
                doc.text(firmaPersona.value, 144, firmaY)
                firmaY+=5.2
                //si firma es diferente de vacio
                vl3="1"
            }else{
                alert("Campo firma se encuentra vacío")
                vl3="0"
            }   
        })
        //ColocarHoraIngreso
        let horaIngresoY = 241
        let horaIngresos = document.querySelectorAll(".h-ingreso")
        horaIngresos.forEach((horaIngreso)=>{
            doc.text(horaIngreso.value,166,horaIngresoY)
            horaIngresoY+=5.2
        })
        //ColocarHoraSalida
        let horaSalidaY = 241
        let horasSalida = document.querySelectorAll(".h-salida")
        horasSalida.forEach((horaSalida)=>{
            doc.text(horaSalida.value,180,horaSalidaY)
            horaSalidaY+=5.2
        })

        //si todos los campos tienen datos, sus variables tendrán un número asignado, diferente a a0
        if(vl1!="0" && vl2!="0" && vl3!="0"){
            //si los valores son diferentes a 0, esta función retornará un true
            return true;
        }else{
            //si al menos uno de los valores es 0, esta función retornará un false
            return false;
        }

    }

    let evaluarObservaciones = ()=>{
        let observaciones = document.getElementById("input-observaciones").value
        if(observaciones!=""){
            doc.setFontSize(9)
            doc.text(observaciones, 12, 274, {maxWidth: 185, lineHeightFactor: 0.8})
            return true;
        }else{
            return false;
        }
    }

    //introduciendo datos
    doc.setFontSize(10)
    //validar que todas las funciones den true, sino, parecerá el alert
    evaluarObservaciones()
    if(evaluarEmpresa() && evaluarDatosPrincipales() && reconocerActividades() && evaluarCheckbox() && evaluarClinica() && evaluarPersonas() && evaluarObservaciones()){
        var blob = doc.output("blob");
        window.open(URL.createObjectURL(blob))
    }else{
         alert("Asegúrse de competar todos los campos para generar el documento")
    }
    // evaluarEmpresa()
    // evaluarDatosPrincipales()
    // reconocerActividades()
    // evaluarCheckbox()
    // evaluarClinica()
    // evaluarPersonas()

    

    //doc.save("analisis_trabajo_seguro.pdf")
})