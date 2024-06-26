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
    <title>Lista de Inspección Diaria</title>
    <?php 
      require("./header_comun/scripts_links.php")
    ?>
    <!-- Estilos -->
    <link rel="stylesheet" href="../estilos/stylesListIns.css" />
  </head>
  <body>
    <main class="main">
      <figure class="logo-title">
        <a href="../">
          <img src="../recursos/logo_teching.png" alt="teching_logo" />
        </a>
        <div>
          <span>Lista de Inspección Diaria</span>
        </div>
      </figure>
      <!-- editando -->
      <section class="form-container">
        <!--Inicia Cuerpo del Formulario-->
        <div class="form-body">
          <section
            class="datos-generales-documento"
            id="datos-generales-documento"
          >
            <div class="contenedor-empresa">
              <label for="empresa">Seleccionar Empresa</label>
              <select name="empresa" id="empresa" class="clase-empresa">
                <option selected>- Seleccionar -</option>
                <option value="TECHING">TECHING</option>
                <option value="CONTRATISTA1">CONTRATISTA1</option>
                <option value="CONTRATISTA2">CONTRATISTA2</option>
              </select>
            </div>
            <div class="contenedor-fecha">
              <label for="fecha">Fecha: </label
              ><input type="text" value="00-00-00" id="fecha" readonly />
            </div>
            <div class="contenedor-hora">
              <label for="hora">Hora: </label>
              <input type="time" id="hora" />
            </div>
            <div class="contenedor-trabajo">
              <label for="trabajo">Trabajo a Realizar: </label
              ><input type="text" id="trabajo" />
            </div>
            <div class="contendor-lugar">
              <label for="lugar">Lugar: </label><input type="text" id="lugar" />
            </div>
            <div class="contenedor-responsable">
              <label for="responsable-nombre">Responsable: </label>
              <select name="responsable-nombre" id="responsable-nombre">
                <option value="Seleccionar">--Seleccionar Responsable--</option>
              </select>
              <input type="text" id="firma-responsable" />
            </div>

            <div class="contenedor-supervisor">
              <label for="supervisor-nombre">Supervisor: </label>
              <select name="supervisor-nombre" id="supervisor-nombre">
                <option value="Seleccionar">--Seleccionar Supervisor--</option>
              </select>
              <input type="text" id="firma-supervisor" />
            </div>

            <div class="contenedor-comentarios">
              <label for="comentarios">Comentarios</label>
              <textarea
                name="comentarios"
                id="comentarios"
                cols="30"
                rows="10"
              ></textarea>
            </div>
          </section>

          <section class="section-todo-personal">
            <!-- La replica será de todo el contenido de 'contenedor-trabajador' -->
            <div id="botones">
              <div class="agregar-personal">
                Añadir <i class="fa-solid fa-user-plus"></i>
              </div>
              <!-- <div class="terminar">
                Generar <i class="fa-solid fa-check"></i>
              </div> -->
            </div>
            <article class="contenedor-trabajador">
              <h3>Datos del Personal</h3>
              <!-- Persona a evaluar -->
              <div class="cargo-nombre">
                <!-- cargo evaluado -->
                <div class="contenedor-cargo">
                  <select name="select-cargo" class="trabajador-cargo">
                    <option value="">-Seleccione un cargo-</option>
                    <option value="4">Jefe de Cuadrilla</option>
                    <option value="3">Técnico/Operario</option>
                    <option value="2">Conductor</option>
                    <option value="1">Ayudante</option>
                    <option value="5">Responsable de Grupo</option>
                  </select>
                </div>

                <!-- nombre evaluado -->
                <div class="contenedor-nombre">
                  <select name="select-nombre" class="trabajador-nombre">
                    <option value="">-Seleccione nombre-</option>
                  </select>
                  <input type="text" class="trabajador-firma" />
                  <input type="text" class="trabajador-dni" />
                </div>
              </div>
              <table class="leyenda">
                <thead>
                  <th>Bueno</th>
                  <th>Malogrado/ Dañado</th>
                  <th>No Tiene</th>
                  <th>No requiere</th>
                  <th>Fuera de Vigencia</th>
                </thead>
                <tbody>
                  <td>B</td>
                  <td>M</td>
                  <td>NT</td>
                  <td>NR</td>
                  <td>FV</td>
                </tbody>
              </table>

              <div class="elementos-evaluar">
                <!-- EPP -->
                <div class="contenedor-EPP">
                  <h4 class="elemento-titulo-general">
                    * EQUIPO DE PROTECCIÓN PERSONAL
                  </h4>
                  <ul class="lista">
                    <!-- camisa -->
                    <li class="elemento-lista">
                      <h4 class="elemento-titulo">
                        1. Camisa de Verano/Invierno
                      </h4>
                      <div class="elemento-cuerpo">
                        <label class="elemento-cantidad"
                          >Cantidad:
                          <select name="cantidad" class="camisa-cantidad">
                            <option value="0">0</option>
                            <option value="1" selected>1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                          </select>
                        </label>
                        <span class="elemento-opciones">
                          <label
                            >B
                            <input
                              type="radio"
                              name="camisa-verano-invierno"
                              value="B"
                          /></label>
                          <label
                            >M
                            <input
                              type="radio"
                              name="camisa-verano-invierno"
                              value="M"
                          /></label>
                          <label
                            >NT
                            <input
                              type="radio"
                              name="camisa-verano-invierno"
                              value="NT"
                          /></label>
                          <label
                            >NR
                            <input
                              type="radio"
                              name="camisa-verano-invierno"
                              value="NR"
                              checked
                          /></label>
                          <label
                            >FV
                            <input
                              type="radio"
                              name="camisa-verano-invierno"
                              value="FV"
                          /></label>
                        </span>
                      </div>
                      <div class="contenedor-codigo-fv">
                        <label>Código<input type="text" class="cod" /></label>
                        <label
                          >F. Vencimiento
                          <input type="date" class="vencimiento" />
                        </label>
                      </div>
                    </li>
                    <!-- pantalón de verano -->
                    <li class="elemento-lista">
                      <h4 class="elemento-titulo">2. Pantalón de Verano</h4>
                      <div class="elemento-cuerpo">
                        <label class="elemento-cantidad"
                          >Cantidad:
                          <select name="cantidad" class="pantalon-cantidad">
                            <option value="0">0</option>
                            <option value="1" selected>1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                          </select>
                        </label>
                        <span class="elemento-opciones">
                          <label
                            >B
                            <input
                              type="radio"
                              name="pantalon-verano-invierno"
                              value="B"
                          /></label>
                          <label
                            >M
                            <input
                              type="radio"
                              name="pantalon-verano-invierno"
                              value="M"
                          /></label>
                          <label
                            >NT
                            <input
                              type="radio"
                              name="pantalon-verano-invierno"
                              value="NT"
                          /></label>
                          <label
                            >NR
                            <input
                              type="radio"
                              name="pantalon-verano-invierno"
                              value="NR"
                              checked
                          /></label>
                          <label
                            >FV
                            <input
                              type="radio"
                              name="pantalon-verano-invierno"
                              value="FV"
                          /></label>
                        </span>
                      </div>
                      <div class="contenedor-codigo-fv">
                        <label>Código<input type="text" class="cod" /></label>
                        <label
                          >F. Vencimiento
                          <input type="date" class="vencimiento" />
                        </label>
                      </div>
                    </li>
                    <!-- camisa antiflama -->
                    <li class="elemento-lista">
                      <h4 class="elemento-titulo">3. Camisa antiflama</h4>
                      <div class="elemento-cuerpo">
                        <label class="elemento-cantidad"
                          >Cantidad:
                          <select
                            name="cantidad"
                            class="camisa-antiflama-cantidad"
                          >
                            <option value="0">0</option>
                            <option value="1" selected>1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                          </select>
                        </label>
                        <span class="elemento-opciones">
                          <label
                            >B
                            <input
                              type="radio"
                              name="camisa-antiflama"
                              value="B"
                          /></label>
                          <label
                            >M
                            <input
                              type="radio"
                              name="camisa-antiflama"
                              value="M"
                          /></label>
                          <label
                            >NT
                            <input
                              type="radio"
                              name="camisa-antiflama"
                              value="NT"
                          /></label>
                          <label
                            >NR
                            <input
                              type="radio"
                              name="camisa-antiflama"
                              value="NR"
                              checked
                          /></label>
                          <label
                            >FV
                            <input
                              type="radio"
                              name="camisa-antiflama"
                              value="FV"
                          /></label>
                        </span>
                      </div>
                      <div class="contenedor-codigo-fv">
                        <label>Código<input type="text" class="cod" /></label>
                        <label
                          >F. Vencimiento
                          <input type="date" class="vencimiento" />
                        </label>
                      </div>
                    </li>
                    <!-- pantalon antiflama -->
                    <li class="elemento-lista">
                      <h4 class="elemento-titulo">4. Pantalón antiflama</h4>
                      <div class="elemento-cuerpo">
                        <label class="elemento-cantidad"
                          >Cantidad:
                          <select
                            name="cantidad"
                            class="pantalon-antiflama-cantidad"
                          >
                            <option value="0">0</option>
                            <option value="1" selected>1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                          </select>
                        </label>
                        <span class="elemento-opciones">
                          <label
                            >B
                            <input
                              type="radio"
                              name="pantalon-antiflama"
                              value="B"
                          /></label>
                          <label
                            >M
                            <input
                              type="radio"
                              name="pantalon-antiflama"
                              value="M"
                          /></label>
                          <label
                            >NT
                            <input
                              type="radio"
                              name="pantalon-antiflama"
                              value="NT"
                          /></label>
                          <label
                            >NR
                            <input
                              type="radio"
                              name="pantalon-antiflama"
                              value="NR"
                              checked
                          /></label>
                          <label
                            >FV
                            <input
                              type="radio"
                              name="pantalon-antiflama"
                              value="FV"
                          /></label>
                        </span>
                      </div>
                      <div class="contenedor-codigo-fv">
                        <label>Código<input type="text" class="cod" /></label>
                        <label
                          >F. Vencimiento
                          <input type="date" class="vencimiento" />
                        </label>
                      </div>
                    </li>
                    <!-- zapatos dieléctricos -->
                    <li class="elemento-lista">
                      <h4 class="elemento-titulo">5. Zapatos Dieléctricos</h4>
                      <div class="elemento-cuerpo">
                        <label class="elemento-cantidad"
                          >Cantidad:
                          <select
                            name="cantidad"
                            class="zapatos-dielectricos-cantidad"
                          >
                            <option value="0">0</option>
                            <option value="1" selected>1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                          </select>
                        </label>
                        <span class="elemento-opciones">
                          <label
                            >B
                            <input
                              type="radio"
                              name="zapatos-dielectricos"
                              value="B"
                          /></label>
                          <label
                            >M
                            <input
                              type="radio"
                              name="zapatos-dielectricos"
                              value="M"
                          /></label>
                          <label
                            >NT
                            <input
                              type="radio"
                              name="zapatos-dielectricos"
                              value="NT"
                          /></label>
                          <label
                            >NR
                            <input
                              type="radio"
                              name="zapatos-dielectricos"
                              value="NR"
                              checked
                          /></label>
                          <label
                            >FV
                            <input
                              type="radio"
                              name="zapatos-dielectricos"
                              value="FV"
                          /></label>
                        </span>
                      </div>
                      <div class="contenedor-codigo-fv">
                        <label>Código<input type="text" class="cod" /></label>
                        <label
                          >F. Vencimiento
                          <input type="date" class="vencimiento" />
                        </label>
                      </div>
                    </li>
                    <!-- Chaleco preventivo de seguridad -->
                    <li class="elemento-lista">
                      <h4 class="elemento-titulo">
                        6. Chaleco preventivo de seguridad
                      </h4>
                      <div class="elemento-cuerpo">
                        <label class="elemento-cantidad"
                          >Cantidad:
                          <select
                            name="cantidad"
                            class="chaleco-preventivo-cantidad"
                          >
                            <option value="0">0</option>
                            <option value="1" selected>1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                          </select>
                        </label>
                        <span class="elemento-opciones">
                          <label
                            >B
                            <input
                              type="radio"
                              name="chaleco-preventivo"
                              value="B"
                          /></label>
                          <label
                            >M
                            <input
                              type="radio"
                              name="chaleco-preventivo"
                              value="M"
                          /></label>
                          <label
                            >NT
                            <input
                              type="radio"
                              name="chaleco-preventivo"
                              value="NT"
                          /></label>
                          <label
                            >NR
                            <input
                              type="radio"
                              name="chaleco-preventivo"
                              value="NR"
                              checked
                          /></label>
                          <label
                            >FV
                            <input
                              type="radio"
                              name="chaleco-preventivo"
                              value="FV"
                          /></label>
                        </span>
                      </div>
                      <div class="contenedor-codigo-fv">
                        <label>Código<input type="text" class="cod" /></label>
                        <label
                          >F. Vencimiento
                          <input type="date" class="vencimiento" />
                        </label>
                      </div>
                    </li>
                    <!-- Lentes con protección UV -->
                    <li class="elemento-lista">
                      <h4 class="elemento-titulo">
                        7. Lentes con protección UV
                      </h4>
                      <div class="elemento-cuerpo">
                        <label class="elemento-cantidad"
                          >Cantidad:
                          <select name="cantidad" class="lentes-uv-cantidad">
                            <option value="0">0</option>
                            <option value="1" selected>1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                          </select>
                        </label>
                        <span class="elemento-opciones">
                          <label
                            >B <input type="radio" name="lentes-uv" value="B"
                          /></label>
                          <label
                            >M <input type="radio" name="lentes-uv" value="M"
                          /></label>
                          <label
                            >NT <input type="radio" name="lentes-uv" value="NT"
                          /></label>
                          <label
                            >NR
                            <input
                              type="radio"
                              name="lentes-uv"
                              value="NR"
                              checked
                          /></label>
                          <label
                            >FV <input type="radio" name="lentes-uv" value="FV"
                          /></label>
                        </span>
                      </div>
                      <div class="contenedor-codigo-fv">
                        <label>Código<input type="text" class="cod" /></label>
                        <label
                          >F. Vencimiento
                          <input type="date" class="vencimiento" />
                        </label>
                      </div>
                    </li>
                    <!-- Lentes contra impacto -->
                    <li class="elemento-lista">
                      <h4 class="elemento-titulo">8. Lentes contra impacto</h4>
                      <div class="elemento-cuerpo">
                        <label class="elemento-cantidad"
                          >Cantidad:
                          <select
                            name="cantidad"
                            class="lentes-impacto-cantidad"
                          >
                            <option value="0">0</option>
                            <option value="1" selected>1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                          </select>
                        </label>
                        <span class="elemento-opciones">
                          <label
                            >B
                            <input type="radio" name="lentes-impacto" value="B"
                          /></label>
                          <label
                            >M
                            <input type="radio" name="lentes-impacto" value="M"
                          /></label>
                          <label
                            >NT
                            <input
                              type="radio"
                              name="lentes-impacto"
                              value="NT"
                          /></label>
                          <label
                            >NR
                            <input
                              type="radio"
                              name="lentes-impacto"
                              value="NR"
                              checked
                          /></label>
                          <label
                            >FV
                            <input
                              type="radio"
                              name="lentes-impacto"
                              value="FV"
                          /></label>
                        </span>
                      </div>
                      <div class="contenedor-codigo-fv">
                        <label>Código<input type="text" class="cod" /></label>
                        <label
                          >F. Vencimiento
                          <input type="date" class="vencimiento" />
                        </label>
                      </div>
                    </li>
                    <!-- Bloqueador solar -->
                    <li class="elemento-lista">
                      <h4 class="elemento-titulo">9. Bloqueador solar</h4>
                      <div class="elemento-cuerpo">
                        <label class="elemento-cantidad"
                          >Cantidad:
                          <select
                            name="cantidad"
                            class="bloqueador-solar-cantidad"
                          >
                            <option value="0">0</option>
                            <option value="1" selected>1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                          </select>
                        </label>
                        <span class="elemento-opciones">
                          <label
                            >B
                            <input
                              type="radio"
                              name="bloqueador-solar"
                              value="B"
                          /></label>
                          <label
                            >M
                            <input
                              type="radio"
                              name="bloqueador-solar"
                              value="M"
                          /></label>
                          <label
                            >NT
                            <input
                              type="radio"
                              name="bloqueador-solar"
                              value="NT"
                          /></label>
                          <label
                            >NR
                            <input
                              type="radio"
                              name="bloqueador-solar"
                              value="NR"
                              checked
                          /></label>
                          <label
                            >FV
                            <input
                              type="radio"
                              name="bloqueador-solar"
                              value="FV"
                          /></label>
                        </span>
                      </div>
                      <div class="contenedor-codigo-fv">
                        <label>Código<input type="text" class="cod" /></label>
                        <label
                          >F. Vencimiento
                          <input type="date" class="vencimiento" />
                        </label>
                      </div>
                    </li>
                    <!-- Casco Dieléctrico normado con barbiqueo -->
                    <li class="elemento-lista">
                      <h4 class="elemento-titulo">
                        10. Casco Dieléctrico normado con barbiqueo
                      </h4>
                      <div class="elemento-cuerpo">
                        <label class="elemento-cantidad"
                          >Cantidad:
                          <select
                            name="cantidad"
                            class="casco-dielectrico-cantidad"
                          >
                            <option value="0">0</option>
                            <option value="1" selected>1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                          </select>
                        </label>
                        <span class="elemento-opciones">
                          <label
                            >B
                            <input
                              type="radio"
                              name="casco-dielectrico"
                              value="B"
                          /></label>
                          <label
                            >M
                            <input
                              type="radio"
                              name="casco-dielectrico"
                              value="M"
                          /></label>
                          <label
                            >NT
                            <input
                              type="radio"
                              name="casco-dielectrico"
                              value="NT"
                          /></label>
                          <label
                            >NR
                            <input
                              type="radio"
                              name="casco-dielectrico"
                              value="NR"
                              checked
                          /></label>
                          <label
                            >FV
                            <input
                              type="radio"
                              name="casco-dielectrico"
                              value="FV"
                          /></label>
                        </span>
                      </div>
                      <div class="contenedor-codigo-fv">
                        <label>Código<input type="text" class="cod" /></label>
                        <label
                          >F. Vencimiento
                          <input type="date" class="vencimiento" />
                        </label>
                      </div>
                    </li>
                    <!-- Guantes Dieléctricos BT-Clase 0, TIPO I -->
                    <li class="elemento-lista">
                      <h4 class="elemento-titulo">
                        11. Guantes Dieléctricos BT-Clase 0, TIPO I
                      </h4>
                      <div class="elemento-cuerpo">
                        <label class="elemento-cantidad"
                          >Cantidad:
                          <select
                            name="cantidad"
                            class="guantes-dielectricos-cantidad"
                          >
                            <option value="0">0</option>
                            <option value="1" selected>1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                          </select>
                        </label>
                        <span class="elemento-opciones">
                          <label
                            >B
                            <input
                              type="radio"
                              name="guantes-dielectricos"
                              value="B"
                          /></label>
                          <label
                            >M
                            <input
                              type="radio"
                              name="guantes-dielectricos"
                              value="M"
                          /></label>
                          <label
                            >NT
                            <input
                              type="radio"
                              name="guantes-dielectricos"
                              value="NT"
                          /></label>
                          <label
                            >NR
                            <input
                              type="radio"
                              name="guantes-dielectricos"
                              value="NR"
                              checked
                          /></label>
                          <label
                            >FV
                            <input
                              type="radio"
                              name="guantes-dielectricos"
                              value="FV"
                          /></label>
                        </span>
                      </div>
                      <div class="contenedor-codigo-fv">
                        <label>Código<input type="text" class="cod" /></label>
                        <label
                          >F. Vencimiento
                          <input type="date" class="vencimiento" />
                        </label>
                      </div>
                    </li>
                    <!-- Careta facial policarbonato -->
                    <li class="elemento-lista">
                      <h4 class="elemento-titulo">
                        12. Careta facial policarbonato
                      </h4>
                      <div class="elemento-cuerpo">
                        <label class="elemento-cantidad"
                          >Cantidad:
                          <select
                            name="cantidad"
                            class="careta-policarbonato-cantidad"
                          >
                            <option value="0">0</option>
                            <option value="1" selected>1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                          </select>
                        </label>
                        <span class="elemento-opciones">
                          <label
                            >B
                            <input
                              type="radio"
                              name="careta-policarbonato"
                              value="B"
                          /></label>
                          <label
                            >M
                            <input
                              type="radio"
                              name="careta-policarbonato"
                              value="M"
                          /></label>
                          <label
                            >NT
                            <input
                              type="radio"
                              name="careta-policarbonato"
                              value="NT"
                          /></label>
                          <label
                            >NR
                            <input
                              type="radio"
                              name="careta-policarbonato"
                              value="NR"
                              checked
                          /></label>
                          <label
                            >FV
                            <input
                              type="radio"
                              name="careta-policarbonato"
                              value="FV"
                          /></label>
                        </span>
                      </div>
                      <div class="contenedor-codigo-fv">
                        <label>Código<input type="text" class="cod" /></label>
                        <label
                          >F. Vencimiento
                          <input type="date" class="vencimiento" />
                        </label>
                      </div>
                    </li>
                    <!-- Careta facial antiarco -->
                    <li class="elemento-lista">
                      <h4 class="elemento-titulo">
                        13. Careta facial antiarco
                      </h4>
                      <div class="elemento-cuerpo">
                        <label class="elemento-cantidad"
                          >Cantidad:
                          <select
                            name="cantidad"
                            class="careta-antiarco-cantidad"
                          >
                            <option value="0">0</option>
                            <option value="1" selected>1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                          </select>
                        </label>
                        <span class="elemento-opciones">
                          <label
                            >B
                            <input
                              type="radio"
                              name="careta-antiarco"
                              value="B"
                          /></label>
                          <label
                            >M
                            <input
                              type="radio"
                              name="careta-antiarco"
                              value="M"
                          /></label>
                          <label
                            >NT
                            <input
                              type="radio"
                              name="careta-antiarco"
                              value="NT"
                          /></label>
                          <label
                            >NR
                            <input
                              type="radio"
                              name="careta-antiarco"
                              value="NR"
                              checked
                          /></label>
                          <label
                            >FV
                            <input
                              type="radio"
                              name="careta-antiarco"
                              value="FV"
                          /></label>
                        </span>
                      </div>
                      <div class="contenedor-codigo-fv">
                        <label>Código<input type="text" class="cod" /></label>
                        <label
                          >F. Vencimiento
                          <input type="date" class="vencimiento" />
                        </label>
                      </div>
                    </li>
                    <!-- Guante de badana -->
                    <li class="elemento-lista">
                      <h4 class="elemento-titulo">14. Guante de badana</h4>
                      <div class="elemento-cuerpo">
                        <label class="elemento-cantidad"
                          >Cantidad:
                          <select
                            name="cantidad"
                            class="guante-badana-cantidad"
                          >
                            <option value="0">0</option>
                            <option value="1" selected>1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                          </select>
                        </label>
                        <span class="elemento-opciones">
                          <label
                            >B
                            <input type="radio" name="guante-badana" value="B"
                          /></label>
                          <label
                            >M
                            <input type="radio" name="guante-badana" value="M"
                          /></label>
                          <label
                            >NT
                            <input type="radio" name="guante-badana" value="NT"
                          /></label>
                          <label
                            >NR
                            <input
                              type="radio"
                              name="guante-badana"
                              value="NR"
                              checked
                          /></label>
                          <label
                            >FV
                            <input type="radio" name="guante-badana" value="FV"
                          /></label>
                        </span>
                      </div>
                      <div class="contenedor-codigo-fv">
                        <label>Código<input type="text" class="cod" /></label>
                        <label
                          >F. Vencimiento
                          <input type="date" class="vencimiento" />
                        </label>
                      </div>
                    </li>
                    <!-- Guante de cuero -->
                    <li class="elemento-lista">
                      <h4 class="elemento-titulo">15. Guante de cuero</h4>
                      <div class="elemento-cuerpo">
                        <label class="elemento-cantidad"
                          >Cantidad:
                          <select name="cantidad" class="guante-cuero-cantidad">
                            <option value="0">0</option>
                            <option value="1" selected>1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                          </select>
                        </label>
                        <span class="elemento-opciones">
                          <label
                            >B
                            <input type="radio" name="guante-cuero" value="B"
                          /></label>
                          <label
                            >M
                            <input type="radio" name="guante-cuero" value="M"
                          /></label>
                          <label
                            >NT
                            <input type="radio" name="guante-cuero" value="NT"
                          /></label>
                          <label
                            >NR
                            <input
                              type="radio"
                              name="guante-cuero"
                              value="NR"
                              checked
                          /></label>
                          <label
                            >FV
                            <input type="radio" name="guante-cuero" value="FV"
                          /></label>
                        </span>
                      </div>
                      <div class="contenedor-codigo-fv">
                        <label>Código<input type="text" class="cod" /></label>
                        <label
                          >F. Vencimiento
                          <input type="date" class="vencimiento" />
                        </label>
                      </div>
                    </li>
                    <!-- Guante de hilo -->
                    <li class="elemento-lista">
                      <h4 class="elemento-titulo">16. Guante de hilo</h4>
                      <div class="elemento-cuerpo">
                        <label class="elemento-cantidad"
                          >Cantidad:
                          <select name="cantidad" class="guante-hilo-cantidad">
                            <option value="0">0</option>
                            <option value="1" selected>1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                          </select>
                        </label>
                        <span class="elemento-opciones">
                          <label
                            >B <input type="radio" name="guante-hilo" value="B"
                          /></label>
                          <label
                            >M <input type="radio" name="guante-hilo" value="M"
                          /></label>
                          <label
                            >NT
                            <input type="radio" name="guante-hilo" value="NT"
                          /></label>
                          <label
                            >NR
                            <input
                              type="radio"
                              name="guante-hilo"
                              value="NR"
                              checked
                          /></label>
                          <label
                            >FV
                            <input type="radio" name="guante-hilo" value="FV"
                          /></label>
                        </span>
                      </div>
                      <div class="contenedor-codigo-fv">
                        <label>Código<input type="text" class="cod" /></label>
                        <label
                          >F. Vencimiento
                          <input type="date" class="vencimiento" />
                        </label>
                      </div>
                    </li>
                    <!-- Mascarilla contra polvo -->
                    <li class="elemento-lista">
                      <h4 class="elemento-titulo">
                        17. Mascarilla contra polvo
                      </h4>
                      <div class="elemento-cuerpo">
                        <label class="elemento-cantidad"
                          >Cantidad:
                          <select
                            name="cantidad"
                            class="mascarilla-polvo-cantidad"
                          >
                            <option value="0">0</option>
                            <option value="1" selected>1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                          </select>
                        </label>
                        <span class="elemento-opciones">
                          <label
                            >B
                            <input
                              type="radio"
                              name="mascarilla-polvo"
                              value="B"
                          /></label>
                          <label
                            >M
                            <input
                              type="radio"
                              name="mascarilla-polvo"
                              value="M"
                          /></label>
                          <label
                            >NT
                            <input
                              type="radio"
                              name="mascarilla-polvo"
                              value="NT"
                          /></label>
                          <label
                            >NR
                            <input
                              type="radio"
                              name="mascarilla-polvo"
                              value="NR"
                              checked
                          /></label>
                          <label
                            >FV
                            <input
                              type="radio"
                              name="mascarilla-polvo"
                              value="FV"
                          /></label>
                        </span>
                      </div>
                      <div class="contenedor-codigo-fv">
                        <label>Código<input type="text" class="cod" /></label>
                        <label
                          >F. Vencimiento
                          <input type="date" class="vencimiento" />
                        </label>
                      </div>
                    </li>
                    <!-- Correa Porta Herramientas -->
                    <li class="elemento-lista">
                      <h4 class="elemento-titulo">
                        18. Correa Porta Herramientas
                      </h4>
                      <div class="elemento-cuerpo">
                        <label class="elemento-cantidad"
                          >Cantidad:
                          <select
                            name="cantidad"
                            class="correa-herramientas-cantidad"
                          >
                            <option value="0">0</option>
                            <option value="1" selected>1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                          </select>
                        </label>
                        <span class="elemento-opciones">
                          <label
                            >B
                            <input
                              type="radio"
                              name="correa-herramientas"
                              value="B"
                          /></label>
                          <label
                            >M
                            <input
                              type="radio"
                              name="correa-herramientas"
                              value="M"
                          /></label>
                          <label
                            >NT
                            <input
                              type="radio"
                              name="correa-herramientas"
                              value="NT"
                          /></label>
                          <label
                            >NR
                            <input
                              type="radio"
                              name="correa-herramientas"
                              value="NR"
                              checked
                          /></label>
                          <label
                            >FV
                            <input
                              type="radio"
                              name="correa-herramientas"
                              value="FV"
                          /></label>
                        </span>
                      </div>
                      <div class="contenedor-codigo-fv">
                        <label>Código<input type="text" class="cod" /></label>
                        <label
                          >F. Vencimiento
                          <input type="date" class="vencimiento" />
                        </label>
                      </div>
                    </li>
                    <!-- Manta Dieléctrica -->
                    <li class="elemento-lista">
                      <h4 class="elemento-titulo">19. Manta Dieléctrica</h4>
                      <div class="elemento-cuerpo">
                        <label class="elemento-cantidad"
                          >Cantidad:
                          <select
                            name="cantidad"
                            class="manta-dielectrica-cantidad"
                          >
                            <option value="0">0</option>
                            <option value="1" selected>1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                          </select>
                        </label>
                        <span class="elemento-opciones">
                          <label
                            >B
                            <input
                              type="radio"
                              name="manta-dielectrica"
                              value="B"
                          /></label>
                          <label
                            >M
                            <input
                              type="radio"
                              name="manta-dielectrica"
                              value="M"
                          /></label>
                          <label
                            >NT
                            <input
                              type="radio"
                              name="manta-dielectrica"
                              value="NT"
                          /></label>
                          <label
                            >NR
                            <input
                              type="radio"
                              name="manta-dielectrica"
                              value="NR"
                              checked
                          /></label>
                          <label
                            >FV
                            <input
                              type="radio"
                              name="manta-dielectrica"
                              value="FV"
                          /></label>
                        </span>
                      </div>
                      <div class="contenedor-codigo-fv">
                        <label>Código<input type="text" class="cod" /></label>
                        <label
                          >F. Vencimiento
                          <input type="date" class="vencimiento" />
                        </label>
                      </div>
                    </li>
                    <!-- Capucha Ignífuga -->
                    <li class="elemento-lista">
                      <h4 class="elemento-titulo">20. Capucha Ignífuga</h4>
                      <div class="elemento-cuerpo">
                        <label class="elemento-cantidad"
                          >Cantidad:
                          <select
                            name="cantidad"
                            class="capucha-ignifigua-cantidad"
                          >
                            <option value="0">0</option>
                            <option value="1" selected>1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                          </select>
                        </label>
                        <span class="elemento-opciones">
                          <label
                            >B
                            <input
                              type="radio"
                              name="capucha-ignifigua"
                              value="B"
                          /></label>
                          <label
                            >M
                            <input
                              type="radio"
                              name="capucha-ignifigua"
                              value="M"
                          /></label>
                          <label
                            >NT
                            <input
                              type="radio"
                              name="capucha-ignifigua"
                              value="NT"
                          /></label>
                          <label
                            >NR
                            <input
                              type="radio"
                              name="capucha-ignifigua"
                              value="NR"
                              checked
                          /></label>
                          <label
                            >FV
                            <input
                              type="radio"
                              name="capucha-ignifigua"
                              value="FV"
                          /></label>
                        </span>
                      </div>
                      <div class="contenedor-codigo-fv">
                        <label>Código<input type="text" class="cod" /></label>
                        <label
                          >F. Vencimiento
                          <input type="date" class="vencimiento" />
                        </label>
                      </div>
                    </li>
                  </ul>
                </div>
                <hr />

                <!-- Herramientas -->
                <div class="contenedor-herramientas">
                  <h4 class="elemento-titulo-general">* HERRAMIENTAS</h4>
                  <ul class="lista">
                    <!-- Alicate universal 8" de longitud 1000V -->
                    <li class="elemento-lista">
                      <h4 class="elemento-titulo">
                        1. Alicate universal 8" de longitud 1000V
                      </h4>
                      <div class="elemento-cuerpo">
                        <label class="elemento-cantidad"
                          >Cantidad:
                          <select
                            name="cantidad"
                            class="alicate-universal-cantidad"
                          >
                            <option value="0">0</option>
                            <option value="1" selected>1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                          </select>
                        </label>
                        <span class="elemento-opciones">
                          <label
                            >B
                            <input
                              type="radio"
                              name="alicate-universal"
                              value="B"
                          /></label>
                          <label
                            >M
                            <input
                              type="radio"
                              name="alicate-universal"
                              value="M"
                          /></label>
                          <label
                            >NT
                            <input
                              type="radio"
                              name="alicate-universal"
                              value="NT"
                          /></label>
                          <label
                            >NR
                            <input
                              type="radio"
                              name="alicate-universal"
                              value="NR"
                              checked
                          /></label>
                          <label
                            >FV
                            <input
                              type="radio"
                              name="alicate-universal"
                              value="FV"
                          /></label>
                        </span>
                      </div>
                      <div class="contenedor-codigo-fv">
                        <label>Código<input type="text" class="cod" /></label>
                        <label
                          >F. Vencimiento
                          <input type="date" class="vencimiento" />
                        </label>
                      </div>
                    </li>
                    <!-- Alicate de corte aislado 6" -->
                    <li class="elemento-lista">
                      <h4 class="elemento-titulo">
                        2. Alicate de corte aislado 6"
                      </h4>
                      <div class="elemento-cuerpo">
                        <label class="elemento-cantidad"
                          >Cantidad:
                          <select
                            name="cantidad"
                            class="alicate-corte-cantidad"
                          >
                            <option value="0">0</option>
                            <option value="1" selected>1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                          </select>
                        </label>
                        <span class="elemento-opciones">
                          <label
                            >B
                            <input type="radio" name="alicate-corte" value="B"
                          /></label>
                          <label
                            >M
                            <input type="radio" name="alicate-corte" value="M"
                          /></label>
                          <label
                            >NT
                            <input type="radio" name="alicate-corte" value="NT"
                          /></label>
                          <label
                            >NR
                            <input
                              type="radio"
                              name="alicate-corte"
                              value="NR"
                              checked
                          /></label>
                          <label
                            >FV
                            <input type="radio" name="alicate-corte" value="FV"
                          /></label>
                        </span>
                      </div>
                      <div class="contenedor-codigo-fv">
                        <label>Código<input type="text" class="cod" /></label>
                        <label
                          >F. Vencimiento
                          <input type="date" class="vencimiento" />
                        </label>
                      </div>
                    </li>
                    <!-- Alicate de punta aislada 6" -->
                    <li class="elemento-lista">
                      <h4 class="elemento-titulo">
                        3. Alicate de punta aislada 6"
                      </h4>
                      <div class="elemento-cuerpo">
                        <label class="elemento-cantidad"
                          >Cantidad:
                          <select
                            name="cantidad"
                            class="alicate-punnta-cantidad"
                          >
                            <option value="0">0</option>
                            <option value="1" selected>1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                          </select>
                        </label>
                        <span class="elemento-opciones">
                          <label
                            >B
                            <input type="radio" name="alicate-punnta" value="B"
                          /></label>
                          <label
                            >M
                            <input type="radio" name="alicate-punnta" value="M"
                          /></label>
                          <label
                            >NT
                            <input
                              type="radio"
                              name="alicate-punnta"
                              value="NT"
                          /></label>
                          <label
                            >NR
                            <input
                              type="radio"
                              name="alicate-punnta"
                              value="NR"
                              checked
                          /></label>
                          <label
                            >FV
                            <input
                              type="radio"
                              name="alicate-punnta"
                              value="FV"
                          /></label>
                        </span>
                      </div>
                      <div class="contenedor-codigo-fv">
                        <label>Código<input type="text" class="cod" /></label>
                        <label
                          >F. Vencimiento
                          <input type="date" class="vencimiento" />
                        </label>
                      </div>
                    </li>
                    <!-- Destornillador plano aislado 6" -->
                    <li class="elemento-lista">
                      <h4 class="elemento-titulo">
                        4. Destornillador plano aislado 6"
                      </h4>
                      <div class="elemento-cuerpo">
                        <label class="elemento-cantidad"
                          >Cantidad:
                          <select
                            name="cantidad"
                            class="destornillador-plano-cantidad"
                          >
                            <option value="0">0</option>
                            <option value="1" selected>1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                          </select>
                        </label>
                        <span class="elemento-opciones">
                          <label
                            >B
                            <input
                              type="radio"
                              name="destornillador-plano"
                              value="B"
                          /></label>
                          <label
                            >M
                            <input
                              type="radio"
                              name="destornillador-plano"
                              value="M"
                          /></label>
                          <label
                            >NT
                            <input
                              type="radio"
                              name="destornillador-plano"
                              value="NT"
                          /></label>
                          <label
                            >NR
                            <input
                              type="radio"
                              name="destornillador-plano"
                              value="NR"
                              checked
                          /></label>
                          <label
                            >FV
                            <input
                              type="radio"
                              name="destornillador-plano"
                              value="FV"
                          /></label>
                        </span>
                      </div>
                      <div class="contenedor-codigo-fv">
                        <label>Código<input type="text" class="cod" /></label>
                        <label
                          >F. Vencimiento
                          <input type="date" class="vencimiento" />
                        </label>
                      </div>
                    </li>
                    <!-- Perillero (opcional) -->
                    <li class="elemento-lista">
                      <h4 class="elemento-titulo">5. Perillero (opcional)</h4>
                      <div class="elemento-cuerpo">
                        <label class="elemento-cantidad"
                          >Cantidad:
                          <select name="cantidad" class="perillero-cantidad">
                            <option value="0">0</option>
                            <option value="1" selected>1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                          </select>
                        </label>
                        <span class="elemento-opciones">
                          <label
                            >B <input type="radio" name="perillero" value="B"
                          /></label>
                          <label
                            >M <input type="radio" name="perillero" value="M"
                          /></label>
                          <label
                            >NT <input type="radio" name="perillero" value="NT"
                          /></label>
                          <label
                            >NR
                            <input
                              type="radio"
                              name="perillero"
                              value="NR"
                              checked
                          /></label>
                          <label
                            >FV <input type="radio" name="perillero" value="FV"
                          /></label>
                        </span>
                      </div>
                      <div class="contenedor-codigo-fv">
                        <label>Código<input type="text" class="cod" /></label>
                        <label
                          >F. Vencimiento
                          <input type="date" class="vencimiento" />
                        </label>
                      </div>
                    </li>
                    <!-- Destornillador estrella aislado 6" o 8" -->
                    <li class="elemento-lista">
                      <h4 class="elemento-titulo">
                        6. Destornillador estrella aislado 6" o 8"
                      </h4>
                      <div class="elemento-cuerpo">
                        <label class="elemento-cantidad"
                          >Cantidad:
                          <select
                            name="cantidad"
                            class="destornillador-estrella-cantidad"
                          >
                            <option value="0">0</option>
                            <option value="1" selected>1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                          </select>
                        </label>
                        <span class="elemento-opciones">
                          <label
                            >B
                            <input
                              type="radio"
                              name="destornillador-estrella"
                              value="B"
                          /></label>
                          <label
                            >M
                            <input
                              type="radio"
                              name="destornillador-estrella"
                              value="M"
                          /></label>
                          <label
                            >NT
                            <input
                              type="radio"
                              name="destornillador-estrella"
                              value="NT"
                          /></label>
                          <label
                            >NR
                            <input
                              type="radio"
                              name="destornillador-estrella"
                              value="NR"
                              checked
                          /></label>
                          <label
                            >FV
                            <input
                              type="radio"
                              name="destornillador-estrella"
                              value="FV"
                          /></label>
                        </span>
                      </div>
                      <div class="contenedor-codigo-fv">
                        <label>Código<input type="text" class="cod" /></label>
                        <label
                          >F. Vencimiento
                          <input type="date" class="vencimiento" />
                        </label>
                      </div>
                    </li>
                    <!-- Destornillador hexagonal -->
                    <li class="elemento-lista">
                      <h4 class="elemento-titulo">
                        7. Destornillador hexagonal
                      </h4>
                      <div class="elemento-cuerpo">
                        <label class="elemento-cantidad"
                          >Cantidad:
                          <select
                            name="cantidad"
                            class="destornillador-hexagonal-cantidad"
                          >
                            <option value="0">0</option>
                            <option value="1" selected>1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                          </select>
                        </label>
                        <span class="elemento-opciones">
                          <label
                            >B
                            <input
                              type="radio"
                              name="destornillador-hexagonal"
                              value="B"
                          /></label>
                          <label
                            >M
                            <input
                              type="radio"
                              name="destornillador-hexagonal"
                              value="M"
                          /></label>
                          <label
                            >NT
                            <input
                              type="radio"
                              name="destornillador-hexagonal"
                              value="NT"
                          /></label>
                          <label
                            >NR
                            <input
                              type="radio"
                              name="destornillador-hexagonal"
                              value="NR"
                              checked
                          /></label>
                          <label
                            >FV
                            <input
                              type="radio"
                              name="destornillador-hexagonal"
                              value="FV"
                          /></label>
                        </span>
                      </div>
                      <div class="contenedor-codigo-fv">
                        <label>Código<input type="text" class="cod" /></label>
                        <label
                          >F. Vencimiento
                          <input type="date" class="vencimiento" />
                        </label>
                      </div>
                    </li>
                    <!-- Juego de llave allen -->
                    <li class="elemento-lista">
                      <h4 class="elemento-titulo">8. Juego de llave allen</h4>
                      <div class="elemento-cuerpo">
                        <label class="elemento-cantidad"
                          >Cantidad:
                          <select name="cantidad" class="llaves-allen-cantidad">
                            <option value="0">0</option>
                            <option value="1" selected>1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                          </select>
                        </label>
                        <span class="elemento-opciones">
                          <label
                            >B
                            <input type="radio" name="llaves-allen" value="B"
                          /></label>
                          <label
                            >M
                            <input type="radio" name="llaves-allen" value="M"
                          /></label>
                          <label
                            >NT
                            <input type="radio" name="llaves-allen" value="NT"
                          /></label>
                          <label
                            >NR
                            <input
                              type="radio"
                              name="llaves-allen"
                              value="NR"
                              checked
                          /></label>
                          <label
                            >FV
                            <input type="radio" name="llaves-allen" value="FV"
                          /></label>
                        </span>
                      </div>
                      <div class="contenedor-codigo-fv">
                        <label>Código<input type="text" class="cod" /></label>
                        <label
                          >F. Vencimiento
                          <input type="date" class="vencimiento" />
                        </label>
                      </div>
                    </li>
                    <!-- juego de llave ratchets Aislado -->
                    <li class="elemento-lista">
                      <h4 class="elemento-titulo">
                        9. juego de llave ratchets Aislado
                      </h4>
                      <div class="elemento-cuerpo">
                        <label class="elemento-cantidad"
                          >Cantidad:
                          <select
                            name="cantidad"
                            class="llaves-ratchets-aislado-cantidad"
                          >
                            <option value="0">0</option>
                            <option value="1" selected>1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                          </select>
                        </label>
                        <span class="elemento-opciones">
                          <label
                            >B
                            <input
                              type="radio"
                              name="llaves-ratchets-aislado"
                              value="B"
                          /></label>
                          <label
                            >M
                            <input
                              type="radio"
                              name="llaves-ratchets-aislado"
                              value="M"
                          /></label>
                          <label
                            >NT
                            <input
                              type="radio"
                              name="llaves-ratchets-aislado"
                              value="NT"
                          /></label>
                          <label
                            >NR
                            <input
                              type="radio"
                              name="llaves-ratchets-aislado"
                              value="NR"
                              checked
                          /></label>
                          <label
                            >FV
                            <input
                              type="radio"
                              name="llaves-ratchets-aislado"
                              value="FV"
                          /></label>
                        </span>
                      </div>
                      <div class="contenedor-codigo-fv">
                        <label>Código<input type="text" class="cod" /></label>
                        <label
                          >F. Vencimiento
                          <input type="date" class="vencimiento" />
                        </label>
                      </div>
                    </li>
                    <!-- Revelador de tensión BT -->
                    <li class="elemento-lista">
                      <h4 class="elemento-titulo">
                        10. Revelador de tensión BT
                      </h4>
                      <div class="elemento-cuerpo">
                        <label class="elemento-cantidad"
                          >Cantidad:
                          <select
                            name="cantidad"
                            class="rev-tension-bt-cantidad"
                          >
                            <option value="0">0</option>
                            <option value="1" selected>1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                          </select>
                        </label>
                        <span class="elemento-opciones">
                          <label
                            >B
                            <input type="radio" name="rev-tension-bt" value="B"
                          /></label>
                          <label
                            >M
                            <input type="radio" name="rev-tension-bt" value="M"
                          /></label>
                          <label
                            >NT
                            <input
                              type="radio"
                              name="rev-tension-bt"
                              value="NT"
                          /></label>
                          <label
                            >NR
                            <input
                              type="radio"
                              name="rev-tension-bt"
                              value="NR"
                              checked
                          /></label>
                          <label
                            >FV
                            <input
                              type="radio"
                              name="rev-tension-bt"
                              value="FV"
                          /></label>
                        </span>
                      </div>
                      <div class="contenedor-codigo-fv">
                        <label>Código<input type="text" class="cod" /></label>
                        <label
                          >F. Vencimiento
                          <input type="date" class="vencimiento" />
                        </label>
                      </div>
                    </li>
                    <!-- Pinza Volt amperimétrica -->
                    <li class="elemento-lista">
                      <h4 class="elemento-titulo">
                        11. Pinza Volt amperimétrica
                      </h4>
                      <div class="elemento-cuerpo">
                        <label class="elemento-cantidad"
                          >Cantidad:
                          <select
                            name="cantidad"
                            class="pinza-amperimetrica-cantidad"
                          >
                            <option value="0">0</option>
                            <option value="1" selected>1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                          </select>
                        </label>
                        <span class="elemento-opciones">
                          <label
                            >B
                            <input
                              type="radio"
                              name="pinza-amperimetrica"
                              value="B"
                          /></label>
                          <label
                            >M
                            <input
                              type="radio"
                              name="pinza-amperimetrica"
                              value="M"
                          /></label>
                          <label
                            >NT
                            <input
                              type="radio"
                              name="pinza-amperimetrica"
                              value="NT"
                          /></label>
                          <label
                            >NR
                            <input
                              type="radio"
                              name="pinza-amperimetrica"
                              value="NR"
                              checked
                          /></label>
                          <label
                            >FV
                            <input
                              type="radio"
                              name="pinza-amperimetrica"
                              value="FV"
                          /></label>
                        </span>
                      </div>
                      <div class="contenedor-codigo-fv">
                        <label>Código<input type="text" class="cod" /></label>
                        <label
                          >F. Vencimiento
                          <input type="date" class="vencimiento" />
                        </label>
                      </div>
                    </li>
                    <!-- Pinza MT -->
                    <li class="elemento-lista">
                      <h4 class="elemento-titulo">12. Pinza MT</h4>
                      <div class="elemento-cuerpo">
                        <label class="elemento-cantidad"
                          >Cantidad:
                          <select name="cantidad" class="pinza-mt-cantidad">
                            <option value="0">0</option>
                            <option value="1" selected>1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                          </select>
                        </label>
                        <span class="elemento-opciones">
                          <label
                            >B <input type="radio" name="pinza-mt" value="B"
                          /></label>
                          <label
                            >M <input type="radio" name="pinza-mt" value="M"
                          /></label>
                          <label
                            >NT <input type="radio" name="pinza-mt" value="NT"
                          /></label>
                          <label
                            >NR
                            <input
                              type="radio"
                              name="pinza-mt"
                              value="NR"
                              checked
                          /></label>
                          <label
                            >FV <input type="radio" name="pinza-mt" value="FV"
                          /></label>
                        </span>
                      </div>
                      <div class="contenedor-codigo-fv">
                        <label>Código<input type="text" class="cod" /></label>
                        <label
                          >F. Vencimiento
                          <input type="date" class="vencimiento" />
                        </label>
                      </div>
                    </li>
                    <!-- Linterna grande -->
                    <li class="elemento-lista">
                      <h4 class="elemento-titulo">13. Linterna grande</h4>
                      <div class="elemento-cuerpo">
                        <label class="elemento-cantidad"
                          >Cantidad:
                          <select
                            name="cantidad"
                            class="linterna-grande-cantidad"
                          >
                            <option value="0">0</option>
                            <option value="1" selected>1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                          </select>
                        </label>
                        <span class="elemento-opciones">
                          <label
                            >B
                            <input
                              type="radio"
                              name="linterna-grande"
                              value="B"
                          /></label>
                          <label
                            >M
                            <input
                              type="radio"
                              name="linterna-grande"
                              value="M"
                          /></label>
                          <label
                            >NT
                            <input
                              type="radio"
                              name="linterna-grande"
                              value="NT"
                          /></label>
                          <label
                            >NR
                            <input
                              type="radio"
                              name="linterna-grande"
                              value="NR"
                              checked
                          /></label>
                          <label
                            >FV
                            <input
                              type="radio"
                              name="linterna-grande"
                              value="FV"
                          /></label>
                        </span>
                      </div>
                      <div class="contenedor-codigo-fv">
                        <label>Código<input type="text" class="cod" /></label>
                        <label
                          >F. Vencimiento
                          <input type="date" class="vencimiento" />
                        </label>
                      </div>
                    </li>
                    <!-- Llave Francesa Aislado / Mecánica -->
                    <li class="elemento-lista">
                      <h4 class="elemento-titulo">
                        14. Llave Francesa Aislado / Mecánica
                      </h4>
                      <div class="elemento-cuerpo">
                        <label class="elemento-cantidad"
                          >Cantidad:
                          <select
                            name="cantidad"
                            class="llave-francesa-cantidad"
                          >
                            <option value="0">0</option>
                            <option value="1" selected>1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                          </select>
                        </label>
                        <span class="elemento-opciones">
                          <label
                            >B
                            <input type="radio" name="llave-francesa" value="B"
                          /></label>
                          <label
                            >M
                            <input type="radio" name="llave-francesa" value="M"
                          /></label>
                          <label
                            >NT
                            <input
                              type="radio"
                              name="llave-francesa"
                              value="NT"
                          /></label>
                          <label
                            >NR
                            <input
                              type="radio"
                              name="llave-francesa"
                              value="NR"
                              checked
                          /></label>
                          <label
                            >FV
                            <input
                              type="radio"
                              name="llave-francesa"
                              value="FV"
                          /></label>
                        </span>
                      </div>
                      <div class="contenedor-codigo-fv">
                        <label>Código<input type="text" class="cod" /></label>
                        <label
                          >F. Vencimiento
                          <input type="date" class="vencimiento" />
                        </label>
                      </div>
                    </li>
                    <!-- Bolsa y recipiente para almacenar residuos -->
                    <li class="elemento-lista">
                      <h4 class="elemento-titulo">
                        15. Bolsa y recipiente para almacenar residuos
                      </h4>
                      <div class="elemento-cuerpo">
                        <label class="elemento-cantidad"
                          >Cantidad:
                          <select
                            name="cantidad"
                            class="bolsa-residuos-cantidad"
                          >
                            <option value="0">0</option>
                            <option value="1" selected>1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                          </select>
                        </label>
                        <span class="elemento-opciones">
                          <label
                            >B
                            <input type="radio" name="bolsa-residuos" value="B"
                          /></label>
                          <label
                            >M
                            <input type="radio" name="bolsa-residuos" value="M"
                          /></label>
                          <label
                            >NT
                            <input
                              type="radio"
                              name="bolsa-residuos"
                              value="NT"
                          /></label>
                          <label
                            >NR
                            <input
                              type="radio"
                              name="bolsa-residuos"
                              value="NR"
                              checked
                          /></label>
                          <label
                            >FV
                            <input
                              type="radio"
                              name="bolsa-residuos"
                              value="FV"
                          /></label>
                        </span>
                      </div>
                      <div class="contenedor-codigo-fv">
                        <label>Código<input type="text" class="cod" /></label>
                        <label
                          >F. Vencimiento
                          <input type="date" class="vencimiento" />
                        </label>
                      </div>
                    </li>
                    <!-- Arnés de seguridad con accesorios -->
                    <li class="elemento-lista">
                      <h4 class="elemento-titulo">
                        16. Arnés de seguridad con accesorios
                      </h4>
                      <div class="elemento-cuerpo">
                        <label class="elemento-cantidad"
                          >Cantidad:
                          <select
                            name="cantidad"
                            class="arnes-seguridad-cantidad"
                          >
                            <option value="0">0</option>
                            <option value="1" selected>1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                          </select>
                        </label>
                        <span class="elemento-opciones">
                          <label
                            >B
                            <input
                              type="radio"
                              name="arnes-seguridad"
                              value="B"
                          /></label>
                          <label
                            >M
                            <input
                              type="radio"
                              name="arnes-seguridad"
                              value="M"
                          /></label>
                          <label
                            >NT
                            <input
                              type="radio"
                              name="arnes-seguridad"
                              value="NT"
                          /></label>
                          <label
                            >NR
                            <input
                              type="radio"
                              name="arnes-seguridad"
                              value="NR"
                              checked
                          /></label>
                          <label
                            >FV
                            <input
                              type="radio"
                              name="arnes-seguridad"
                              value="FV"
                          /></label>
                        </span>
                      </div>
                      <div class="contenedor-codigo-fv">
                        <label>Código<input type="text" class="cod" /></label>
                        <label
                          >F. Vencimiento
                          <input type="date" class="vencimiento" />
                        </label>
                      </div>
                    </li>
                    <!-- Lima -->
                    <li class="elemento-lista">
                      <h4 class="elemento-titulo">17. Lima</h4>
                      <div class="elemento-cuerpo">
                        <label class="elemento-cantidad"
                          >Cantidad:
                          <select name="cantidad" class="lima-cantidad">
                            <option value="0">0</option>
                            <option value="1" selected>1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                          </select>
                        </label>
                        <span class="elemento-opciones">
                          <label
                            >B <input type="radio" name="lima" value="B"
                          /></label>
                          <label
                            >M <input type="radio" name="lima" value="M"
                          /></label>
                          <label
                            >NT <input type="radio" name="lima" value="NT"
                          /></label>
                          <label
                            >NR
                            <input type="radio" name="lima" value="NR" checked
                          /></label>
                          <label
                            >FV <input type="radio" name="lima" value="FV"
                          /></label>
                        </span>
                      </div>
                      <div class="contenedor-codigo-fv">
                        <label>Código<input type="text" class="cod" /></label>
                        <label
                          >F. Vencimiento
                          <input type="date" class="vencimiento" />
                        </label>
                      </div>
                    </li>
                    <!-- Cincel -->
                    <li class="elemento-lista">
                      <h4 class="elemento-titulo">18. Cincel</h4>
                      <div class="elemento-cuerpo">
                        <label class="elemento-cantidad"
                          >Cantidad:
                          <select name="cantidad" class="cincel-cantidad">
                            <option value="0">0</option>
                            <option value="1" selected>1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                          </select>
                        </label>
                        <span class="elemento-opciones">
                          <label
                            >B <input type="radio" name="cincel" value="B"
                          /></label>
                          <label
                            >M <input type="radio" name="cincel" value="M"
                          /></label>
                          <label
                            >NT <input type="radio" name="cincel" value="NT"
                          /></label>
                          <label
                            >NR
                            <input
                              type="radio"
                              name="cincel"
                              value="NR"
                              checked
                          /></label>
                          <label
                            >FV <input type="radio" name="cincel" value="FV"
                          /></label>
                        </span>
                      </div>
                      <div class="contenedor-codigo-fv">
                        <label>Código<input type="text" class="cod" /></label>
                        <label
                          >F. Vencimiento
                          <input type="date" class="vencimiento" />
                        </label>
                      </div>
                    </li>
                    <!-- Comba chica 4 o 5 libras -->
                    <li class="elemento-lista">
                      <h4 class="elemento-titulo">
                        19. Comba chica 4 o 5 libras
                      </h4>
                      <div class="elemento-cuerpo">
                        <label class="elemento-cantidad"
                          >Cantidad:
                          <select name="cantidad" class="comba-chica-cantidad">
                            <option value="0">0</option>
                            <option value="1" selected>1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                          </select>
                        </label>
                        <span class="elemento-opciones">
                          <label
                            >B <input type="radio" name="comba-chica" value="B"
                          /></label>
                          <label
                            >M <input type="radio" name="comba-chica" value="M"
                          /></label>
                          <label
                            >NT
                            <input type="radio" name="comba-chica" value="NT"
                          /></label>
                          <label
                            >NR
                            <input
                              type="radio"
                              name="comba-chica"
                              value="NR"
                              checked
                          /></label>
                          <label
                            >FV
                            <input type="radio" name="comba-chica" value="FV"
                          /></label>
                        </span>
                      </div>
                      <div class="contenedor-codigo-fv">
                        <label>Código<input type="text" class="cod" /></label>
                        <label
                          >F. Vencimiento
                          <input type="date" class="vencimiento" />
                        </label>
                      </div>
                    </li>
                    <!-- Martillo -->
                    <li class="elemento-lista">
                      <h4 class="elemento-titulo">20. Martillo</h4>
                      <div class="elemento-cuerpo">
                        <label class="elemento-cantidad"
                          >Cantidad:
                          <select name="cantidad" class="martillo-cantidad">
                            <option value="0">0</option>
                            <option value="1" selected>1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                          </select>
                        </label>
                        <span class="elemento-opciones">
                          <label
                            >B <input type="radio" name="martillo" value="B"
                          /></label>
                          <label
                            >M <input type="radio" name="martillo" value="M"
                          /></label>
                          <label
                            >NT <input type="radio" name="martillo" value="NT"
                          /></label>
                          <label
                            >NR
                            <input
                              type="radio"
                              name="martillo"
                              value="NR"
                              checked
                          /></label>
                          <label
                            >FV <input type="radio" name="martillo" value="FV"
                          /></label>
                        </span>
                      </div>
                      <div class="contenedor-codigo-fv">
                        <label>Código<input type="text" class="cod" /></label>
                        <label
                          >F. Vencimiento
                          <input type="date" class="vencimiento" />
                        </label>
                      </div>
                    </li>
                    <!-- Linterna portátil adaptable para casco -->
                    <li class="elemento-lista">
                      <h4 class="elemento-titulo">
                        21. Linterna portátil adaptable para casco
                      </h4>
                      <div class="elemento-cuerpo">
                        <label class="elemento-cantidad"
                          >Cantidad:
                          <select
                            name="cantidad"
                            class="linterna-casco-cantidad"
                          >
                            <option value="0">0</option>
                            <option value="1" selected>1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                          </select>
                        </label>
                        <span class="elemento-opciones">
                          <label
                            >B
                            <input type="radio" name="linterna-casco" value="B"
                          /></label>
                          <label
                            >M
                            <input type="radio" name="linterna-casco" value="M"
                          /></label>
                          <label
                            >NT
                            <input
                              type="radio"
                              name="linterna-casco"
                              value="NT"
                          /></label>
                          <label
                            >NR
                            <input
                              type="radio"
                              name="linterna-casco"
                              value="NR"
                              checked
                          /></label>
                          <label
                            >FV
                            <input
                              type="radio"
                              name="linterna-casco"
                              value="FV"
                          /></label>
                        </span>
                      </div>
                      <div class="contenedor-codigo-fv">
                        <label>Código<input type="text" class="cod" /></label>
                        <label
                          >F. Vencimiento
                          <input type="date" class="vencimiento" />
                        </label>
                      </div>
                    </li>
                    <!-- Nivel -->
                    <li class="elemento-lista">
                      <h4 class="elemento-titulo">22. Nivel</h4>
                      <div class="elemento-cuerpo">
                        <label class="elemento-cantidad"
                          >Cantidad:
                          <select name="cantidad" class="nivel-cantidad">
                            <option value="0">0</option>
                            <option value="1" selected>1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                          </select>
                        </label>
                        <span class="elemento-opciones">
                          <label
                            >B <input type="radio" name="nivel" value="B"
                          /></label>
                          <label
                            >M <input type="radio" name="nivel" value="M"
                          /></label>
                          <label
                            >NT <input type="radio" name="nivel" value="NT"
                          /></label>
                          <label
                            >NR
                            <input type="radio" name="nivel" value="NR" checked
                          /></label>
                          <label
                            >FV <input type="radio" name="nivel" value="FV"
                          /></label>
                        </span>
                      </div>
                      <div class="contenedor-codigo-fv">
                        <label>Código<input type="text" class="cod" /></label>
                        <label
                          >F. Vencimiento
                          <input type="date" class="vencimiento" />
                        </label>
                      </div>
                    </li>
                    <!-- Cinta pasa cable -->
                    <li class="elemento-lista">
                      <h4 class="elemento-titulo">23. Cinta pasa cable</h4>
                      <div class="elemento-cuerpo">
                        <label class="elemento-cantidad"
                          >Cantidad:
                          <select
                            name="cantidad"
                            class="cinta-pasacable-cantidad"
                          >
                            <option value="0">0</option>
                            <option value="1" selected>1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                          </select>
                        </label>
                        <span class="elemento-opciones">
                          <label
                            >B
                            <input
                              type="radio"
                              name="cinta-pasacable"
                              value="B"
                          /></label>
                          <label
                            >M
                            <input
                              type="radio"
                              name="cinta-pasacable"
                              value="M"
                          /></label>
                          <label
                            >NT
                            <input
                              type="radio"
                              name="cinta-pasacable"
                              value="NT"
                          /></label>
                          <label
                            >NR
                            <input
                              type="radio"
                              name="cinta-pasacable"
                              value="NR"
                              checked
                          /></label>
                          <label
                            >FV
                            <input
                              type="radio"
                              name="cinta-pasacable"
                              value="FV"
                          /></label>
                        </span>
                      </div>
                      <div class="contenedor-codigo-fv">
                        <label>Código<input type="text" class="cod" /></label>
                        <label
                          >F. Vencimiento
                          <input type="date" class="vencimiento" />
                        </label>
                      </div>
                    </li>
                    <!-- Prensa terminal -->
                    <li class="elemento-lista">
                      <h4 class="elemento-titulo">24. Prensa terminal</h4>
                      <div class="elemento-cuerpo">
                        <label class="elemento-cantidad"
                          >Cantidad:
                          <select
                            name="cantidad"
                            class="prensa-terminal-cantidad"
                          >
                            <option value="0">0</option>
                            <option value="1" selected>1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                          </select>
                        </label>
                        <span class="elemento-opciones">
                          <label
                            >B
                            <input
                              type="radio"
                              name="prensa-terminal"
                              value="B"
                          /></label>
                          <label
                            >M
                            <input
                              type="radio"
                              name="prensa-terminal"
                              value="M"
                          /></label>
                          <label
                            >NT
                            <input
                              type="radio"
                              name="prensa-terminal"
                              value="NT"
                          /></label>
                          <label
                            >NR
                            <input
                              type="radio"
                              name="prensa-terminal"
                              value="NR"
                              checked
                          /></label>
                          <label
                            >FV
                            <input
                              type="radio"
                              name="prensa-terminal"
                              value="FV"
                          /></label>
                        </span>
                      </div>
                      <div class="contenedor-codigo-fv">
                        <label>Código<input type="text" class="cod" /></label>
                        <label
                          >F. Vencimiento
                          <input type="date" class="vencimiento" />
                        </label>
                      </div>
                    </li>
                    <li class="elemento-lista">
                      <h4 class="elemento-titulo">25. Pertiga</h4>
                      <div class="elemento-cuerpo">
                        <label class="elemento-cantidad"
                          >Cantidad:
                          <select name="cantidad" class="pertiga-cantidad">
                            <option value="0">0</option>
                            <option value="1" selected>1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                          </select>
                        </label>
                        <span class="elemento-opciones">
                          <label
                            >B <input type="radio" name="pertiga" value="B"
                          /></label>
                          <label
                            >M <input type="radio" name="pertiga" value="M"
                          /></label>
                          <label
                            >NT <input type="radio" name="pertigal" value="NT"
                          /></label>
                          <label
                            >NR
                            <input
                              type="radio"
                              name="pertiga"
                              value="NR"
                              checked
                          /></label>
                          <label
                            >FV <input type="radio" name="pertiga" value="FV"
                          /></label>
                        </span>
                      </div>
                      <div class="contenedor-codigo-fv">
                        <label>Código<input type="text" class="cod" /></label>
                        <label
                          >F. Vencimiento
                          <input type="date" class="vencimiento" />
                        </label>
                      </div>
                    </li>
                  </ul>
                </div>
                <hr />

                <!-- EQUPOS -->
                <div class="contenedor-equipos">
                  <h4 class="elemento-titulo-general">* EQUIPOS</h4>
                  <ul class="lista">
                    <!-- Máquina de Soldar -->
                    <li class="elemento-lista">
                      <h4 class="elemento-titulo">1. Máquina de Soldar</h4>
                      <div class="elemento-cuerpo">
                        <label class="elemento-cantidad"
                          >Cantidad:
                          <select
                            name="cantidad"
                            class="maquina-soldar-cantidad"
                          >
                            <option value="0">0</option>
                            <option value="1" selected>1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                          </select>
                        </label>
                        <span class="elemento-opciones">
                          <label
                            >B
                            <input type="radio" name="maquina-soldar" value="B"
                          /></label>
                          <label
                            >M
                            <input type="radio" name="maquina-soldar" value="M"
                          /></label>
                          <label
                            >NT
                            <input
                              type="radio"
                              name="maquina-soldar"
                              value="NT"
                          /></label>
                          <label
                            >NR
                            <input
                              type="radio"
                              name="maquina-soldar"
                              value="NR"
                              checked
                          /></label>
                          <label
                            >FV
                            <input
                              type="radio"
                              name="maquina-soldar"
                              value="FV"
                          /></label>
                        </span>
                      </div>
                      <div class="contenedor-codigo-fv">
                        <label>Código<input type="text" class="cod" /></label>
                        <label
                          >F. Vencimiento
                          <input type="date" class="vencimiento" />
                        </label>
                      </div>
                    </li>
                    <!-- Equipo de soldar (mandil, máscara y mangas) -->
                    <li class="elemento-lista">
                      <h4 class="elemento-titulo">
                        2. Equipo de soldar (mandil, máscara y mangas)
                      </h4>
                      <div class="elemento-cuerpo">
                        <label class="elemento-cantidad"
                          >Cantidad:
                          <select
                            name="cantidad"
                            class="equipo-soldar-cantidad"
                          >
                            <option value="0">0</option>
                            <option value="1" selected>1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                          </select>
                        </label>
                        <span class="elemento-opciones">
                          <label
                            >B
                            <input type="radio" name="equipo-soldar" value="B"
                          /></label>
                          <label
                            >M
                            <input type="radio" name="equipo-soldar" value="M"
                          /></label>
                          <label
                            >NT
                            <input type="radio" name="equipo-soldar" value="NT"
                          /></label>
                          <label
                            >NR
                            <input
                              type="radio"
                              name="equipo-soldar"
                              value="NR"
                              checked
                          /></label>
                          <label
                            >FV
                            <input type="radio" name="equipo-soldar" value="FV"
                          /></label>
                        </span>
                      </div>
                      <div class="contenedor-codigo-fv">
                        <label>Código<input type="text" class="cod" /></label>
                        <label
                          >F. Vencimiento
                          <input type="date" class="vencimiento" />
                        </label>
                      </div>
                    </li>
                    <!-- Amoladora con disco de corte -->
                    <li class="elemento-lista">
                      <h4 class="elemento-titulo">
                        3. Amoladora con disco de corte
                      </h4>
                      <div class="elemento-cuerpo">
                        <label class="elemento-cantidad"
                          >Cantidad:
                          <select
                            name="cantidad"
                            class="amoladora-disco-cantidad"
                          >
                            <option value="0">0</option>
                            <option value="1" selected>1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                          </select>
                        </label>
                        <span class="elemento-opciones">
                          <label
                            >B
                            <input
                              type="radio"
                              name="amoladora-disco"
                              value="B"
                          /></label>
                          <label
                            >M
                            <input
                              type="radio"
                              name="amoladora-disco"
                              value="M"
                          /></label>
                          <label
                            >NT
                            <input
                              type="radio"
                              name="amoladora-disco"
                              value="NT"
                          /></label>
                          <label
                            >NR
                            <input
                              type="radio"
                              name="amoladora-disco"
                              value="NR"
                              checked
                          /></label>
                          <label
                            >FV
                            <input
                              type="radio"
                              name="amoladora-disco"
                              value="FV"
                          /></label>
                        </span>
                      </div>
                      <div class="contenedor-codigo-fv">
                        <label>Código<input type="text" class="cod" /></label>
                        <label
                          >F. Vencimiento
                          <input type="date" class="vencimiento" />
                        </label>
                      </div>
                    </li>
                    <!-- Cámara fotográfica digital -->
                    <li class="elemento-lista">
                      <h4 class="elemento-titulo">
                        4. Cámara fotográfica digital
                      </h4>
                      <div class="elemento-cuerpo">
                        <label class="elemento-cantidad"
                          >Cantidad:
                          <select
                            name="cantidad"
                            class="camara-fotografica-cantidad"
                          >
                            <option value="0">0</option>
                            <option value="1" selected>1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                          </select>
                        </label>
                        <span class="elemento-opciones">
                          <label
                            >B
                            <input
                              type="radio"
                              name="camara-fotografica"
                              value="B"
                          /></label>
                          <label
                            >M
                            <input
                              type="radio"
                              name="camara-fotografica"
                              value="M"
                          /></label>
                          <label
                            >NT
                            <input
                              type="radio"
                              name="camara-fotografica"
                              value="NT"
                          /></label>
                          <label
                            >NR
                            <input
                              type="radio"
                              name="camara-fotografica"
                              value="NR"
                              checked
                          /></label>
                          <label
                            >FV
                            <input
                              type="radio"
                              name="camara-fotografica"
                              value="FV"
                          /></label>
                        </span>
                      </div>
                      <div class="contenedor-codigo-fv">
                        <label>Código<input type="text" class="cod" /></label>
                        <label
                          >F. Vencimiento
                          <input type="date" class="vencimiento" />
                        </label>
                      </div>
                    </li>
                    <!-- Escalera (tipo tijera) (telescópica) -->
                    <li class="elemento-lista">
                      <h4 class="elemento-titulo">
                        5. Escalera (tipo tijera) (telescópica)
                      </h4>
                      <div class="elemento-cuerpo">
                        <label class="elemento-cantidad"
                          >Cantidad:
                          <select name="cantidad" class="escalera-cantidad">
                            <option value="0">0</option>
                            <option value="1" selected>1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                          </select>
                        </label>
                        <span class="elemento-opciones">
                          <label
                            >B <input type="radio" name="escalera" value="B"
                          /></label>
                          <label
                            >M <input type="radio" name="escalera" value="M"
                          /></label>
                          <label
                            >NT <input type="radio" name="escalera" value="NT"
                          /></label>
                          <label
                            >NR
                            <input
                              type="radio"
                              name="escalera"
                              value="NR"
                              checked
                          /></label>
                          <label
                            >FV <input type="radio" name="escalera" value="FV"
                          /></label>
                        </span>
                      </div>
                      <div class="contenedor-codigo-fv">
                        <label>Código<input type="text" class="cod" /></label>
                        <label
                          >F. Vencimiento
                          <input type="date" class="vencimiento" />
                        </label>
                      </div>
                    </li>
                    <!-- Banco escalera -->
                    <li class="elemento-lista">
                      <h4 class="elemento-titulo">6. Banco escalera</h4>
                      <div class="elemento-cuerpo">
                        <label class="elemento-cantidad"
                          >Cantidad:
                          <select
                            name="cantidad"
                            class="banco-escalera-cantidad"
                          >
                            <option value="0">0</option>
                            <option value="1" selected>1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                          </select>
                        </label>
                        <span class="elemento-opciones">
                          <label
                            >B
                            <input type="radio" name="banco-escalera" value="B"
                          /></label>
                          <label
                            >M
                            <input type="radio" name="banco-escalera" value="M"
                          /></label>
                          <label
                            >NT
                            <input
                              type="radio"
                              name="banco-escalera"
                              value="NT"
                          /></label>
                          <label
                            >NR
                            <input
                              type="radio"
                              name="banco-escalera"
                              value="NR"
                              checked
                          /></label>
                          <label
                            >FV
                            <input
                              type="radio"
                              name="banco-escalera"
                              value="FV"
                          /></label>
                        </span>
                      </div>
                      <div class="contenedor-codigo-fv">
                        <label>Código<input type="text" class="cod" /></label>
                        <label
                          >F. Vencimiento
                          <input type="date" class="vencimiento" />
                        </label>
                      </div>
                    </li>
                    <!-- Extensión de cable vulcanizado Industrial -->
                    <li class="elemento-lista">
                      <h4 class="elemento-titulo">
                        7. Extensión de cable vulcanizado Industrial
                      </h4>
                      <div class="elemento-cuerpo">
                        <label class="elemento-cantidad"
                          >Cantidad:
                          <select
                            name="cantidad"
                            class="extension-cable-vulcanizado-cantidad"
                          >
                            <option value="0">0</option>
                            <option value="1" selected>1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                          </select>
                        </label>
                        <span class="elemento-opciones">
                          <label
                            >B
                            <input
                              type="radio"
                              name="extension-cable-vulcanizado"
                              value="B"
                          /></label>
                          <label
                            >M
                            <input
                              type="radio"
                              name="extension-cable-vulcanizado"
                              value="M"
                          /></label>
                          <label
                            >NT
                            <input
                              type="radio"
                              name="extension-cable-vulcanizado"
                              value="NT"
                          /></label>
                          <label
                            >NR
                            <input
                              type="radio"
                              name="extension-cable-vulcanizado"
                              value="NR"
                              checked
                          /></label>
                          <label
                            >FV
                            <input
                              type="radio"
                              name="extension-cable-vulcanizado"
                              value="FV"
                          /></label>
                        </span>
                      </div>
                      <div class="contenedor-codigo-fv">
                        <label>Código<input type="text" class="cod" /></label>
                        <label
                          >F. Vencimiento
                          <input type="date" class="vencimiento" />
                        </label>
                      </div>
                    </li>
                    <!-- Reflector -->
                    <li class="elemento-lista">
                      <h4 class="elemento-titulo">8. Reflector</h4>
                      <div class="elemento-cuerpo">
                        <label class="elemento-cantidad"
                          >Cantidad:
                          <select name="cantidad" class="reflector-cantidad">
                            <option value="0">0</option>
                            <option value="1" selected>1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                          </select>
                        </label>
                        <span class="elemento-opciones">
                          <label
                            >B <input type="radio" name="reflector" value="B"
                          /></label>
                          <label
                            >M <input type="radio" name="reflector" value="M"
                          /></label>
                          <label
                            >NT <input type="radio" name="reflector" value="NT"
                          /></label>
                          <label
                            >NR
                            <input
                              type="radio"
                              name="reflector"
                              value="NR"
                              checked
                          /></label>
                          <label
                            >FV <input type="radio" name="reflector" value="FV"
                          /></label>
                        </span>
                      </div>
                      <div class="contenedor-codigo-fv">
                        <label>Código<input type="text" class="cod" /></label>
                        <label
                          >F. Vencimiento
                          <input type="date" class="vencimiento" />
                        </label>
                      </div>
                    </li>
                    <!-- Taladro -->
                    <li class="elemento-lista">
                      <h4 class="elemento-titulo">9. Taladro</h4>
                      <div class="elemento-cuerpo">
                        <label class="elemento-cantidad"
                          >Cantidad:
                          <select name="cantidad" class="taladro-cantidad">
                            <option value="0">0</option>
                            <option value="1" selected>1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                          </select>
                        </label>
                        <span class="elemento-opciones">
                          <label
                            >B <input type="radio" name="taladro" value="B"
                          /></label>
                          <label
                            >M <input type="radio" name="taladro" value="M"
                          /></label>
                          <label
                            >NT <input type="radio" name="taladro" value="NT"
                          /></label>
                          <label
                            >NR
                            <input
                              type="radio"
                              name="taladro"
                              value="NR"
                              checked
                          /></label>
                          <label
                            >FV <input type="radio" name="taladro" value="FV"
                          /></label>
                        </span>
                      </div>
                      <div class="contenedor-codigo-fv">
                        <label>Código<input type="text" class="cod" /></label>
                        <label
                          >F. Vencimiento
                          <input type="date" class="vencimiento" />
                        </label>
                      </div>
                    </li>
                    <!-- Rotomartillo -->
                    <li class="elemento-lista">
                      <h4 class="elemento-titulo">10. Rotomartillo</h4>
                      <div class="elemento-cuerpo">
                        <label class="elemento-cantidad"
                          >Cantidad:
                          <select name="cantidad" class="rotomartillo-cantidad">
                            <option value="0">0</option>
                            <option value="1" selected>1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                          </select>
                        </label>
                        <span class="elemento-opciones">
                          <label
                            >B
                            <input type="radio" name="rotomartillo" value="B"
                          /></label>
                          <label
                            >M
                            <input type="radio" name="rotomartillo" value="M"
                          /></label>
                          <label
                            >NT
                            <input type="radio" name="rotomartillo" value="NT"
                          /></label>
                          <label
                            >NR
                            <input
                              type="radio"
                              name="rotomartillo"
                              value="NR"
                              checked
                          /></label>
                          <label
                            >FV
                            <input type="radio" name="rotomartillo" value="FV"
                          /></label>
                        </span>
                      </div>
                      <div class="contenedor-codigo-fv">
                        <label>Código<input type="text" class="cod" /></label>
                        <label
                          >F. Vencimiento
                          <input type="date" class="vencimiento" />
                        </label>
                      </div>
                    </li>
                    <!-- Caja de Herramientas -->
                    <li class="elemento-lista">
                      <h4 class="elemento-titulo">11. Caja de Herramientas</h4>
                      <div class="elemento-cuerpo">
                        <label class="elemento-cantidad"
                          >Cantidad:
                          <select
                            name="cantidad"
                            class="caja-herramientas-cantidad"
                          >
                            <option value="0">0</option>
                            <option value="1" selected>1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                          </select>
                        </label>
                        <span class="elemento-opciones">
                          <label
                            >B
                            <input
                              type="radio"
                              name="caja-herramientas"
                              value="B"
                          /></label>
                          <label
                            >M
                            <input
                              type="radio"
                              name="caja-herramientas"
                              value="M"
                          /></label>
                          <label
                            >NT
                            <input
                              type="radio"
                              name="caja-herramientas"
                              value="NT"
                          /></label>
                          <label
                            >NR
                            <input
                              type="radio"
                              name="caja-herramientas"
                              value="NR"
                              checked
                          /></label>
                          <label
                            >FV
                            <input
                              type="radio"
                              name="caja-herramientas"
                              value="FV"
                          /></label>
                        </span>
                      </div>
                      <div class="contenedor-codigo-fv">
                        <label>Código<input type="text" class="cod" /></label>
                        <label
                          >F. Vencimiento
                          <input type="date" class="vencimiento" />
                        </label>
                      </div>
                    </li>
                  </ul>
                </div>
                <hr />

                <!-- SEÑALIZACIÓN -->
                <div class="contenedor-senializacion">
                  <h4 class="elemento-titulo-general">* SEÑALIZACIÓN</h4>
                  <ul class="lista">
                    <!-- Cercos -->
                    <li class="elemento-lista">
                      <h4 class="elemento-titulo">- Cercos</h4>
                      <div class="elemento-cuerpo">
                        <label class="elemento-cantidad"
                          >Cantidad:
                          <select name="cantidad" class="cercos-cantidad">
                            <option value="0">0</option>
                            <option value="1" selected>1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                          </select>
                        </label>
                        <span class="elemento-opciones">
                          <label
                            >B
                            <input
                              type="radio"
                              name="cercos-verano-invierno"
                              value="B"
                          /></label>
                          <label
                            >M
                            <input
                              type="radio"
                              name="cercos-verano-invierno"
                              value="M"
                          /></label>
                          <label
                            >NT
                            <input
                              type="radio"
                              name="cercos-verano-invierno"
                              value="NT"
                          /></label>
                          <label
                            >NR
                            <input
                              type="radio"
                              name="cercos-verano-invierno"
                              value="NR"
                              checked
                          /></label>
                          <label
                            >FV
                            <input
                              type="radio"
                              name="cercos-verano-invierno"
                              value="FV"
                          /></label>
                        </span>
                      </div>
                      <div class="contenedor-codigo-fv">
                        <label>Código<input type="text" class="cod" /></label>
                        <label
                          >F. Vencimiento
                          <input type="date" class="vencimiento" />
                        </label>
                      </div>
                    </li>
                    <!-- Malla con parantes -->
                    <li class="elemento-lista">
                      <h4 class="elemento-titulo">- Malla con parantes</h4>
                      <div class="elemento-cuerpo">
                        <label class="elemento-cantidad"
                          >Cantidad:
                          <select
                            name="cantidad"
                            class="malla-parantes-cantidad"
                          >
                            <option value="0">0</option>
                            <option value="1" selected>1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                          </select>
                        </label>
                        <span class="elemento-opciones">
                          <label
                            >B
                            <input type="radio" name="malla-parantes" value="B"
                          /></label>
                          <label
                            >M
                            <input type="radio" name="malla-parantes" value="M"
                          /></label>
                          <label
                            >NT
                            <input
                              type="radio"
                              name="malla-parantes"
                              value="NT"
                          /></label>
                          <label
                            >NR
                            <input
                              type="radio"
                              name="malla-parantes"
                              value="NR"
                              checked
                          /></label>
                          <label
                            >FV
                            <input
                              type="radio"
                              name="malla-parantes"
                              value="FV"
                          /></label>
                        </span>
                      </div>
                      <div class="contenedor-codigo-fv">
                        <label>Código<input type="text" class="cod" /></label>
                        <label
                          >F. Vencimiento
                          <input type="date" class="vencimiento" />
                        </label>
                      </div>
                    </li>
                  </ul>
                </div>
                <hr />

                <!-- DOCUMENTACIÓN -->
                <div class="contenedor-documentacion">
                  <h4 class="elemento-titulo-general">* DOCUMENTACIÓN</h4>
                  <ul class="lista">
                    <!-- AST/ASG/SGI Vigentes -->
                    <li class="elemento-lista">
                      <h4 class="elemento-titulo">- AST/ASG/SGI Vigentes</h4>
                      <div class="elemento-cuerpo">
                        <label class="elemento-cantidad"
                          >Cantidad:
                          <select name="cantidad" class="ast-asg-sgi-cantidad">
                            <option value="0">0</option>
                            <option value="1" selected>1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                          </select>
                        </label>
                        <span class="elemento-opciones">
                          <label
                            >B <input type="radio" name="ast-asg-sgi" value="B"
                          /></label>
                          <label
                            >M <input type="radio" name="ast-asg-sgi" value="M"
                          /></label>
                          <label
                            >NT
                            <input type="radio" name="ast-asg-sgi" value="NT"
                          /></label>
                          <label
                            >NR
                            <input
                              type="radio"
                              name="ast-asg-sgi"
                              value="NR"
                              checked
                          /></label>
                          <label
                            >FV
                            <input type="radio" name="ast-asg-sgi" value="FV"
                          /></label>
                        </span>
                      </div>
                      <div class="contenedor-codigo-fv">
                        <label>Código<input type="text" class="cod" /></label>
                        <label
                          >F. Vencimiento
                          <input type="date" class="vencimiento" />
                        </label>
                      </div>
                    </li>
                    <!-- Charla pre operacional -->
                    <li class="elemento-lista">
                      <h4 class="elemento-titulo">- Charla pre operacional</h4>
                      <div class="elemento-cuerpo">
                        <label class="elemento-cantidad"
                          >Cantidad:
                          <select name="cantidad" class="charla-pre-cantidad">
                            <option value="0">0</option>
                            <option value="1" selected>1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                          </select>
                        </label>
                        <span class="elemento-opciones">
                          <label
                            >B <input type="radio" name="charla-pre" value="B"
                          /></label>
                          <label
                            >M <input type="radio" name="charla-pre" value="M"
                          /></label>
                          <label
                            >NT
                            <input type="radio" name="charla-pre" value="NT"
                          /></label>
                          <label
                            >NR
                            <input
                              type="radio"
                              name="charla-pre"
                              value="NR"
                              checked
                          /></label>
                          <label
                            >FV
                            <input type="radio" name="charla-pre" value="FV"
                          /></label>
                        </span>
                      </div>
                      <div class="contenedor-codigo-fv">
                        <label>Código<input type="text" class="cod" /></label>
                        <label
                          >F. Vencimiento
                          <input type="date" class="vencimiento" />
                        </label>
                      </div>
                    </li>
                    <!-- Check list vehicular -->
                    <li class="elemento-lista">
                      <h4 class="elemento-titulo">- Check list vehicular</h4>
                      <div class="elemento-cuerpo">
                        <label class="elemento-cantidad"
                          >Cantidad:
                          <select
                            name="cantidad"
                            class="check-vehicular-cantidad"
                          >
                            <option value="0">0</option>
                            <option value="1" selected>1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                          </select>
                        </label>
                        <span class="elemento-opciones">
                          <label
                            >B
                            <input
                              type="radio"
                              name="check-vehicular"
                              value="B"
                          /></label>
                          <label
                            >M
                            <input
                              type="radio"
                              name="check-vehicular"
                              value="M"
                          /></label>
                          <label
                            >NT
                            <input
                              type="radio"
                              name="check-vehicular"
                              value="NT"
                          /></label>
                          <label
                            >NR
                            <input
                              type="radio"
                              name="check-vehicular"
                              value="NR"
                              checked
                          /></label>
                          <label
                            >FV
                            <input
                              type="radio"
                              name="check-vehicular"
                              value="FV"
                          /></label>
                        </span>
                      </div>
                      <div class="contenedor-codigo-fv">
                        <label>Código<input type="text" class="cod" /></label>
                        <label
                          >F. Vencimiento
                          <input type="date" class="vencimiento" />
                        </label>
                      </div>
                    </li>
                    <!-- Registro de residuos generados  -->
                    <li class="elemento-lista">
                      <h4 class="elemento-titulo">
                        - Registro de residuos generados
                      </h4>
                      <div class="elemento-cuerpo">
                        <label class="elemento-cantidad"
                          >Cantidad:
                          <select
                            name="cantidad"
                            class="registro-residuos-cantidad"
                          >
                            <option value="0">0</option>
                            <option value="1" selected>1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                          </select>
                        </label>
                        <span class="elemento-opciones">
                          <label
                            >B
                            <input
                              type="radio"
                              name="registro-residuos"
                              value="B"
                          /></label>
                          <label
                            >M
                            <input
                              type="radio"
                              name="registro-residuos"
                              value="M"
                          /></label>
                          <label
                            >NT
                            <input
                              type="radio"
                              name="registro-residuos"
                              value="NT"
                          /></label>
                          <label
                            >NR
                            <input
                              type="radio"
                              name="registro-residuos"
                              value="NR"
                              checked
                          /></label>
                          <label
                            >FV
                            <input
                              type="radio"
                              name="registro-residuos"
                              value="FV"
                          /></label>
                        </span>
                      </div>
                      <div class="contenedor-codigo-fv">
                        <label>Código<input type="text" class="cod" /></label>
                        <label
                          >F. Vencimiento
                          <input type="date" class="vencimiento" />
                        </label>
                      </div>
                    </li>
                  </ul>
                </div>
                <hr />

                <!-- ACCESORIOS -->
                <div class="contenedor-accesorios">
                  <h4 class="elemento-titulo-general">* ACCESORIOS</h4>
                  <ul class="lista">
                    <!-- Medio de comunicación radio RPM -->
                    <li class="elemento-lista">
                      <h4 class="elemento-titulo">
                        - Medio de comunicación radio (Celular)
                      </h4>
                      <div class="elemento-cuerpo">
                        <label class="elemento-cantidad">
                          Cantidad:
                          <select name="cantidad" class="accesorios-cantidad">
                            <option value="0">0</option>
                            <option value="1" selected>1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                          </select>
                        </label>
                        <span class="elemento-opciones">
                          <label
                            >B
                            <input
                              type="radio"
                              name="medio-comunicacion"
                              value="B"
                              checked
                          /></label>
                          <label
                            >M
                            <input
                              type="radio"
                              name="medio-comunicacion"
                              value="M"
                          /></label>
                          <label
                            >NT
                            <input
                              type="radio"
                              name="medio-comunicacion"
                              value="NT"
                          /></label>
                          <label
                            >NR
                            <input
                              type="radio"
                              name="medio-comunicacion"
                              value="NR"
                          /></label>
                          <label
                            >FV
                            <input
                              type="radio"
                              name="medio-comunicacion"
                              value="FV"
                          /></label>
                        </span>
                      </div>
                      <div class="contenedor-codigo-fv">
                        <label>Código<input type="text" class="cod" /></label>
                        <label
                          >F. Vencimiento
                          <input type="date" class="vencimiento" />
                        </label>
                      </div>
                    </li>
                  </ul>
                </div>
              </div>
            </article>
          </section>

          <h3 class="title-commentarios" id="title-commentarios">
            Comentarios
          </h3>
          <div class="contenedor-comentarios">
            <h4>Equipo de protección personal</h4>
            <div class="comentarios-epp">
              <div>
                <label class="comentario-epp"
                  >1. Camisa de verano/Invierno<textarea></textarea>
                </label>
              </div>
              <div>
                <label class="comentario-epp"
                  >2. Pantalón de verano<textarea></textarea>
                </label>
              </div>
              <div>
                <label class="comentario-epp"
                  >3. Camisa antiflama<textarea></textarea>
                </label>
              </div>
              <div>
                <label class="comentario-epp"
                  >4. Pantalón antiflama<textarea></textarea>
                </label>
              </div>
              <div>
                <label class="comentario-epp"
                  >5. Zapatos Dieléctricos<textarea></textarea>
                </label>
              </div>
              <div>
                <label class="comentario-epp"
                  >6. Chaleco preventivo de seguridad<textarea></textarea>
                </label>
              </div>
              <div>
                <label class="comentario-epp"
                  >7. Lentes con protección UV<textarea></textarea>
                </label>
              </div>
              <div>
                <label class="comentario-epp"
                  >8. Lentes contra impacto<textarea></textarea>
                </label>
              </div>
              <div>
                <label class="comentario-epp"
                  >9. Bloqueador Solar<textarea></textarea>
                </label>
              </div>
              <div>
                <label class="comentario-epp"
                  >10. Casco dielectrico normado con barbiquejo<textarea
                  ></textarea>
                </label>
              </div>
              <div>
                <label class="comentario-epp"
                  >11. Guantes dielectricos BT-Clase 0, Tipo I<textarea
                  ></textarea>
                </label>
              </div>
              <div>
                <label class="comentario-epp"
                  >12. Careta facial policarbonato<textarea></textarea>
                </label>
              </div>
              <div>
                <label class="comentario-epp"
                  >13. Careta facial antiarco<textarea></textarea>
                </label>
              </div>
              <div>
                <label class="comentario-epp"
                  >14. Guante de badana<textarea></textarea>
                </label>
              </div>
              <div>
                <label class="comentario-epp"
                  >15. Guante de cuero<textarea></textarea>
                </label>
              </div>
              <div>
                <label class="comentario-epp"
                  >16. Guante de hilo<textarea></textarea>
                </label>
              </div>
              <div>
                <label class="comentario-epp"
                  >17. Mascarilla contra polvo<textarea></textarea>
                </label>
              </div>
              <div>
                <label class="comentario-epp"
                  >18. Correa porta herramientas<textarea></textarea>
                </label>
              </div>
              <div>
                <label class="comentario-epp"
                  >19. Manta Dielectrica<textarea></textarea>
                </label>
              </div>
              <div>
                <label class="comentario-epp"
                  >20. Capucha Ignifuga<textarea></textarea>
                </label>
              </div>
            </div>
            <h4>Herramientas</h4>
            <div class="comentarios-herramientas">
              <div>
                <label class="comentario-herramienta"
                  >1. Alicate universal 8" de longitud 1000V<textarea
                  ></textarea>
                </label>
              </div>
              <div>
                <label class="comentario-herramienta"
                  >2. Alicate de corte aislado 6"<textarea></textarea>
                </label>
              </div>
              <div>
                <label class="comentario-herramienta"
                  >3. Alicate de punta aislada 6"<textarea></textarea>
                </label>
              </div>
              <div>
                <label class="comentario-herramienta"
                  >4. Destornillador plano aislado 6"<textarea></textarea>
                </label>
              </div>
              <div>
                <label class="comentario-herramienta"
                  >5. Perillero (opcional)<textarea></textarea>
                </label>
              </div>
              <div>
                <label class="comentario-herramienta"
                  >6. Destornillador estrella aislado 6" o 8"<textarea
                  ></textarea>
                </label>
              </div>
              <div>
                <label class="comentario-herramienta"
                  >7. Destornillador hexagonal<textarea></textarea>
                </label>
              </div>
              <div>
                <label class="comentario-herramienta"
                  >8. Juego de llave allen<textarea></textarea>
                </label>
              </div>
              <div>
                <label class="comentario-herramienta"
                  >9. Juego de llave ratchets Aislado<textarea></textarea>
                </label>
              </div>
              <div>
                <label class="comentario-herramienta"
                  >10. Revelador de tensión BT<textarea></textarea>
                </label>
              </div>
              <div>
                <label class="comentario-herramienta"
                  >11. Pinza Volt amperimétrica<textarea></textarea>
                </label>
              </div>
              <div>
                <label class="comentario-herramienta"
                  >12. Pinza MT<textarea></textarea>
                </label>
              </div>
              <div>
                <label class="comentario-herramienta"
                  >13. Linterna Grande<textarea></textarea>
                </label>
              </div>
              <div>
                <label class="comentario-herramienta"
                  >14. Llave Francesa Aislado/ Mecánica<textarea></textarea>
                </label>
              </div>
              <div>
                <label class="comentario-herramienta"
                  >15. Bolsa y recipiente para almacenar residuos<textarea
                  ></textarea>
                </label>
              </div>
              <div>
                <label class="comentario-herramienta"
                  >16. Arnés de seguridad con accesorios<textarea></textarea>
                </label>
              </div>
              <div>
                <label class="comentario-herramienta"
                  >17. Lima<textarea></textarea>
                </label>
              </div>
              <div>
                <label class="comentario-herramienta"
                  >18. Cincel<textarea></textarea>
                </label>
              </div>
              <div>
                <label class="comentario-herramienta"
                  >19. Comba chica 4 o 5 libras<textarea></textarea>
                </label>
              </div>
              <div>
                <label class="comentario-herramienta"
                  >20. Martillo<textarea></textarea>
                </label>
              </div>
              <div>
                <label class="comentario-herramienta"
                  >21. Linterna portátil adaptable para casco<textarea
                  ></textarea>
                </label>
              </div>
              <div>
                <label class="comentario-herramienta"
                  >22. Nivel<textarea></textarea>
                </label>
              </div>
              <div>
                <label class="comentario-herramienta"
                  >23. Cinta pasacable<textarea></textarea>
                </label>
              </div>
              <div>
                <label class="comentario-herramienta"
                  >24. Prensa terminal<textarea></textarea>
                </label>
              </div>
              <div>
                <label class="comentario-herramienta"
                  >25. Pertiga<textarea></textarea>
                </label>
              </div>
            </div>
            <h4>Equipos</h4>
            <div class="comentarios-equipos">
              <div>
                <label class="comentario-equipo"
                  >1. Máquina de soldar<textarea></textarea>
                </label>
              </div>
              <div>
                <label class="comentario-equipo"
                  >2. Equipo de soldar (mandil, máscara y mangas)<textarea
                  ></textarea>
                </label>
              </div>
              <div>
                <label class="comentario-equipo"
                  >3. Amoladora con disco de corte<textarea></textarea>
                </label>
              </div>
              <div>
                <label class="comentario-equipo"
                  >4. Cámara fotográfica digital<textarea></textarea>
                </label>
              </div>
              <div>
                <label class="comentario-equipo"
                  >5. Escalera (tipo tijera) (telescópica)<textarea></textarea>
                </label>
              </div>
              <div>
                <label class="comentario-equipo"
                  >6. Banco escalera<textarea></textarea>
                </label>
              </div>
              <div>
                <label class="comentario-equipo"
                  >7. Extensión de cable vulcanizado industrial<textarea
                  ></textarea>
                </label>
              </div>
              <div>
                <label class="comentario-equipo"
                  >8. Reflector<textarea></textarea>
                </label>
              </div>
              <div>
                <label class="comentario-equipo"
                  >9. Taladro<textarea></textarea>
                </label>
              </div>
              <div>
                <label class="comentario-equipo"
                  >10. Rotomartillo<textarea></textarea>
                </label>
              </div>
              <div>
                <label class="comentario-equipo"
                  >11. Caja de herramientas<textarea></textarea>
                </label>
              </div>
            </div>
            <h4>Señalización</h4>
            <div class="comentarios-senializacion">
              <div>
                <label class="comentario-senial"
                  >1. Cercos<textarea></textarea>
                </label>
              </div>
              <div>
                <label class="comentario-senial"
                  >2. Mallas con parantes<textarea></textarea>
                </label>
              </div>
            </div>
            <h4>Documentación</h4>
            <div class="comentarios-documentacion">
              <div>
                <label class="comentario-documentacion"
                  >1. AST/ASG/SGI Vigentes<textarea></textarea>
                </label>
              </div>
              <div>
                <label class="comentario-documentacion"
                  >2. Charla pre operacional<textarea></textarea>
                </label>
              </div>
              <div>
                <label class="comentario-documentacion"
                  >3. Check list vehicular<textarea></textarea>
                </label>
              </div>
              <div>
                <label class="comentario-documentacion"
                  >4. Registro de residuos generados<textarea></textarea>
                </label>
              </div>
            </div>
            <h4>Accesorios</h4>
            <div class="comentarios-accesorios">
              <label class="comentario-accesorio"
                >1. Medio de comunicación radio (celular)<textarea></textarea>
              </label>
            </div>
          </div>
        </div>
      </section>
      <div class="terminar" id="btnGenerar">
        <i class="fa-solid fa-file-pdf fa-lg"></i>
      </div>
      <div id="btnListaPersonal"><i class="fa-solid fa-address-book"></i></div>
      <div id="btnComentarios"><i class="fa-solid fa-comment-dots"></i></div>
    </main>
    <script src="../scripts/functionsListaInspeccion.js"></script>
    <script type="module" src="../scripts/control_tiempo.js"></script>
  </body>
</html>
