//Obtener el elemento con la clase 'equipos'
const contenedorEquipos = document.querySelector('.equipos');

// Función para agregar un nuevo equipo
function agregarEquipo() {
  // Crear elementos HTML
  const nuevoEquipo = document.createElement('div');
  nuevoEquipo.classList.add('contenedor-equipos');

  const labelDescripcion = document.createElement('label');
  labelDescripcion.textContent = 'Descripción ';
  const inputDescripcion = document.createElement('input');
  inputDescripcion.type = 'text';
  inputDescripcion.classList.add('descripcion-equipo');
  labelDescripcion.appendChild(inputDescripcion);

  const labelUnidad = document.createElement('label');
  labelUnidad.textContent = 'Unidad ';
  const inputUnidad = document.createElement('input');
  inputUnidad.type = 'text';
  inputUnidad.classList.add('unidad');
  labelUnidad.appendChild(inputUnidad);

  const labelCantidad = document.createElement('label');
  labelCantidad.textContent = 'Cantidad ';
  const inputCantidad = document.createElement('input');
  inputCantidad.type = 'number';
  inputCantidad.classList.add('cantidad-e');
  labelCantidad.appendChild(inputCantidad);

  const labelObservaciones = document.createElement('label');
  labelObservaciones.textContent = 'Observaciones ';
  const textareaObservaciones = document.createElement('textarea');
  textareaObservaciones.cols = '30';
  textareaObservaciones.rows = '10';
  textareaObservaciones.classList.add('observaciones-e');
  labelObservaciones.appendChild(textareaObservaciones);

  // Crear botón de eliminar
  const btnEliminarEquipo = document.createElement('button');
  btnEliminarEquipo.textContent = 'Eliminar Equipo';
  btnEliminarEquipo.addEventListener('click', function() {
    // Eliminar el equipo al hacer clic en el botón de eliminar
    contenedorEquipos.removeChild(nuevoEquipo);
  });

  // Añadir elementos al contenedor del equipo
  nuevoEquipo.appendChild(labelDescripcion);
  nuevoEquipo.appendChild(labelUnidad);
  nuevoEquipo.appendChild(labelCantidad);
  nuevoEquipo.appendChild(labelObservaciones);
  nuevoEquipo.appendChild(btnEliminarEquipo);

  // Añadir el nuevo equipo al contenedor de equipos principal
  contenedorEquipos.appendChild(nuevoEquipo);
}

// Obtener el botón de agregar equipo (puedes tenerlo en tu HTML)
const btnAgregarEquipo = document.querySelector('.agregar-equipo');

// Manejador de eventos para el clic en el botón de agregar equipo
btnAgregarEquipo.addEventListener('click', agregarEquipo);