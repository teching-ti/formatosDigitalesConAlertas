<?php 
require("../control/db.php");
require("../control/control_access.php");
?>

<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="UTF-8" />
    <meta name="robots" content="noindex, nofollow">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Formatos</title>
    <?php 
      require("./header_comun/scripts_links.php");
    ?>
    <link rel="stylesheet" href="../estilos/stylesMenu.css" />
  </head>
  <body>
    <main>
      <figure class="contenedor-imagen">
        <img
          src="../recursos/logo_teching.png"
          alt="logo_teching"
          class="imagen-logo"
        />
      </figure>
      <h1>Formatos TECHING - ENEL DX BALANCE Y CORRECCION DE CADENA</h1>
      <div class="formatos">
        <a href="./analisis_trabajo_seguro.php" class="links"
          >Análisis de Trabajo Seguro - ATS</a
        >
      </div>
      <div class="formatos">
        <a href="./charla_05_minutos.php" class="links"
          >Reporte - Charla de 05 Minutos</a
        >
      </div>
      <div class="formatos">
        <a href="./lista_de_inspeccion.php" class="links"
          >Lista de Inspección Diaria</a
        >
      </div>
      <div class="formatos">
        <a href="./orden_de_trabajo.php" class="links"
          >Orden de Trabajo</a
        >
      </div>
      <div class="formatos">
        <a href="./formatos/permiso_alto_riesgo.php" class="links"
          >Permiso de Alto Riesgo</a
        >
      </div>
      <div class="formatos">
        <a href="./inspeccion_vehicular.php" class="links"
          >Checklist de inspección vehicular</a
        >
      </div>
      <div class="formatos">
        <a href="./inspeccion_escalera.php" class="links"
          >Inspección Escalera</a
        >
      </div>
      <div class="formatos">
        <a href="./proteccion_contra_caidas.php" class="links"
          >Checklist de Sistema de Protección Contra Caídas</a
        >
      </div>
      <div class="formatos">
        <a href="./acta_inspeccion.php" class="links"
          >Acta de Inspección</a
        >
      </div>
    </main>
  </body>
</html>