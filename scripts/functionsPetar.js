let fecha = document.getElementById("fecha")
let fechaActual = new Date()
fecha.value = fechaActual.toLocaleDateString()

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
    llenarSelect(document.querySelector("#supervisor-responsable"))
    autocompletarCamposSup(document.querySelector("#supervisor-responsable"), document.querySelector(".contenedor-sup"))
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
    var doc = new jsPDF("p", "mm", [666, 943]);
    //imagen del documento vacía
    const image = await loadImage("../recursos/formatoPetar.png");
    //colocar la imagen
    //colocar imagen desde una posicion en especifico, con las dimensiones especificas
    doc.addImage(image, "PNG", 0, 0, 666, 943);
    doc.setFontSize(16.5) //es el tamaño por defecto

    

    function evaluarDatosGenerales(){
        let evalDatosGenerales = true

        let area = document.getElementById("area").value
        let lugar = document.getElementById("lugar").value
        let empresa = document.getElementById("empresa").value
        let hInicio = document.getElementById("h-inicio").value
        let hFInal = document.getElementById("h-final").value

        if(area!=""){
            doc.text(area, 124, 103)
        }else{
            alert("Complete el campo de area")  
            evalDatosGenerales = false
            return
        }

        if(lugar!=""){
            doc.text(lugar, 124, 113)
        }else{
            alert("Complete el campo de lugar")  
            evalDatosGenerales = false
            return
        }

        if(fecha.value!=""){
            doc.text(fecha.value, 124, 123)
        }else{
            alert("Complete el campo de lugar")  
            evalDatosGenerales = false
            return
        }

        if(empresa!=""){
            doc.text(empresa, 487, 103)
        }else{
            alert("Complete el campo de empresa")  
            evalDatosGenerales = false
            return
        }

        if(hInicio!=""){
            doc.text(hInicio, 487, 113)
        }else{
            alert("Complete la hora de inicio")  
            evalDatosGenerales = false
            return
        }

        if(hFInal!=""){
            doc.text(hFInal, 487, 123)
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

        meY = 225.5
        //opciones
        elementosMantenimientoElectrico.forEach(e=>{
            inputsEvaluar = e.querySelectorAll("input")

            inputsEvaluar.forEach(ie=>{
                if(ie.checked){
                    if(ie.value=="SI"){
                        doc.text("X", 432, meY)
                    }else{
                        doc.text("X", 464.5, meY)
                    }
                    meY+=14.2
                }
                
            })
        })


        meObsY = 219.5  
        doc.setFontSize(13)
        elementosMantenimientoElectrico.forEach(o=>{
            textArea = o.querySelectorAll("textarea")

            textArea.forEach(t=>{
                doc.text(t.value, 486, meObsY, {
                    maxWidth: 90,
                    lineHeightFactor: 0.9
                })
                meObsY+=14.4
            })
        })

        return true
    }

    function evaluarTrabajoAltura(){
        let elementosTrabajoAltura = document.querySelectorAll(".elemento-trabajo-altura")

        taY = 335.
        elementosTrabajoAltura.forEach(e=>{
            inputsEvaluar = e.querySelectorAll("input")

            inputsEvaluar.forEach(ie=>{
                if(ie.checked){
                    if(ie.value=="SI"){
                        doc.text("X", 432, taY)
                    }else{
                        doc.text("X", 464.5, taY)
                    }
                    taY+=14.2
                }
                
            })
        })

        taObsY = 330.5
        doc.setFontSize(13)
        elementosTrabajoAltura.forEach(o=>{
            textArea = o.querySelectorAll("textarea")

            textArea.forEach(t=>{
                doc.text(t.value, 486, taObsY, {
                    maxWidth: 90,
                    lineHeightFactor: 0.9
                })
                taObsY+=14.2
            })
        })
        return true
    }

    function evaluarEspaciosConfinados(){
        let elementosEspaciosConfinados = document.querySelectorAll(".elemento-espacios-confinados")

        ecY = 446
        elementosEspaciosConfinados.forEach(e=>{
            inputsEvaluar = e.querySelectorAll("input")

            inputsEvaluar.forEach(ie=>{
                if(ie.checked){
                    if(ie.value=="SI"){
                        doc.text("X", 432, ecY)
                    }else{
                        doc.text("X", 464.5, ecY)
                    }
                    ecY+=14.2
                }
                
            })
        })

        ecObsY = 441.5
        doc.setFontSize(13)
        elementosEspaciosConfinados.forEach(o=>{
            textArea = o.querySelectorAll("textarea")

            textArea.forEach(t=>{
                doc.text(t.value, 486, ecObsY, {
                    maxWidth: 90,
                    lineHeightFactor: 0.9
                })
                ecObsY+=14.2
            })
        })
        return true
    }

    function evaluarDescripcionTarea(){
        let descripcionTarea = document.getElementById("descripcion-tarea").value
        doc.setFontSize(14)
        doc.text(descripcionTarea, 105, 528, {
            maxWidth: 465,
            lineHeightFactor: 2.2
        })

        return true
    }

    

    function evaluarPersonal(){
        doc.setFontSize(16.5)
        let evalPersonal = true
        let pY = 586

        let cargos = document.querySelectorAll(".ocupacion")
        cargos.forEach(c=>{
            if(c.value!=""){
                doc.text(c.value, 108, pY)
            }else{
                evalPersonal=false
                alert("Seleccione un responsable en 'Personal Involucrado en la Tarea'")
                return
            }
            pY+=10
        })

        pY = 586
        let participantes = document.querySelectorAll(".nombre-participante")
        participantes.forEach(p=>{
            if(p.value!="Seleccionar" && p.value!=""){
                doc.text(p.value, 240, pY)
            }else{
                evalPersonal=false
                alert("Seleccione un responsable en 'Personal Involucrado en la Tarea'")
                return
            }
            pY+=10
        })

        /*Probarlo con las firmas verdaderas*/
        pY = 582
        let firmasInicio = document.querySelectorAll(".firma-inicio")
        firmasInicio.forEach(p=>{
            if(p.value!=""){
                doc.addImage(p.value, 425, pY, 48, 5)
            }else{
                evalPersonal=false
                alert("Seleccione un responsable en 'Personal Involucrado en la Tarea'")
                return
            }
            pY+=9.7
        })
        
        /*Probarlo con las firmas verdaderas*/
        pY = 582
        let firmasSalida = document.querySelectorAll(".firma-salida")
        firmasSalida.forEach(p=>{
            if(p.value!=""){
                doc.addImage(p.value, 510, pY, 48, 5)
            }else{
                evalPersonal=false
                alert("Seleccione un responsable en 'Personal Involucrado en la Tarea'")
                return
            }
            pY+=9.7
        })

        if(evalPersonal){
            return true
        }else{
            return false
        }

    }

    function evaluarEquiposProteccion(){
        let column1 = document.querySelectorAll(".c1")
        let cY = 669
        column1.forEach(c=>{
            if(c.checked){
                doc.text("X", 107.5, cY)
            }
            cY+=8.3
        })

        let column2 = document.querySelectorAll(".c2")
        cY = 669
        column2.forEach(c=>{
            if(c.checked){
                doc.text("X", 242.5, cY)
            }
            cY+=8.3
        })

        let column3 = document.querySelectorAll(".c3")
        cY = 669
        column3.forEach(c=>{
            if(c.checked){
                doc.text("X", 442, cY)
            }
            cY+=8.3
        })
        doc.setFontSize(14)
        doc.text(document.getElementById("guantes-clase").value, 325, 684)

        let otros = document.getElementById("otros").value
        if(otros!=""){
            doc.text("X", 108.5, 731.2)
            doc.text(otros, 165, 731.5)
        }
        doc.setFontSize(16.5)
        return true
    }

    function evaluarHerramientas(){
        let hEM = document.getElementById("hem").value

        doc.setFontSize(14)
        doc.text(hEM, 105, 754, {
            maxWidth: 465,
            lineHeightFactor: 2
        })

        return true
    }

    function evaluarProcedimiento(){
        let proc = document.getElementById("procedimiento").value

        doc.setFontSize(14)
        doc.text(proc, 105, 796, {
            maxWidth: 465,
            lineHeightFactor: 2
        })

        return true
    }


    function evaluarAutorizacionSupervision(){
        doc.setFontSize(16)
        let supervisor = document.getElementById("supervisor-responsable").value
        doc.text(supervisor, 360, 855,{
            align: "center"
        })
        let responsable = document.getElementById("responsable").value
        doc.text(responsable, 360, 874,{
            align: "center"
        })
        let prevencionista = document.getElementById("prevencionista").value
        doc.text(prevencionista, 360, 893,{
            align: "center"
        })

        let firmas = document.querySelectorAll(".a-s-firma")
        let fY = 843
        firmas.forEach(f=>{
            doc.addImage(f.value, "PNG", 502, fY)
            fY+=19
        })

        return true
    }
    
    
    
    if(evaluarDatosGenerales() && evaluarMantenimientoElectrico() && evaluarTrabajoAltura() && evaluarEspaciosConfinados() && evaluarDescripcionTarea() && evaluarPersonal() && evaluarEquiposProteccion() && evaluarHerramientas() && evaluarProcedimiento() && evaluarAutorizacionSupervision()){
        var blob = doc.output("blob");
        window.open(URL.createObjectURL(blob));
    }
    


  })