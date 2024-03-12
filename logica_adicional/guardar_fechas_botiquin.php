<?php

try {

    //echo json_encode(['message' => 'Datos actualizados exitosamente, respondiendo desde php']);

    //se recibe la data y deberá ser decodificada
    $data = json_decode(file_get_contents('php://input'), true);

    //se guardan en variables php los datos obtenidos por el envío
    $nombreConductor = $data['nombreConductor'];
    $fechasVencimiento = $data['fechasVencimiento'];

    /*
    Agregar la lógica necesaria para modificar el archivo 'datos.json'
    */

    // Por ahora, solo imprimimos los datos recibidos
    echo json_encode([
        'nombreConductor' => $nombreConductor,
        'fechasVencimiento' => $fechasVencimiento
    ]);

} catch (Exception $e) {

    echo json_encode(['error' => $e->getMessage()]);
}
?>