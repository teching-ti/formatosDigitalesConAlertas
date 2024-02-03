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
    llenarSelect(document.querySelector(".trabajador-nombre"));
    autocompletarCampos(
      document.querySelector(".trabajador-nombre"),
      document.querySelector(".contenedor-nombre")
    );

    //llena el select del responsable del proyecto
    llenarSelect(document.getElementById("responsable-nombre"));
    autocompletarCamposResponsable(
      document.getElementById("responsable-nombre"),
      document.getElementById("firma-responsable")
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
    datosParticipante.querySelector(".trabajador-dni").value =
      usuarioSeleccionado.dni;
    datosParticipante.querySelector(".trabajador-firma").value =
      usuarioSeleccionado.firma;
  });
}

/*Autocompletado del responsable*/
function autocompletarCamposResponsable(elementoSelect, datosResponsable) {
  elementoSelect.addEventListener("change", function () {
    const nombreSeleccionado = elementoSelect.value;
    const responsableSeleccionado = users.tecnico.find(
      (tecnico) => tecnico.name === nombreSeleccionado
    );
    //autocompletar los campos correspondientes
    datosResponsable.value = responsableSeleccionado.firma;
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
    let selectores = document.querySelectorAll(".trabajador-nombre");
    selectores.forEach((selectorNombre) => {
      selectorNombre.addEventListener("change", function (event) {
        const nombreSeleccionado = selectorNombre.value;
        const usuarioSeleccionado = users.tecnico.find(
          (tecnico) => tecnico.name === nombreSeleccionado
        );
        const contenedor = event.target.closest(".contenedor-nombre");

        contenedor.querySelector(".trabajador-dni").value =
          usuarioSeleccionado.dni;
        contenedor.querySelector(".trabajador-firma").value =
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
  const contenedorTrabajador = document.querySelector(".contenedor-trabajador");
  const nuevoContenedor = contenedorTrabajador.cloneNode(true);
  nuevoContenedor.classList.add("clon");

  // itera sobre los radio buttons que aparecerán dentro del nuevo contenedor de usuarios y cambia sus atributos "name"
  // ya que los radio buttons deben tener nombres específicos
  nuevoContenedor
    .querySelectorAll('input[type="radio"]')
    .forEach((radioButton) => {
      const originalName = radioButton.getAttribute("name");
      const newName = `${originalName}-${numUser}`;
      radioButton.setAttribute("name", newName);
    });

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

//creación de los tamaños para el texto en el documento
//fontSizeTexo es importante definirla porque es el tamaño de fuente que aarecereá en el pdf
const fontSizeTexto = 10;

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
  var doc = new jsPDF();
  //imagen del documento vacía
  const image = await loadImage("../recursos/formatoListaInspeccion2.jpg");
  //colocar la imagen
  //colocar imagen desde una posicion en especifico, con las dimensiones especificas
  doc.addImage(image, "JPG", 0, 0, 210, 297, '', 'FAST');

  //funcion para obtener y evaluar datos de la empresa
  let evaluarEmpresa = () => {
    /*Seleccionar empresa start*/
    doc.setFontSize(4.6)
    let empresa = document.getElementById("empresa");
    /*Seleccionar empresa end*/

    /*EMPRESA SELECCIONADA */
    switch (empresa.value) {
      //La validación se da en el primer caso
      //si el valor del input es seleccionar se returna un valor falso
      //esto redirige el flujo al final del código
      case "- Seleccionar -":
        alert("Complete la sección de Empresa");
        return false;
      case "TECHING":
        doc.text("X", 20.6, 11.3);
        break;
      case "CONTRATISTA1":
        doc.text("X", 44.6, 11.3);
        doc.text(empresa.value, 60, 11.4);
        break;
      case "CONTRATISTA2":
        doc.text("X", 44.6, 11.3);
        doc.text(empresa.value, 50, 11.4);
        break;
    }
    return true;
  };

  //funcion para obtener y colocar datos de la parte superior e inferior con firma del responsable
  let evaluarDatosPrincipales = () => {
    let trabajo = document.getElementById("trabajo").value;
    let lugar = document.getElementById("lugar").value;
    let fecha = document.getElementById("fecha").value;
    let hora = document.getElementById("hora").value;
    let responsable1 = document.getElementById("responsable-nombre").value;
    let responsableFirma = document.getElementById("firma-responsable").value;

    if (trabajo != "" && lugar != "" && responsable1 != "") {
      doc.text(trabajo, 36, 13.6);
      doc.text(lugar, 24, 15.5);
      doc.text(fecha, 24, 17.9);
      doc.text(hora, 47, 17.9);
      doc.text("Bernabe Oscco León", 120, 16.5);

      //tecnico responsable
      doc.text(responsable1, 79.5, 276, {align: "center"})
      doc.addImage(responsableFirma, "PNG", 67.5, 267.5, 24, 6);

      
      /*nombre supervisor*/
      /*La firma del supervisor estará siendo colocada desde aquí*/
      /*firma supervisor*/
      //En caso sea necesario, esta es la firma para el supervisor
      //se debería de crear un input en el html y una variable para obtener su nombre
      //y con ello también su firma, similar a como se hace con el resto, pero una única vez
      let supervisorNombre = "Roberto Carlos Luis Bailon"
      let supervisorFirma = "../recursos/firmas/RobertoLuisBailon.png"
      doc.text(supervisorNombre, 150, 276, {align: "center"});
      //modificar por la firma de roberto carlos luis bailon
      doc.addImage(supervisorFirma, "PNG", 138, 267.5, 24, 6);
      //para que aparezca el nombre y la firma

      return true;
    } else {
      alert("Complete todos los campos de la parte superior del formulario");
      return false;
    }
  };

  //colocar comentarios
  doc.setFontSize(4)
  comentarios = document.getElementById("comentarios").value;
  doc.text(comentarios, 22, 274, {
    maxWidth: 180,
    lineHeightFactor: 2.4,
  });

  //INICIA COLOCAR CARGOS Y NOMBRES
  function evaluarNombreCargo() {
    let resEvalNombreCargo = true;
    let cargos = document.querySelectorAll(".trabajador-cargo");
    let nombres = document.querySelectorAll(".trabajador-nombre");
    let firmas = document.querySelectorAll(".trabajador-firma");
    let dnis = document.querySelectorAll(".trabajador-dni");
    doc.setFontSize(4);

    //colocar cargos
    //altura de 90 es buena para los cargos
    let cargosX = 80;
    let contador = 0;
    cargos.forEach((cargo) => {
      if (cargo.value != "") {
        if (contador != 0) {
          doc.text(cargo.value, cargosX, 21.8);
          cargosX += 23.72;
        } else {
          doc.text(cargo.value, 59, 21.8);
          contador = 1;
        }
        return true;
      } else {
        alert("Complete todos los cargos del peronal evaluado");
        resEvalNombreCargo = false;
        return;
      }
    });

    //colocar nombres
    let nombresX1 = 80;
    let contadorn = 0;
    nombres.forEach((nombre) => {
      if (nombre.value != "") {
        if (contadorn != 0) {
          doc.setFontSize(4)
          doc.text(nombre.value, nombresX1, 24, {
            align: "center",
            maxWidth: 15,
            lineHeightFactor: 1,
          });
          nombresX1 += 23.9;
        } else {
          doc.setFontSize(3.8)
          doc.text(nombre.value, 59.5, 24, {
            align: "center",
            maxWidth: 10,
            lineHeightFactor: 1,
          });
          contadorn = 1;
        }
      } else {
        alert("Complete todos los nombres del peronal evaluado");
        resEvalNombreCargo = false;
        return;
      }
    });

    //colocarFirmas
    let firmasX = 50;
    firmas.forEach((firma) => {
      doc.addImage(firma.value, "PNG", firmasX, 259, 15, 4);
      firmasX += 24.5;
    });

    //colocarDNI
    let dnisX = 53;
    dnis.forEach((dni) => {
      doc.text(dni.value, dnisX, 265);
      dnisX += 25
    });

    if (resEvalNombreCargo) {
      return true;
    } else {
      return false;
    }
  }

  //TERMINA COLOCAR CARGOS Y NOMBRES

  //CONTENEDORES DE LOS ELEMENTOS A EVALUAR
  //se obtiene todos los contenedores epp
  let epp = document.querySelectorAll(".contenedor-EPP");
  //se obtiene todos los contenedores herramientas
  let herramientas = document.querySelectorAll(".contenedor-herramientas");
  //se obtiene todos los contenedores equipos
  let equipos = document.querySelectorAll(".contenedor-equipos");
  //se obtiene todos los contenedores señalizacion
  let senializacion = document.querySelectorAll(".contenedor-senializacion");
  //se obtiene todos los contenedores documentacion
  let documentacion = document.querySelectorAll(".contenedor-documentacion");
  //se obtienen todos los accesorios
  let accesorios = document.querySelectorAll(".contenedor-accesorios");

  /*revisión de los select*/
  doc.setFontSize(5);
  //EPP
  //posicionamiento inicial
  positionSelectX = 46.5;
  positionSelectY = 32.5;
  let contadorElementos = 1
  let contadorColumnas = 1
  epp.forEach((e) => {
    //se crea un array que contenga a todos los inputs
    //que se encontraban dentro de ese contenedor
    selectsEvaluar = e.querySelectorAll("select");
    //se evalua a cada input
    selectsEvaluar.forEach((se) => {
      if(contadorElementos<=10){
        //si el input ha sido marcado
        //se obtendrá su valor y se colocará en el documento
        doc.text(se.value, positionSelectX, positionSelectY);
        //la posicion y aumenta para completar el resto de elementos
        positionSelectY += 2.72
      }else if(contadorElementos==11){
        positionSelectY += 1
        doc.text(se.value, positionSelectX, positionSelectY);
        positionSelectY += 1.5
      }else if(contadorElementos==19){
        positionSelectY += 5
        doc.text(se.value, positionSelectX, positionSelectY);
        positionSelectY += 1
      }else{
        positionSelectY += 2.72
        doc.text(se.value, positionSelectX, positionSelectY);
      }
      contadorElementos+=1
    });
    //al terminar con el primer contenedor se corre el sitio de impresion en 60
    //y vuelve el punto y a su lugar de inicio
    if(contadorColumnas==1){
      positionSelectX += 25.4;
    }else{
      positionSelectX+=24
    }
    contadorElementos=1
    contadorColumnas+=1
    positionSelectY = 32.5;
  });

  //HERRAMIENTAS
  //posicionamiento inicial
  let contadorHerramientas = 1
  contadorColumnas = 1
  positionSelectX = 46.5;
  positionSelectY = 97.5;
  herramientas.forEach((e) => {
    //se crea un array que contenga a todos los inputs
    //que se encontraban dentro de ese contenedor
    selectsEvaluar = e.querySelectorAll("select");
    //se evalua a cada input
    selectsEvaluar.forEach((se) => {
      
      if(contadorHerramientas<10){
        doc.text(se.value, positionSelectX, positionSelectY);
        positionSelectY += 2.7;
      }else if(contadorHerramientas == 10 || contadorHerramientas == 11 || contadorHerramientas == 24){
        doc.text(se.value, positionSelectX, positionSelectY);
        positionSelectY += 5;
      }else if( contadorHerramientas == 12){
        doc.text(se.value, positionSelectX, positionSelectY);
        positionSelectY += 4
      }else{
        doc.text(se.value, positionSelectX, positionSelectY);
        positionSelectY += 2.7;
      }
      contadorHerramientas+=1
    });
    //al terminar con el primer contenedor se corre el sitio de impresion en 60
    //y vuelve el punto y a su lugar de inicio

    if(contadorColumnas==1){
      positionSelectX += 25.4;
    }else{
      positionSelectX+=24
    }
    contadorHerramientas = 1
    contadorColumnas+=1
    positionSelectY = 97.5;
  });

  //EQUIPOS
  //posicionamiento inicial
  contadorColumnas = 1
  positionSelectX = 46.5;
  positionSelectY = 181.4;
  equipos.forEach((e) => {
    //se crea un array que contenga a todos los inputs
    //que se encontraban dentro de ese contenedor
    selectsEvaluar = e.querySelectorAll("select");
    //se evalua a cada input
    selectsEvaluar.forEach((se) => {
      doc.text(se.value, positionSelectX, positionSelectY);
      //la posicion y aumenta para completar el resto de elementos
      positionSelectY += 2.7;

    });
    //al terminar con el primer contenedor se corre el sitio de impresion en 60
    //y vuelve el punto y a su lugar de inicio
    if(contadorColumnas==1){
      positionSelectX += 25.4;
    }else{
      positionSelectX+=24
    }
    
    contadorColumnas+=1
    positionSelectY = 181.4;
  });

  //SEÑALIZACION
  //posicionamiento inicial
  contadorColumnas = 1
  positionSelectX = 46.5;
  positionSelectY = 224;
  senializacion.forEach((e) => {
    //se crea un array que contenga a todos los inputs
    //que se encontraban dentro de ese contenedor
    selectsEvaluar = e.querySelectorAll("select");
    //se evalua a cada input
    selectsEvaluar.forEach((se) => {

      doc.text(se.value, positionSelectX, positionSelectY);
      positionSelectY += 2.7;

    });
    //al terminar con el primer contenedor se corre el sitio de impresion en 60
    //y vuelve el punto y a su lugar de inicio

    if(contadorColumnas==1){
      positionSelectX += 25.4;
    }else{
      positionSelectX+=24
    }
    contadorColumnas+=1
    positionSelectY = 224;
  });

  //DOCUMENTACION
  //posicionamiento inicial
  contadorColumnas = 1
  positionSelectX = 46.5;
  positionSelectY = 237;
  documentacion.forEach((e) => {
    //se crea un array que contenga a todos los inputs
    //que se encontraban dentro de ese contenedor
    selectsEvaluar = e.querySelectorAll("select");
    //se evalua a cada input
    selectsEvaluar.forEach((se) => {
      //si el input ha sido marcado
      //if(se.checked){
      //se obtendrá su valor y se colocará en el documento
      doc.text(se.value, positionSelectX, positionSelectY);
      //la posicion y aumenta para completar el resto de elementos
      positionSelectY += 2.7;
      //}
    });
    //al terminar con el primer contenedor se corre el sitio de impresion en 60
    //y vuelve el punto y a su lugar de inicio
    if(contadorColumnas==1){
      positionSelectX += 25.4;
    }else{
      positionSelectX+=24
    }
    contadorColumnas += 1
    positionSelectY = 237;
  });

  /*revisión de los inputs*/

  //EPP
  //posicionamiento inicial
  positionX = 54;
  positionY = 32.5;
  contadorElementos = 1
  contadorColumnas = 1

  epp.forEach((e) => {
    //se crea un array que contenga a todos los inputs
    //que se encontraban dentro de ese contenedor
    inputsEvaluar = e.querySelectorAll("input");
    //se evalua a cada input
    inputsEvaluar.forEach((se) => {

      if(se.checked){
        if(contadorElementos<=10){
          //si el input ha sido marcado
          //se obtendrá su valor y se colocará en el documento
          doc.text(se.value, positionX, positionY, {align:'center'});
          //la posicion y aumenta para completar el resto de elementos
          positionY += 2.72
        }else if(contadorElementos==11){
          positionY += 1
          doc.text(se.value, positionX, positionY, {align:'center'});
          positionY += 1.5
        }else if(contadorElementos==19){
          positionY += 5
          doc.text(se.value, positionX, positionY, {align:'center'});
          positionY += 1
        }else{
          positionY += 2.72
          doc.text(se.value, positionX, positionY, {align:'center'});
        }
        contadorElementos+=1
      }
    });
    //al terminar con el primer contenedor se corre el sitio de impresion en 60
    //y vuelve el punto y a su lugar de inicio
    if(contadorColumnas==1){
      positionX += 24.6;
    }else{
      positionX+=24
    }
    contadorElementos=1
    contadorColumnas+=1
    positionY = 32.5;
  });

  //HERRAMIENTAS
  //posicionamiento inicial
  positionX = 54;
  positionY = 97.5;
  contadorElementos = 1
  contadorColumnas = 1
  //recore todos los contenedores epp
  herramientas.forEach((e) => {
    //se crea un array que contenga a todos los inputs
    //que se encontraban dentro de ese contenedor
    inputsEvaluar = e.querySelectorAll("input");
    //se evalua a cada input
    inputsEvaluar.forEach((ie) => {
      //si el input ha sido marcado
      if(ie.checked){
        if(contadorElementos<10){
          //si el input ha sido marcado
          //se obtendrá su valor y se colocará en el documento
          doc.text(ie.value, positionX, positionY, {align:'center'});
          //la posicion y aumenta para completar el resto de elementos
          positionY += 2.72
        }else if(contadorElementos == 10 || contadorElementos == 11 || contadorElementos == 24){
          doc.text(ie.value, positionX, positionY, {align:'center'});
          positionY += 5;
        }else if(contadorElementos == 12){
          doc.text(ie.value, positionX, positionY, {align:'center'});
          positionY += 4
        }else{
          doc.text(ie.value, positionX, positionY, {align:'center'});
          positionY += 2.7;
        }
        contadorElementos+=1
      }
    });
    //al terminar con el primer contenedor se corre el sitio de impresion en 60
    //y vuelve el punto y a su lugar de inicio
    if(contadorColumnas==1){
      positionX += 24.6;
    }else{
      positionX+=24
    }
    contadorElementos=1
    contadorColumnas+=1
    positionY = 97.5;
  });

  //EQUIPOS
  //posicionamiento inicial
  positionX = 54;
  positionY = 181.4;
  contadorColumnas = 1
  //recore todos los contenedores epp
  equipos.forEach((e) => {
    //se crea un array que contenga a todos los inputs
    //que se encontraban dentro de ese contenedor
    inputsEvaluar = e.querySelectorAll("input");
    //se evalua a cada input
    inputsEvaluar.forEach((ie) => {
      //si el input ha sido marcado
      if (ie.checked) {
        //se obtendrá su valor y se colocará en el documento
        doc.text(ie.value, positionX, positionY, {align: "center"});
        //la posicion y aumenta para completar el resto de elementos
        positionY += 2.7;
      }
    });

    //al terminar con el primer contenedor se corre el sitio de impresion en 60
    //y vuelve el punto y a su lugar de inicio
    if(contadorColumnas==1){
      positionX += 24.6;
    }else{
      positionX+=24
    }
    contadorColumnas+=1
    positionY = 181.4;
  });

  //SEÑALIZACION
  //posicionamiento inicial
  contadorColumnas = 1
  positionX = 54;
  positionY = 224;
  //recore todos los contenedores epp
  senializacion.forEach((e) => {
    //se crea un array que contenga a todos los inputs
    //que se encontraban dentro de ese contenedor
    inputsEvaluar = e.querySelectorAll("input");
    //se evalua a cada input
    inputsEvaluar.forEach((ie) => {
      //si el input ha sido marcado
      if (ie.checked) {
        //se obtendrá su valor y se colocará en el documento
        doc.text(ie.value, positionX, positionY, {align: "center"});
        //la posicion y aumenta para completar el resto de elementos
        positionY += 2.7;
      }
    });
    //al terminar con el primer contenedor se corre el sitio de impresion en 60
    //y vuelve el punto y a su lugar de inicio
    if(contadorColumnas==1){
      positionX += 24.6;
    }else{
      positionX+=24
    }
    contadorColumnas+=1
    positionY = 224;
  });

  //DOCUMENTACIÓN
  //posicionamiento inicial
  contadorColumnas = 1
  positionX = 54;
  positionY = 237;
  //recore todos los contenedores epp
  documentacion.forEach((e) => {
    //se crea un array que contenga a todos los inputs
    //que se encontraban dentro de ese contenedor
    inputsEvaluar = e.querySelectorAll("input");
    //se evalua a cada input
    inputsEvaluar.forEach((ie) => {
      //si el input ha sido marcado
      if (ie.checked) {
        //se obtendrá su valor y se colocará en el documento
        doc.text(ie.value, positionX, positionY, {align:"center"});
        //la posicion y aumenta para completar el resto de elementos
        positionY += 2.7;
      }
    });
    //al terminar con el primer contenedor se corre el sitio de impresion en 60
    //y vuelve el punto y a su lugar de inicio
    if(contadorColumnas==1){
      positionX += 24.6;
    }else{
      positionX+=24
    }
    contadorColumnas += 1
    positionY = 237;
  });

  //ACCESORIOS
  //posicionamiento inicial
  positionX = 71;
  positionY = 250;
  //recore todos los contenedores de accesorios
  accesorios.forEach((e) => {
    //se crea un array que contenga a todos los inputs
    //que se encontraban dentro de ese contenedor
    inputsEvaluar = e.querySelectorAll("input");
    //se evalua a cada input
    inputsEvaluar.forEach((ie) => {
      //si el input ha sido marcado
      if (ie.checked) {
        //se obtendrá su valor y se colocará en el documento
        doc.text(ie.value, positionX, positionY, {align: "center"});
        //la posicion y aumenta para completar el resto de elementos
        //positionY+=3.1
      }
    });
    //al terminar con el primer contenedor se corre el sitio de impresion en 60
    //y vuelve el punto y a su lugar de inicio
    positionX += 18.7;
    //positionY = 250
  });

  if (evaluarEmpresa() && evaluarDatosPrincipales() && evaluarNombreCargo()) {
    var blob = doc.output("blob");
    window.open(URL.createObjectURL(blob));

    /*dia = dia.replace(/\//g, "_")
    //console.log(dia)
    const nombreDocumento = `lista_inspeccion_${dia}.pdf` 
    doc.save(nombreDocumento)
    //endodear el resultado del pdf
    var file_data = btoa(doc.output())
    var form_data = new FormData()

    form_data.append("file", file_data)
    form_data.append("nombre", "LISTA_DE_INSPECCION")
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
  } else {
    alert("Complete los campos solicitados para generar el documento");
  }
  //final
});
