<?php 
require("../control/db.php");
require("../control/control_access.php");
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="robots" content="noindex, nofollow">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Reporte Charla de 5 Minutos</title>
    <?php 
      require("./header_comun/scripts_links.php")
    ?>
    <!-- Estilos -->
    <link rel="stylesheet" href="../estilos/stylesCharla.css" />
  </head>
  <body>
    <main class="main">
      <figure class="logo-title">
        <a href="../">
          <img src="../recursos/logo_teching.png" alt="teching_logo" />
        </a>
        <div>
          <span>Charla de 5 Minutos</span>
        </div>
      </figure>
      <section class="form-container">
        <form class="principal-form" id="principal-form">
          <!--Inicia parte superior del Formulario-->
          <div class="form-sup">
            <div class="form-sup-e">
              <label for="empresa">Seleccionar Empresa</label>
              <select name="empresa" id="empresa">
                <option selected>- Seleccionar -</option>
                <option value="TECHING">TECHING</option>
                <option value="CONTRATISTA1">CONTRATISTA1</option>
                <option value="CONTRATISTA2">CONTRATISTA2</option>
              </select>
            </div>
            <div class="form-sup-e">
              <label for="fecha">Fecha: </label
              ><input type="text" value="00-00-00" id="fecha" readonly />
            </div>
          </div>
          <!--Fin parte superior del Formulario-->

          <!--Inicia Cuerpo del Formulario-->
          <div class="form-body">
            <div class="section-body">
              <label for="tema">1. Tema Desarrollado: </label
              ><input
                type="text"
                id="tema" />
            </div>
            <div class="section-body">
              <label for="lugar">2. Lugar: </label
              ><input type="text" id="lugar" />
            </div>
            <div class="section-body">
              <label for="responsable-nombre">3. Responsable del Proyecto</label>
             <input type="text" name="responsable-nombre" id="responsable-nombre" value="Bernabe Oscco León" readonly>
            </div>
            <br />
            <div class="contenedor-preguntas">
              <div class="opciones">
                <span
                  >1. Durante la charla o al final de la misma, los
                  participantes realizaron preguntas:
                </span>
                <div class="opciones-lbl-inp">
                  <label for="nada">Nada</label>
                  <input type="radio" name="nPreguntas" id="nada" class="op1" />
                </div>
                <div class="opciones-lbl-inp">
                  <label for="poco">Poco</label>
                  <input type="radio" name="nPreguntas" id="poco" class="op1" />
                </div>
                <div class="opciones-lbl-inp">
                  <label for="mucho">Mucho</label>
                  <input
                    type="radio"
                    name="nPreguntas"
                    id="mucho"
                    class="op1"
                  />
                </div>
                <div class="opciones-lbl-inp">
                  <label for="otro">Otro</label>
                  <input type="radio" name="nPreguntas" id="otro" class="op1" />
                </div>
              </div>
              <div class="opciones">
                <span>2. El interés de los asistentes a la charla fue: </span>
                <div class="opciones-lbl-inp">
                  <label for="muyInteresante">Muy interesante</label>
                  <input
                    type="radio"
                    name="nPreguntas1"
                    id="muyInteresante"
                    class="op2"
                  />
                </div>
                <div class="opciones-lbl-inp">
                  <label for="interesante">Interesante</label>
                  <input
                    type="radio"
                    name="nPreguntas1"
                    id="interesante"
                    class="op2"
                  />
                </div>
                <div class="opciones-lbl-inp">
                  <label for="pocoInteresante">Poco interesante</label>
                  <input
                    type="radio"
                    name="nPreguntas1"
                    id="pocoInteresante"
                    class="op2"
                  />
                </div>
                <div class="opciones-lbl-inp">
                  <label for="otro2">Otro</label>
                  <input
                    type="radio"
                    name="nPreguntas1"
                    id="otro2"
                    class="op2"
                  />
                </div>
              </div>
            </div>
            <section class="nombres">
              <div id="contenedor-inputs">
                <div class="participantes-header">
                  <h3>Participantes de la Charla</h3>
                  <button id="btn-aniadir">Añadir <i class="fa-solid fa-user-plus"></i></button>
                </div>
                <div class="participante-datos">
                  <select name="participante-nombre" class="participante-nombre">
                    <option value="Seleccionar">--Seleccionar Nombre--</option>
                  </select>
                  <input
                    type="text"
                    class="participante-dni"
                    placeholder="DNI."
                    readonly
                  />
                  <input
                    type="text"
                    class="participante-firma"
                    placeholder="Firma."
                    readonly
                  />
                  <div class="btn-remover-participante">
                    <i class="fa-solid fa-trash"></i>
                  </div>
                </div>
              </div>
            </section>
            <h3>Expositor</h3>
            <section id="expositor">
              <div id="dexp1" class="expositor-datos">
                <label for="expositor-firma">Firma: </label>
                <input type="text" id="expositor-firma"/>
              </div>
              <div id="dexp2" class="expositor-datos">
                <label for="expositor-nombre">Nombre: </label>
                <select type="text" id="expositor-nombre">
                  <option value="">- Seleccionar -</option>
                </select>
              </div>
            </section>
          </div>
          <!--Creando autocompletado de expositor, (firma)-->
          <!--Fin Cuerpo del Formulario-->
          <a class="subir-audio" href="https://techindustrias.sharepoint.com/sites/ProyectosyServicios/Documentos%20compartidos/Forms/AllItems.aspx?id=%2Fsites%2FProyectosyServicios%2FDocumentos%20compartidos%2F1%2EDOCUMENTOS%20SEGURIDAD%2F4%2ECharlas%20de%205%20min%20%28Escaneado%20%2D%20Grabado%29%2F2024%2F2%2E%20FEBRERO&viewid=c546e89a%2D18b7%2D4d45%2D8e9b%2Df7703d423794" target="_blank">Subir Audio <i class="fa-solid fa-music"></i></a>
          <button id="btn-generar">Generar PDF</button>
        </form>
      </section>
    </main>
    <script src="../scripts/functionsCharla.js"></script>
    <script type="module" src="../scripts/control_tiempo.js"></script>
  </body>
</html>