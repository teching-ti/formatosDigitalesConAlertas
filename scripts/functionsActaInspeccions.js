let fecha = document.getElementById("fecha");
let fechaActual = new Date().toLocaleDateString();
fecha.value = fechaActual;

//obtener los datos del archivo
//uso de una petición fetch
fetch("../scripts/datos.json")
  .then((response) => response.json())
  .then((data) => {
    //la data obtenida será nombrada como users
    users = data;
    llenarSelect(document.getElementById("jefe-cuadrilla"))
    autocompletarInformacion(document.getElementById("jefe-cuadrilla"), document.getElementById("nombres"), document.getElementById("apellidos"), document.getElementById("firma"), document.getElementById("dni"))

  })
  .catch((error) => console.error("Error al cargar los datos:", error));

//funcion para seleccionar entre los responsables de cuadrilla y el supervisor
function llenarSelect(elemento) {

  //obtiene los datos de los técnicos responsables de cuadrilla
  //y el autocompletado solo funciona para los responsables de cuadrilla
  users.tecnico.forEach((tecnico) => {
      const option = document.createElement("option");
      option.value = tecnico.name;

      if(tecnico.cargo=="Jefe Cuadrilla de Balance"){
         option.textContent = tecnico.name;
         //agrega los elementos obtenidos al select
         elemento.appendChild(option);
      }
  });
}

function autocompletarInformacion(elementoSelect, dato, dato1, dato2, dato3){
    elementoSelect.addEventListener("change", function(){
        const nombreSeleccionado = elementoSelect.value;
        if(nombreSeleccionado!="" && nombreSeleccionado!="Seleccionar"){
            const usuarioSeleccionado = users.tecnico.find(
                (tecnico) => tecnico.name === nombreSeleccionado
            );

            if (usuarioSeleccionado) {
                dato.value = usuarioSeleccionado.nombres
                dato1.value = usuarioSeleccionado.apellidos
                dato2.value = usuarioSeleccionado.firma
                dato3.value = usuarioSeleccionado.dni
            }
        }
    })
}

const jsPDF = window.jspdf.jsPDF;

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

    e.preventDefault()
    //doc, objeto
    //dimensiones del documento pdf
    var doc = new jsPDF();
    //imagen del documento vacía
    const image = await loadImage("../recursos/formatoActaInspeccion.jpg");
    //colocar la imagen
    //colocar imagen desde una posicion en especifico, con las dimensiones especificas
    doc.addImage(image, "JPG", 0, 0, 210, 297);
    doc.setFontSize(6.5)
    let eval = true

    function evaluarDatosGenerales(){
        let subestacion = document.getElementById("subestacion").value
        let tiposed = document.getElementById("tipo-sed").value
        let nivel_tension = document.getElementById("nivel-tension").value
        let cliente   = document.getElementById("cliente").value
        let ubicacion = document.getElementById("ubicacion").value
        let fecha = document.getElementById("fecha").value
        let hora_inicio = document.getElementById("h-inicio").value
        let hora_final = document.getElementById("h-fin").value

        let datosGenerales = [subestacion, tiposed, nivel_tension, cliente, ubicacion, fecha, hora_inicio, hora_final]

        let col1X = 40
        let col2X = 100
        let datosX = 90
        let datosY = 47.5
        let datosYc2 = 47.5
        let cont = 1

        datosGenerales.forEach(e=>{
            if(cont<4){
                if(e!=""){
                    doc.text(e, col1X, datosY)
                    datosY+=4.6
                }else{
                    eval = false
                }
                cont+=1
            }else if(cont<=5){
                if(e!=""){
                    doc.text(e, col2X, datosYc2)
                    datosYc2+=4.6
                }else{
                    eval = false
                }
                cont+=1
            }else{
               datosY = 56.7
                if(e!=""){
                    doc.text(e, datosX, datosY)
                    datosX+=38
                }else{
                    eval = false;
                }
            }
        })

        if(eval==false){
            alert("Debe completar todos los campos de datos generales")
            return
        }

    }

    function evaluarSituacionEncontrada(){
      doc.setFontSize(12)
      doc.setTextColor(0, 0, 225);
      let opcionesSituacion1 = document.querySelectorAll(".situacion-encontrada-1")
      opcionesSituacion1.forEach(e=>{
         if(e.checked){
            if(e.value==1){
               doc.text("X", 98, 70.6)
            }else{
               doc.text("X", 158, 70.6)
            }
         }
      })

      let opcionesSituacion2 = document.querySelectorAll(".situacion-encontrada-2")
      opcionesSituacion2.forEach(e=>{
         if(e.checked){
            if(e.value==1){
               doc.text("X", 98, 75.4)
            }else{
               doc.text("X", 158, 75.4)
            }  
         }
      })
    }

    function evaluarDatosInspeccion(){
        let contador = 1
        //la lógica es la siguiente
        //primero se selecciona a todos los contenedores principales de 'Datos de inspeccion'
        document.querySelectorAll(".contenedor-dato-inspeccion").forEach(e=>{
            //Luego se selecciona solo a sus input, ya que estos son los que serán evaluados
            let inputs = e.querySelectorAll("input[type='radio']:checked")
            //Se recorre cada uno de  los input existentes dentro de uno de los contenedores
            inputs.forEach(function(i){
                //la aplicaicon de un contador sería útil para que se ejecute una lógica difrente
                //según el número de contenedor que esté siendo utilizado

                switch (contador){
                    case 1:
                        if(i.value==1){
                            console.log("Se imprimirá la marca en x:21")
                        }else if(i.value==2){
                            console.log("Se imprimirá la marca en x:40")
                        }else if(i.value==3){
                            console.log("Se imprimirá la marca en x:64")
                        }else if(i.value==4){
                            console.log("Se imprimirá la marca en x:88")
                        }else if(i.value==5){
                            console.log("Se imprimirá la marca en x:100")
                        }else{
                            console.log("Se imprimirá la marca en x:120")
                        }
                        break;
                    case 2:
                    case 3:
                    case 4:  
                    case 7:
                    case 9:
                    case 10:
                    case 12:
                        if(i.checked){
                            console.log(i.value)
                        }
                        break;
                    case 5:
                        if(i.checked){
                            console.log(i.value)
                        } 
                        break;
                    case 6:
                        if(i.checked){
                            console.log(i.value)
                        } 
                        break;
                    case 8:
                        if(i.checked){
                            console.log(i.value)
                        } 
                        break;
                    case 11:
                        if(i.checked){
                            console.log(i.value)
                        } 
                        break;
                    case 13:
                        if(i.checked){
                            console.log(i.value)
                        } 
                        break;
                    case 14:
                        if(i.checked){
                            console.log(i.value)
                        } 
                        break;
                    case 15:
                        if(i.checked){
                            console.log(i.value)
                        } 
                        break;
                    
                }

            })
            contador+=1
        })
        
    }

    function evaluarObservaciones(){
        doc.setFontSize(8)
        doc.setTextColor(0, 0,0)
        let observaciones = document.getElementById("t-observaciones").value
        let textY = 185.4
        doc.text(observaciones, 21, textY, {
            maxWidth: 168,
            lineHeightFactor : 1.75,
            align: "justify"
        })
    }

    function evaluarRecomendaciones(){
        let observaciones = document.getElementById("t-recomendaciones").value
        let textY = 213
        doc.text(observaciones, 21, textY, {
            maxWidth: 168,
            lineHeightFactor : 1.75,
            align: "justify"
        })
    }

    function evaluarJefeCuadrilla(){
        //let jefeCuadrilla = document.getElementById("jefe-cuadrilla").value
        doc.setFontSize(7)
        let nombres = document.getElementById("nombres").value.toUpperCase()
        let apellidos = document.getElementById("apellidos").value.toUpperCase()
        let dni = document.getElementById("dni").value
        let firma = document.getElementById("firma").value

        let firmaSupervisor = "../recursos/firmas/RobertoLuisBailon.png"
        //let firmaResponsable = "../recursos/firmas/.png"
        //falta la firma de luis paredes

        doc.text(nombres, 98, 249)
        doc.text(apellidos, 98, 253.4)
        doc.text(dni, 92, 257.8)
        doc.addImage(firma, "PNG", 90, 229, 30, 10)
        //aquí también se colocará la firma del supervisor y responsable del proyecto
        doc.addImage(firmaSupervisor, "PNG", 40, 229, 30, 10)

    }

    //ejecutar funciones en orden de creacion
    evaluarDatosGenerales()
    evaluarSituacionEncontrada()
    evaluarDatosInspeccion()
    evaluarObservaciones()
    evaluarRecomendaciones()
    evaluarJefeCuadrilla()

    if(eval){
        var blob = doc.output("blob");
        window.open(URL.createObjectURL(blob));

        /*fechaActual = fechaActual.replace(/\//g, "_")
        const nombreDocumento = `INSPECCION_DE_ESCALERA_${fechaActual}.pdf`
        doc.save(nombreDocumento)
        //endodear el resultado del pdf
        var file_data = btoa(doc.output())
        var form_data = new FormData()

        form_data.append("file", file_data)
        form_data.append("nombre", "INSPECCION_DE_ESCALERA")
        //alert(form_data)
        $.ajax({
            url: "../envios/enviar_alerta.php",
            dataType: "text",
            cache: false,
            contentType: false,
            processData: false,
            data: form_data,
            type:"post",
            success: function(php_script_response){
                alert("Archivo generado correctamente")
            }
        })*/
    }else{
      alert("Debe completar datos")
    }
})