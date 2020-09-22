<!DOCTYPE html>
  <?php 
  include_once '../config.inc.php';
  include_once '../conexion.class.php';
  //include_once '../clases/repositorio_pago.class.php';
  //include_once '../clases/escritor_pago.class.php';
  include_once '../clases/redireccion.class.php';
  include_once '../pantallas/barra_nav.php';


  Conexion::abrirConexion();
  if (isset($_POST['ver_detalle'])) {
    $oc_id = $_POST['ver_detalle'];
  }
  ?>
  <html>

  <head>
    <title>Detalle Pagos</title>
    <link rel="stylesheet" type="text/css" href="/puestofit/css/header.css" />
    <link rel="stylesheet" type="text/css" href="/puestofit/css/cotizaciones_cargar.css"/>
    <link href="https://fonts.googleapis.com/css?family=Actor" rel="stylesheet" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
    <!--Tabla con bootstrap-->
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <!---->
  </head>

  <body>

    <div id="formulario" class="form">
      <table class="tabla" border="1px">
        <tr>
          <td colspan="2" class="titulo">DETALLE DE PAGO</td>
        </tr>
        <tr>
          <td class="titulos">Cod. Pago:</td>
          <td class="valor">
            <input type="text" readonly name="id_pago" id="id_pago" value="<?php //echo $_POST['ver_detalle']; ?>">
          </td>
        </tr>
        <tr>
          <td class="titulos">Metodo de pago:</td>
          <td class="valor">
            <input type="text" readonly name="id_met_pago" id="id_met_pago" value="<?php //echo $_POST['ver_detalle']; ?>">
          </td>
        </tr>
        <tr>
          <td colspan="2">
            <!--Grilla de productos para cotizacion-->
            <div class="table-responsive-lg">
              <table class="table-hover table table-bordered grilla">
                <thead class="thead-dark">
                  <tr>
                    <th>Cod.Det.</th>
                    <th>Nombre producto</th>
                    <th>Marca</th>
                    <th>Cantidad</th>
                    <th>Precio unitario</th>
                    <th>Subtotal</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <?php
                    if (isset($_POST['ver_detalle'])) {
                      //escritor_pago::escribir_detalles_pago($_POST['ver_detalle']);
                    } ?>
                  </tr>
                  <tr>
                    <td colspan="5" align="right">
                      <h3>Total</h3>
                    </td>
                    <td align="center">
                      <h3>$ <?php //echo $total; ?> </h3>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </td>
        </tr>
      </table>
    </div>

    <div class="contenedor4">
      <a href="<?php echo ruta_pagos_principal ?>"><button type="submit" name="volver" id="volver">VOLVER</button></a>
    </div>
  </body>

  </html>