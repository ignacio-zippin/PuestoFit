<!DOCTYPE html>
<?php
    include_once '../config.inc.php';
    include_once '../pantallas/barra_nav.php';
    include_once '../conexion.class.php';
    include_once '../clases/escritor_informe_ranking_prod.class.php';
    include_once '../clases/repositorio_ranking_prod.class.php';

    Conexion::abrirConexion();
 
?>
<html>
    <head>
        <title>Informe Ranking Productos</title>

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

        <!--Gráfico de Barras-->
        <script src="../chart.min.js"></script>
    <!---->
    </head>
    <br>
    <br>
    <body>
        <div class="table-responsive-lg">
            <table id="grilla" class="table-hover table table-bordered">
                <thead class="thead-dark">
                    <tr colspan="6">
                        <div class="titulo_grilla"><h4>RANKING DE PRODUCTOS POR VENTA</h4></div>
                    </tr>   
                    <tr>
                        <th>Posición</th>
                        <th>Total Vendidos (Unidades)</th>
                        <th>Total Vendidos ($)</th>
                        <th>Cod. Prod.</th>
                        <th>Nombre</th>
                        <th>Marca</th>
                        <th>Categoría</th>
                        <th>Precio Compra</th>
                        <th>Precio Venta</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        escritor_informe_ranking_prod::escribir_ranking_principal(Conexion::obtenerConexion());
                    ?> 
                </tbody>
            </table>
        </div>
        <br>
        <br>
        <div class="contenedor3">
            <a href="<?php echo ruta_exportar_excel_ranking ?>"><button type="submit" name="reg_factura" id="rf" class="boton">
            <i class="fa fa-print" aria-hidden="true">
            </i> Exportar Excel</button></a>
        </div>
        <br>
        <br>
        <br>
        <div  style= "margin-left: auto; margin-right: auto; width:85%;">
            <canvas id="chart2" height="100"></canvas>
            <script language="javascript">
                var ranking = document.getElementById("chart2");

                
                Chart.defaults.global.defaultFontSize = 15;
                

                var densityData = {
                label: 'Top 10 Cantidad de Unidades Vendidas en el Último Semestre',
                data: [
                        <?php
                            $conexion=Conexion::obtenerConexion();     
                            if (isset($conexion)){
                                try{
                                    $sql= 'select total_unidades from grilla_informes_ranking limit 10';
                                    
                                    $sentencia = $conexion ->prepare($sql);
                                    
                                    $sentencia -> execute();
                                    
                                    $resultado = $sentencia -> fetchAll();
                                    
                                    if(count($resultado)){
                                        foreach($resultado as $fila){
                                            $arrlength = count($fila);
                                            for($x = 0; $x < $arrlength; $x=$x+2) {
                                                echo $fila[$x] . "," ;
                                            }
                                        }
                                    } 
                                }
                                catch(PDOException $ex){
                                        print 'ERROR OT' . $ex -> getMessage();
                                }
                            }else{ echo 'No hay conexion';}
                        ?>
                    ],
                    backgroundColor: [
                        'rgba(0, 99, 132, 0.6)',
                        'rgba(30, 99, 132, 0.6)',
                        'rgba(60, 99, 132, 0.6)',
                        'rgba(90, 99, 132, 0.6)',
                        'rgba(120, 99, 132, 0.6)',
                        'rgba(150, 99, 132, 0.6)',
                        'rgba(180, 99, 132, 0.6)',
                        'rgba(210, 99, 132, 0.6)',
                        'rgba(240, 99, 132, 0.6)'
                    ],
                    borderColor: [
                        'rgba(0, 99, 132, 1)',
                        'rgba(30, 99, 132, 1)',
                        'rgba(60, 99, 132, 1)',
                        'rgba(90, 99, 132, 1)',
                        'rgba(120, 99, 132, 1)',
                        'rgba(150, 99, 132, 1)',
                        'rgba(180, 99, 132, 1)',
                        'rgba(210, 99, 132, 1)',
                        'rgba(240, 99, 132, 1)'
                    ],
                    borderWidth: 2,
                    hoverBorderWidth: 0,
                    
                };

                var barChart = new Chart(ranking, {
                type: 'bar',
                data: {
                    labels: [
                        <?php
                            $conexion=Conexion::obtenerConexion();     
                            if (isset($conexion)){
                                try{
                                    $sql= 'select nombre from grilla_informes_ranking limit 10';
                                    
                                    $sentencia = $conexion ->prepare($sql);
                                    
                                    $sentencia -> execute();
                                    
                                    $resultado = $sentencia -> fetchAll();
                                    
                                    if(count($resultado)){
                                        foreach($resultado as $fila){
                                            $arrlength = count($fila);
                                            for($x = 0; $x < $arrlength; $x=$x+2) {
                                                echo '"'.$fila[$x].'"'. "," ;
                                            }
                                        }
                                    } 
                                }
                                catch(PDOException $ex){
                                        print 'ERROR OT' . $ex -> getMessage();
                                }
                            }else{ echo 'No hay conexion';}
                        ?>
                    ],
                    datasets: [densityData]
                }
                });
            </script>
        </div>
        <br>
        <br>
    </body>
</html>
