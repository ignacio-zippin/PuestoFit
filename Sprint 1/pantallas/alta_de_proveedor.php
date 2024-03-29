<!DOCTYPE html>
<?php
include_once '../conexion.class.php';
include_once '../config.inc.php';
include_once '../clases/proveedores.class.php';
include_once '../clases/repositorio_proveedores.class.php';
include_once '../clases/redireccion.class.php';
include_once '../pantallas/barra_nav.php';

if (isset($_POST['enviar'])) {

    Conexion::abrirConexion();

    $proveedor = new Proveedores('', $_POST['cuil'], $_POST['nombre'], $_POST['direccion'], $_POST['telefono'], $_POST['email']);

    $proveedor_insertado = repositorio_proveedores::insertar_proveedor(Conexion::obtenerConexion(), $proveedor);

    if ($proveedor_insertado) {

        Redireccion::redirigir(ruta_proveedor_principal);
    }

    Conexion::cerrarConexion();
}
?>
<html>

<head>
    <title>Registrar un proveedor</title>
    <link rel="stylesheet" type="text/css" href="/puestofit/css/header.css">
    <link rel="stylesheet" type="text/css" href="/puestofit/css/alta_mod_proveedor.css">
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

    <!--------------------------------------------------------------------------------------------------------------->

    <body>
        <div id="formulario" class="form">
            <form name="formP1" action="" method="post">
                <table class="tabla" border="1px">

                    <tr>
                        <td colspan="4" class="titulo">
                            REGISTRAR UN NUEVO PROVEEDOR
                        </td>
                    </tr>
                    <tr>
                        <td class="titulos">Nombre:</td>
                        <td class="valor">
                            <input type="text" name="nombre" id="nombre">
                        </td>
                    </tr>
                    <tr>
                        <td class="titulos">Cuil:</td>
                        <td class="valor">
                            <input type="text" name="cuil" id="cuil">
                        </td>

                    </tr>
                    <tr>
                        <td class="titulos">Dirección:</td>
                        <td class="valor">
                            <input type="text" name="direccion" id="direccion">
                        </td>


                    </tr>
                    <tr>
                        <td class="titulos">Teléfono:</td>
                        <td class="valor">
                            <input type="tel" name="telefono" id="telefono">
                        </td>

                    </tr>
                    <tr>
                        <td class="titulos" valign="top">Email:</td>
                        <td class="valor">
                            <input type="email" name="email" id="email">
                        </td>
                    </tr>
                    <tr>
                        <td colspan="4" style="text-align:right" class="valor">
                            <button type="submit" name="enviar" id="gd" class="boton">REGISTRAR</button>
                            <button type="refresh" name="limpiar" id="ld" class="boton">LIMPIAR DATOS</button>
                        </td>
                    </tr>
                </table>
            </form>
        </div>
        <div class="contenedor4">
            <a href="<?php echo ruta_proveedor_principal ?>"><button type="submit" name="volver" id="volver">VOLVER</button></a>
        </div>




    </body>

</html>