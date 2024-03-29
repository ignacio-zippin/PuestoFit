<!DOCTYPE html>
<?php
    include_once '../config.inc.php';
    include_once '../conexion.class.php';
    include_once '../pantallas/barra_nav.php';
    include_once '../clases/escritor_ventas.class.php';
    include_once '../clases/repositorio_ventas.class.php';
    include_once '../clases/repositorio_movimientos_stock.class.php';
 
    Conexion::abrirConexion();


    if(isset($_POST['anular'])){ 

        repositorio_ventas::actualizar_estado_anulada(Conexion::obtenerConexion(),$_POST['anular']);
        $tipo = 'Entrada';
        $motivo = 'Venta anulada';
        $observaciones = repositorio_ventas::obtener_observaciones(Conexion::obtenerConexion(),$_POST['anular']);
        $cod_mov = repositorio_movimientos_stock::obtener_cod_mov(Conexion::obtenerConexion(),$_POST['anular']);
        repositorio_movimientos_stock::insertar_movimiento_stock_validado(Conexion::obtenerConexion(),$tipo, $motivo, 
                                      $observaciones, $cod_mov);
        repositorio_movimientos_stock::actualizar_stock_deposito_mov($cod_mov,$tipo);
    }

?>
<html>

  <head>
    <title>Ventas por Depósito</title>

  <!--  CSS -->
    <link rel="stylesheet" type="text/css" href="/puestofit/css/compras_principal.css">
    <link rel="stylesheet" type="text/css" href="/puestofit/css/header.css">
  <!---->

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

  <!--Tabla con bootstrap-->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <!---->
  </head>
  

  <body>
    <!-- BODY -->
    <!---BARRA DE BUSQUEDA-->
        <!--Se mete dentro de un form para poder usar el metodo post-->
    <form role="form" method="post" action="<?php  echo $_SERVER['PHP_SELF'] ?>">
      <div class="form-group"> 
        <p id="busqueda">
          <input type="text" class="form-control" id="searchBox" name="criterio" placeholder="BUSCAR"/>
          <!--El button se hace de type = "submit" para que pueda trasladar datos-->
          <button type="submit" name="busqueda" id="buscar" class="boton_buscar"><i class="fa fa-search"></i></button>
        </p>
      </div>
    </form>
    <!---->
    <!-- GRILLA -->
    <div class="table-responsive-lg">
      <table id="grilla" class="table-hover table table-bordered" >
        <thead class="thead-dark">
          <tr colspan="7">
            <div class="titulo_grilla"><h4>VENTAS</h4></div>
          </tr>
          <tr>
            <th>Nº de Venta</th>
            <th>Sucursal</th>
            <th>Cliente</th>
            <th>Fecha</th> 
            <th>Total</th>
            <th>DETALLE</th>
            <th>ANULAR</th> 
          </tr> 
        </thead>
        <tbody>
        <?php

        if(isset($_POST['busqueda'])){//si entra en el if quiere decir que la pagina se cargo por la busqueda

          $criterio= $_POST['criterio'];
          
          escritor_ventas::escribir_filas_filtradas_ventas($criterio);
          
        }else{//si entra por else quiere decir que la pagina cargo desde la barra de navegacion

          escritor_ventas::escribir_ventas(Conexion::obtenerConexion());
          
        } 
        
        
        ?>
      <!-- AGRRGAR ACA FUNCIONES PHP -->
        </tbody>
      </table>
    </div>
    <!---->
    <div class="contenedor3">
      <form method ="post" action= "<?php  echo ruta_registrar_detalle_venta  ?>">
        <br>
        <a href="<?php  echo ruta_registrar_detalle_venta ?>"><button type="submit" name="reg_venta" id="rv" class="boton"><i class="fa fa-plus" aria-hidden="true"></i>   REGISTRAR VENTAS</button></a>                      
      </form>
    </div>
  </body>
</html>