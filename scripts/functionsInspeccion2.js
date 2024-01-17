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
    const image = await loadImage("../recursos/fInspeccionVehicular.jpg");
    doc.addImage(image, "jpg", 0, 0, 210, 295);
    doc.setFontSize(6)

    let evaluar = true
    function evaluarDatosGenerales(){
        doc.setFontSize(6)
        let dia = fecha
        let placa = document.getElementById("placa").value
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
        let categoria = document.getElementById("categoria").value  

        partesFecha = fechaVencimiento.value.split("-")
        vSeparado = new Date(partesFecha[0], partesFecha[1] - 1, partesFecha[2])
        let vencimiento = vSeparado.toLocaleDateString('es-ES', { day: '2-digit', month: '2-digit', year: 'numeric' })

        if(placa!="" && tarjeta!="" && empresa!="" && inicio!="" && final!="" && soat!="" && horaInspeccion!="" && vRevTecF!="Invalid Date" && vSoatF!="Invalid Date" && vencimiento!="Invalid Date"){
            console.log(vSoatF)
            //fecha de inspeccion
            doc.text(fecha.value, 178, 43)
            doc.text(empresa, 40, 30.6)
            doc.text(placa, 40, 33.8)
            doc.text(tarjeta, 40, 37)
            doc.text(vRevTecF, 40, 45)
            
            doc.text(numBrevete, 166, 33.8)
            doc.text(categoria, 166, 37)

            if(lentes.checked){
                doc.text("x", 178.3, 27.25)
            }else{
                doc.text("x", 190.8, 27.25)
            }
            doc.setFontSize(4.5)
            doc.text(inicio, 177, 30.6)
            doc.text(final, 199.5, 30.6)
            doc.setFontSize(6)
            doc.text(soat, 90, 33.8)
            doc.text(eSoat, 90, 37)
            doc.text(vSoatF, 90, 40.2)
            doc.text(horaInspeccion, 180, 47.2)
            doc.text(vencimiento, 166, 40.2)
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
            doc.text(nombreConductor, 40, 27.6)
            doc.addImage(firmaConductor, "PNG", 34, 264, 35, 5.8)
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
        doc.text(observaciones, 6.5, 238, {
            maxWidth: 192,
            lineHeightFactor: 1.48, 
            align: "justify"
        })
        
        
        return true
    }

    function evaluarTodoVehiculo(){
        let positionY = 72.5
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
                        doc.text(i.value, 54.4, positionY,{ align: "center"})
                    }else if(10<=contarSaltoX && contarSaltoX<=19){
                        doc.text(i.value, 116.5, positionY,{ align: "center"})
                    }else if(19<contarSaltoX){
                        doc.text(i.value, 176, positionY,{ align: "center"})
                    }
                    
                    if(contadorEspacio==4){
                        positionY+=4.2
                    }else if(contadorEspacio==14){
                        positionY+=4.2
                    }else if(contadorEspacio==24){
                        positionY+=4.2
                    }else{
                        positionY+=3.6
                    }
                    
                    contarSaltoX+=1
                    contadorEspacio+=1

                    if(contarSaltoX%10==0){
                        positionY=60
                    }
                }

            })
        })

        positionY = 60
        contarSaltoX = 0
        contadorEspacio = 0

        //evaluando los select
        tv.forEach(s=>{
            selectEvaluar = s.querySelectorAll("select")
            selectEvaluar.forEach((se)=>{
                
                if(contarSaltoX<10){
                    doc.text(se.value, 61, positionY,{ align: "center"})
                }else if(10<=contarSaltoX && contarSaltoX<=19){
                    doc.text(se.value, 128.5, positionY,{ align: "center"})
                }else if(19<contarSaltoX){
                    doc.text(se.value, 194, positionY,{ align: "center"})
                }
                
                if(contadorEspacio==4){
                    positionY+=4.2
                }else if(contadorEspacio==14){
                    positionY+=4.2
                }else if(contadorEspacio==24){
                    positionY+=4.2
                }else{
                    positionY+=3.6
                }
                
                contarSaltoX+=1
                contadorEspacio+=1

                if(contarSaltoX%10==0){
                    positionY=60
                }
            })
        })
        return true
    }

    function evaluarLLantas(){
        let cl = document.querySelector(".contenedor-llantas").querySelectorAll(".selector-elemento")
        positionLlantasY = 105.5
        cl.forEach(c=>{
            inputsEvaluar = c.querySelectorAll("input")
            inputsEvaluar.forEach((i)=>{
                if(i.checked){
                    doc.text(i.value, 48.9, positionLlantasY,{
                        align: "center"
                    })
                    positionLlantasY+=4.2
                }
            })
        })

        positionLlantasY = 105.5
        cl.forEach(c=>{
            selectEvaluar = c.querySelectorAll("select")
            selectEvaluar.forEach((i)=>{
                doc.text(i.value, 61, positionLlantasY,{ align: "center"} )
                positionLlantasY += 4.2
            })
        })

        return true
    }


    function evaluarAccesorios(){
        let cl = document.querySelector(".contenedor-accesorios").querySelectorAll(".selector-elemento")
        positionY = 105.5
        cl.forEach(c=>{
            inputsEvaluar = c.querySelectorAll("input")
            inputsEvaluar.forEach((i)=>{
                if(i.checked){
                    doc.text(i.value, 116.5, positionY,{
                        align: "center"
                    })
                    positionY+=4.2
                }
            })
        })

        positionY = 105.5
        cl.forEach(c=>{
            selectEvaluar = c.querySelectorAll("select")
            selectEvaluar.forEach((i)=>{
                doc.text(i.value, 128.5, positionY,{ align: "center"} )
                positionY += 4.2
            })
        })

        return true
    }

    function evaluarTapas(){
        let cl = document.querySelector(".contenedor-tapas").querySelectorAll(".selector-elemento")
        positionY = 105.5
        cl.forEach(c=>{
            inputsEvaluar = c.querySelectorAll("input")
            inputsEvaluar.forEach((i)=>{
                if(i.checked){
                    doc.text(i.value, 176, positionY,{
                        align: "center"
                    })
                    positionY+=4.2
                }
            })
        })

        positionY = 105.5
        cl.forEach(c=>{
            selectEvaluar = c.querySelectorAll("select")
            selectEvaluar.forEach((i)=>{
                doc.text(i.value, 194, positionY,{ align: "center"} )
                positionY += 4.2
            })
        })

        return true
    }

    function evaluarEpp(){
        let contenedoresEpp = document.querySelectorAll(".elemento-epp")
        positionY = 159
        contenedoresEpp.forEach(c=>{
            elemento = c.querySelectorAll("input")
            elemento.forEach(i=>{
                if(i.checked){
                    doc.text(i.value, 55, positionY,{
                        align: "center"
                    } )
                    positionY+=4.1
                }
            })
        })

        positionY = 159
        contenedoresEpp.forEach(c=>{
            elemento = c.querySelectorAll("select")
            elemento.forEach(i=>{

                    doc.text(i.value, 74, positionY,{
                        align: "center"
                    } )
                    positionY+=4.1
            })
        })
        
        return true
    }

    function evaluarPma(){
        let contenedoresPma = document.querySelectorAll(".elemento-pma")
        positionY = 198.3
        contenedoresPma.forEach(c=>{
            elemento = c.querySelectorAll("input")
            elemento.forEach(i=>{
                if(i.checked){
                    doc.text(i.value, 55, positionY,{
                        align: "center"
                    } )
                    positionY+=4.9
                }
            })
        })

        positionY = 198.2
        contenedoresPma.forEach(c=>{
            elemento = c.querySelectorAll("select")
            elemento.forEach(i=>{

                    doc.text(i.value, 74, positionY,{
                        align: "center"
                    } )
                    positionY+=4.7
            })
        })
        
        return true
    }


    /*datos del supervisor directamente al documento*/
    doc.text("Roberto Carlos Luis Bailon", 171.5, 278.5, {
        align: "center"
    })
    doc.addImage("../recursos/firmas/RobertoLuisBailon.png", "PNG", 153, 268,  35, 5.8)

    if(/*evaluarDatosGenerales() && evaluarNombre() && */evaluarObservaciones() && evaluarTodoVehiculo()    /* && evaluarLLantas() && evaluarAccesorios() && evaluarTapas() && evaluarEpp() && evaluarPma()*/){
        var blob = doc.output("blob");
        window.open(URL.createObjectURL(blob));
        //fechaActual.replace("/","_")
        //doc.save(`INSPECCION_VEHICULAR_${fechaActual}.pdf`)
    }else{
        //alert("Completar todos los campos")
    }

    
  })