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
    <title>Formato Inspeccion de Esccalera</title>
    <?php 
      require("./header_comun/scripts_links.php")
    ?>
    <!-- Estilos -->
    <link rel="stylesheet" href="../estilos/stylesEscalera.css" />
  </head>
  <body>
    <main class="main">
      <figure class="logo-title">
        <a href="../">
          <img src="../recursos/logo_teching.png" alt="teching_logo" />
        </a>
        <div>
          <span>Inspección Escalera</span>
        </div>
      </figure>
      <section class="form-container">
        <form class="principal-form" id="principal-form">
          <h3 class="title-datos-principales">Datos Principales</h3>
          <!--Inicia parte superior del Formulario-->
          <div class="form-sup">
            <div class="form-sup1">
              <div class="form-sup-e">
                <label>Trabajo: <input type="text" id="trabajo"/></label>
              </div>
              <div class="form-sup-e">
                <label>Ubicación: <input type="text" id="ubicacion"/></label>
              </div>
              <div class="form-sup-e">
                <label>Empresa: <input type="text" id="empresa"/></label>
              </div>
              <div class="form-sup-e">
                <label>Tipo de Escalera: <input type="text" id="tipo-escalera"/></label>
              </div>
            </div>
            <div class="form-sup2">
              <div class="form-sup-e">
                <label>Fecha: 
                <input type="text" value="00-00-00" id="fecha" readonly /></label>
              </div>
              <div class="form-sup-e">
                <label>Hora: <input type="time" id="hora"/></label>
              </div>
              <div class="form-sup-e">
                <label>Usuario: <select name="user" id="user">
                        <option value="">Seleccionar</option>
                    </select>
                    <input type="text" id="usuario" style="display: none;"/></label>
              </div>
              <div class="form-sup-e">
                <label>Código/ Serie: <input type="text" id="cod-serie"/></label>
              </div>
            </div>
          </div>
          <!--Fin parte superior del Formulario-->

          <!--Inicia Cuerpo del Formulario-->
          <div class="form-body">
            <h3 class="title-body">Partes a examinar</h3>
            <section class="section-partes-examinar">
              <div class="parte-examinada">
                <label
                  >Largueros (en buen estado)<select name="pe1" id="pe1">
                    <option value="✓">Correcto</option>
                    <option value="X">Incorrecto</option>
                    <option value="NA">No Aplica</option>
                  </select></label
                >
                <textarea name="obs" id="obs1" cols="30" rows="10" placeholder="Observaciones..."></textarea>
              </div>

              <div class="parte-examinada">
                <label
                  >Peldaños (antideslizantes, no torcidos y en buen estado)
                  <select name="pe2" id="pe2">
                    <option value="✓">Correcto</option>
                    <option value="X">Incorrecto</option>
                    <option value="NA">No Aplica</option>
                  </select></label
                >
                <textarea name="obs2" id="obs2" cols="30" rows="10" placeholder="Observaciones..."></textarea>
              </div>

              <div class="parte-examinada">
                <label
                  >Unión de peldaños y largueros
                  <select name="pe3" id="pe3">
                    <option value="✓">Correcto</option>
                    <option value="X">Incorrecto</option>
                    <option value="NA">No Aplica</option>
                  </select></label
                >
                <textarea name="obs3" id="obs3" cols="30" rows="10" placeholder="Observaciones..."></textarea>
              </div>

              <div class="parte-examinada">
                <label
                  >Refuerso de peldaño en buen estado
                  <select name="pe4" id="pe4">
                    <option value="✓">Correcto</option>
                    <option value="X">Incorrecto</option>
                    <option value="NA">No Aplica</option>
                  </select></label
                >
                <textarea name="obs4" id="obs4" cols="30" rows="10" placeholder="Observaciones..."></textarea>
              </div>

              <div class="parte-examinada">
                <label
                  >Zapatas antideslizantes
                  <select name="pe5" id="pe5">
                    <option value="✓">Correcto</option>
                    <option value="X">Incorrecto</option>
                    <option value="NA">No Aplica</option>
                  </select></label
                >
                <textarea name="obs5" id="obs5" cols="30" rows="10" placeholder="Observaciones..."></textarea>
              </div>
              
              <div class="parte-examinada">
                <label
                  >Piezas de ajuste (tornillos, pernos, otros)
                  <select name="pe6" id="pe6">
                    <option value="✓">Correcto</option>
                    <option value="X">Incorrecto</option>
                    <option value="NA">No Aplica</option>
                  </select></label
                >
                <textarea name="obs6" id="obs6" cols="30" rows="10" placeholder="Observaciones..."></textarea>
              </div>

              <div class="parte-examinada">
                <label
                  >Aseo de escalera (libre de sustancias deslizantes)
                  <select name="pe7" id="pe7">
                    <option value="✓">Correcto</option>
                    <option value="X">Incorrecto</option>
                    <option value="NA">No Aplica</option>
                  </select></label
                >
                <textarea name="obs7" id="obs7" cols="30" rows="10" placeholder="Observaciones..."></textarea>
              </div>

              <div class="parte-examinada">
                <label
                  >Identificación legible en la escalera
                  <select name="pe8" id="pe8">
                    <option value="✓">Correcto</option>
                    <option value="X">Incorrecto</option>
                    <option value="NA">No Aplica</option>
                  </select></label
                >
                <textarea name="obs8" id="obs8" cols="30" rows="10" placeholder="Observaciones..."></textarea>
              </div>

              <div class="parte-examinada">
                <label
                  >Cuenta con señalización de seguridad en peldaño
                  <select name="pe9" id="pe9">
                    <option value="✓">Correcto</option>
                    <option value="X">Incorrecto</option>
                    <option value="NA">No Aplica</option>
                  </select></label
                >
                <textarea name="obs9" id="obs9" cols="30" rows="10" placeholder="Observaciones..."></textarea>
              </div>

              <div class="parte-examinada">
                <label
                  >Brazos de unión anti-apertura (aplica para escaleras tipo tijera)
                  <select name="pe10" id="pe10">
                    <option value="✓">Correcto</option>
                    <option value="X">Incorrecto</option>
                    <option value="NA">No Aplica</option>
                  </select></label
                >
                <textarea name="obs10" id="obs10" cols="30" rows="10" placeholder="Observaciones..."></textarea>
              </div>

              <div class="parte-examinada">
                <label
                  >Ganchos trabapeldaños (libre de corrosión, grietas, deformaciones, etc)
                  <select name="pe11" id="pe11">
                    <option value="✓">Correcto</option>
                    <option value="X">Incorrecto</option>
                    <option value="NA">No Aplica</option>
                  </select></label
                >
                <textarea name="obs11" id="obs11" cols="30" rows="10" placeholder="Observaciones..."></textarea>
              </div>

              <div class="parte-examinada">
                <label
                  >Guías externas para unión de largueros (libre de corrosión, grietas, deformaciones, etc)
                  <select name="pe12" id="pe12">
                    <option value="✓">Correcto</option>
                    <option value="X">Incorrecto</option>
                    <option value="NA">No Aplica</option>
                  </select></label
                >
                <textarea name="obs12" id="obs12" cols="30" rows="10" placeholder="Observaciones..."></textarea>
              </div>

              <div class="parte-examinada">
                <label
                  >Cuerda (en buen estado, libre de grasas, lubricantes, etc)
                  <select name="pe13" id="pe13">
                    <option value="✓">Correcto</option>
                    <option value="X">Incorrecto</option>
                    <option value="NA">No Aplica</option>
                  </select></label
                >
                <textarea name="obs13" id="obs13" cols="30" rows="10" placeholder="Observaciones..."></textarea>
              </div>

              <div class="parte-examinada">
                <label
                  >Polea (en buen estado, libre de corrosión)
                  <select name="pe14" id="pe14">
                    <option value="✓">Correcto</option>
                    <option value="X">Incorrecto</option>
                    <option value="NA">No Aplica</option>
                  </select></label
                >
                <textarea name="obs14" id="obs14" cols="30" rows="10" placeholder="Observaciones..."></textarea>
              </div>

              <div class="parte-examinada">
                <label
                  >Protector de largueros
                  <select name="pe15" id="pe15">
                    <option value="✓">Correcto</option>
                    <option value="X">Incorrecto</option>
                    <option value="NA">No Aplica</option>
                  </select></label
                >
                <textarea name="obs15" id="obs15" cols="30" rows="10" placeholder="Observaciones..."></textarea>
              </div>

              <div class="parte-examinada">
                <label
                  >Apoya poste (en buen estado, libre de corrosión, grietas, deformaciones, etc.)
                  <select name="pe16" id="pe16">
                    <option value="✓">Correcto</option>
                    <option value="X">Incorrecto</option>
                    <option value="NA">No Aplica</option>
                  </select></label
                >
                <textarea name="obs16" id="obs16" cols="30" rows="10" placeholder="Observaciones..."></textarea>
              </div>
            </section>

            <section class="conclusion">
                <div class="escalera-apta">
                    <h4>* Escalera apta para ser usada </h4>
                    <label>Si: <input type="radio" name="escalera-apta1" value="si"></label>
                    <label>No: <input type="radio" name="escalera-apta1" checked value="no"></label>
                </div>
                <div class="contenedor-supervisor">
                    <label>Inspección realizada por: <select name="supervisor" id="supervisor">
                    <option value="">Seleccionar</option>
                    </select></label>
                    <input type="text" id="supervisor-firma" style="display: none;">
                </div>
            </section>
          </div>

          <div id="btnGenerar"><i class="fa-solid fa-file-pdf fa-lg"></i></div>
        </form>
      </section>
    </main>
    <script src="../scripts/functionsEscalera.js"></script>
    <script type="module" src="../scripts/control_tiempo.js"></script>
  </body>
</html>
