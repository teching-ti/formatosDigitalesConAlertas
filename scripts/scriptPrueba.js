// Definir los valores de tiempo en un array
const tiempos = ["2:30 horas", "10 minutos", "10 minuto", "30 minutos", "20 minutos", "20 minutos", "2:30 horas", "30 minutos", "1 hora"];

// Función para convertir el tiempo a minutos
function convertirAMinutos(tiempo) {
  // Verificar si el tiempo incluye "hora" o "horas"
  if (tiempo.includes("hora") || tiempo.includes("horas")) {
    const partes = tiempo.split(":");
    return parseInt(partes[0]) * 60 + parseInt(partes[1] || 0);
  } else if (tiempo.includes("minuto") || tiempo.includes("minutos")) {
    return parseInt(tiempo);
  }
  return 0;
}

// Calcular el tiempo total en minutos
const tiempoTotalEnMinutos = tiempos.reduce((total, tiempo) => total + convertirAMinutos(tiempo), 0);

// Convertir el tiempo total de nuevo a horas y minutos
const horas = Math.floor(tiempoTotalEnMinutos / 60);
const minutos = tiempoTotalEnMinutos % 60;

console.log(`El tiempo total es de ${horas} horas y ${minutos} minutos.`);