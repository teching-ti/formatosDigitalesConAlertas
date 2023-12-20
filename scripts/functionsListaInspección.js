/*colocar fecha en base al reloj del sistema, dentro de la casilla 'fecha'*/
let cargarFecha = ()=>{
    let fecha = document.getElementById("fecha")
    dia = new Date().toLocaleDateString()
    fecha.value = dia
}
cargarFecha()
/*colocar fecha end*/

let btnAgregarPersonal = document.querySelector(".agregar-personal")
let btnGenerar = document.querySelector(".terminar")

btnAgregarPersonal.addEventListener("click", function(){
    agregarContenedorPersona()
})

function agregarContenedorPersona() {
    alert("Se ha creado uno similar")
    // Clona el contenedor-trabajador
    const contenedorTrabajador = document.querySelector('.contenedor-trabajador');
    const nuevoContenedor = contenedorTrabajador.cloneNode(true);
    // Agrega el nuevo contenedor al final de la sección

    document.querySelector('.section-todo-personal').appendChild(nuevoContenedor);
    /*se debe revisar la manera de hacer que cuando se realice la clonación 
    el resto de contenedores tengan también sus inputs en en NA
    de esta manera se evitará inconvenientes.
    */
}

btnGenerar.addEventListener("click", function(){
    console.log(document.querySelectorAll(".contenedor-trabajador").length)
})

