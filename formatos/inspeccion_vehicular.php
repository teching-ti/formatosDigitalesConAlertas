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
    <title>Checklist de Inspección Vehicular</title>
    <?php 
      require("./header_comun/scripts_links.php")
    ?>
    <!-- Estilos -->
    <link rel="stylesheet" href="../estilos/stylesChecklist2.css" />
  </head>
  <body>
    <main class="main">
      <figure class="logo-title">
        <a href="../">
          <img src="../recursos/logo_teching.png" alt="teching_logo" />
        </a>
        <div>
          <span>Checklist de Inspección Vehicular</span>
        </div>
      </figure>

      <section class="form-container">
        <!--Inicia Cuerpo del Formulario-->
        <div class="form-body">
          <section
            class="datos-generales-documento"
            id="datos-generales-documento"
          >
            <h1>Datos Generales</h1>
            <div class="contenedor-vehiculo">
              <h4>Marque el tipo de vehículo al que le realizará la inspección</h4>
              <div class="vehiculos">
                <label for="vehiculo-auto">Auto<input type="radio" name="vehiculo" id="vehiculo-auto" checked></label>
                <label for="vehiculo-moto">Moto<input type="radio" name="vehiculo" id="vehiculo-moto"></label>
              </div>
            </div>
            <div class="dg-contenedor">
              <select name="nombre-conductor" id="nombre-conductor">
                <option>-Seleccionar Conductor-</option>
              </select>
              <input
                type="text"
                id="firma-conductor"
                placeholder="firma-conductor"
              />
              <input
                type="text"
                name="empresa"
                id="empresa"
                placeholder="EMPRESA"
              />
              <input type="text" placeholder="PLACA" id="placa" maxlength="7"/>
              <input
                type="text"
                name="tarjeta-propiedad"
                id="tarjeta-propiedad"
                placeholder="TARJETA DE PROPIEDAD"
              />
              <!-- <label>Supervisor inmediato: <input type="text" id="supervisor-inmediato-nombre"></label> -->
              <label>Fecha de vencimiento de revisión técnica<input type="date" id="vencimiento-revision-tecnica" min='01-01-2022' max='31-12-2050'></label>
              <label for="usa-lentes" id="cont-lentes"
                >Usa lentes correctores
                <input type="checkbox" name="usa-lentes" id="usa-lentes"
              /></label>
              <label id="cont-inicio"
                >Inicio(Km) <input type="number" id="inicio-km"
              /></label>
              <label id="cont-final">
                Final(Km) <input type="number" id="final-km"
              /></label>
              <input type="text" placeholder="N° SOAT" id="numero-soat" />
              <input type="text" placeholder="Empresa SOAT" id="empresa-soat" />
              <label>
                Vencimiento del SOAT
                <input type="date" id="vencimiento-soat" min='01-01-2022' max='31-12-2050'/>
              </label>

              <input type="text" placeholder="Número Brevete" id="numero-brevete" />
              <input type="text" placeholder="Categoría" id="categoria" />
              <label>Fecha de Vencimiento <input type="date" id="fecha-vencimiento" min='01-01-2022' max='31-12-2050'></label>
              
              <!--fecha y hora de la inspección-->
              <label for="fecha" id="container-fecha"
                >Fecha de inspección <input type="text" id="fecha" readonly
              /></label>
              <label id="cont-h-inspeccion"
                >Hora de Inspección<input
                  type="time"
                  name="hora-inspeccion"
                  id="hora-inspeccion"
              /></label>
            </div>
          </section>

          <section class="selectores">
            <div class="selectores-todo-vehiculo">
              <h1>Vehiculos</h1>
              <div class="selector-elemento">
                <span class="verificar">Nivel de aceite de motor *</span>
                <div>
                  <label>B<input type="radio" name="v1" value="Bueno" checked /></label>
                  <label>M<input type="radio" name="v1" value="Malo" /></label>
                  <label
                    >NT<input type="radio" name="v1" value="No Tiene"
                  /></label>
                  <label
                    >NA<input type="radio" name="v1" value="No Aplica"
                  /></label>
                </div>
                <span>Atención</span>
                <select id="oc1">
                  <option>NA</option>
                  <option value="Inmediata">Inmediata</option>
                  <option value="Antes 24 h.">Antes 24 h.</option>
                </select>
              </div>

              <div class="selector-elemento">
                <span class="verificar">Nivel de líquido de freno *</span>
                <div>
                  <label>B<input type="radio" name="v2" value="Bueno" checked /></label>
                  <label>M<input type="radio" name="v2" value="Malo" /></label>
                  <label
                    >NT<input type="radio" name="v2" value="No Tiene"
                  /></label>
                  <label
                    >NA<input type="radio" name="v2" value="No Aplica"
                  /></label>
                </div>
                <span>Atención</span>
                <select>
                  <option>NA</option>
                  <option value="Inmediata">Inmediata</option>
                  <option value="Antes 24 h.">Antes 24 h.</option>
                </select>
              </div>

              <div class="selector-elemento">
                <span class="verificar">Nivel de hidrolina de dirección *</span>
                <div>
                  <label>B<input type="radio" name="v3" value="Bueno" checked /></label>
                  <label>M<input type="radio" name="v3" value="Malo" /></label>
                  <label
                    >NT<input type="radio" name="v3" value="No Tiene"
                  /></label>
                  <label
                    >NA<input type="radio" name="v3" value="No Aplica"
                  /></label>
                </div>
                <span>Atención</span>
                <select>
                  <option>NA</option>
                  <option value="Inmediata">Inmediata</option>
                  <option value="Antes 24 h.">Antes 24 h.</option>
                </select>
              </div>

              <div class="selector-elemento">
                <span class="verificar">Nivel de agua del radiador *</span>
                <div>
                  <label>B<input type="radio" name="v4" value="Bueno" checked /></label>
                  <label>M<input type="radio" name="v4" value="Malo" /></label>
                  <label
                    >NT<input type="radio" name="v4" value="No Tiene"
                  /></label>
                  <label
                    >NA<input type="radio" name="v4" value="No Aplica"
                  /></label>
                </div>
                <span>Atención</span>
                <select>
                  <option>NA</option>
                  <option value="Inmediata">Inmediata</option>
                  <option value="Antes 24 h.">Antes 24 h.</option>
                </select>
              </div>

              <div class="selector-elemento">
                <span class="verificar">Luces de alta/ baja *</span>
                <div>
                  <label>B<input type="radio" name="v5" value="Bueno" checked /></label>
                  <label>M<input type="radio" name="v5" value="Malo" /></label>
                  <label
                    >NT<input type="radio" name="v5" value="No Tiene"
                  /></label>
                  <label
                    >NA<input type="radio" name="v5" value="No Aplica"
                  /></label>
                </div>
                <span>Atención</span>
                <select>
                  <option>NA</option>
                  <option value="Inmediata">Inmediata</option>
                  <option value="Antes 24 h.">Antes 24 h.</option>
                </select>
              </div>

              <div class="selector-elemento">
                <span class="verificar">Luces direccionales *</span>
                <div>
                  <label>B<input type="radio" name="v6" value="Bueno" checked /></label>
                  <label>M<input type="radio" name="v6" value="Malo" /></label>
                  <label
                    >NT<input type="radio" name="v6" value="No Tiene"
                  /></label>
                  <label
                    >NA<input type="radio" name="v6" value="No Aplica"
                  /></label>
                </div>
                <span>Atención</span>
                <select>
                  <option>NA</option>
                  <option value="Inmediata">Inmediata</option>
                  <option value="Antes 24 h.">Antes 24 h.</option>
                </select>
              </div>

              <div class="selector-elemento">
                <span class="verificar">Luces de freno *</span>
                <div>
                  <label>B<input type="radio" name="v7" value="Bueno" checked /></label>
                  <label>M<input type="radio" name="v7" value="Malo" /></label>
                  <label
                    >NT<input type="radio" name="v7" value="No Tiene"
                  /></label>
                  <label
                    >NA<input type="radio" name="v7" value="No Aplica"
                  /></label>
                </div>
                <span>Atención</span>
                <select>
                  <option>NA</option>
                  <option value="Inmediata">Inmediata</option>
                  <option value="Antes 24 h.">Antes 24 h.</option>
                </select>
              </div>

              <div class="selector-elemento">
                <span>Luces de emergencia</span>
                <div>
                  <label>B<input type="radio" name="v8" value="Bueno" checked /></label>
                  <label>M<input type="radio" name="v8" value="Malo" /></label>
                  <label
                    >NT<input type="radio" name="v8" value="No Tiene"
                  /></label>
                  <label
                    >NA<input type="radio" name="v8" value="No Aplica"
                  /></label>
                </div>
                <span>Atención</span>
                <select>
                  <option>NA</option>
                  <option value="Inmediata">Inmediata</option>
                  <option value="Antes 24 h.">Antes 24 h.</option>
                </select>
              </div>

              <div class="selector-elemento">
                <span>Luces de faros pirata</span>
                <div>
                  <label>B<input type="radio" name="v9" value="Bueno" checked /></label>
                  <label>M<input type="radio" name="v9" value="Malo" /></label>
                  <label
                    >NT<input type="radio" name="v9" value="No Tiene"
                  /></label>
                  <label
                    >NA<input type="radio" name="v9" value="No Aplica"
                  /></label>
                </div>
                <span>Atención</span>
                <select>
                  <option>NA</option>
                  <option value="Inmediata">Inmediata</option>
                  <option value="Antes 24 h.">Antes 24 h.</option>
                </select>
              </div>

              <div class="selector-elemento">
                <span>Luces de neblinero</span>
                <div>
                  <label
                    >B<input type="radio" name="v10" value="Bueno" checked
                  /></label>
                  <label>M<input type="radio" name="v10" value="Malo" /></label>
                  <label
                    >NT<input type="radio" name="v10" value="No Tiene"
                  /></label>
                  <label
                    >NA<input type="radio" name="v10" value="No Aplica"
                  /></label>
                </div>
                <span>Atención</span>
                <select>
                  <option>NA</option>
                  <option value="Inmediata">Inmediata</option>
                  <option value="Antes 24 h.">Antes 24 h.</option>
                </select>
              </div>

              <div class="selector-elemento">
                <span class="verificar">Espejos retrovisores laterales *</span>
                <div>
                  <label
                    >B<input type="radio" name="v11" value="Bueno" checked
                  /></label>
                  <label>M<input type="radio" name="v11" value="Malo" /></label>
                  <label
                    >NT<input type="radio" name="v11" value="No Tiene"
                  /></label>
                  <label
                    >NA<input type="radio" name="v11" value="No Aplica"
                  /></label>
                </div>
                <span>Atención</span>
                <select>
                  <option>NA</option>
                  <option value="Inmediata">Inmediata</option>
                  <option value="Antes 24 h.">Antes 24 h.</option>
                </select>
              </div>

              <div class="selector-elemento">
                <span class="verificar">Botiquín de primeros auxilios *</span>
                <div>
                  <label
                    >B<input type="radio" name="v12" value="Bueno" checked
                  /></label>
                  <label>M<input type="radio" name="v12" value="Malo" /></label>
                  <label
                    >NT<input type="radio" name="v12" value="No Tiene"
                  /></label>
                  <label
                    >NA<input type="radio" name="v12" value="No Aplica"
                  /></label>
                </div>
                <span>Atención</span>
                <select>
                  <option>NA</option>
                  <option value="Inmediata">Inmediata</option>
                  <option value="Antes 24 h.">Antes 24 h.</option>
                </select>
              </div>

              <div class="selector-elemento">
                <span class="verificar"
                  >Cinturón de seguridad de conductor *</span
                >
                <div>
                  <label
                    >B<input type="radio" name="v13" value="Bueno" checked
                  /></label>
                  <label>M<input type="radio" name="v13" value="Malo" /></label>
                  <label
                    >NT<input type="radio" name="v13" value="No Tiene"
                  /></label>
                  <label
                    >NA<input type="radio" name="v13" value="No Aplica"
                  /></label>
                </div>
                <span>Atención</span>
                <select>
                  <option>NA</option>
                  <option value="Inmediata">Inmediata</option>
                  <option value="Antes 24 h.">Antes 24 h.</option>
                </select>
              </div>

              <div class="selector-elemento">
                <span>Cinturón de seguridad de copiloto</span>
                <div>
                  <label
                    >B<input type="radio" name="v14" value="Bueno" checked
                  /></label>
                  <label>M<input type="radio" name="v14" value="Malo" /></label>
                  <label
                    >NT<input type="radio" name="v14" value="No Tiene"
                  /></label>
                  <label
                    >NA<input type="radio" name="v14" value="No Aplica"
                  /></label>
                </div>
                <span>Atención</span>
                <select>
                  <option>NA</option>
                  <option value="Inmediata">Inmediata</option>
                  <option value="Antes 24 h.">Antes 24 h.</option>
                </select>
              </div>

              <div class="selector-elemento">
                <span>Cinturón de seguridad de asientos posteriores</span
                >
                <div>
                  <label
                    >B<input type="radio" name="v15" value="Bueno" checked
                  /></label>
                  <label>M<input type="radio" name="v15" value="Malo" /></label>
                  <label
                    >NT<input type="radio" name="v15" value="No Tiene"
                  /></label>
                  <label
                    >NA<input type="radio" name="v15" value="No Aplica"
                  /></label>
                </div>
                <span>Atención</span>
                <select>
                  <option>NA</option>
                  <option value="Inmediata">Inmediata</option>
                  <option value="Antes 24 h.">Antes 24 h.</option>
                </select>
              </div>

              <!-- <div class="selector-elemento">
                <span
                  >Cinturón de seguridad</span
                >
                <div>
                  <label
                    >B<input type="radio" name="v16" value="Bueno" checked
                  /></label>
                  <label>M<input type="radio" name="v16" value="Malo" /></label>
                  <label
                    >NT<input type="radio" name="v16" value="No Tiene"
                  /></label>
                  <label
                    >NA<input type="radio" name="v16" value="No Aplica"
                  /></label>
                </div>
                <span>Atención</span>
                <select>
                  <option>NA</option>
                  <option value="Inmediata">Inmediata</option>
                  <option value="Antes 24 h.">Antes 24 h.</option>
                </select>
              </div> -->

              <div class="selector-elemento">
                <span class="verificar">Llave de ruedas *</span>
                <div>
                  <label
                    >B<input type="radio" name="v17" value="Bueno" checked
                  /></label>
                  <label>M<input type="radio" name="v17" value="Malo" /></label>
                  <label
                    >NT<input type="radio" name="v17" value="No Tiene"
                  /></label>
                  <label
                    >NA<input type="radio" name="v17" value="No Aplica"
                  /></label>
                </div>
                <span>Atención</span>
                <select>
                  <option>NA</option>
                  <option value="Inmediata">Inmediata</option>
                  <option value="Antes 24 h.">Antes 24 h.</option>
                </select>
              </div>

              <div class="selector-elemento">
                <span class="verificar">Linterna o faro pirata *</span>
                <div>
                  <label
                    >B<input type="radio" name="v18" value="Bueno" checked
                  /></label>
                  <label>M<input type="radio" name="v18" value="Malo" /></label>
                  <label
                    >NT<input type="radio" name="v18" value="No Tiene"
                  /></label>
                  <label
                    >NA<input type="radio" name="v18" value="No Aplica"
                  /></label>
                </div>
                <span>Atención</span>
                <select>
                  <option>NA</option>
                  <option value="Inmediata">Inmediata</option>
                  <option value="Antes 24 h.">Antes 24 h.</option>
                </select>
              </div>

              <div class="selector-elemento">
                <span class="verificar">Frenos de estacionamiento *</span>
                <div>
                  <label
                    >B<input type="radio" name="v19" value="Bueno" checked
                  /></label>
                  <label>M<input type="radio" name="v19" value="Malo" /></label>
                  <label
                    >NT<input type="radio" name="v19" value="No Tiene"
                  /></label>
                  <label
                    >NA<input type="radio" name="v19" value="No Aplica"
                  /></label>
                </div>
                <span>Atención</span>
                <select>
                  <option>NA</option>
                  <option value="Inmediata">Inmediata</option>
                  <option value="Antes 24 h.">Antes 24 h.</option>
                </select>
              </div>

              <div class="selector-elemento">
                <span class="verificar">Nivel de agua del limpiabrisas *</span>
                <div>
                  <label
                    >B<input type="radio" name="v20" value="Bueno" checked
                  /></label>
                  <label>M<input type="radio" name="v20" value="Malo" /></label>
                  <label
                    >NT<input type="radio" name="v20" value="No Tiene"
                  /></label>
                  <label
                    >NA<input type="radio" name="v20" value="No Aplica"
                  /></label>
                </div>
                <span>Atención</span>
                <select>
                  <option>NA</option>
                  <option value="Inmediata">Inmediata</option>
                  <option value="Antes 24 h.">Antes 24 h.</option>
                </select>
              </div>

              <div class="selector-elemento">
                <span
                  >Estado de tablero/ Indicadores operativos</span
                >
                <div>
                  <label
                    >B<input type="radio" name="v21" value="Bueno" checked
                  /></label>
                  <label>M<input type="radio" name="v21" value="Malo" /></label>
                  <label
                    >NT<input type="radio" name="v21" value="No Tiene"
                  /></label>
                  <label
                    >NA<input type="radio" name="v21" value="No Aplica"
                  /></label>
                </div>
                <span>Atención</span>
                <select>
                  <option>NA</option>
                  <option value="Inmediata">Inmediata</option>
                  <option value="Antes 24 h.">Antes 24 h.</option>
                </select>
              </div>

              <div class="selector-elemento">
                <span class="verificar">Vidrios de ventanas *</span>
                <div>
                  <label
                    >B<input type="radio" name="v22" value="Bueno" checked
                  /></label>
                  <label>M<input type="radio" name="v22" value="Malo" /></label>
                  <label
                    >NT<input type="radio" name="v22" value="No Tiene"
                  /></label>
                  <label
                    >NA<input type="radio" name="v22" value="No Aplica"
                  /></label>
                </div>
                <span>Atención</span>
                <select>
                  <option>NA</option>
                  <option value="Inmediata">Inmediata</option>
                  <option value="Antes 24 h.">Antes 24 h.</option>
                </select>
              </div>

              <div class="selector-elemento">
                <span class="verificar">Espejo retrovisor interior *</span>
                <div>
                  <label
                    >B<input type="radio" name="v23" value="Bueno" checked
                  /></label>
                  <label>M<input type="radio" name="v23" value="Malo" /></label>
                  <label
                    >NT<input type="radio" name="v23" value="No Tiene"
                  /></label>
                  <label
                    >NA<input type="radio" name="v23" value="No Aplica"
                  /></label>
                </div>
                <span>Atención</span>
                <select>
                  <option>NA</option>
                  <option value="Inmediata">Inmediata</option>
                  <option value="Antes 24 h.">Antes 24 h.</option>
                </select>
              </div>

              <div class="selector-elemento">
                <span class="verificar">Cable de remolque *</span>
                <div>
                  <label
                    >B<input type="radio" name="v24" value="Bueno" checked
                  /></label>
                  <label>M<input type="radio" name="v24" value="Malo" /></label>
                  <label
                    >NT<input type="radio" name="v24" value="No Tiene"
                  /></label>
                  <label
                    >NA<input type="radio" name="v24" value="No Aplica"
                  /></label>
                </div>
                <span>Atención</span>
                <select>
                  <option>NA</option>
                  <option value="Inmediata">Inmediata</option>
                  <option value="Antes 24 h.">Antes 24 h.</option>
                </select>
              </div>

              <div class="selector-elemento">
                <span class="verificar"
                  >Cable eléctrico auxiliar de arranque *</span
                >
                <div>
                  <label
                    >B<input type="radio" name="v25" value="Bueno" checked
                  /></label>
                  <label>M<input type="radio" name="v25" value="Malo" /></label>
                  <label
                    >NT<input type="radio" name="v25" value="No Tiene"
                  /></label>
                  <label
                    >NA<input type="radio" name="v25" value="No Aplica"
                  /></label>
                </div>
                <span>Atención</span>
                <select>
                  <option>NA</option>
                  <option value="Inmediata">Inmediata</option>
                  <option value="Antes 24 h.">Antes 24 h.</option>
                </select>
              </div>

              <div class="selector-elemento">
                <span>Herramientas y palanca de ruedas</span>
                <div>
                  <label
                    >B<input type="radio" name="v26" value="Bueno" checked
                  /></label>
                  <label>M<input type="radio" name="v26" value="Malo" /></label>
                  <label
                    >NT<input type="radio" name="v26" value="No Tiene"
                  /></label>
                  <label
                    >NA<input type="radio" name="v26" value="No Aplica"
                  /></label>
                </div>
                <span>Atención</span>
                <select>
                  <option>NA</option>
                  <option value="Inmediata">Inmediata</option>
                  <option value="Antes 24 h.">Antes 24 h.</option>
                </select>
              </div>

              <div class="selector-elemento">
                <span class="verificar">Parabrisas y plumillas *</span>
                <div>
                  <label
                    >B<input type="radio" name="v27" value="Bueno" checked
                  /></label>
                  <label>M<input type="radio" name="v27" value="Malo" /></label>
                  <label
                    >NT<input type="radio" name="v27" value="No Tiene"
                  /></label>
                  <label
                    >NA<input type="radio" name="v27" value="No Aplica"
                  /></label>
                </div>
                <span>Atención</span>
                <select>
                  <option>NA</option>
                  <option value="Inmediata">Inmediata</option>
                  <option value="Antes 24 h.">Antes 24 h.</option>
                </select>
              </div>

              <div class="selector-elemento">
                <span class="verificar">Triángulo * </span>
                <div>
                  <label
                    >B<input type="radio" name="v28" value="Bueno" checked
                  /></label>
                  <label>M<input type="radio" name="v28" value="Malo" /></label>
                  <label
                    >NT<input type="radio" name="v28" value="No Tiene"
                  /></label>
                  <label
                    >NA<input type="radio" name="v28" value="No Aplica"
                  /></label>
                </div>
                <span>Atención</span>
                <select>
                  <option>NA</option>
                  <option value="Inmediata">Inmediata</option>
                  <option value="Antes 24 h.">Antes 24 h.</option>
                </select>
              </div>

              <div class="selector-elemento">
                <span class="verificar">Batería, bornes de batería *</span>
                <div>
                  <label
                    >B<input type="radio" name="v29" value="Bueno" checked
                  /></label>
                  <label>M<input type="radio" name="v29" value="Malo" /></label>
                  <label
                    >NT<input type="radio" name="v29" value="No Tiene"
                  /></label>
                  <label
                    >NA<input type="radio" name="v29" value="No Aplica"
                  /></label>
                </div>
                <span>Atención</span>
                <select>
                  <option>NA</option>
                  <option value="Inmediata">Inmediata</option>
                  <option value="Antes 24 h.">Antes 24 h.</option>
                </select>
              </div>

              <div class="selector-elemento">
                <span>Orden y limpieza</span>
                <div>
                  <label
                    >B<input type="radio" name="v30" value="Bueno" checked
                  /></label>
                  <label>M<input type="radio" name="v30" value="Malo" /></label>
                  <label
                    >NT<input type="radio" name="v30" value="No Tiene"
                  /></label>
                  <label
                    >NA<input type="radio" name="v30" value="No Aplica"
                  /></label>
                </div>
                <span>Atención</span>
                <select>
                  <option>NA</option>
                  <option value="Inmediata">Inmediata</option>
                  <option value="Antes 24 h.">Antes 24 h.</option>
                </select>
              </div>
            </div>

            <div class="contenedor-llantas">
              <h1>Estado de llantas</h1>
              <div class="selector-elemento">
                <span>Llanta delantera derecha</span>
                <div>
                  <label>B<input type="radio" name="l1" value="Bueno" checked /></label>
                  <label>M<input type="radio" name="l1" value="Malo" /></label>
                  <label
                    >NT<input type="radio" name="l1" value="No Tiene"
                  /></label>
                  <label
                    >NA<input type="radio" name="l1" value="No Aplica"
                  /></label>
                </div>
                <span>Atención</span>
                <select>
                  <option>NA</option>
                  <option value="Inmediata">Inmediata</option>
                  <option value="Antes 24 h.">Antes 24 h.</option>
                </select>
              </div>

              <div class="selector-elemento">
                <span>Llanta delantera izquierda</span>
                <div>
                  <label>B<input type="radio" name="l2" value="Bueno" checked /></label>
                  <label>M<input type="radio" name="l2" value="Malo" /></label>
                  <label
                    >NT<input type="radio" name="l2" value="No Tiene"
                  /></label>
                  <label
                    >NA<input type="radio" name="l2" value="No Aplica"
                  /></label>
                </div>
                <span>Atención</span>
                <select>
                  <option>NA</option>
                  <option value="Inmediata">Inmediata</option>
                  <option value="Antes 24 h.">Antes 24 h.</option>
                </select>
              </div>

              <div class="selector-elemento">
                <span>Llanta posterior derecha</span>
                <div>
                  <label>B<input type="radio" name="l3" value="Bueno" checked /></label>
                  <label>M<input type="radio" name="l3" value="Malo" /></label>
                  <label
                    >NT<input type="radio" name="l3" value="No Tiene"
                  /></label>
                  <label
                    >NA<input type="radio" name="l3" value="No Aplica"
                  /></label>
                </div>
                <span>Atención</span>
                <select>
                  <option>NA</option>
                  <option value="Inmediata">Inmediata</option>
                  <option value="Antes 24 h.">Antes 24 h.</option>
                </select>
              </div>

              <div class="selector-elemento">
                <span>Llanta posterior izquierda</span>
                <div>
                  <label>B<input type="radio" name="l4" value="Bueno" checked /></label>
                  <label>M<input type="radio" name="l4" value="Malo" /></label>
                  <label
                    >NT<input type="radio" name="l4" value="No Tiene"
                  /></label>
                  <label
                    >NA<input type="radio" name="l4" value="No Aplica"
                  /></label>
                </div>
                <span>Atención</span>
                <select>
                  <option>NA</option>
                  <option value="Inmediata">Inmediata</option>
                  <option value="Antes 24 h.">Antes 24 h.</option>
                </select>
              </div>

              <div class="selector-elemento">
                <span>Llanta de repuesto</span>
                <div>
                  <label
                    >B<input type="radio" name="l5" value="Bueno" checked
                  /></label>
                  <label
                    >M<input type="radio" name="l5" value="Malo"
                  /></label>
                  <label
                    >NT<input type="radio" name="l5" value="No Tiene"
                  /></label>
                  <label
                    >NA<input type="radio" name="l5" value="No Aplica"
                  /></label>
                </div>
                <span>Atención</span>
                <select>
                  <option>NA</option>
                  <option value="Inmediata">Inmediata</option>
                  <option value="Antes 24 h.">Antes 24 h.</option>
                </select>
              </div>
            </div>

            <div class="contenedor-accesorios">
              <h1>Accesorios de seguridad</h1>
              <div class="selector-elemento">
                <span class="verificar"
                  >Conos de Seguridad reflectivos (02) *</span
                >
                <div>
                  <label>B<input type="radio" name="a1" value="Bueno" checked /></label>
                  <label>M<input type="radio" name="a1" value="Malo" /></label>
                  <label
                    >NT<input type="radio" name="a1" value="No Tiene"
                  /></label>
                  <label
                    >NA<input type="radio" name="a1" value="No Aplica"
                  /></label>
                </div>
                <span>Atención</span>
                <select>
                  <option>NA</option>
                  <option value="Inmediata">Inmediata</option>
                  <option value="Antes 24 h.">Antes 24 h.</option>
                </select>
              </div>

              <div class="selector-elemento">
                <span class="verificar">Extintor PQS *</span>
                <div>
                  <label>B<input type="radio" name="a2" value="Bueno" checked /></label>
                  <label>M<input type="radio" name="a2" value="Malo" /></label>
                  <label
                    >NT<input type="radio" name="a2" value="No Tiene"
                  /></label>
                  <label
                    >NA<input type="radio" name="a2" value="No Aplica"
                  /></label>
                </div>
                <span>Atención</span>
                <select>
                  <option>NA</option>
                  <option value="Inmediata">Inmediata</option>
                  <option value="Antes 24 h.">Antes 24 h.</option>
                </select>
              </div>

              <div class="selector-elemento">
                <span class="verificar">Alarma de retrocesos (NN) *</span>
                <div>
                  <label>B<input type="radio" name="a3" value="Bueno" checked /></label>
                  <label>M<input type="radio" name="a3" value="Malo" /></label>
                  <label
                    >NT<input type="radio" name="a3" value="No Tiene"
                  /></label>
                  <label
                    >NA<input type="radio" name="a3" value="No Aplica"
                  /></label>
                </div>
                <span>Atención</span>
                <select>
                  <option>NA</option>
                  <option value="Inmediata">Inmediata</option>
                  <option value="Antes 24 h.">Antes 24 h.</option>
                </select>
              </div>

              <div class="selector-elemento">
                <span class="verificar">Claxon (NN) *</span>
                <div>
                  <label>B<input type="radio" name="a4" value="Bueno" checked /></label>
                  <label>M<input type="radio" name="a4" value="Malo" /></label>
                  <label
                    >NT<input type="radio" name="a4" value="No Tiene"
                  /></label>
                  <label
                    >NA<input type="radio" name="a4" value="No Aplica"
                  /></label>
                </div>
                <span>Atención</span>
                <select>
                  <option>NA</option>
                  <option value="Inmediata">Inmediata</option>
                  <option value="Antes 24 h.">Antes 24 h.</option>
                </select>
              </div>

              <div class="selector-elemento">
                <span class="verificar">Tacos de seguridad (02) *</span>
                <div>
                  <label>B<input type="radio" name="a5" value="Bueno" checked /></label>
                  <label>M<input type="radio" name="a5" value="Malo" /></label>
                  <label
                    >NT<input type="radio" name="a5" value="No Tiene"
                  /></label>
                  <label
                    >NA<input type="radio" name="a5" value="No Aplica"
                  /></label>
                </div>
                <span>Atención</span>
                <select>
                  <option>NA</option>
                  <option value="Inmediata">Inmediata</option>
                  <option value="Antes 24 h.">Antes 24 h.</option>
                </select>
              </div>
            </div>

            <div class="contenedor-tapas">
              <h1>Tapas y otros</h1>
              <div class="selector-elemento">
                <span
                  >Tapa de tanque de gasolina y/o petróleo</span
                >
                <div>
                  <label>B<input type="radio" name="t1" value="Bueno" checked /></label>
                  <label>M<input type="radio" name="t1" value="Malo" /></label>
                  <label
                    >NT<input type="radio" name="t1" value="No Tiene"
                  /></label>
                  <label
                    >NA<input type="radio" name="t1" value="No Aplica"
                  /></label>
                </div>
                <span>Atención</span>
                <select>
                  <option>NA</option>
                  <option value="Inmediata">Inmediata</option>
                  <option value="Antes 24 h.">Antes 24 h.</option>
                </select>
              </div>

              <div class="selector-elemento">
                <span>Gata hidráulica</span>
                <div>
                  <label>B<input type="radio" name="t2" value="Bueno" checked /></label>
                  <label>M<input type="radio" name="t2" value="Malo" /></label>
                  <label
                    >NT<input type="radio" name="t2" value="No Tiene"
                  /></label>
                  <label
                    >NA<input type="radio" name="t2" value="No Aplica"
                  /></label>
                </div>
                <span>Atención</span>
                <select>
                  <option>NA</option>
                  <option value="Inmediata">Inmediata</option>
                  <option value="Antes 24 h.">Antes 24 h.</option>
                </select>
              </div>

              <div class="selector-elemento">
                <span>Cable, cadena y/o estrobo</span>
                <div>
                  <label>B<input type="radio" name="t3" value="Bueno" checked /></label>
                  <label>M<input type="radio" name="t3" value="Malo" /></label>
                  <label
                    >NT<input type="radio" name="t3" value="No Tiene"
                  /></label>
                  <label
                    >NA<input type="radio" name="t3" value="No Aplica"
                  /></label>
                </div>
                <span>Atención</span>
                <select>
                  <option>NA</option>
                  <option value="Inmediata">Inmediata</option>
                  <option value="Antes 24 h.">Antes 24 h.</option>
                </select>
              </div>
            </div>
          </section>

          <section class="selectores-motorizado">
            <h1>Motorizado</h1>

            <div class="selector-motorizado">
              <p>Espejo retrovisor Der/Izq</p>
              <div>
                <label>B<input type="radio" name="m1" value="Bueno" checked /></label>
                <label>M<input type="radio" name="m1" value="Malo" /></label>
                <label
                  >NT<input type="radio" name="m1" value="No Tiene"
                /></label>
                <label
                  >NA<input type="radio" name="m1" value="No Aplica"
                /></label>
              </div>
              <span>Atención</span>
              <select>
                <option>NA</option>
                <option value="Inmediata">Inmediata</option>
                <option value="Antes 24 h.">Antes 24 h.</option>
              </select>
            </div>

            <div class="selector-motorizado">
              <p>Direccionales delantero</p>
              <div>
                <label>B<input type="radio" name="m2" value="Bueno" checked /></label>
                <label>M<input type="radio" name="m2" value="Malo" /></label>
                <label
                  >NT<input type="radio" name="m2" value="No Tiene"
                /></label>
                <label
                  >NA<input type="radio" name="m2" value="No Aplica"
                /></label>
              </div>
              <span>Atención</span>
              <select>
                <option>NA</option>
                <option value="Inmediata">Inmediata</option>
                <option value="Antes 24 h.">Antes 24 h.</option>
              </select>
            </div>

            <div class="selector-motorizado">
              <p>Direccionales posterior</p>
              <div>
                <label>B<input type="radio" name="m3" value="Bueno" checked /></label>
                <label>M<input type="radio" name="m3" value="Malo" /></label>
                <label
                  >NT<input type="radio" name="m3" value="No Tiene"
                /></label>
                <label
                  >NA<input type="radio" name="m3" value="No Aplica"
                /></label>
              </div>
              <span>Atención</span>
              <select>
                <option>NA</option>
                <option value="Inmediata">Inmediata</option>
                <option value="Antes 24 h.">Antes 24 h.</option>
              </select>
            </div>

            <div class="selector-motorizado">
              <p>Funcionamiento de freno delantero</p>
              <div>
                <label>B<input type="radio" name="m4" value="Bueno" checked /></label>
                <label>M<input type="radio" name="m4" value="Malo" /></label>
                <label
                  >NT<input type="radio" name="m4" value="No Tiene"
                /></label>
                <label
                  >NA<input type="radio" name="m4" value="No Aplica"
                /></label>
              </div>
              <span>Atención</span>
              <select>
                <option>NA</option>
                <option value="Inmediata">Inmediata</option>
                <option value="Antes 24 h.">Antes 24 h.</option>
              </select>
            </div>

            <div class="selector-motorizado">
              <p>Funcionamiento de freno posterior</p>
              <div>
                <label>B<input type="radio" name="m5" value="Bueno" checked /></label>
                <label>M<input type="radio" name="m5" value="Malo" /></label>
                <label
                  >NT<input type="radio" name="m5" value="No Tiene"
                /></label>
                <label
                  >NA<input type="radio" name="m5" value="No Aplica"
                /></label>
              </div>
              <span>Atención</span>
              <select>
                <option>NA</option>
                <option value="Inmediata">Inmediata</option>
                <option value="Antes 24 h.">Antes 24 h.</option>
              </select>
            </div>

            <div class="selector-motorizado">
              <p>Llantas delantera/ trasera</p>
              <div>
                <label>B<input type="radio" name="m6" value="Bueno" checked /></label>
                <label>M<input type="radio" name="m6" value="Malo" /></label>
                <label
                  >NT<input type="radio" name="m6" value="No Tiene"
                /></label>
                <label
                  >NA<input type="radio" name="m6" value="No Aplica"
                /></label>
              </div>
              <span>Atención</span>
              <select>
                <option>NA</option>
                <option value="Inmediata">Inmediata</option>
                <option value="Antes 24 h.">Antes 24 h.</option>
              </select>
            </div>

            <div class="selector-motorizado">
              <p>Luces: alta/ baja, direccionales, freno</p>
              <div>
                <label>B<input type="radio" name="m7" value="Bueno" checked /></label>
                <label>M<input type="radio" name="m7" value="Malo" /></label>
                <label
                  >NT<input type="radio" name="m7" value="No Tiene"
                /></label>
                <label
                  >NA<input type="radio" name="m7" value="No Aplica"
                /></label>
              </div>
              <span>Atención</span>
              <select>
                <option>NA</option>
                <option value="Inmediata">Inmediata</option>
                <option value="Antes 24 h.">Antes 24 h.</option>
              </select>
            </div>

            <div class="selector-motorizado">
              <p>Equipos de la unidad (caja portaherramientas, barras protectoras para las piernas/ manos, llaves de boca, alicate universal, destornillador plano/ estrella y medidor de presión)
              </p>
              <div>
                <label>B<input type="radio" name="m8" value="Bueno" checked /></label>
                <label>M<input type="radio" name="m8" value="Malo" /></label>
                <label
                  >NT<input type="radio" name="m8" value="No Tiene"
                /></label>
                <label
                  >NA<input type="radio" name="m8" value="No Aplica"
                /></label>
              </div>
              <span>Atención</span>
              <select>
                <option>NA</option>
                <option value="Inmediata">Inmediata</option>
                <option value="Antes 24 h.">Antes 24 h.</option>
              </select>
            </div>

            <div class="selector-motorizado">
              <p>Bocina (claxon)</p>
              <div>
                <label>B<input type="radio" name="m9" value="Bueno" checked /></label>
                <label>M<input type="radio" name="m9" value="Malo" /></label>
                <label
                  >NT<input type="radio" name="m9" value="No Tiene"
                /></label>
                <label
                  >NA<input type="radio" name="m9" value="No Aplica"
                /></label>
              </div>
              <span>Atención</span>
              <select>
                <option>NA</option>
                <option value="Inmediata">Inmediata</option>
                <option value="Antes 24 h.">Antes 24 h.</option>
              </select>
            </div>


          </section>

          <section class="equipos-proteccion-personal">
            <h1>EPP</h1>
            <div class="elemento-epp">
              <p>Casco dieléctrico</p>
              <div>
                <label>B<input type="radio" name="e1" value="Bueno" checked /></label>
                <label>M<input type="radio" name="e1" value="Malo" /></label>
                <label
                  >NT<input type="radio" name="e1" value="No Tiene"
                /></label>
                <label
                  >NA<input type="radio" name="e1" value="No Aplica"
                /></label>
              </div>
              <span>Atención</span>
                <select>
                  <option>NA</option>
                  <option value="Inmediata">Inmediata</option>
                  <option value="Antes 24 h.">Antes 24 h.</option>
                </select>
            </div>
            <div class="elemento-epp">
              <p>Chaleco con cintas reflectivas</p>
              <div>
                <label>B<input type="radio" name="e2" value="Bueno" checked /></label>
                <label>M<input type="radio" name="e2" value="Malo" /></label>
                <label
                  >NT<input type="radio" name="e2" value="No Tiene"
                /></label>
                <label
                  >NA<input type="radio" name="e2" value="No Aplica"
                /></label>
              </div>
              <span>Atención</span>
                <select>
                  <option>NA</option>
                  <option value="Inmediata">Inmediata</option>
                  <option value="Antes 24 h.">Antes 24 h.</option>
                </select>
            </div>
            <div class="elemento-epp">
              <p>Guantes de bada</p>
              <div>
                <label>B<input type="radio" name="e3" value="Bueno" checked /></label>
                <label>M<input type="radio" name="e3" value="Malo" /></label>
                <label
                  >NT<input type="radio" name="e3" value="No Tiene"
                /></label>
                <label
                  >NA<input type="radio" name="e3" value="No Aplica"
                /></label>
              </div>
              <span>Atención</span>
                <select>
                  <option>NA</option>
                  <option value="Inmediata">Inmediata</option>
                  <option value="Antes 24 h.">Antes 24 h.</option>
                </select>
            </div>

            <div class="elemento-epp">
              <p>Camisa</p>
              <div>
                <label>B<input type="radio" name="e4" value="Bueno" checked /></label>
                <label>M<input type="radio" name="e4" value="Malo" /></label>
                <label
                  >NT<input type="radio" name="e4" value="No Tiene"
                /></label>
                <label
                  >NA<input type="radio" name="e4" value="No Aplica"
                /></label>
              </div>
              <span>Atención</span>
                <select>
                  <option>NA</option>
                  <option value="Inmediata">Inmediata</option>
                  <option value="Antes 24 h.">Antes 24 h.</option>
                </select>
            </div>

            <div class="elemento-epp">
              <p>Pantalón</p>
              <div>
                <label>B<input type="radio" name="e5" value="Bueno" checked /></label>
                <label>M<input type="radio" name="e5" value="Malo" /></label>
                <label
                  >NT<input type="radio" name="e5" value="No Tiene"
                /></label>
                <label
                  >NA<input type="radio" name="e5" value="No Aplica"
                /></label>
              </div>
              <span>Atención</span>
                <select>
                  <option>NA</option>
                  <option value="Inmediata">Inmediata</option>
                  <option value="Antes 24 h.">Antes 24 h.</option>
                </select>
            </div>

            <div class="elemento-epp">
              <p>Lentes de seguridad transparentes</p>
              <div>
                <label>B<input type="radio" name="e6" value="Bueno" checked /></label>
                <label>M<input type="radio" name="e6" value="Malo" /></label>
                <label
                  >NT<input type="radio" name="e6" value="No Tiene"
                /></label>
                <label
                  >NA<input type="radio" name="e6" value="No Aplica"
                /></label>
              </div>
              <span>Atención</span>
                <select>
                  <option>NA</option>
                  <option value="Inmediata">Inmediata</option>
                  <option value="Antes 24 h.">Antes 24 h.</option>
                </select>
            </div>

            <div class="elemento-epp">
              <p>Lentes de seguridad oscuros</p>
              <div>
                <label>B<input type="radio" name="e7" value="Bueno" checked /></label>
                <label>M<input type="radio" name="e7" value="Malo" /></label>
                <label
                  >NT<input type="radio" name="e7" value="No Tiene"
                /></label>
                <label
                  >NA<input type="radio" name="e7" value="No Aplica"
                /></label>
              </div>
              <span>Atención</span>
                <select>
                  <option>NA</option>
                  <option value="Inmediata">Inmediata</option>
                  <option value="Antes 24 h.">Antes 24 h.</option>
                </select>
            </div>

            <div class="elemento-epp">
              <p>Zapatos dieléctricos</p>
              <div>
                <label>B<input type="radio" name="e8" value="Bueno" checked /></label>
                <label>M<input type="radio" name="e8" value="Malo" /></label>
                <label
                  >NT<input type="radio" name="e8" value="No Tiene"
                /></label>
                <label
                  >NA<input type="radio" name="e8" value="No Aplica"
                /></label>
              </div>
              <span>Atención</span>
                <select>
                  <option>NA</option>
                  <option value="Inmediata">Inmediata</option>
                  <option value="Antes 24 h.">Antes 24 h.</option>
                </select>
            </div>

            <div class="elemento-epp">
              <p>Casco de Protección</p>
              <div>
                <label>B<input type="radio" name="e9" value="Bueno" /></label>
                <label>M<input type="radio" name="e9" value="Malo" /></label>
                <label
                  >NT<input type="radio" name="e9" value="No Tiene"
                /></label>
                <label
                  >NA<input type="radio" name="e9" value="No Aplica" checked
                /></label>
              </div>
              <span>Atención</span>
                <select>
                  <option>NA</option>
                  <option value="Inmediata">Inmediata</option>
                  <option value="Antes 24 h.">Antes 24 h.</option>
                </select>
            </div>

            <div class="elemento-epp">
              <p>Guantes de Motorizado</p>
              <div>
                <label>B<input type="radio" name="e10" value="Bueno" /></label>
                <label>M<input type="radio" name="e10" value="Malo" /></label>
                <label
                  >NT<input type="radio" name="e10" value="No Tiene"
                /></label>
                <label
                  >NA<input type="radio" name="e10" value="No Aplica" checked
                /></label>
              </div>
              <span>Atención</span>
                <select>
                  <option>NA</option>
                  <option value="Inmediata">Inmediata</option>
                  <option value="Antes 24 h.">Antes 24 h.</option>
                </select>
            </div>

            <div class="elemento-epp">
              <p>Coderas y Rodilleras</p>
              <div>
                <label>B<input type="radio" name="e11" value="Bueno" /></label>
                <label>M<input type="radio" name="e11" value="Malo" /></label>
                <label
                  >NT<input type="radio" name="e11" value="No Tiene"
                /></label>
                <label
                  >NA<input type="radio" name="e11" value="No Aplica" checked
                /></label>
              </div>
              <span>Atención</span>
                <select>
                  <option>NA</option>
                  <option value="Inmediata">Inmediata</option>
                  <option value="Antes 24 h.">Antes 24 h.</option>
                </select>
            </div>
          </section>

          <section class="proteccion-medio-ambiente">
            <h1>Protección al medio ambiente</h1>
            <div class="elemento-pma">
              <p>Kit antiderrame</p>
              <div>
                <label>B<input type="radio" name="p1" value="Bueno" checked /></label>
                <label>M<input type="radio" name="p1" value="Malo" /></label>
                <label
                  >NT<input type="radio" name="p1" value="No Tiene"
                /></label>
                <label
                  >NA<input type="radio" name="p1" value="No Aplica"
                /></label>
              </div>
              <span>Atención</span>
                <select>
                  <option>NA</option>
                  <option value="Inmediata">Inmediata</option>
                  <option value="Antes 24 h.">Antes 24 h.</option>
                </select>
            </div>

            <div class="elemento-pma">
              <p>Recipientes para residuos</p>
              <div>
                <label>B<input type="radio" name="p2" value="Bueno" checked /></label>
                <label>M<input type="radio" name="p2" value="Malo" /></label>
                <label
                  >NT<input type="radio" name="p2" value="No Tiene"
                /></label>
                <label
                  >NA<input type="radio" name="p2" value="No Aplica"
                /></label>
              </div>
              <span>Atención</span>
                <select>
                  <option>NA</option>
                  <option value="Inmediata">Inmediata</option>
                  <option value="Antes 24 h.">Antes 24 h.</option>
                </select>
            </div>

            <div class="elemento-pma">
              <p>Bolsas para residuos</p>
              <div>
                <label>B<input type="radio" name="p3" value="Bueno" checked /></label>
                <label>M<input type="radio" name="p3" value="Malo" /></label>
                <label
                  >NT<input type="radio" name="p3" value="No Tiene"
                /></label>
                <label
                  >NA<input type="radio" name="p3" value="No Aplica"
                /></label>
              </div>
              <span>Atención</span>
                <select>
                  <option>NA</option>
                  <option value="Inmediata">Inmediata</option>
                  <option value="Antes 24 h.">Antes 24 h.</option>
                </select>
            </div>
          </section>

          <section class="botiquin">
            <h1>Botiquín de primeros auxilios</h1>
            <div class="elemento-botiquin">
              <p>*Alcohol de 70° de 500 ml</p>
                <label>Fecha de vencimiento: <input type="date" class="vencimiento-elemento-botiquin"></label>
              <div>
                <label>B<input type="radio" name="bo1" value="Bueno" checked /></label>
                <label>M<input type="radio" name="bo1" value="Malo" /></label>
                <label
                  >NT<input type="radio" name="bo1" value="No Tiene"
                /></label>
                <label
                  >NA<input type="radio" name="bo1" value="No Aplica"
                /></label>
              </div>
              <span>Atención</span>
                <select>
                  <option>NA</option>
                  <option value="Inmediata">Inmediata</option>
                  <option value="Antes 24 h.">Antes 24 h.</option>
                </select>
            </div>

            <div class="elemento-botiquin">
              <p>*Jabón antiséptico</p>
                <label>Fecha de vencimiento: <input type="date" class="vencimiento-elemento-botiquin"></label>
              <div>
                <label>B<input type="radio" name="bo2" value="Bueno" checked /></label>
                <label>M<input type="radio" name="bo2" value="Malo" /></label>
                <label
                  >NT<input type="radio" name="bo2" value="No Tiene"
                /></label>
                <label
                  >NA<input type="radio" name="bo2" value="No Aplica"
                /></label>
              </div>
              <span>Atención</span>
                <select>
                  <option>NA</option>
                  <option value="Inmediata">Inmediata</option>
                  <option value="Antes 24 h.">Antes 24 h.</option>
                </select>
            </div>

            <div class="elemento-botiquin">
              <p>*Gasas esterilizadas fraccionadas de 1m x 10cm</p>
                <label>Fecha de vencimiento: <input type="date" class="vencimiento-elemento-botiquin"></label>
              <div>
                <label>B<input type="radio" name="bo3" value="Bueno" checked /></label>
                <label>M<input type="radio" name="bo3" value="Malo" /></label>
                <label
                  >NT<input type="radio" name="bo3" value="No Tiene"
                /></label>
                <label
                  >NA<input type="radio" name="bo3" value="No Aplica"
                /></label>
              </div>
              <span>Atención</span>
                <select>
                  <option>NA</option>
                  <option value="Inmediata">Inmediata</option>
                  <option value="Antes 24 h.">Antes 24 h.</option>
                </select>
            </div>

            <div class="elemento-botiquin">
              <p>*Apósito Esterilizado 10x10 cm</p>
                <label>Fecha de vencimiento: <input type="date" class="vencimiento-elemento-botiquin"></label>
              <div>
                <label>B<input type="radio" name="bo4" value="Bueno" checked /></label>
                <label>M<input type="radio" name="bo4" value="Malo" /></label>
                <label
                  >NT<input type="radio" name="bo4" value="No Tiene"
                /></label>
                <label
                  >NA<input type="radio" name="bo4" value="No Aplica"
                /></label>
              </div>
              <span>Atención</span>
                <select>
                  <option>NA</option>
                  <option value="Inmediata">Inmediata</option>
                  <option value="Antes 24 h.">Antes 24 h.</option>
                </select>
            </div>

            <div class="elemento-botiquin">
              <p>*Esparadrapo hipoalérgico 2.5 cm x 5m</p>
                <label>Fecha de vencimiento: <input type="date" class="vencimiento-elemento-botiquin"></label>
              <div>
                <label>B<input type="radio" name="bo5" value="Bueno" checked /></label>
                <label>M<input type="radio" name="bo5" value="Malo" /></label>
                <label
                  >NT<input type="radio" name="bo5" value="No Tiene"
                /></label>
                <label
                  >NA<input type="radio" name="bo5" value="No Aplica"
                /></label>
              </div>
              <span>Atención</span>
                <select>
                  <option>NA</option>
                  <option value="Inmediata">Inmediata</option>
                  <option value="Antes 24 h.">Antes 24 h.</option>
                </select>
            </div>

            <div class="elemento-botiquin">
              <p>*Venda elástica 4 pulg x 5 yardas</p>
                <label>Fecha de vencimiento: <input type="date" class="vencimiento-elemento-botiquin"></label>
              <div>
                <label>B<input type="radio" name="bo6" value="Bueno" checked /></label>
                <label>M<input type="radio" name="bo6" value="Malo" /></label>
                <label
                  >NT<input type="radio" name="bo6" value="No Tiene"
                /></label>
                <label
                  >NA<input type="radio" name="bo6" value="No Aplica"
                /></label>
              </div>
              <span>Atención</span>
                <select>
                  <option>NA</option>
                  <option value="Inmediata">Inmediata</option>
                  <option value="Antes 24 h.">Antes 24 h.</option>
                </select>
            </div>

            <div class="elemento-botiquin">
              <p>*Bandas adhesivas (curitas)</p>
                <label>Fecha de vencimiento: <input type="date" class="vencimiento-elemento-botiquin"></label>
              <div>
                <label>B<input type="radio" name="bo7" value="Bueno" checked /></label>
                <label>M<input type="radio" name="bo7" value="Malo" /></label>
                <label
                  >NT<input type="radio" name="bo7" value="No Tiene"
                /></label>
                <label
                  >NA<input type="radio" name="bo7" value="No Aplica"
                /></label>
              </div>
              <span>Atención</span>
                <select>
                  <option>NA</option>
                  <option value="Inmediata">Inmediata</option>
                  <option value="Antes 24 h.">Antes 24 h.</option>
                </select>
            </div>

            <div class="elemento-botiquin">
              <p>Tijeras punta roma de 3 pulgadas</p>
                <label class="fecha-inutilizable">Fecha de vencimiento: <input type="date"></label>
              <div>
                <label>B<input type="radio" name="bo8" value="Bueno" checked /></label>
                <label>M<input type="radio" name="bo8" value="Malo" /></label>
                <label
                  >NT<input type="radio" name="bo8" value="No Tiene"
                /></label>
                <label
                  >NA<input type="radio" name="bo8" value="No Aplica"
                /></label>
              </div>
              <span>Atención</span>
                <select>
                  <option>NA</option>
                  <option value="Inmediata">Inmediata</option>
                  <option value="Antes 24 h.">Antes 24 h.</option>
                </select>
            </div>

            <div class="elemento-botiquin">
              <p>*Guantes quirúrjicos esterilizados 7 1/2 (pares)</p>
                <label>Fecha de vencimiento: <input type="date" class="vencimiento-elemento-botiquin"></label>
              <div>
                <label>B<input type="radio" name="bo9" value="Bueno" checked /></label>
                <label>M<input type="radio" name="bo9" value="Malo" /></label>
                <label
                  >NT<input type="radio" name="bo9" value="No Tiene"
                /></label>
                <label
                  >NA<input type="radio" name="bo9" value="No Aplica"
                /></label>
              </div>
              <span>Atención</span>
                <select>
                  <option>NA</option>
                  <option value="Inmediata">Inmediata</option>
                  <option value="Antes 24 h.">Antes 24 h.</option>
                </select>
            </div>

            <div class="elemento-botiquin">
              <p>*Algodón x 50 gr</p>
                <label>Fecha de vencimiento: <input type="date" class="vencimiento-elemento-botiquin"></label>
              <div>
                <label>B<input type="radio" name="bo10" value="Bueno" checked /></label>
                <label>M<input type="radio" name="bo10" value="Malo" /></label>
                <label
                  >NT<input type="radio" name="bo10" value="No Tiene"
                /></label>
                <label
                  >NA<input type="radio" name="bo10" value="No Aplica"
                /></label>
              </div>
              <span>Atención</span>
                <select>
                  <option>NA</option>
                  <option value="Inmediata">Inmediata</option>
                  <option value="Antes 24 h.">Antes 24 h.</option>
                </select>
            </div>

            <div class="elemento-botiquin">
              <p>*Flamodil o Hirudoid (golpes, hematomas)</p>
                <label>Fecha de vencimiento: <input type="date" class="vencimiento-elemento-botiquin"></label>
              <div>
                <label>B<input type="radio" name="bo11" value="Bueno" checked /></label>
                <label>M<input type="radio" name="bo11" value="Malo" /></label>
                <label
                  >NT<input type="radio" name="bo11" value="No Tiene"
                /></label>
                <label
                  >NA<input type="radio" name="bo11" value="No Aplica"
                /></label>
              </div>
              <span>Atención</span>
                <select>
                  <option>NA</option>
                  <option value="Inmediata">Inmediata</option>
                  <option value="Antes 24 h.">Antes 24 h.</option>
                </select>
            </div>

            <div class="elemento-botiquin">
              <p>*Apositos de Jelonet 10 x 10 cm</p>
                <label>Fecha de vencimiento: <input type="date" class="vencimiento-elemento-botiquin"></label>
              <div>
                <label>B<input type="radio" name="bo12" value="Bueno" checked /></label>
                <label>M<input type="radio" name="bo12" value="Malo" /></label>
                <label
                  >NT<input type="radio" name="bo12" value="No Tiene"
                /></label>
                <label
                  >NA<input type="radio" name="bo12" value="No Aplica"
                /></label>
              </div>
              <span>Atención</span>
                <select>
                  <option>NA</option>
                  <option value="Inmediata">Inmediata</option>
                  <option value="Antes 24 h.">Antes 24 h.</option>
                </select>
            </div>

            <div class="elemento-botiquin">
              <p>Tablillas de madera 30x5x1 cm</p>
                <label class="fecha-inutilizable">Fecha de vencimiento: <input type="date"></label>
              <div>
                <label>B<input type="radio" name="bo13" value="Bueno" checked /></label>
                <label>M<input type="radio" name="bo13" value="Malo" /></label>
                <label
                  >NT<input type="radio" name="bo13" value="No Tiene"
                /></label>
                <label
                  >NA<input type="radio" name="bo13" value="No Aplica"
                /></label>
              </div>
              <span>Atención</span>
                <select>
                  <option>NA</option>
                  <option value="Inmediata">Inmediata</option>
                  <option value="Antes 24 h.">Antes 24 h.</option>
                </select>
            </div>

            <div class="elemento-botiquin">
              <p>Tablillas de madera 70x5x1 cm</p>
                <label class="fecha-inutilizable">Fecha de vencimiento: <input type="date"></label>
              <div>
                <label>B<input type="radio" name="bo14" value="Bueno" checked /></label>
                <label>M<input type="radio" name="bo14" value="Malo" /></label>
                <label
                  >NT<input type="radio" name="bo14" value="No Tiene"
                /></label>
                <label
                  >NA<input type="radio" name="bo14" value="No Aplica"
                /></label>
              </div>
              <span>Atención</span>
                <select>
                  <option>NA</option>
                  <option value="Inmediata">Inmediata</option>
                  <option value="Antes 24 h.">Antes 24 h.</option>
                </select>
            </div>

            <div class="elemento-botiquin">
              <p>*Agua estéril x 1/2 litro</p>
                <label>Fecha de vencimiento: <input type="date" class="vencimiento-elemento-botiquin"></label>
              <div>
                <label>B<input type="radio" name="bo15" value="Bueno" checked /></label>
                <label>M<input type="radio" name="bo15" value="Malo" /></label>
                <label
                  >NT<input type="radio" name="bo5" value="No Tiene"
                /></label>
                <label
                  >NA<input type="radio" name="bo15" value="No Aplica"
                /></label>
              </div>
              <span>Atención</span>
                <select>
                  <option>NA</option>
                  <option value="Inmediata">Inmediata</option>
                  <option value="Antes 24 h.">Antes 24 h.</option>
                </select>
            </div>
            <div id="seccion-modificar">
              <button id="btn-modificar-fechas">Modificar Fechas</button>
            </div>
          </section>

          <section class="section-evaluacion-conductor">
            <h3>Evaluación al conductor</h3>

            <table class="table-checkbox">
              <thead>
                <th>Opciones para la evaluación</th>
                <th>SI</th>
                <th>NO</th>
              </thead>
              <tbody>
                <td></td>
                <td><img class="image-checkbox" src="../recursos/checkbox_checked.jpg" alt="checkbox_marcado"></td>
                <td><img class="image-checkbox" src="../recursos/checkbox_clean.jpg" alt="checkbox_vacio"></td>
              </tbody>
            </table>

            <div class="evaluacion-conductor">
              <label for="ev-conductor1">1. Estoy consciente de la responsabilidad que significa conducir, sin poner en riesgo mi vida y la de mis pasajeros</label>
              <input type="checkbox" id="ev-conductor1">
            </div>
            
            <div class="evaluacion-conductor">
              <label for="ev-conductor2">2. Me siento en buena condición física y emocional para poder conducir de manera segura</label>
              <input type="checkbox" id="ev-conductor2">
            </div>
          </section>

          <section class="contenedor-observaciones">
            <p>Observaciones</p>
            <textarea
              name="Observaciones"
              id="observaciones"
              cols="30"
              rows="10"
            ></textarea>
          </section>
        </div>
      </section>
      <div id="btnGenerar"><i class="fa-solid fa-file-pdf fa-lg"></i></div>
    </main>
    <script src="../scripts/functionsInspeccion2.js"></script>
    <script type="module" src="../scripts/control_tiempo.js"></script>
  </body>
</html>
