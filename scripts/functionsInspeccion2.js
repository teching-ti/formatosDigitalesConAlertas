let auto = document.getElementById("vehiculo-auto")
let moto = document.getElementById("vehiculo-moto")
let sectionAuto = document.querySelector(".selectores")
let sectionMoto = document.querySelector(".selectores-motorizado")

let eppMoto1 = document.getElementsByName("e9")
let eppMoto2 = document.getElementsByName("e10")
let eppMoto3 = document.getElementsByName("e11")

auto.addEventListener("click", function(){
    sectionAuto.style.display = "block"
    sectionMoto.style.display = "none"

    
    eppMoto1[3].checked = true
    eppMoto1[0].checked = false

    eppMoto2[3].checked = true
    eppMoto2[0].checked = false

    eppMoto3[3].checked = true
    eppMoto3[0].checked = false
})

moto.addEventListener("click", function(){
    sectionMoto.style.display = "grid"
    sectionAuto.style.display = "none"

    eppMoto1[3].checked = false
    eppMoto1[0].checked = true

    eppMoto2[3].checked = false
    eppMoto2[0].checked = true

    eppMoto3[3].checked = false
    eppMoto3[0].checked = true
})

//alert("Los elementos marcados de color rojo con un (*), son obligatorios")
let fecha = document.getElementById("fecha")
let fechaActual= new Date().toLocaleDateString('es-ES', { day: '2-digit', month: '2-digit', year: 'numeric' })
fecha.value = fechaActual
//esta es la fecha en que se realiza la inspección

function validarFechas(campoFecha){

    let fechaIngresada = campoFecha
    let fechaEvaluar = new Date(fechaIngresada.value)

    let fechaMinima = new Date(2020, 1, 1)

    let fechaMaxima = new Date(2999, 1, 1)
    
    if (fechaEvaluar < fechaMinima || fechaEvaluar>fechaMaxima) {
        alert("Ingrese una fecha adecuada para el vencimiento de la revisión técnica.");
        fechaIngresada.value = ""// Limpiar el campo de entrada
        return false
    }

    return true

}

let fechaVencimientoRt = document.getElementById("vencimiento-revision-tecnica")
let fechaVencimientoSOAT = document.getElementById("vencimiento-soat")
let fechaVencimiento = document.getElementById("fecha-vencimiento")


fechaVencimientoRt.addEventListener("blur", function(){
    validarFechas(fechaVencimientoRt)

})
fechaVencimientoSOAT.addEventListener("blur", function(){
    validarFechas(fechaVencimientoSOAT)
})
fechaVencimiento.addEventListener("blur", function(){
    validarFechas(fechaVencimiento)
})



//obtener los datos del archivo
//uso de una petición fetch
fetch("../scripts/datos.json")
  .then((response) => response.json())
  .then((data) => {
    //la data obtenida será nombrada como users
    users = data;
    choferAyudanteData = users.tecnico.filter((tecnico) => tecnico.cargo === 'Chofer Ayudante de Balance')
    //cargar nombre de los choferes
    llenarSelect(document.getElementById("nombre-conductor"))
    //autocompletar firmas
    AutocompletarFirma(document.getElementById("nombre-conductor"), document.getElementById("firma-conductor"))
    
  })
  .catch((error) => console.error("Error al cargar los datos:", error));

  //cargar nombre de los choferes
  function llenarSelect(selector){
    
    choferAyudanteData.forEach(u=>{
        let opcion = document.createElement("option")
        opcion.innerText = u.name
        selector.appendChild(opcion)
    })
  }

  //autocompletar firmas
  function AutocompletarFirma(selector, inputFirma){
    selector.addEventListener("change", function(){
        let nombreSeleccionado = selector.value
        let usuarioSeleccionado = choferAyudanteData.find(
            (chofer) => chofer.name === nombreSeleccionado
        )

    inputFirma.value = usuarioSeleccionado.firma
    })
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
    //doc, objeto
    var doc = new jsPDF();
    //imagen del documento vacía
    const image = await loadImage("../recursos/formatoInspeccionVehicular21.jpg");
    doc.addImage(image, "jpg", 0, 0, 210, 295);
    doc.setFontSize(6)

    let evaluar = true
    function evaluarDatosGenerales(){
        doc.setFontSize(6)
        let dia = fecha
        let placa = document.getElementById("placa").value.toUpperCase()
        let tarjeta = document.getElementById("tarjeta-propiedad").value
        let empresa = document.getElementById("empresa").value
        let lentes = document.getElementById("usa-lentes") //es checkbox
        let inicio = document.getElementById("inicio-km").value
        let final = document.getElementById("final-km").value
        let soat = document.getElementById("numero-soat").value
        let eSoat = document.getElementById("empresa-soat").value


        let partesFecha = fechaVencimientoSOAT.value.split("-")
        let vSeparado = new Date(partesFecha[0], partesFecha[1] - 1, partesFecha[2]);
        let vSoatF = vSeparado.toLocaleDateString('es-ES', { day: '2-digit', month: '2-digit', year: 'numeric' })
        
        let horaInspeccion = document.getElementById("hora-inspeccion").value

        partesFecha = fechaVencimientoRt.value.split("-")
        vSeparado = new Date(partesFecha[0], partesFecha[1] - 1, partesFecha[2])
        let vRevTecF = vSeparado.toLocaleDateString('es-ES', { day: '2-digit', month: '2-digit', year: 'numeric' })

        let numBrevete = document.getElementById("numero-brevete").value
        let categoria = document.getElementById("categoria").value.toUpperCase()

        partesFecha = fechaVencimiento.value.split("-")
        vSeparado = new Date(partesFecha[0], partesFecha[1] - 1, partesFecha[2])
        let vencimiento = vSeparado.toLocaleDateString('es-ES', { day: '2-digit', month: '2-digit', year: 'numeric' })

        if(placa!="" && tarjeta!="" && empresa!="" && inicio!="" && final!="" && soat!="" && horaInspeccion!="" && vRevTecF!="Invalid Date" && vSoatF!="Invalid Date" && vencimiento!="Invalid Date"){

            //fecha de inspeccion
            doc.text(fecha.value, 177, 40.5)
            doc.text(empresa, 36.5, 25.2)
            doc.text(placa, 36.5, 28.8)
            doc.text(tarjeta, 36.5, 32.8)
            doc.text(vRevTecF, 36.5, 42)
            
            doc.text(numBrevete, 165, 28.8)
            doc.text(categoria, 165, 32.5)

            if(lentes.checked){
                doc.text("x", 177, 20)
            }else{
                doc.text("x", 189.6, 20)
            }
            doc.setFontSize(4.5)
            doc.text(inicio, 175., 24.5)
            doc.text(final, 197.5, 24.5)
            doc.setFontSize(6)
            doc.text(soat, 87, 28.8)
            doc.text(eSoat, 87, 32.7)
            doc.text(vSoatF, 87, 36.2)
            doc.text(horaInspeccion, 177, 43.8)
            doc.text(vencimiento, 165, 37)
        }else{
            evaluar = false
        }

        if(evaluar){
            return true
        }else{
            alert("Complete todos los campos de Datos Generales")
            return false
        }
    }

    function evaluarNombre(){
        let nombreConductor = document.getElementById("nombre-conductor").value
        let firmaConductor = document.getElementById("firma-conductor").value

        if(nombreConductor!="" && firmaConductor!=""){
            doc.text(nombreConductor, 36.5, 20.7)
            doc.addImage(firmaConductor, "PNG", 34, 272, 35, 5.8)
        }else{
            evaluar = false
        }
        
        if(evaluar){
            return true
        }else{
            alert("Seleccionar el nombre del conductor")
            return false
        }
    }

    function evaluarObservaciones(){
        let observaciones = document.getElementById("observaciones").value
        doc.text(observaciones, 6.5, 255.4, {
            maxWidth: 192,
            lineHeightFactor: 1.48, 
            align: "justify"
        })
        
        
        return true
    }

    function evaluarTodoVehiculo(){
        let positionY = 68
        let contarSaltoX = 0
        let contadorEspacio = 0

        doc.setFontSize(4.6)
        //evaluando los radio button
        let tv = document.querySelector(".selectores-todo-vehiculo").querySelectorAll(".selector-elemento")
        tv.forEach(t=>{
            inputsEvaluar = t.querySelectorAll("input")
            inputsEvaluar.forEach((i)=>{
                
                if(i.checked){

                    if(contarSaltoX<10){
                        doc.text(i.value, 51.75, positionY,{ align: "center"})
                    }else if(10<=contarSaltoX && contarSaltoX<=19){
                        doc.text(i.value, 121.3, positionY,{ align: "center"})
                    }else if(19<contarSaltoX){
                        doc.text(i.value, 181.4, positionY,{ align: "center"})
                    }
                    
                    if(contadorEspacio==4){
                        positionY+=5.2
                    }else if(contadorEspacio==14){
                        positionY+=5.2
                    }else if(contadorEspacio==24){
                        positionY+=5.2
                    }else{
                        positionY+=3.86
                    }
                    
                    contarSaltoX+=1
                    contadorEspacio+=1

                    if(contarSaltoX%10==0){
                        positionY=68
                    }
                }

            })
        })

        positionY = 68
        contarSaltoX = 0
        contadorEspacio = 0

        //evaluando los select
        tv.forEach(s=>{
            selectEvaluar = s.querySelectorAll("select")
            selectEvaluar.forEach((se)=>{
                
                if(contarSaltoX<10){
                    doc.text(se.value, 60.5, positionY,{ align: "center"})
                }else if(10<=contarSaltoX && contarSaltoX<=19){
                    doc.text(se.value, 131, positionY,{ align: "center"})
                }else if(19<contarSaltoX){
                    doc.text(se.value, 196.5, positionY,{ align: "center"})
                }
                
                if(contadorEspacio==4){
                    positionY+=5.2
                }else if(contadorEspacio==14){
                    positionY+=5.2
                }else if(contadorEspacio==24){
                    positionY+=5.2
                }else{
                    positionY+=3.8
                }
                
                contarSaltoX+=1
                contadorEspacio+=1

                if(contarSaltoX%10==0){
                    positionY=68
                }
            })
        })
        return true
    }

    function evaluarLLantas(){
        let cl = document.querySelector(".contenedor-llantas").querySelectorAll(".selector-elemento")
        positionLlantasY = 111.8
        cl.forEach(c=>{
            inputsEvaluar = c.querySelectorAll("input")
            inputsEvaluar.forEach((i)=>{
                if(i.checked){
                    doc.text(i.value, 51.75, positionLlantasY,{
                        align: "center"
                    })
                    positionLlantasY+=3.8
                }
            })
        })

        positionLlantasY = 111.8
        cl.forEach(c=>{
            selectEvaluar = c.querySelectorAll("select")
            selectEvaluar.forEach((i)=>{
                doc.text(i.value, 60.5, positionLlantasY,{ align: "center"} )
                positionLlantasY += 3.8
            })
        })

        return true
    }


    function evaluarAccesorios(){
        let cl = document.querySelector(".contenedor-accesorios").querySelectorAll(".selector-elemento")
        positionY = 111.8
        cl.forEach(c=>{
            inputsEvaluar = c.querySelectorAll("input")
            inputsEvaluar.forEach((i)=>{
                if(i.checked){
                    doc.text(i.value, 121.3, positionY,{
                        align: "center"
                    })
                    positionY+=3.8
                }
            })
        })

        positionY = 111.8
        cl.forEach(c=>{
            selectEvaluar = c.querySelectorAll("select")
            selectEvaluar.forEach((i)=>{
                doc.text(i.value, 131, positionY,{ align: "center"} )
                positionY += 3.8
            })
        })

        return true
    }

    function evaluarTapas(){
        let cl = document.querySelector(".contenedor-tapas").querySelectorAll(".selector-elemento")
        positionY = 111.8
        cl.forEach(c=>{
            inputsEvaluar = c.querySelectorAll("input")
            inputsEvaluar.forEach((i)=>{
                if(i.checked){
                    doc.text(i.value, 181.4, positionY,{
                        align: "center"
                    })
                    positionY+=3.8
                }
            })
        })

        positionY = 111.8
        cl.forEach(c=>{
            selectEvaluar = c.querySelectorAll("select")
            selectEvaluar.forEach((i)=>{
                doc.text(i.value, 196.5, positionY,{ align: "center"} )
                positionY += 3.8
            })
        })

        return true
    }

    function evaluarMoto(){
        doc.setFontSize(4.6)
        
        let positionY = 139
        let contarSaltoX = 0
        let contadorEspacio = 0

        let motos = document.querySelectorAll(".selector-motorizado")
        motos.forEach(mt=>{
            inputsEvaluar = mt.querySelectorAll("input")
            inputsEvaluar.forEach(i=>{
                if(i.checked){

                    if(contarSaltoX<4){
                        doc.text(i.value, 51.75, positionY, {
                            align: "center"
                        })
                    }else if(4<=contarSaltoX && contarSaltoX<=7){
                        doc.text(i.value, 121.3, positionY, {
                            align: "center"
                        })
                    }else{
                        doc.text(i.value, 181.4, positionY, {
                            align: "center"
                        })
                    }
                    
                    if(contadorEspacio==2){
                        positionY+=7
                    }else if(contadorEspacio==6){
                        positionY+=7
                    }else{
                        positionY+=3.6
                    }

                    contarSaltoX+=1
                    contadorEspacio+=1

                    if(contarSaltoX%4==0){
                        positionY=139
                    }

                }
            })
        })

        positionY = 139
        contarSaltoX = 0
        contadorEspacio = 0

        motos.forEach(mt=>{
            inputsEvaluar = mt.querySelectorAll("select")
            inputsEvaluar.forEach(i=>{
       
                if(contarSaltoX<4){
                    doc.text(i.value, 60.5, positionY, {
                        align: "center"
                    })
                }else if(4<=contarSaltoX && contarSaltoX<=7){
                    doc.text(i.value, 131, positionY, {
                        align: "center"
                    })
                }else{
                    doc.text(i.value, 196.5, positionY, {
                        align: "center"
                    })
                }
                    
                if(contadorEspacio==2){
                    positionY+=7
                }else if(contadorEspacio==6){
                    positionY+=7
                }else{
                    positionY+=3.6
                }

                contarSaltoX+=1
                contadorEspacio+=1

                if(contarSaltoX%4==0){
                    positionY=139
                }
            })
        })
        return true
    }

    function evaluarEpp(){
        let contenedoresEpp = document.querySelectorAll(".elemento-epp")
        positionY = 175
        contenedoresEpp.forEach(c=>{
            elemento = c.querySelectorAll("input")
            elemento.forEach(i=>{
                if(i.checked){
                    doc.text(i.value, 56.5, positionY,{
                        align: "center"
                    } )
                    positionY+=3.8
                }
            })
        })

        positionY = 175
        contenedoresEpp.forEach(c=>{
            elemento = c.querySelectorAll("select")
            elemento.forEach(i=>{

                    doc.text(i.value, 75.5, positionY,{
                        align: "center"
                    } )
                    positionY+=3.8
            })
        })
        
        return true
    }

    function evaluarPma(){
        let contenedoresPma = document.querySelectorAll(".elemento-pma")
        positionY = 222
        contenedoresPma.forEach(c=>{
            elemento = c.querySelectorAll("input")
            elemento.forEach(i=>{
                if(i.checked){
                    doc.text(i.value, 56.5, positionY,{
                        align: "center"
                    } )
                    positionY+=3.8
                }
            })
        })

        positionY = 222
        contenedoresPma.forEach(c=>{
            elemento = c.querySelectorAll("select")
            elemento.forEach(i=>{

                    doc.text(i.value, 75.5, positionY,{
                        align: "center"
                    } )
                    positionY+=3.8
            })
        })
        
        return true
    }

    function evaluarConductor(){
        evaluar = true

        let eval1 = document.getElementById("ev-conductor1")
        let eval2 = document.getElementById("ev-conductor2")

        if(!eval1.checked  || !eval2.checked){
            alert("Ambas casillas de evaluación deben estar marcadas")
            evaluar = false
            return evaluar
        }
        doc.setFontSize(9)
        doc.setTextColor(0, 0, 150);
        doc.text("X", 172.8, 240)
        doc.text("X", 172.8, 244)

        return evaluar
    }

    /*datos del supervisor directamente al documento*/
    
    doc.setFontSize(5.2)
    doc.text("Roberto Carlos Luis Bailon", 36.5, 36.5)
    doc.text("Roberto Carlos Luis Bailon", 170, 286.8, {
        maxWidth: "32"
    })
    doc.addImage("../recursos/firmas/RobertoLuisBailon.png", "PNG", 156, 272,  35, 5.8)

    if(auto.checked){

        if(evaluarDatosGenerales() && evaluarNombre() && evaluarObservaciones() && evaluarTodoVehiculo() && evaluarLLantas() && evaluarAccesorios() && evaluarTapas() && evaluarEpp() && evaluarPma() && evaluarConductor()){
            /*var blob = doc.output("blob");
            window.open(URL.createObjectURL(blob));*/
            fechaActual.replace("/","_")
            doc.save(`INSPECCION_VEHICULAR_${fechaActual}.pdf`)
        }else{
            alert("Completar todos los campos")
        }
    }else if(moto.checked){

        if(evaluarDatosGenerales() && evaluarNombre() && evaluarObservaciones() && evaluarMoto() && evaluarEpp() && evaluarPma() && evaluarConductor()){
            /*var blob = doc.output("blob");
            window.open(URL.createObjectURL(blob));*/
            fechaActual.replace("/","_")
            doc.save(`INSPECCION_VEHICULAR_${fechaActual}.pdf`)
        }else{
            alert("Completar todos los campos")
        }
    }
  })