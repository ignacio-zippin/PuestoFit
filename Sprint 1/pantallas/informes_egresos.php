<!DOCTYPE html>
<?php
include_once '../config.inc.php';
include_once '../conexion.class.php';
include_once '../pantallas/barra_nav.php';
include_once '../clases/repositorio_ventas.class.php';
include_once '../clases/repositorio_factura.class.php';
include_once '../clases/escritor_pago.class.php';
include_once '../clases/repositorio_pago.class.php';
require_once("../phpChart_Lite/phpChart_Lite/conf.php");

Conexion::abrirConexion();

?>

<html>

<head>
    <title>Informes</title>


    <link rel="stylesheet" type="text/css" href="/puestofit/css/header.css">
    <link rel="stylesheet" type="text/css" href="/puestofit/css/compras_principal.css">
    <link href='https://fonts.googleapis.com/css?family=' Actor'' rel='stylesheet'>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

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
    <br>
    <br>
    <div class="table-responsive-lg">
            <table id="grilla" class="table-hover table table-bordered">
                <thead class="thead-dark">
                <tr>
                <div class="titulo_grilla"><h4>EGRESOS</h4></div>
                    <tr>
                        <th>Mes</th>
                        <th>Cantidad de Compras</th>
                        <th>Total de Egresos</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    escritor_pago :: escribir_filas_informe_egresos ();
                    ?> 
                </tbody>
            </table>
        </div>
        <div class="contenedor3">
            <a href="<?php echo ruta_exportar_excel_egresos ?>"><button type="submit" name="reg_factura" id="rf" class="boton">
            <i class="fa fa-print" aria-hidden="true">
            </i> Exportar Excel</button></a>
        </div>
        <br>
        <br>
        <br>
        <div align = "center">
            <h3>Egresos</h3>
        <?php repositorio_pago::obtener_grafica_egresos(Conexion::obtenerConexion()); ?>
        </div>  
        <br>
        <br>
        <br>
    </body>
</html>