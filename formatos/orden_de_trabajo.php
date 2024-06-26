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
    <title>Orden de Trabajo</title>
    <?php 
      require("./header_comun/scripts_links.php")
    ?>
    <!-- Estilos -->
    <link rel="stylesheet" href="../estilos/stylesOrden.css" />
  </head>
  <body>
    <main class="main">
      <figure class="logo-title">
        <a href="../">
          <img src="../recursos/logo_teching.png" alt="teching_logo" />
        </a>
        <div>
          <span>Orden de Trabajo</span>
        </div>
      </figure>

      <section class="form-container">
        <!--Inicia Cuerpo del Formulario-->
        <div class="form-body">
          <section
            class="datos-generales-documento"
            id="datos-generales-documento"
          >
            <h4>Datos Generales</h4>
            <!-- Algunos elementos de estos datos generales son cargados por defecto -->
            <div class="dg dg-1">
              <input type="text" value="00-00-00" id="fecha" readonly />
              <input type="text" id="proyecto" placeholder="PROYECTO." value="ENEL DX BALANCE Y CORRECCION DE CADENA" readonly/>
            </div>
            <div class="dg-2">
              <div>
                <input type="text" id="nproyecto" placeholder="N° PROYECTO." value="SE-23-135" readonly/>
                <input type="text" id="ot" placeholder="OT." />
              </div>
              <input type="text" id="actividad" placeholder="ACTIVIDAD." />
            </div>
            <div class="dg dg-3">
              <input type="text" id="contacto" placeholder="CONTACTO." value="Josue Hidalgo Deza" readonly/>
              <input type="text" id="telefono" placeholder="TELEFONO." value="919 297 229" readonly/>
            </div>
            <div class="dg dg-4">
              <input type="text" id="direccion" placeholder="DIRECCION." />
              <input type="text" id="referencia" placeholder="REFERENCIA." />
              <input type="text" id="ceco" placeholder="CECO." value="PO_EDP" readonly/>
            </div>
          </section>

          <div class="solicitud-autorizacion">
            <div class="contenedor-solicitado">
              <label for="solicitado">Solicitado por: </label>
              <select type="text" id="solicitado">
                <option value="">-Seleccionar-</option>
              </select>
              <input
                type="text"
                alt="firma-solicitante"
                id="firma-solicitado"
              />
            </div>
            <div class="contenedor-autorizado">
              <label for="autorizado">Autorizado por:</label>
              <input
                type="text"
                id="autorizado"
                value="Josue Hidalgo Deza"
                readonly
              />
              <input
                type="text"
                alt="firma-solicitante"
                id="firma-autorizado"
                value="../recursos/firmas/JosueHidalgo.png"
              />
            </div>
          </div>

          <!-- TAREAS A EJECUTAR -->
          <!--Considerar el tema de los comentarios para los que ya están insertados por defecto-->
          <section class="tareas">
            <h3>Tareas a Ejecutar</h3>
            <!-- <div class="tareas-iniciales">
              <div class="tarea-inicial">
                <label
                  >- Traslado de personal, equipos y herramientas
                  <input
                    type="text"
                    placeholder="Observaciones."
                    class="obs-tarea-inicial"
                /></label>
                <select class="tiempo-real">
                  <option selected value="0">-Tiempo REAL-</option>
                  <option>5 minutos</option>
                  <option>10 minutos</option>
                  <option>20 minutos</option>
                  <option>30 minutos</option>
                  <option>1 hora</option>
                  <option>1:30 horas</option>
                  <option>2 horas</option>
                  <option>2:30 horas</option>
                  <option>3 horas</option>
                  <option>3:30 horas</option>
                  <option>4 horas</option>
                </select>
              </div>
              <div class="tarea-inicial">
                <label
                  >- Identificar area de trabajo
                  <input
                    type="text"
                    placeholder="Observaciones."
                    class="obs-tarea-inicial"
                /></label>
                <select class="tiempo-real">
                  <option selected value="0">-Tiempo REAL-</option>
                  <option>5 minutos</option>
                  <option>10 minutos</option>
                  <option>20 minutos</option>
                  <option>30 minutos</option>
                  <option>1 hora</option>
                  <option>1:30 horas</option>
                  <option>2 horas</option>
                  <option>2:30 horas</option>
                  <option>3 horas</option>
                  <option>3:30 horas</option>
                  <option>4 horas</option>
                </select>
              </div>
              <div class="tarea-inicial">
                <label
                  >- Inspección visual de subestación
                  <input
                    type="text"
                    placeholder="Observaciones."
                    class="obs-tarea-inicial"
                /></label>
                <select class="tiempo-real">
                  <option selected value="0">-Tiempo REAL-</option>
                  <option>5 minutos</option>
                  <option>10 minutos</option>
                  <option>20 minutos</option>
                  <option>30 minutos</option>
                  <option>1 hora</option>
                  <option>1:30 horas</option>
                  <option>2 horas</option>
                  <option>2:30 horas</option>
                  <option>3 horas</option>
                  <option>3:30 horas</option>
                  <option>4 horas</option>
                </select>
              </div>
              <div class="tarea-inicial">
                <label
                  >- Armado y posicionamiento de escalera telescópica
                  <input
                    type="text"
                    placeholder="Observaciones."
                    class="obs-tarea-inicial"
                /></label>
                <select class="tiempo-real">
                  <option selected value="0">-Tiempo REAL-</option>
                  <option>5 minutos</option>
                  <option>10 minutos</option>
                  <option>20 minutos</option>
                  <option>30 minutos</option>
                  <option>1 hora</option>
                  <option>1:30 horas</option>
                  <option>2 horas</option>
                  <option>2:30 horas</option>
                  <option>3 horas</option>
                  <option>3:30 horas</option>
                  <option>4 horas</option>
                </select>
              </div>
              <div class="tarea-inicial">
                <label
                  >- Toma de cargas de subestación/ Inyección de carga
                  <input
                    type="text"
                    placeholder="Observaciones."
                    class="obs-tarea-inicial"
                /></label>
                <select class="tiempo-real">
                  <option selected value="0">-Tiempo REAL-</option>
                  <option>5 minutos</option>
                  <option>10 minutos</option>
                  <option>20 minutos</option>
                  <option>30 minutos</option>
                  <option>1 hora</option>
                  <option>1:30 horas</option>
                  <option>2 horas</option>
                  <option>2:30 horas</option>
                  <option>3 horas</option>
                  <option>3:30 horas</option>
                  <option>4 horas</option>
                </select>
              </div>
              <div class="tarea-inicial">
                <label
                  >- Inspección de Totalizador aéreo/ subterráneo
                  <input
                    type="text"
                    placeholder="Observaciones."
                    class="obs-tarea-inicial"
                /></label>
                <select class="tiempo-real">
                  <option selected value="0">-Tiempo REAL-</option>
                  <option>5 minutos</option>
                  <option>10 minutos</option>
                  <option>20 minutos</option>
                  <option>30 minutos</option>
                  <option>1 hora</option>
                  <option>1:30 horas</option>
                  <option>2 horas</option>
                  <option>2:30 horas</option>
                  <option>3 horas</option>
                  <option>3:30 horas</option>
                  <option>4 horas</option>
                </select>
              </div>
              <div class="tarea-inicial">
                <label
                  >- Toma de lecturas por suministro
                  <input
                    type="text"
                    placeholder="Observaciones."
                    class="obs-tarea-inicial"
                /></label>
                <select class="tiempo-real">
                  <option selected value="0">-Tiempo REAL-</option>
                  <option>5 minutos</option>
                  <option>10 minutos</option>
                  <option>20 minutos</option>
                  <option>30 minutos</option>
                  <option>1 hora</option>
                  <option>1:30 horas</option>
                  <option>2 horas</option>
                  <option>2:30 horas</option>
                  <option>3 horas</option>
                  <option>3:30 horas</option>
                  <option>4 horas</option>
                </select>
              </div>
              <div class="tarea-inicial">
                <label
                  >- Retiro de escalera
                  <input
                    type="text"
                    placeholder="Observaciones."
                    class="obs-tarea-inicial"
                /></label>
                <select class="tiempo-real">
                  <option selected value="0">-Tiempo REAL-</option>
                  <option>5 minutos</option>
                  <option>10 minutos</option>
                  <option>20 minutos</option>
                  <option>30 minutos</option>
                  <option>1 hora</option>
                  <option>1:30 horas</option>
                  <option>2 horas</option>
                  <option>2:30 horas</option>
                  <option>3 horas</option>
                  <option>3:30 horas</option>
                  <option>4 horas</option>
                </select>
              </div>
              <div class="tarea-inicial">
                <label
                  >- Llenado de plano de subestación
                  <input
                    type="text"
                    placeholder="Observaciones."
                    class="obs-tarea-inicial"
                /></label>
                <select class="tiempo-real">
                  <option selected value="0">-Tiempo REAL-</option>
                  <option>5 minutos</option>
                  <option>10 minutos</option>
                  <option>20 minutos</option>
                  <option>30 minutos</option>
                  <option>1 hora</option>
                  <option>1:30 horas</option>
                  <option>2 horas</option>
                  <option>2:30 horas</option>
                  <option>3 horas</option>
                  <option>3:30 horas</option>
                  <option>4 horas</option>
                </select>
              </div>
            </div> -->
            <!-- Tareas añadidas -->
            <div class="agregar-tarea">
              Nueva Tarea_<i class="fa-solid fa-pen-to-square"></i>
            </div>
            
          </section>

          <!-- EQUIPOS Y MATERIALES -->
          <section class="equipos">
            <h3>Equipos/ Materiales</h3>
            <!-- Equipos Iniciales-->
            <div class="equipos-iniciales">
              <label
                >Escalera telescopica
                <input
                  type="text"
                  placeholder="Observaciones."
                  class="obs-equip-inicial"
              /></label>

              <label
                >Carga resistiva 60A
                <input
                  type="text"
                  placeholder="Observaciones."
                  class="obs-equip-inicial"
              /></label>

              <label
                >Pinza Volt-amperimetrica BT
                <input
                  type="text"
                  placeholder="Observaciones."
                  class="obs-equip-inicial"
              /></label>

              <label
                >Pinza amperimétrica MT
                <input
                  type="text"
                  placeholder="Observaciones."
                  class="obs-equip-inicial"
              /></label>

              <label
                >Estrobo/Linea de anclaje
                <input
                  type="text"
                  placeholder="Observaciones."
                  class="obs-equip-inicial"
              /></label>

              <label
                >Tie Off
                <input
                  type="text"
                  placeholder="Observaciones."
                  class="obs-equip-inicial"
              /></label>

              <label
                >Mosquetón de acero
                <input
                  type="text"
                  placeholder="Observaciones."
                  class="obs-equip-inicial"
              /></label>

              <label
                >Polea
                <input
                  type="text"
                  placeholder="Observaciones."
                  class="obs-equip-inicial"
              /></label>

              <label
                >Freno de cuerda
                <input
                  type="text"
                  placeholder="Observaciones."
                  class="obs-equip-inicial"
              /></label>

              <label
                >Gri-Gri
                <input
                  type="text"
                  placeholder="Observaciones."
                  class="obs-equip-inicial"
              /></label>

              <label
                >Cuerda semiestatica 11mm
                <input
                  type="text"
                  placeholder="Observaciones."
                  class="obs-equip-inicial"
              /></label>

              <label
                >Soga de sujeción de poste
                <input
                  type="text"
                  placeholder="Observaciones."
                  class="obs-equip-inicial"
              /></label>

              <label
                >Cercos de seguridad PVC
                <input
                  type="text"
                  placeholder="Observaciones."
                  class="obs-equip-inicial"
              /></label>

              <label
                >Revelador de tensión
                <input
                  type="text"
                  placeholder="Observaciones."
                  class="obs-equip-inicial"
              /></label>

              <label
                >Manta aislante
                <input
                  type="text"
                  placeholder="Observaciones."
                  class="obs-equip-inicial"
              /></label>
            </div>

            <!--Herramientas Añadidas-->
            <div class="agregar-equipo">
              Nuevo Equipo/Material_<i class="fa-solid fa-helmet-safety"></i>
            </div>
            
          </section>

          <!-- HERRAMIENTAS -->
          <section class="herramientas">
            <h3>Herramientas</h3>
            <!-- Herramientas Iniciales-->
            <div class="herramientas-iniciales">
              <label
                >Juego de destornilladores
                <input
                  type="text"
                  placeholder="Observaciones."
                  class="obs-herr-inicial"
              /></label>
              <label
                >Juego de alicates
                <input
                  type="text"
                  placeholder="Observaciones."
                  class="obs-herr-inicial"
              /></label>
              <label
                >Juego de llaves 5 pines, triangular, circular
                <input
                  type="text"
                  placeholder="Observaciones."
                  class="obs-herr-inicial"
              /></label>
            </div>
            <!--Herramientas Añadidas-->
            <div class="agregar-herramienta">
              Nueva Herramienta<i class="fa-solid fa-screwdriver-wrench"></i>
            </div>
          </section>

          <!-- PERSONAL -->

          <section class="section-todo-personal">
            <h3>Personal</h3>
            <div class="agregar-personal">
              Adicionar Personal<i class="fa-solid fa-user-plus"></i>
            </div>
          </section>

          <!-- Comentarios -->
          <section class="comentarios">
            <h3>Observaciones</h3>
            <textarea
              name="comentario"
              id="comentario"
              cols="30"
              rows="10"
            ></textarea>
          </section>
        </div>
      </section>
      <div id="btnGenerar"><i class="fa-solid fa-file-pdf fa-lg"></i></div>
    </main>

    <script src="../scripts/functionsOrden.js"></script>
    <script type="module" src="../scripts/control_tiempo.js"></script>
  </body>
</html>
