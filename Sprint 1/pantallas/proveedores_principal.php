<!DOCTYPE html>
<?php
include_once '../config.inc.php';
include_once '../clases/escritor_filas.class.php';
include_once '../conexion.class.php';
include_once '../clases/repositorio_proveedores.class.php';
include_once '../pantallas/barra_nav.php';

Conexion::abrirConexion();

if (isset($_POST['guardar_cambios'])) {



  $cambio = repositorio_proveedores::actualizar_proveedores(
    Conexion::obtenerConexion(),
    $_POST['id'],
    $_POST['cuil'],
    $_POST['nombre'],
    $_POST['direccion'],
    $_POST['telefono'],
    $_POST['email']
  );
  


  //Conexion :: cerrarConexion();
} 
?>
<html>

<head>
  <title>Proveedores</title>

  <!--  CSS -->
  <link rel="stylesheet" type="text/css" href="/puestofit/css/compras_principal.css">
  <link rel="stylesheet" type="text/css" href="/puestofit/css/header.css">
  <!---->

  <link href='https://fonts.googleapis.com/css?family='Actor'' rel='stylesheet'>
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
  <form role="form" method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>">
    <div class="form-group">
      <p id="busqueda">
        <input type="text" class="form-control" id="searchBox" name="criterio" placeholder="BUSCAR" />
        <!--El button se hace de type = "submit" para que pueda trasladar datos-->
        <button type="submit" name="busqueda" id="buscar" class="boton_buscar"><i class="fa fa-search"></i></button>
      </p>
    </div>
  </form>



  <!-- GRILLA -->
  <div class="table-responsive-lg">
    <table id="grilla" class="table-hover table table-bordered">
      <thead class="thead-dark">
        <tr colspan="6">
          <div class="titulo_grilla"><h4>PROVEEDORES</h4></div>
        </tr>
        <tr>
          <th>Cod. Prov</th>
          <th>Nombre</th>
          <th>CUIL</th>
          <th>Dirección</th>
          <th>Teléfono</th>
          <th>Email</th>
          <th>EDITAR</th>
          <th>ELIMINAR</th>
        </tr>
      </thead>
      <tbody>
        <?php
        //Metodo para borrar un elemento de la tabla

        if (isset($_POST['eliminar'])) {

          repositorio_proveedores::eliminar_proveedor(Conexion::obtenerConexion(), $_POST['eliminar']);
        }
        //Metodo para cargar la tabla desde la base
        if (isset($_POST['busqueda'])) { //si entra en el if quiere decir que la pagina se cargo por la busqueda
          $criterio = $_POST['criterio'];
          escritor_filas::escribir_filas_filtradas_proveedores($criterio);
        } else { //si entra por else quiere decir que la pagina cargo desde la barra de navegacion

          escritor_filas::escribir_filas_proveedores();
        }
        ?>
      </tbody>
    </table>
  </div>
  <!---BOTONES VER DETALLE/MODIFICAR-->
  <div class="contenedor3">
    <a href="<?php echo ruta_alta_de_proveedor ?>"><button type="submit" name="rp" id="rp" class="boton"><i class="fa fa-plus" aria-hidden="true"></i> REGISTRAR UN PROVEEDOR</button></a>
  </div>
  <!---->

</body>

</html>