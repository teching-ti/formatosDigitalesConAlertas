let fecha = document.getElementById("fecha")
let fechaActual = new Date().toLocaleDateString()
fecha.value = fechaActual

//obtener los datos del archivo
//uso de una petición fetch
fetch("../scripts/datos.json")
  .then((response) => response.json())
  .then((data) => {
    //la data obtenida será nombrada como users
    users = data;

    llenarSelect(document.querySelector(".nombre-participante"))
    autocompletarCampos(document.querySelector(".nombre-participante"), document.querySelector(".contenedor-personal"))
    

    //Para la parte de autorización
    llenarSelect(document.querySelector("#responsable"))
    autocompletarCamposSup(document.querySelector("#responsable"), document.querySelector(".contenedor-resp"))

    //colocar las firmas del supervisor y prevencionista
    document.getElementById("supervisor-firma").value = users.supervisor[0].firma
    document.getElementById("prevencionista-firma").value = users.prevencionista[0].firma
    
  })
  .catch((error) => console.error("Error al cargar los datos:", error));

  function llenarSelect(elementoSelect) {
    users.tecnico.forEach((tecnico) => {
      const option = document.createElement("option");
      option.value = tecnico.name;
      option.textContent = tecnico.name;
      elementoSelect.appendChild(option);
    });
  }

  //datos personal será el elemento donde se encuentran todos los elementos a modificar
  function autocompletarCampos(elementoSelect, datosPersonal) {
    elementoSelect.addEventListener("change", function () {
      const nombreSeleccionado = elementoSelect.value;
      const usuarioSeleccionado = users.tecnico.find(
        (tecnico) => tecnico.name === nombreSeleccionado
      );

      datosPersonal.querySelector(".ocupacion").value =
        usuarioSeleccionado.cargo;
        datosPersonal.querySelector(".firma-inicio").value =
        usuarioSeleccionado.firma;
        datosPersonal.querySelector(".firma-salida").value =
        usuarioSeleccionado.firma;
    });
  }
  
  function autocompletarCamposSup(elementoSelect, df) {
    elementoSelect.addEventListener("change", function () {
      const nombreSeleccionado = elementoSelect.value;
      const usuarioSeleccionado = users.tecnico.find(
        (tecnico) => tecnico.name === nombreSeleccionado
      );
        df.querySelector(".a-s-firma").value =
        usuarioSeleccionado.firma;
    });
  }
  

  let contenedorPersonas = document.querySelector(".section-todo-personal")
  let btnAgregarPersona = document.querySelector(".agregar-personal")

  //Solo se podrán agregar 3 equipos/materiales adicionales
  btnAgregarPersona.addEventListener("click", function(){
    let numPersonasCreadas = document.querySelectorAll(".creado").length
    if(numPersonasCreadas<6){
        agregarPersonal()
    }else{
      alert("Se ha alcanzado el máximo número permitido")
    }
  })


  //antes del agregar al personal agregar llamar al boton para luego comparar el número de participantes
  function agregarPersonal(){

    let contenedorPersonal = document.createElement("div")
    contenedorPersonal.classList.add("contenedor-personal")
    contenedorPersonal.classList.add("creado")

    let nombrePersonal = document.createElement("select")
    nombrePersonal.classList.add("nombre-participante")
    let option0 = document.createElement("option");
    option0.textContent = "-Seleccionar-"
    nombrePersonal.appendChild(option0)

    let ocupacion = document.createElement("input")
    ocupacion.classList.add("ocupacion")
    ocupacion.placeholder = "Ocupación."
    ocupacion.setAttribute("readonly", true)

    let firmaInicio = document.createElement("input")
    firmaInicio.classList.add("firma-personal")
    firmaInicio.classList.add("firma-inicio")

    let firmaSalida = document.createElement("input")
    firmaSalida.classList.add("firma-personal")
    firmaSalida.classList.add("firma-salida")

    let btnEliminarPersona = document.createElement('div');
    let iEliminar = document.createElement("i")
    iEliminar.classList.add("fa-solid")
    iEliminar.classList.add("fa-user-minus")
    btnEliminarPersona.appendChild(iEliminar)

    llenarSelect(nombrePersonal)
    autocompletarCampos(nombrePersonal, contenedorPersonal)    
    //btnEliminarPersona.textContent = 'Eliminar ';
    btnEliminarPersona.classList.add("btn-eliminar-persona")
    btnEliminarPersona.addEventListener('click', function() {
      // Eliminar la tarea al hacer clic en el botón de eliminar
      contenedorPersonas.removeChild(contenedorPersonal);
    });

    contenedorPersonal.append(nombrePersonal, ocupacion, firmaInicio, firmaSalida, btnEliminarPersona)

    contenedorPersonas.append(contenedorPersonal)
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
    e.preventDefault()
    //doc, objeto}
    //dimensiones del documento pdf
    var doc = new jsPDF();
    //imagen del documento vacía
    const image = await loadImage("../recursos/formatoPetar.jpg");
    //colocar la imagen
    //colocar imagen desde una posicion en especifico, con las dimensiones especificas
    doc.addImage(image, "JPG", 0, 0, 210, 297);
    doc.setFontSize(6.5) //es el tamaño por defecto

    function evaluarDatosGenerales(){
        let evalDatosGenerales = true

        let area = document.getElementById("area").value
        let lugar = document.getElementById("lugar").value
        let empresa = document.getElementById("empresa").value
        let hInicio = document.getElementById("h-inicio").value
        let hFInal = document.getElementById("h-final").value

        if(area!=""){
            doc.text(area, 24.5, 25.5)
        }else{
            alert("Complete el campo de area")  
            evalDatosGenerales = false
            return
        }

        if(lugar!=""){
            doc.text(lugar, 24.5, 29)
        }else{
            alert("Complete el campo de lugar")  
            evalDatosGenerales = false
            return
        }

        if(fecha.value!=""){
            doc.text(fecha.value, 24.5, 32.5)
        }else{
            alert("Complete el campo de lugar")  
            evalDatosGenerales = false
            return
        }

        if(empresa!=""){
            doc.text(empresa, 163, 25.5)
        }else{
            alert("Complete el campo de empresa")  
            evalDatosGenerales = false
            return
        }

        if(hInicio!=""){
            doc.text(hInicio, 163, 29)
        }else{
            alert("Complete la hora de inicio")  
            evalDatosGenerales = false
            return
        }

        if(hFInal!=""){
            doc.text(hFInal, 163, 32.5)
        }else{
            alert("Complete la hora de salida")  
            evalDatosGenerales = false
            return
        }

        if(evalDatosGenerales){
            return true
        }else{
            return false
        }
    }

    function evaluarMantenimientoElectrico(){
        let elementosMantenimientoElectrico = document.querySelectorAll(".elemento-mantenimiento-electrico")

        meY = 67
        //opciones
        elementosMantenimientoElectrico.forEach(e=>{
            inputsEvaluar = e.querySelectorAll("input")

            inputsEvaluar.forEach(ie=>{
                if(ie.checked){
                    if(ie.value=="SI"){
                        doc.text("X", 142.5, meY)
                    }else{
                        doc.text("X", 155.5, meY)
                    }
                    meY+=4.8
                }
                
            })
        })


        meObsY = 65
        doc.setFontSize(4.5)
        elementosMantenimientoElectrico.forEach(o=>{
            textArea = o.querySelectorAll("textarea")

            textArea.forEach(t=>{
                doc.text(t.value, 163, meObsY, {
                    maxWidth: 32,
                    lineHeightFactor: 0.8
                })
                meObsY+=4.8
            })
        })

        return true
    }
    
    function evaluarTrabajoAltura(){
        doc.setFontSize(6.5)
        let elementosTrabajoAltura = document.querySelectorAll(".elemento-trabajo-altura")

        taY = 104
        elementosTrabajoAltura.forEach(e=>{
            inputsEvaluar = e.querySelectorAll("input")

            inputsEvaluar.forEach(ie=>{
                if(ie.checked){
                    if(ie.value=="SI"){
                        doc.text("X", 142.5, taY)
                    }else{
                        doc.text("X", 155.5, taY)
                    }
                    taY+=4.8
                }
                
            })
        })

        taObsY = 102
        doc.setFontSize(4.5)
        elementosTrabajoAltura.forEach(o=>{
            textArea = o.querySelectorAll("textarea")

            textArea.forEach(t=>{
                doc.text(t.value, 163, taObsY, {
                    maxWidth: 32,
                    lineHeightFactor: 0.8
                })
                taObsY+=4.8
            })
        })
        return true
    }

    function evaluarEspaciosConfinados(){
        doc.setFontSize(6.5)
        let elementosEspaciosConfinados = document.querySelectorAll(".elemento-espacios-confinados")

        ecY = 141
        elementosEspaciosConfinados.forEach(e=>{
            inputsEvaluar = e.querySelectorAll("input")

            inputsEvaluar.forEach(ie=>{
                if(ie.checked){
                    if(ie.value=="SI"){
                        doc.text("X", 142.5, ecY)
                    }else{
                        doc.text("X", 155.5, ecY)
                    }
                    ecY+=4.8
                }
                
            })
        })

        ecObsY = 139
        doc.setFontSize(4.5)
        elementosEspaciosConfinados.forEach(o=>{
            textArea = o.querySelectorAll("textarea")

            textArea.forEach(t=>{
                doc.text(t.value, 163, ecObsY, {
                    maxWidth: 32,
                    lineHeightFactor: 0.8
                })
                ecObsY+=4.8
            })
        })
        return true
    }

    function evaluarDescripcionTarea(){
        let descripcionTarea = document.getElementById("descripcion-tarea").value
        doc.setFontSize(6.5)
        doc.text(descripcionTarea, 21, 167.5, {
            maxWidth: 180,
            lineHeightFactor: 1.6
        })

        return true
    }

    

    function evaluarPersonal(){
        doc.setFontSize(5)
        let evalPersonal = true
        let pY = 187

        let cargos = document.querySelectorAll(".ocupacion")
        cargos.forEach(c=>{
            if(c.value!=""){
                doc.text(c.value, 20.2, pY)
            }else{
                evalPersonal=false
                //alert("Seleccione un responsable en 'Personal Involucrado en la Tarea'")
                return
            }
            pY+=3.3
        })

        pY = 187
        let participantes = document.querySelectorAll(".nombre-participante")
        participantes.forEach(p=>{
            if(p.value!="Seleccionar" && p.value!=""){
                doc.text(p.value, 72, pY)
            }else{
                evalPersonal=false
                alert("Seleccione un responsable en 'Personal Involucrado en la Tarea'")
                return
            }
            pY+=3.3
        })

        /*Probarlo con las firmas verdaderas*/
        pY = 185
        let firmasInicio = document.querySelectorAll(".firma-inicio")
        firmasInicio.forEach(p=>{
            if(p.value!=""){
                doc.addImage(p.value, 142, pY, 16.3, 2.1)
            }else{
                evalPersonal=false
                //alert("Seleccione un responsable en 'Personal Involucrado en la Tarea'")
                return
            }
            pY+=3.3
        })
        
        /*Probarlo con las firmas verdaderas*/
        pY = 185
        let firmasSalida = document.querySelectorAll(".firma-salida")
        firmasSalida.forEach(p=>{
            if(p.value!=""){
                doc.addImage(p.value, 172, pY, 16.3, 2.1)
            }else{
                evalPersonal=false
                //alert("Seleccione un responsable en 'Personal Involucrado en la Tarea'")
                return
            }
            pY+=3.3
        })

        if(evalPersonal){
            return true
        }else{
            return false
        }

    }

    function evaluarEquiposProteccion(){
        let column1 = document.querySelectorAll(".c1")
        let cY = 214.8
        column1.forEach(c=>{
            if(c.checked){
                doc.text("X", 20, cY)
            }
            cY+=2.8
        })

        let column2 = document.querySelectorAll(".c2")
        cY = 214.8
        column2.forEach(c=>{
            if(c.checked){
                doc.text("X", 71.3,  cY)
            }
            cY+=2.8
        })

        let column3 = document.querySelectorAll(".c3")
        cY = 214.8
        column3.forEach(c=>{
            if(c.checked){
                doc.text("X", 146.6, cY)
            }
            cY+=2.8
        })
        doc.setFontSize(5)
        doc.text(document.getElementById("guantes-clase").value, 102, 220)

        let otros = document.getElementById("otros").value
        if(otros!=""){
            doc.text("X", 20.5, 235.8)
            doc.text(otros, 40, 235.5)
        }

        return true
    }

    function evaluarHerramientas(){
        let hEM = document.getElementById("hem").value

        doc.setFontSize(6.5)
        doc.text(hEM, 21, 243.2, {
            maxWidth: 180,
            lineHeightFactor: 1.5
        })

        return true
    }

    function evaluarProcedimiento(){
        let proc = document.getElementById("procedimiento").value

        doc.setFontSize(6.5)
        doc.text(proc, 21, 256.8, {
            maxWidth: 180,
            lineHeightFactor: 1.5
        })

        return true
    }

    function evaluarAutorizacionSupervision(){
        let evalAuto = true
        doc.setFontSize(6.5)
        let supervisor = document.getElementById("supervisor-responsable").value
        doc.text(supervisor, 115, 278,{
            align: "center"
        })
        let responsable = document.getElementById("responsable").value
        if(responsable.value==""){
            alert("Ingrese el nombre del responsable en la parte inferior de la página")
            evalAuto = false
            return
        }else{
            doc.text(responsable, 115, 284,{
                align: "center"
            })
        }
        
        let prevencionista = document.getElementById("prevencionista").value
        doc.text(prevencionista, 115, 290,{
            align: "center"
        })

        let firmas = document.querySelectorAll(".a-s-firma")
        let fY = 274
        firmas.forEach(f=>{
            doc.addImage(f.value, "PNG", 172, fY, 20, 4)
            fY+=6
        })

        if(evalAuto){
            return true
        }else{
            return false
        }

        
    }
    
    if(evaluarDatosGenerales() && evaluarMantenimientoElectrico() && evaluarTrabajoAltura() && evaluarEspaciosConfinados() && evaluarDescripcionTarea() && evaluarPersonal() && evaluarEquiposProteccion() && evaluarHerramientas() && evaluarProcedimiento() && evaluarAutorizacionSupervision()){
        /*var blob = doc.output("blob");
        window.open(URL.createObjectURL(blob));*/
                fechaActual.replace("/", "_")
        doc.save(`PETAR_${fechaActual}.pdf`)
    }

  })