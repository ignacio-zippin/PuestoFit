<?php 
    
    include_once '../conexion.class.php';
    include_once 'detalle_pedido.class.php'; 
    include_once 'cotizaciones.class.php';
    include_once 'repositorio_pedido_reposicion.class.php';

    class repositorio_cotizacion{
        
        public static function insertar_detalle_cotizacion($conexion,$cod_cotizacion,$nombre,$marca,$cantidad){
        
            $detalle_insertado = false;
          
        if (isset($conexion)){
            try{
                $sql = "insert into detalle_cotizacion (cod_cotizacion,nombre,marca,cantidad) values
                 (:cod_cotizacion,:nombre,:marca,:cantidad)";
                
                $cod_cotizaciontemp = $cod_cotizacion;
                $nombretemp = $nombre;
                $marcatemp = $marca;
                $cantidadtemp = $cantidad;
                

                $sentencia = $conexion ->prepare($sql);

                
                $sentencia -> bindParam(':cod_cotizacion', $cod_cotizaciontemp, PDO::PARAM_STR);
                $sentencia -> bindParam(':nombre', $nombretemp, PDO::PARAM_STR);
                $sentencia -> bindParam(':marca', $marcatemp, PDO::PARAM_STR);
                $sentencia -> bindParam(':cantidad', $cantidadtemp, PDO::PARAM_STR);

                
            $detalle_insertado = $sentencia -> execute();
                
            } catch(PDOException $ex){
                print 'ERROR INSCo' . $ex -> getMessage();
            }
            
            return $detalle_insertado;
        }
        else{
            echo 'No hubo conexion en detalle pedido!!';
        }
        
    }
    public static function obtener_sucursal($conexion,$cod_deposito){
        if (isset($conexion)){
            $sucursal = 0;
            try{
                $sql= 'select nombre from depositos where cod_deposito='.$cod_deposito;
                
                $sentencia = $conexion ->prepare($sql);
                
                $sentencia -> execute();
                
                $resultado = $sentencia -> fetchColumn() ;
                
                $sucursal = strval($resultado);
                    

                
            }catch(PDOException $ex){
                print 'ERROR UID' . $ex -> getMessage();
            }
        }else{ echo 'no';}
        
        return $sucursal;
    }
    
    public static function obtener_ultimo_id($conexion){        
        if (isset($conexion)){
            $id = 0;
            try{
                $sql= 'select  MAX(cod_cotizacion) from cotizaciones';
                
                $sentencia = $conexion ->prepare($sql);
                
                $sentencia -> execute();
                
                $resultado = $sentencia -> fetchColumn() ;
                
                $id = intval($resultado);
                    

                
            }catch(PDOException $ex){
                print 'ERROR UID' . $ex -> getMessage();
            }
        }else{ echo 'no';}
        
        return $id;
    }

    public static function insertar_cotizacion($conexion,$cotizacion){
        $cotizacion_insertada = false;
        
        if (isset($conexion)){
            try{

                $sql = "insert into cotizaciones (fecha_emision,estado,sucursal) values
                 (NOW(),0,1)";
                
                $cod_cotizaciontemp = $cotizacion -> obtener_cod_cotizacion();
                
                
                $sentencia = $conexion ->prepare($sql);

                
                $sentencia -> bindParam(':cod_cotizacion', $cod_cotizaciontemp, PDO::PARAM_STR);
                
                
                
                $cotizacion_insertada = $sentencia -> execute();
                
            } catch(PDOException $ex){
                print 'ERROR INSCo' . $ex -> getMessage();
            }
            
            return $cotizacion_insertada;
        }
        else{
            echo 'No hubo conexion en cotizacion!!';
        }
        
    }

    public static function estado_cotizacion($conexion,$cod_cotizacion){
        
        $cotizacion_actualizada = false;
        
        if (isset($conexion)){
            try{
                $sql = 'update cotizaciones set estado = 1 WHERE cod_cotizacion =' . $cod_cotizacion;
                
                
                
                $sentencia = $conexion ->prepare($sql);
                
                
                
                $cotizacion_actualizada = $sentencia -> execute();
                
            } catch(PDOException $ex){
                print 'ERROR INSCo' . $ex -> getMessage();
            }
            
            return $cotizacion_actualizada;
        }
        else{
            echo 'No hubo conexion en detalle pedido!!';
        }
        
    }
    public static function estado_cotizacion_cargada($conexion,$cod_cotizacion){
        
        $cotizacion_actualizada = false;
        
        if (isset($conexion)){
            try{
                $sql = 'update cotizaciones set estado = 3 WHERE cod_cotizacion =' . $cod_cotizacion;
                
                
                
                $sentencia = $conexion ->prepare($sql);
                
                
                
                $cotizacion_actualizada = $sentencia -> execute();
                
            } catch(PDOException $ex){
                print 'ERROR INSCo' . $ex -> getMessage();
            }
            
            return $cotizacion_actualizada;
        }
        else{
            echo 'No hubo conexion en detalle pedido!!';
        }
        
    }
    public static function fecha_cotizacion_cargada ($conexion,$cod_cotizacion){
        
        $cotizacion_actualizada = false;
        
        if (isset($conexion)){
            try{
                $sql = 'update cotizaciones set fecha_presupuesto = NOW() WHERE cod_cotizacion =' . $cod_cotizacion;
                
                
                
                $sentencia = $conexion ->prepare($sql);
                
                
                
                $cotizacion_actualizada = $sentencia -> execute();
                
            } catch(PDOException $ex){
                print 'ERROR INSCo' . $ex -> getMessage();
            }
            
            return $cotizacion_actualizada;
        }
        else{
            echo 'No hubo conexion en detalle pedido!!';
        }
        
    }
    public static function total_cotizacion_cargada ($conexion,$cod_cotizacion, $total){
        
        $cotizacion_actualizada = false;
        
        if (isset($conexion)){
            try{
                $sql = 'update cotizaciones set total = :total WHERE cod_cotizacion =' . $cod_cotizacion;
                
                $totaltemp = $total;
                
                $sentencia = $conexion ->prepare($sql);
                
                $sentencia -> bindParam(':total', $totaltemp, PDO::PARAM_STR);
                
                $cotizacion_actualizada = $sentencia -> execute();
                
            } catch(PDOException $ex){
                print 'ERROR INSCo' . $ex -> getMessage();
            }
            
            return $cotizacion_actualizada;
        }
        else{
            echo 'No hubo conexion en detalle pedido!!';
        }
        
    }

    public static function proveedor_cotizacion($conexion,$cod_cotizacion,$proveedor){
        
        $cotizacion_actualizada = false;
        
        if (isset($conexion)){
            try{
                $sql = 'update cotizaciones set proveedor = :proveedor WHERE cod_cotizacion =' . $cod_cotizacion;
                
                $proveedortemp = $proveedor; //-> obtener_proveedor();
                
                $sentencia = $conexion ->prepare($sql);
                
                $sentencia -> bindParam(':proveedor', $proveedortemp, PDO::PARAM_STR);
                
                $cotizacion_actualizada = $sentencia -> execute();
                
            } catch(PDOException $ex){
                print 'ERROR INSCo' . $ex -> getMessage();
            }
            
            return $cotizacion_actualizada;
        }
        else{
            echo 'No hubo conexion en detalle pedido!!';
        }
        
    }

    public static function pedido_cotizacion($conexion,$cod_cotizacion,$cod_pedido){
        
        $cotizacion_actualizada = false;
        
        if (isset($conexion)){
            try{
                $sql = 'update cotizaciones set cod_pedido = :codpedido WHERE cod_cotizacion =' . $cod_cotizacion;
                
                $codpedidotemp = $cod_pedido; 
                
                $sentencia = $conexion ->prepare($sql);
                
                $sentencia -> bindParam(':codpedido', $codpedidotemp, PDO::PARAM_STR);
                
                $cotizacion_actualizada = $sentencia -> execute();
                
            } catch(PDOException $ex){
                print 'ERROR INSCo' . $ex -> getMessage();
            }
            
            return $cotizacion_actualizada;
        }
        else{
            echo 'No hubo conexion en detalle pedido!!';
        }
        
    }
    public static function obtener_detalles($conexion,$id){
        
        $filas = [];
        $id_str=strval($id);

        if (isset($conexion)){
        
            try{
                $sql= 'select * from detalle_cotizacion where cod_cotizacion='.$id_str;
                
                $sentencia = $conexion ->prepare($sql);
                
                $sentencia -> execute();
                
                $resultado = $sentencia -> fetchAll();
                
                if(count($resultado)){
                    foreach($resultado as $fila){
                        $filas[] = new detalle_cotizacion($fila['cod_det_cotizacion'],$fila['cod_cotizacion'],
                                    $fila['nombre'], $fila['marca'], $fila['cantidad'], $fila['precio_unitario']);
                 }
            }
            }catch(PDOException $ex){
        print 'ERROR OT' . $ex -> getMessage();
        }
        }else{ echo 'No hay conexion :(';}

        return $filas;
        }

    public static function obtener_cotizaciones_enviadas($conexion){
        
        $filas = [];
        

        if (isset($conexion)){
        
            try{
                $sql= 'select * from cotizaciones where estado!=0';
                
                $sentencia = $conexion ->prepare($sql);
                
                $sentencia -> execute();
                
                $resultado = $sentencia -> fetchAll();
                
                if(count($resultado)){
                    foreach($resultado as $fila){
                        $filas[] = new cotizaciones($fila['cod_cotizacion'],$fila['cod_pedido'],$fila['fecha_emision'],
                                    $fila['fecha_presupuesto'], $fila['proveedor'], $fila['total'], 
                                    $fila['estado'],$fila['sucursal']);
                 }
            }
            }catch(PDOException $ex){
        print 'ERROR OT' . $ex -> getMessage();
    }
    }else{ echo 'No hay conexion :(';}

    return $filas;
    }

public static function precio_unitario($conexion,$cod_det,$precio){

        $cotizacion_actualizada = false;
        
        if (isset($conexion)){
            try{
                $sql = 'update detalle_cotizacion set precio_unitario = :precio WHERE cod_det_cotizacion =' . $cod_det;
                
                $preciotemp = $precio; 
                
                $sentencia = $conexion ->prepare($sql);
                
                $sentencia -> bindParam(':precio', $preciotemp);
                
                $cotizacion_actualizada = $sentencia -> execute();
                
            } catch(PDOException $ex){
                print 'ERROR INSCo' . $ex -> getMessage();
            }
            
            return $cotizacion_actualizada;
        }
        else{
            echo 'No hubo conexion en detalle pedido!!';
        }
        
    }
    

public static function eliminar_falsos($conexion){
        if (isset($conexion)){
        
            try{
                $sql= 'delete from cotizaciones where estado = 0';
                
                $sentencia = $conexion ->prepare($sql);
                
                $sentencia -> execute();
                    
                print 'se ha borrado con exito!';}
 
            catch(PDOException $ex){
                print 'ERROR OT' . $ex -> getMessage();
            }
        }
     }

public static function cargar_detalles($cod_pedido, $cod_cotizacion){

        $filas = repositorio_pedido_reposicion::obtener_detalles(Conexion::obtenerConexion(),$cod_pedido);

        if(count($filas)){

            foreach($filas as $fila){

               // $detalle = new detalle_cotizacion($fila['cod_det_cotizacion'], $fila['cod_cotizacion'], $fila['nombre'],
                                    //  $fila['marca'], $fila['cantidad']);
                $marca=$fila -> obtener_marca();
                $nombre = $fila -> obtener_nombre();
                $cantidad = $fila -> obtener_cantidad();
                self::insertar_detalle_cotizacion( Conexion :: obtenerConexion(),$cod_cotizacion,$nombre,$marca,$cantidad); 

                }

            }

}
    
public static function calcular_precios($cod_cotizacion){
        
                $detalles = self :: obtener_detalles(Conexion::obtenerConexion(),$cod_cotizacion);
                $total=0;
                if(count($detalles)){
        
                    foreach($detalles as $detalle){
                        
                        //$precio = self::calcular_precio($detalle);
                        $subtotal = $detalle -> obtener_precio_unitario() * $detalle -> obtener_cantidad();
                        $total= $total + $subtotal;
                    }
        
                    }
                return $total;
                
            }
public static function eliminar_cotizacion($conexion,$cod_cotizacion){
                if (isset($conexion)){
 
                    try{
                        $sql= 'delete from cotizaciones where cod_cotizacion=' . $cod_cotizacion;
                        
                        $sentencia = $conexion ->prepare($sql);
                        
                        $sentencia -> execute();
                            
                       // print 'se ha borrado con exito!';
                    }
         
                    catch(PDOException $ex){
                        print 'ERROR OT' . $ex -> getMessage();
                    }
                }
            }
public static function obtener_cotizaciones_filtradas($conexion,$criterio){

    $filas = [];
    $criterio_min=strtolower($criterio);
    
    if (isset($conexion)){

        try{
            $sql= 'select * from grilla_cotizaciones where (cod_cotizacion LIKE "%'.$criterio_min. '%" OR 
                    fecha_emision LIKE "%'. $criterio_min. '%" OR sucursal LIKE "%'  .$criterio_min. '%" OR
                    fecha_presupuesto LIKE "%'  .$criterio_min. '%" OR proveedor LIKE "%'  .$criterio_min. '%"OR 
                    total LIKE "%'  .$criterio_min. '%" OR estado LIKE "%'  .$criterio_min. '%" OR 
                    cod_pedido LIKE "%'  .$criterio_min. '%")
                    and (sucursal="santa ana")';
            
            $sentencia = $conexion ->prepare($sql);
            
            $sentencia -> execute();
            
            $resultado = $sentencia -> fetchAll();
            
            if(count($resultado)){
                foreach($resultado as $fila){
                    $filas[] = new cotizaciones($fila['cod_cotizacion'],$fila['cod_pedido'], $fila['fecha_emision'], $fila['fecha_presupuesto'],
                                                $fila['proveedor'], $fila['total'], $fila['estado'], $fila['sucursal']);
                }
            }

            
        }catch(PDOException $ex){
            print 'ERROR OT' . $ex -> getMessage();
        }
    }else{ echo 'No hay conexion :(';}
    
    return $filas;
}

public static function obtener_cotizaciones_filtrados_sel($conexion,$criterio){
        
    $filas = [];
    $criterio_min=strtolower($criterio);
    
    if (isset($conexion)){

        try{
            $sql= 'select * from grilla_cotizaciones_seleccionar where (cod_cotizacion LIKE "%'.$criterio_min. '%" OR 
                    fecha_emision LIKE "%'. $criterio_min. '%" OR fecha_presupuesto LIKE "%'  .$criterio_min. '%" OR
                    sucursal LIKE "%'  .$criterio_min. '%" OR proveedor LIKE "%'  .$criterio_min. '%"OR 
                    total LIKE "%'  .$criterio_min. '%") and (estado="Cargada")
                    and (sucursal="santa ana") and (total is not null)';
            
            $sentencia = $conexion ->prepare($sql);
            
            $sentencia -> execute();
            
            $resultado = $sentencia -> fetchAll();
            
            if(count($resultado)){
                foreach($resultado as $fila){
                    $filas[] = new cotizaciones($fila['cod_cotizacion'],$fila['cod_pedido'], $fila['fecha_emision'], $fila['fecha_presupuesto'],
                                                $fila['proveedor'], $fila['total'], null, $fila['sucursal']);
                }
            }

            
        }catch(PDOException $ex){
            print 'ERROR OT' . $ex -> getMessage();
        }
    }else{ echo 'No hay conexion :(';}
    
    return $filas;
}

public static function actualizar_estado_listo($conexion,$cod_cotizacion){
        
    $cotizacion_actualizada = false;
    
    if (isset($conexion)){
        try{

            $sql = 'update cotizaciones set estado = 2 WHERE cod_cotizacion =' . $cod_cotizacion;
            
            $sentencia = $conexion ->prepare($sql);
            
            $cotizacion_actualizada = $sentencia -> execute();
            
        } catch(PDOException $ex){
            print 'ERROR INSCo' . $ex -> getMessage();
        }
        
        return $cotizacion_actualizada;
    }
    else{
        echo 'No hay conexion!!';
    }
    
}
public static function obtener_cotizaciones_enviadas_sel($conexion){
        
    $filas = [];
    

    if (isset($conexion)){
    
        try{
            $sql= 'select * from cotizaciones where estado=3';
            
            $sentencia = $conexion ->prepare($sql);
            
            $sentencia -> execute();
            
            $resultado = $sentencia -> fetchAll();
            
            if(count($resultado)){
                foreach($resultado as $fila){
                    $filas[] = new cotizaciones($fila['cod_cotizacion'],$fila['cod_pedido'],$fila['fecha_emision'],
                                $fila['fecha_presupuesto'], $fila['proveedor'], $fila['total'], 
                                $fila['estado'],$fila['sucursal']);
             }
        }
        }catch(PDOException $ex){
    print 'ERROR OT' . $ex -> getMessage();
}
}else{ echo 'No hay conexion :(';}

return $filas;
}
}