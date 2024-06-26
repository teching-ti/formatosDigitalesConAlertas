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
    <title>Formato Checklist de inspeccion contra caidas</title>
    <?php 
      require("./header_comun/scripts_links.php")
    ?>
    <!-- Estilos -->
    <link rel="stylesheet" href="../estilos/stylesCaidas.css" />
  </head>

  <body>
    <main class="main">
      <figure class="logo-title">
        <a href="../">
          <img src="../recursos/logo_teching.png" alt="teching_logo" />
        </a>
        <div>
          <span>Checklist de Inspección Contra Caídas</span>
        </div>
      </figure>
      <section class="form-container">
        <form class="principal-form" id="principal-form">
          <h3 class="title-datos-principales">Datos Principales</h3>
          <div class="form-sup">
            <div class="form-sup1">
              <div class="form-sup-e">
                <label>Actividad: <input type="text" id="actividad" /></label>
              </div>
              <div class="form-sup-e">
                <label>Lugar: <input type="text" id="lugar" /></label>
              </div>
              <div class="form-sup-e">
                <label>Marca/ Modelo: <input type="text" id="marca-modelo" /></label>
              </div>
            </div>
            <div class="form-sup2">
              <div class="form-sup-e">
                <label>Fecha: <input type="text" id="fecha" readonly/></label>
              </div>
              <div class="form-sup-e">
                <label>Hora: <input type="time" id="hora" /></label>
              </div>
              <div class="form-sup-e">
                <label>Código/ Serie de arnés: <input type="text" id="codigo" /></label>
              </div>
            </div>
          </div>

          <div class="form-body">
            <h3 class="title-body">Arnés de Seguridad Dieléctrico</h3>
            
            <!-- Arnes de Seguridad -->
            <section class="section-elementos-arnes">

                <div class="elemento-arnes">
                    <div class="elementos-texto">
                        <b><p>- Costuras</p></b>
                        <p><span>Se busca: </span>Deshilachamiento</p>
                    </div>
                    <div class="selectores">
                        <div class="labels">
                            <label>Bueno<input type="radio" value="bueno" name="ea1" checked></label>
                            <label>Malo<input type="radio" value="malo" name="ea1"></label>
                            <label>No Aplica<input type="radio" value="na" name="ea1"></label>
                        </div>
                        <textarea name="obs1" id="obs1" cols="30" rows="10" placeholder="Observaciones..."></textarea>
                    </div>
                </div>
                <div class="elemento-arnes">
                    <div class="elementos-texto">
                        <b><p>- Correas</p></b>
                        <p><span>Se busca: </span>Roturas y desgarramientos
                        </p>
                    </div>
                    <div class="selectores">
                        <div class="labels">
                            <label>Bueno<input type="radio" value="bueno" name="ea2" checked></label>
                            <label>Malo<input type="radio" value="malo" name="ea2"></label>
                            <label>No Aplica<input type="radio" value="na" name="ea2"></label>
                        </div>
                        <textarea name="obs2" id="obs2" cols="30" rows="10" placeholder="Observaciones..."></textarea>
                    </div>
                </div>

                <div class="elemento-arnes">
                    <div class="elementos-texto">
                        <b><p>- Anilla dieléctrica en la espalda para detención de caídas</p></b>
                        <p><span>Se busca: </span>Sin golpes o deformaciones</p>
                    </div>
                    <div class="selectores">
                        <div class="labels">
                            <label>Bueno<input type="radio" value="bueno" name="ea3" checked></label>
                            <label>Malo<input type="radio" value="malo" name="ea3"></label>
                            <label>No Aplica<input type="radio" value="na" name="ea3"></label>
                        </div>
                        <textarea name="obs3" id="obs3" cols="30" rows="10" placeholder="Observaciones..."></textarea>
                    </div>
                </div>

                <div class="elemento-arnes">
                    <div class="elementos-texto">
                        <b><p>- Anilla dieléctrica en el pecho par trabajos de ascenso y descenso</p></b>
                        <p><span>Se busca: </span>Sin golpes o deformaciones</p>
                    </div>
                    <div class="selectores">
                        <div class="labels">
                            <label>Bueno<input type="radio" value="bueno" name="ea4" checked></label>
                            <label>Malo<input type="radio" value="malo" name="ea4"></label>
                            <label>No Aplica<input type="radio" value="na" name="ea4"></label>
                        </div>
                        <textarea name="obs4" id="obs4" cols="30" rows="10" placeholder="Observaciones..."></textarea>
                    </div>
                </div>

                <div class="elemento-arnes">
                    <div class="elementos-texto">
                        <b><p>- Anillas dieléctricas en la cadera para trabajos de sujeción.</p></b>
                        <p><span>Se busca: </span>Sin golpes o deformaciones</p>
                    </div>
                    <div class="selectores">
                        <div class="labels">
                            <label>Bueno<input type="radio" value="bueno" name="ea5" checked></label>
                            <label>Malo<input type="radio" value="malo" name="ea5"></label>
                            <label>No Aplica<input type="radio" value="na" name="ea5"></label>
                        </div>
                        <textarea name="obs5" id="obs5" cols="30" rows="10" placeholder="Observaciones..."></textarea>
                    </div>
                </div>

                <div class="elemento-arnes">
                    <div class="elementos-texto">
                        <b><p>- Hebillas reguladoras dieléctricas.</p></b>
                        <p><span>Se busca: </span>Sin golpes o deformaciones</p>
                    </div>
                    <div class="selectores">
                        <div class="labels">
                            <label>Bueno<input type="radio" value="bueno" name="ea6" checked></label>
                            <label>Malo<input type="radio" value="malo" name="ea6"></label>
                            <label>No Aplica<input type="radio" value="na" name="ea6"></label>
                        </div>
                        <textarea name="obs6" id="obs6" cols="30" rows="10" placeholder="Observaciones..."></textarea>
                    </div>
                </div>

                <div class="elemento-arnes">
                    <div class="elementos-texto">
                        <b><p>- Mosquetones de cierre automático.</p></b>
                        <p><span>Se busca: </span>Libre de frisuras, óxido</p>
                    </div>
                    <div class="selectores">
                        <div class="labels">
                            <label>Bueno<input type="radio" value="bueno" name="ea7" checked></label>
                            <label>Malo<input type="radio" value="malo" name="ea7"></label>
                            <label>No Aplica<input type="radio" value="na" name="ea7"></label>
                        </div>
                        <textarea name="obs7" id="obs7" cols="30" rows="10" placeholder="Observaciones..."></textarea>
                    </div>
                </div>

                <div class="elemento-arnes">
                    <div class="elementos-texto">
                        <b><p>- Línea de vida.</p></b>
                        <p><span>Se busca: </span>Sin daño, rotura, cortes.</p>
                    </div>
                    <div class="selectores">
                        <div class="labels">
                            <label>Bueno<input type="radio" value="bueno" name="ea8" checked></label>
                            <label>Malo<input type="radio" value="malo" name="ea8"></label>
                            <label>No Aplica<input type="radio" value="na" name="ea8"></label>
                        </div>
                        <textarea name="obs8" id="obs8" cols="30" rows="10" placeholder="Observaciones..."></textarea>
                    </div>
                </div>

            </section>

            
            <!-- Accesorios para escalamiento -->
            <h3 class="title-body">Accesorios para escalamiento</h3>
            <section class="section-accesorios-escalamiento">
                <div class="elemento-escalamiento">
                    <div class="elementos-texto">
                        <b><p>- Eslinga de posicionamiento de 5 o 6 pies graduables</p></b>
                        <p><span>Se busca: </span>Roturas, desgarramientos y oxidos</p>
                    </div>
                    <div class="selectores">
                        <div class="labels">
                            <label>Bueno<input type="radio" value="bueno" name="ae1" checked></label>
                            <label>Malo<input type="radio" value="malo" name="ae1"></label>
                            <label>No Aplica<input type="radio" value="na" name="ae1"></label>
                        </div>
                        <textarea name="obse1" id="obse1" cols="30" rows="10" placeholder="Observaciones..."></textarea>
                    </div>
                </div>
                <div class="elemento-escalamiento">
                    <div class="elementos-texto">
                        <b><p>- Anclaje tie off de 6 pies graduable.</p></b>
                        <p><span>Se busca: </span>Roturas, desgarramientos y oxidos</p>
                    </div>
                    <div class="selectores">
                        <div class="labels">
                            <label>Bueno<input type="radio" value="bueno" name="ae2" checked></label>
                            <label>Malo<input type="radio" value="malo" name="ae2"></label>
                            <label>No Aplica<input type="radio" value="na" name="ae2"></label>
                        </div>
                        <textarea name="obse2" id="obse2" cols="30" rows="10" placeholder="Observaciones..."></textarea>
                    </div>
                </div>

                <div class="elemento-escalamiento">
                    <div class="elementos-texto">
                        <b><p>- Sistema descendedor tipo Gri Gri</p></b>
                        <p><span>Se busca: </span>Sin daños libre de oxidos</p>
                    </div>
                    <div class="selectores">
                        <div class="labels">
                            <label>Bueno<input type="radio" value="bueno" name="ae3" checked></label>
                            <label>Malo<input type="radio" value="malo" name="ae3"></label>
                            <label>No Aplica<input type="radio" value="na" name="ae3"></label>
                        </div>
                        <textarea name="obse3" id="obse3" cols="30" rows="10" placeholder="Observaciones..."></textarea>
                    </div>
                </div>

                <div class="elemento-escalamiento">
                    <div class="elementos-texto">
                        <b><p>- Sistema ascendedor para cuerda.</p></b>
                        <p><span>Se busca: </span>Sin daños libre de oxidos</p>
                    </div>
                    <div class="selectores">
                        <div class="labels">
                            <label>Bueno<input type="radio" value="bueno" name="ae4" checked></label>
                            <label>Malo<input type="radio" value="malo" name="ae4"></label>
                            <label>No Aplica<input type="radio" value="na" name="ae4"></label>
                        </div>
                        <textarea name="obse4" id="obse4" cols="30" rows="10" placeholder="Observaciones..."></textarea>
                    </div>
                </div>

                <div class="elemento-escalamiento">
                    <div class="elementos-texto">
                        <b><p>- Mosquetones de cierre automático.</p></b>
                        <p><span>Se busca: </span>Libre de frisuras, óxido</p>
                    </div>
                    <div class="selectores">
                        <div class="labels">
                            <label>Bueno<input type="radio" value="bueno" name="ae5" checked></label>
                            <label>Malo<input type="radio" value="malo" name="ae5"></label>
                            <label>No Aplica<input type="radio" value="na" name="ae5"></label>
                        </div>
                        <textarea name="obse5" id="obse5" cols="30" rows="10" placeholder="Observaciones..."></textarea>
                    </div>
                </div>

                <div class="elemento-escalamiento">
                    <div class="elementos-texto">
                        <b><p>- Polea.</p></b>
                        <p><span>Se busca: </span>Sin daños libre de oxidos</p>
                    </div>
                    <div class="selectores">
                        <div class="labels">
                            <label>Bueno<input type="radio" value="bueno" name="ae6" checked></label>
                            <label>Malo<input type="radio" value="malo" name="ae6"></label>
                            <label>No Aplica<input type="radio" value="na" name="ae6"></label>
                        </div>
                        <textarea name="obse6" id="obse6" cols="30" rows="10" placeholder="Observaciones..."></textarea>
                    </div>
                </div>

                <div class="elemento-escalamiento">
                    <div class="elementos-texto">
                        <b><p>- Cuerdas estáticas.</p></b>
                        <p><span>Se busca: </span>Roturas y desgarramientos</p>
                    </div>
                    <div class="selectores">
                        <div class="labels">
                            <label>Bueno<input type="radio" value="bueno" name="ae7" checked></label>
                            <label>Malo<input type="radio" value="malo" name="ae7"></label>
                            <label>No Aplica<input type="radio" value="na" name="ae7"></label>
                        </div>
                        <textarea name="obse7" id="obse7" cols="30" rows="10" placeholder="Observaciones..."></textarea>
                    </div>
                </div>

                <div class="elemento-escalamiento">
                    <div class="elementos-texto">
                        <b><p>- Cuerda para aseguramiento de escaleras.</p></b>
                        <p><span>Se busca: </span>Roturas y desgarramientos.</p>
                    </div>
                    <div class="selectores">
                        <div class="labels">
                            <label>Bueno<input type="radio" value="bueno" name="ae8" checked></label>
                            <label>Malo<input type="radio" value="malo" name="ae8"></label>
                            <label>No Aplica<input type="radio" value="na" name="ae8"></label>
                        </div>
                        <textarea name="obse8" id="obse8" cols="30" rows="10" placeholder="Observaciones..."></textarea>
                    </div>
                </div>
            </section>

            <section class="conclusion">
                <div class="marcado">
                    <h4>* Conclusión </h4>
                    <label>Apto: <input type="radio" name="apto" value="si"></label>
                    <label>No Apto: <input type="radio" name="apto" checked value="no"></label>
                </div>
                <div class="contenedor-supervisor">
                    <p>Inspección realizada por </p>
                    <div>
                        <select name="supervisor" id="supervisor">
                        <option value="">Seleccionar</option>
                        </select>
                        <label>DNI. <input type="text" id="dni-supervisor" readonly></label>
                        <input type="text" id="supervisor-firma">
                    </div>
                </div>
                <div class="contenedor-responsable">
                    <p>Responsable del Trabajo </p>
                    <div>
                        <select name="responsable" id="responsable">
                        <option value="">Seleccionar</option>
                        </select>
                        <label>DNI. <input type="text"  id="dni-responsable" readonly></label>
                        <input type="text" id="responsable-firma">
                    </div>
                </div>
            </section>
          </div>
          <div id="btnGenerar"><i class="fa-solid fa-file-pdf fa-lg"></i></div>
        </form>
      </section>
    </main>

    <script src="../scripts/functionsProteccionCaidas.js"></script>
    <script type="module" src="../scripts/control_tiempo.js"></script>
  </body>
</html>
