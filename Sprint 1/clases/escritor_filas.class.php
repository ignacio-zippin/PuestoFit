<?php

include_once '../clases/inventario.class.php';
include_once '../conexion.class.php';
include_once '../clases/repositorio_inventario.class.php';
include_once '../config.inc.php';
include_once '../clases/repositorio_proveedores.class.php';
include_once '../clases/proveedores.class.php';
include_once '../clases/repositorio_cotizacion.class.php';



class escritor_filas{
    

//----------------------------------------------------Inventario--------------------------------------------------------

    public static function escribir_filas(){
        
        $filas = repositorio_inventario::obtener_inventario(Conexion::obtenerConexion());
        
        if(count($filas)){

            foreach($filas as $fila){

                self::escribir_fila($fila);
            
            }

            }            else{
            //$_SESSION['pedido']=0;
        }
    }
    
    public static function escribir_filas_filtradas($criterio){
        
        $filas = repositorio_inventario::obtener_inventario_filtrado(Conexion::obtenerConexion(),$criterio);
        
        if(count($filas)){

            foreach($filas as $fila){
            
                self::escribir_fila($fila);
            
            }

            }            else{
            //$_SESSION['pedido']=0;
        }
    }

    public static function escribir_fila($fila){
        if(!isset($fila)){

            return;
        }
        ?>
    <tr>

            <td class="text-center"> <?php echo $fila ->obtener_cod_prod() ?>  </td>
            <td class="text-center"> <?php echo $fila ->obtener_nombre() ?>  </td>
            <td class="text-center"> <?php echo $fila ->obtener_existencia() ?>  </td>
            <td class="text-center"> <?php echo $fila ->obtener_marca() ?>  </td>
            <td class="text-center"> <?php echo $fila ->obtener_categoria() ?>  </td>
            <td class="text-center"> <?php echo $fila ->obtener_precio_compra()." $" ?>  </td>
            <td class="text-center"> <?php echo $fila ->obtener_precio_venta(). " $" ?>  </td>
            <td>
                <form method="post" action="<?php echo ruta_detalle_producto ?>">
                    <button type="submit" style="background-color:light-gray; padding:8% ; font-size: 14px; border-radius:2px;" class="btn btn-default btn-dark" id="ver_detalle" name="ver_detalle" value="<?php echo $fila->obtener_cod_prod(); ?>" >Detalle</button>
                </form>
            </td>
            <td>
                <form method="post" action="<?php echo ruta_modificar_producto ?>">
                    <button type="submit" style="background-color:light-gray; padding:9% ; font-size: 14px; border-radius:2px;" class="btn btn-default btn-dark" id="editar" name="editar" value="<?php echo $fila->obtener_cod_prod(); ?>" widht= 5%>Editar</button>
                </form>
            </td>
            <td>
                <form method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>">
                    <button type="submit" style="background-color:rgba(177, 60, 30, 0.9);padding:8% ; font-size: 14px; border-radius:2px;" class="btn btn-default btn-dark" id="eliminar" name="eliminar" value="<?php echo $fila->obtener_cod_prod(); ?>" widht= 3%>Eliminar</button>
                </form>
            </td>

    </tr>
<?php
        }

//-------------------------------------------------------Proveedores---------------------------------------------------


   public static function escribir_filas_proveedores(){
        
        $filas = repositorio_proveedores::obtener_proveedores(Conexion::obtenerConexion());
        
        if(count($filas)){

            foreach($filas as $fila){
                self::escribir_fila_proveedores($fila);
            }

            }            else{
         }
        }

    public static function escribir_filas_filtradas_proveedores($criterio){
        
            $filas = repositorio_proveedores::obtener_proveedores_filtrado(Conexion::obtenerConexion(),$criterio);
            
            if(count($filas)){
    
                foreach($filas as $fila){
                
                    self::escribir_fila_proveedores($fila);
                
                }
    
                }            else{
                //$_SESSION['pedido']=0;
            }
        }
    
    public static function escribir_fila_proveedores($fila){
        if(!isset($fila)){

            return;
        }
        ?>
    <tr>
            <td class="text-center"> <?php echo $fila ->obtener_cod_prov() ?>  </td>
            <td class="text-center"> <?php echo $fila ->obtener_nombre() ?>  </td>
            <td class="text-center"> <?php echo $fila ->obtener_CUIL() ?>  </td>
            <td class="text-center"> <?php echo $fila ->obtener_direccion() ?>  </td>
            <td class="text-center"> <?php echo $fila ->obtener_telefono() ?>  </td>
            <td class="text-center"> <?php echo $fila ->obtener_email() ?>  </td>
            <td>
                <form method="post" action="<?php echo ruta_modificar_proveedor ?>">
                    <button type="submit"  style="background-color:light-gray; padding:6% ; font-size: 14px; border-radius:2px;" class="btn btn-default btn-dark" id="editar" name="editar" value="<?php echo $fila->obtener_cod_prov(); ?>" widht= 5%>Editar</button>
                </form>
            </td>
            <td>
                <form method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>">
                    <button type="submit"  style="background-color:rgba(177, 60, 30, 0.9);padding:4% ; font-size: 14px; border-radius:2px;" class="btn btn-default btn-dark" id="eliminar" name="eliminar" value="<?php echo $fila->obtener_cod_prov(); ?>" widht= 5%>Eliminar</button>
                </form>
            </td>
    </tr>
<?php
        }

        public static function escribir_lista_proveedores(){


            $proveedores = repositorio_proveedores::obtener_proveedores(Conexion::obtenerConexion());
                
            if(count($proveedores)){
        
                foreach($proveedores as $proveedor){
                    
                    self::escribir_proveedor($proveedor);
                    
                    }
                }
            else{
                print 'to';
            }
            }
            
    public static function escribir_proveedor($proveedor){
            if(!isset($proveedor)){

                    return;
                }

        ?>
            <option value="<?php echo $proveedor-> obtener_nombre() ?>"> <?php echo $proveedor-> obtener_nombre() ?> </option>
        <?php        
            }

//------------------------------------------------------Pedidos Reposicion---------------------------------------------

        public static function escribir_detalles_pedido($id){

            $filas = repositorio_pedido_reposicion::obtener_detalles(Conexion::obtenerConexion(),$id);

            if(count($filas)){
                
                foreach($filas as $fila){

                    self::escribir_detalle_pedido($fila);
                }
    
                }    

            }

            public static function escribir_detalle_pedido($fila){
                if(!isset($fila)){

                    return;
                }

                ?>
            <tr>
                    <td class="text-center"> <?php echo $fila ->obtener_nombre() ?>  </td>
                    <td class="text-center"> <?php echo $fila ->obtener_marca() ?>  </td>
                    <td class="text-center"> <?php echo $fila ->obtener_cantidad() ?>  </td>
                    <td class="text-center"> <?php echo $fila ->obtener_observaciones() ?>  </td>
                    <td>
                        <form method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>">
                            <button type="submit" style="background-color:light-gray; padding:9% ; font-size: 14px; border-radius:2px;" class="btn btn-default btn-dark" id="eliminar" name="eliminar" value="<?php echo $fila->obtener_cod_det_pedido(); ?>" widht= 5%>Eliminar</button>
                        </form>
                    </td>
            </tr>
        <?php
                }

                public static function escribir_filas_agregar_producto(){
        
                    $filas = repositorio_inventario::obtener_inventario_pedido(Conexion::obtenerConexion());
                    
                    if(count($filas)){
            
                        foreach($filas as $fila){
                        
                            self::escribir_fila_agregar_producto($fila);
                        
                        }
            
                        }            else{
                        //$_SESSION['pedido']=0;
                    }
                }
                
                public static function escribir_filas_filtradas_producto($criterio){
        
                    $filas = repositorio_inventario::obtener_inventario_filtrado_producto(Conexion::obtenerConexion(),$criterio);
                    
                    if(count($filas)){
            
                        foreach($filas as $fila){
                        
                            self::escribir_fila_agregar_producto($fila);
                        
                        }
            
                        }            else{
                        //$_SESSION['pedido']=0;
                    }
                }
                public static function escribir_fila_agregar_producto($fila){
                    if(!isset($fila)){
            
                        return;
                    }
                    ?>
                <tr>
            
                        <td class="text-center"> <?php echo $fila ->obtener_cod_prod() ?>  </td>
                        <td class="text-center"> <?php echo $fila ->obtener_nombre() ?>  </td>
                        <td class="text-center"> <?php echo $fila ->obtener_marca() ?>  </td>
                        <td class="text-center"> <?php echo $fila ->obtener_categoria() ?>  </td>
                        <td class="text-center"> <?php echo $fila ->obtener_precio_compra()." $" ?>  </td>
                        <td>
                            <form method="post" action="<?php echo ruta_registrar_pedido_reposicion ?>">

                                <button type="submit" style="background-color:light-gray; padding:8% ; font-size: 14px; border-radius:2px;" class="btn btn-default btn-dark" id="ver_detalle" name="agregar" value="<?php echo $fila->obtener_nombre(); ?>" >Agregar</button>
                                <input type="hidden" name="marca"  id="marca" value="<?php echo $fila -> obtener_marca() ;?>">

                            </form>
                        </td>
            
                </tr>
            <?php
                    }
/* AHORA HAY DOS ESCRIBIR PEDIDO_REPOSICION */
/* EL QUE ES PARA SELECCIONAR EN COTIZACIONES */
                public static function escribir_pedidos(){
        
                        $filas = repositorio_pedido_reposicion::obtener_pedidos(Conexion::obtenerConexion());
                        
                        if(count($filas)){
                
                            foreach($filas as $fila){
                                self::escribir_pedido($fila);
                            }
                
                            }            
            
                        }
            
                public static function escribir_pedido($fila){
                            if(!isset($fila)){
                    
                                return;
                            }
                            ?>
                        <tr>
                                <td class="text-center"> <?php echo $fila ->obtener_cod_pedido() ?>  </td>
                                <td class="text-center"> <?php echo $fila ->obtener_fecha() ?>  </td>
                                <td> <?php

                                    $sucursal= repositorio_pedido_reposicion::obtener_sucursal(Conexion::obtenerConexion(),$fila ->obtener_sucursal());
                                    echo $sucursal;

                                ?>
                                </td> 

                                <td>
                                    <form method="post" action="<?php echo ruta_cotizaciones_emitir; ?>">
                                        <button type="submit" style="background-color:light-gray; padding:2% ; font-size: 14px; border-radius:2px;" class="btn btn-default btn-dark" id="ver_detalle" name="seleccionar" value="<?php echo $fila->obtener_cod_pedido(); ?>" >Seleccionar</button>
                                        <input type="hidden" name="sucursal2"  id="sucursal" value="<?php echo $sucursal ;?>">
                                    </form> 
                                </td>
                        </tr>
                    <?php
                        }
                    
                

/* EL QUE ES PARA MOSTRAR EN PEDIDOS_REPOSICION_PRINCIPAL */

                public static function escribir_pedidos_principal(){
                        
                    $filas = repositorio_pedido_reposicion::obtener_pedidos(Conexion::obtenerConexion());
                    
                    if(count($filas)){

                        foreach($filas as $fila){
                            self::escribir_pedido_principal($fila);
                        }

                        }            

                    }

                public static function escribir_pedido_principal($fila){
                        if(!isset($fila)){

                            return;
                        }
                        ?>
                    <tr>
                            <td class="text-center"> <?php echo $fila ->obtener_cod_pedido() ?>  </td>
                            <td class="text-center"> <?php echo $fila ->obtener_fecha() ?>  </td>
                            <td> 
                                <?php if($fila ->obtener_estado() == 1){
                                
                                    print "Pendiente";

                                }elseif($fila ->obtener_estado() == 2){
                                    
                                    print "Listo";
                            } ?> </td>
                            <td> <?php
                                $sucursal= repositorio_pedido_reposicion::obtener_sucursal(Conexion::obtenerConexion(),$fila ->obtener_sucursal());
                                echo $sucursal;
                                ?>
                            </td>
                            <td>
                                <form method="post" action="<?php echo ruta_detalle_pedidos_reposicion; ?>">
                                    <button type="submit" style="background-color:light-gray; padding:2% ; font-size: 14px; border-radius:2px;" class="btn btn-default btn-dark" id="ver_detalle" name="ver_detalle" value="<?php echo $fila->obtener_cod_pedido(); ?>" >Detalle</button>
                                </form> 
                            </td>
                            <td>
                            <form method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>">
                               <button type="submit" style="background-color:rgba(177, 60, 30, 0.9);padding:2% ; font-size: 14px; border-radius:2px;" class="btn btn-default btn-dark" id="eliminar" name="eliminar" value="<?php echo $fila->obtener_cod_pedido(); ?>" widht= 3%>Eliminar</button>
                            </form>
                            </td>
                    </tr>
                <?php
                    }
/////////////BUSCADOR
                            public static function escribir_filas_filtradas_reposicion($criterio){
                                    
                                $filas = repositorio_pedido_reposicion::obtener_pedidos_filtrados(Conexion::obtenerConexion(),$criterio);
                                
                                if(count($filas)){

                                    foreach($filas as $fila){
                                    
                                        self::escribir_pedido_busqueda($fila);
                                    
                                    }

                                    }            else{
                                    //$_SESSION['pedido']=0;
                                }
                            }
                            public static function escribir_pedido_busqueda($fila){
                                if(!isset($fila)){
        
                                    return;
                                }
                                ?>
                            <tr>
                                    <td class="text-center"> <?php echo $fila ->obtener_cod_pedido() ?>  </td>
                                    <td class="text-center"> <?php echo $fila ->obtener_fecha() ?>  </td>
                                    <td class="text-center"> <?php echo $fila ->obtener_estado() ?>  </td>
                                    <td class="text-center"> <?php echo $fila ->obtener_sucursal() ?>  </td>
                                    <td>
                                        <form method="post" action="<?php echo ruta_detalle_pedidos_reposicion; ?>">
                                            <button type="submit" style="background-color:light-gray; padding:2% ; font-size: 14px; border-radius:2px;" class="btn btn-default btn-dark" id="ver_detalle" name="ver_detalle" value="<?php echo $fila->obtener_cod_pedido(); ?>" >Detalle</button>
                                        </form> 
                                    </td>
                                    <td>
                                    <form method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>">
                                       <button type="submit" style="background-color:rgba(177, 60, 30, 0.9);padding:2% ; font-size: 14px; border-radius:2px;" class="btn btn-default btn-dark" id="eliminar" name="eliminar" value="<?php echo $fila->obtener_cod_pedido(); ?>" widht= 3%>Eliminar</button>
                                    </form>
                                    </td>
                            </tr>
                        <?php
                            }

//////////////////////////////////////////////////DETALLE PEDIDO////////////////////////////////////////////////
public static function escribir_detalles_pedidos_det($id){

    $filas = repositorio_pedido_reposicion::obtener_detalles(Conexion::obtenerConexion(),$id);

    if(count($filas)){
        
        foreach($filas as $fila){

            self::escribir_detalle_pedido_det($fila);
        }

        }    

    }

public static function escribir_detalle_pedido_det($fila){
        if(!isset($fila)){

            return;
        }

        ?>
    <tr>
            <td class="text-center"> <?php echo $fila ->obtener_cod_det_pedido()?>  </td>
            <td class="text-center"> <?php echo $fila ->obtener_nombre() ?>  </td>
            <td class="text-center"> <?php echo $fila ->obtener_marca() ?>  </td>
            <td class="text-center"> <?php echo $fila ->obtener_cantidad() ?>  </td>
            
    </tr>
<?php
        }

        public static function escribir_filas_filtradas_sel_pedido($criterio){
                                    
            $filas = repositorio_pedido_reposicion::obtener_pedidos_filtrados_sel_pedido(Conexion::obtenerConexion(),$criterio);
            
            if(count($filas)){

                foreach($filas as $fila){
                
                    self::escribir_pedido_busqueda_sel_pedido($fila);
                
                }

                }            else{
                //$_SESSION['pedido']=0;
            }
        }
        public static function escribir_pedido_busqueda_sel_pedido($fila){
            if(!isset($fila)){

                return;
            }
            ?>
        <tr>
                <td class="text-center"> <?php echo $fila ->obtener_cod_pedido() ?></td>
                <td class="text-center"> <?php echo $fila ->obtener_fecha() ?></td>
                <td class="text-center"> <?php echo $fila ->obtener_sucursal()?></td>
                <td>
                    <form method="post" action="<?php echo ruta_cotizaciones_emitir; ?>">
                        <button type="submit" style="background-color:light-gray; padding:2% ; font-size: 14px; border-radius:2px;" class="btn btn-default btn-dark" id="seleccionar" name="seleccionar" value="<?php echo $fila->obtener_cod_pedido(); ?>" >Seleccionar</button>
                        <input type="hidden" name="sucursal2"  id="sucursal" value="<?php echo $fila -> obtener_sucursal() ;?>">
                    </form> 
                </td>
        </tr>
    <?php
        }



        

////////////////////////////////////////////////////////////////////////////////////

        public static function escribir_detalles_pedido_cot($id){

                            $filas = repositorio_pedido_reposicion::obtener_detalles(Conexion::obtenerConexion(),$id);
                
                            if(count($filas)){
                                
                                foreach($filas as $fila){
                
                                    self::escribir_detalle_pedido_cot($fila);
                                }
                    
                                }    
                
                            }
                
        public static function escribir_detalle_pedido_cot($fila){
                                if(!isset($fila)){
                
                                    return;
                                }
                
                                ?>
                            <tr>
                                    <td class="text-center" widht= 20%> <?php echo $fila ->obtener_nombre() ?>  </td>
                                    <td class="text-center" widht= 20%> <?php echo $fila ->obtener_marca() ?>  </td>
                                    <td class="text-center" widht= 10%> <?php echo $fila ->obtener_cantidad() ?>  </td>
                                    
                            </tr>
                        <?php
                                }
        
//-----------------------------------------------------------Cotizaciones--------------------------------------------------


        public static function escribir_detalles_cotizacion($id){
        
                $filas = repositorio_cotizacion::obtener_detalles(Conexion::obtenerConexion(),$id);
                    
                if(count($filas)){
            
                    foreach($filas as $fila){
                        self::escribir_detalle_cotizacion($fila);
                     }
            
                    }            
        
                }
        
        public static function escribir_detalle_cotizacion($fila){
                        if(!isset($fila)){
                
                            return;
                        }
                        ?>
                    <tr>
                            <td class="text-center" widht= 20%> <?php echo $fila ->obtener_nombre() ?>  </td>
                            <td class="text-center" widht= 20%> <?php echo $fila ->obtener_marca() ?> </td>
                            <td class="text-center" widht= 10%> <?php echo $fila ->obtener_cantidad() ?>  </td>
                            
                            <td>
                                <form method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>">
                                    <button type="submit" class="btn btn-default btn-dark" style="background-color:light-gray; padding:9% ; font-size: 14px; border-radius:2px;"  id="eliminar" name="eliminar" value="<?php echo $fila->obtener_cod_det_cotizacion(); ?>" width= 5%>Eliminar</button>
                                </form>
                            </td>
                    </tr>
                <?php
                        }
        public static function escribir_cotizaciones(){
        
                            $filas = repositorio_cotizacion::obtener_cotizaciones_enviadas(Conexion::obtenerConexion());
                            
                            if(count($filas)){
                    
                                foreach($filas as $fila){
                                    self::escribir_cotizacion($fila);
                                }
                    
                                }            
                
                            }
                
        public static function escribir_cotizacion($fila){
                if(!isset($fila)){
        
                    return;
                }
                ?>
            <tr>
                    <td class="text-center"> <?php echo $fila ->obtener_cod_cotizacion() ?>  </td>
                    <td class="text-center"> <?php echo $fila ->obtener_cod_pedido() ?>  </td>
                    <td class="text-center"> <?php echo $fila ->obtener_fecha_emision() ?>  </td>
                    <td> <?php
                    if($fila -> obtener_estado()== 1 ){
                            
                            print "-";
                        
                            } elseif($fila -> obtener_estado()==2 || $fila -> obtener_estado()==3){

                                echo $fila -> obtener_fecha_presupuesto();
                            }?>
                    </td>
                    <td class="text-center" id="proveedor"> <?php echo $fila ->obtener_proveedor() ?>  </td>
            

                    <td class="text-center" id="estado"> <?php 

                        if($fila -> obtener_estado()==1){
                            print 'Pendiente';
                        }elseif($fila -> obtener_estado()==2){
                            print 'Listo';
                        }elseif($fila -> obtener_estado()==3){
                            print 'Cargada';
                        }
                    ?>  
                    </td>
                    <td id="sucursal">
                    
                        <?php
                        $sucursal= repositorio_pedido_reposicion::obtener_sucursal(Conexion::obtenerConexion(),$fila ->obtener_sucursal());
                        echo $sucursal;
                    ?>
                    </td>

                    <td><?php 
                        if($fila -> obtener_estado()== 1 ){?>
                            
                        <form method="post" action="<?php echo ruta_cotizaciones_cargar ?>">
                            <button type="submit" style="background-color:light-gray; padding:5% ; font-size: 14px; border-radius:2px;" class="btn btn-default btn-dark" id="cargar" name="cargar" value="<?php echo $fila->obtener_cod_cotizacion(); ?>" widht= 5%>Cargar</button>
                        </form>
                    
                        <?php } elseif($fila -> obtener_estado()==2 || $fila -> obtener_estado()==3){

                            echo "$ ".$fila -> obtener_total();
                        }
                    ?> </td>
                    <td><?php
                        if($fila -> obtener_estado() == 2 || $fila -> obtener_estado() == 3){?>
                        <form method="post" action="<?php echo ruta_cotizaciones_detalle ?>">

                            <button type="submit" style="background-color:light-gray; padding:3% ; font-size: 14px; border-radius:2px;" class="btn btn-default btn-dark" id="ver_detalle" name="ver_detalle" value="<?php echo $fila->obtener_cod_cotizacion(); ?>" widht= 5%>Detalle</button>
                            <input  type="hidden" name="proveedor"  id="proveedor" value="<?php echo $fila -> obtener_proveedor(); ;?>">

                        </form>
                        <?php } elseif ($fila -> obtener_estado() == 1){?>
                            <button type="submit" disabled style="background-color:light-gray; padding:3% ; font-size: 14px; border-radius:2px;" class="btn btn-default btn-dark" id="ver_detalle" name="ver_detalle" value="<?php echo $fila->obtener_cod_cotizacion(); ?>" widht= 5%>Detalle</button>
                        <?php } ?>
                    </td>
                    <td>
                        <form method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>">
                            <button type="submit" style="background-color:rgba(177, 60, 30, 0.9); padding:5% ; font-size: 14px; border-radius:2px;" class="btn btn-default btn-dark" id="eliminar" name="eliminar" value="<?php echo $fila-> obtener_cod_cotizacion(); ?>" widht= 5%>Eliminar</button>
                        </form>
                    </td>


            </tr>
        <?php
                
            }
    


         public static function escribir_cargas_cotizacion($id){
        
            $filas = repositorio_cotizacion::obtener_detalles(Conexion::obtenerConexion(),$id);
            if(count($filas)){
                foreach($filas as $fila){
                    self::escribir_carga_cotizacion($fila);
                    }
        
                }            
    
            }
                        
    public static function escribir_carga_cotizacion($fila){
            if(!isset($fila)){

                return;
            }

            ?>
        <tr>
                <td class="text-center"> <?php echo $fila ->obtener_nombre() ?>  </td>
                <td class="text-center"> <?php echo $fila ->obtener_marca() ?> </td>
                <td class="text-center"> <?php echo $fila ->obtener_cantidad() ?>  </td>

                <form method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>">
                    <td class="text-center">
                        <input type="hidden" name="cod_cotizacion" value="<?php echo $fila -> obtener_cod_cotizacion() ?>">
                        <input class="text-center" type="number" name="precio_unitario" id="precio_unitario" value="<?php 
                        
                            if(isset($_POST['agregar'])){
                                
                                echo $fila -> obtener_precio_unitario();
                                
                            }
                        ?>" <?php if(isset($_POST['agregar']) && ($fila -> obtener_precio_unitario() !== null) ){ print 'readonly'; } ?> >

                            <?php if(isset($_POST['agregar']) && ($fila -> obtener_precio_unitario() !== null) ){

                            }else{ ?>
                        <button type="submit" style="background-color:light-gray; padding:3% ; font-size: 14px; border-radius:2px;" class="btn btn-default btn-dark" id="agregar" name="agregar" value="<?php echo $fila->obtener_cod_det_cotizacion(); ?>" widht= 5% >Agregar</button>
                            <?php } ?>
                    </form> 
                </td>
                <td >
                    <?php
                        if(isset($_POST['agregar'])){
                            
                            $subtotal= $fila -> obtener_cantidad() * $fila -> obtener_precio_unitario();
                            echo $subtotal." $";

                        }else{
                            print "0 $";
                        }


                    ?>         
                </td>
            </tr>
        <?php
            }

        public static function escribir_ver_detalles_cotizacion($id){
        
                                    $filas = repositorio_cotizacion::obtener_detalles(Conexion::obtenerConexion(),$id);
                                    if(count($filas)){
                                        foreach($filas as $fila){
                                            self::escribir_ver_detalle_cotizacion($fila);
                                         }
                                
                                        }            
                            
                                    }
                            
        public static function escribir_ver_detalle_cotizacion($fila){
                                            if(!isset($fila)){

                                                return;
                                            }

                                            ?>
                                        <tr>
                                                <td class="text-center" widht= 20%> <?php echo $fila ->obtener_nombre() ?>  </td>
                                                <td class="text-center" widht= 20%> <?php echo $fila ->obtener_marca() ?> </td>
                                                <td class="text-center" widht= 10%> <?php echo $fila ->obtener_cantidad() ?>  </td>
                                                <td class="text-center" widht= 10%> <?php echo $fila ->obtener_precio_unitario() ?>  </td>
                                                <td>
                                                      <?php      
                                                            $subtotal= $fila -> obtener_cantidad() * $fila -> obtener_precio_unitario();
                                                            echo $subtotal." $";
                                                        ?>
      
                                                </td>
                                            </tr>
                                        <?php
                                            }


        public static function escribir_filas_filtradas_cot($criterio){

            $filas = repositorio_cotizacion::obtener_cotizaciones_filtradas(Conexion::obtenerConexion(),$criterio);
            
            if(count($filas)){

                foreach($filas as $fila){
                
                    self::escribir_cotizacion_filtrada($fila);
                
                }

                }            else{
                //$_SESSION['pedido']=0;
            }
        }
        public static function escribir_cotizacion_filtrada($fila){
            if(!isset($fila)){

                return;
            }
            ?>
        <tr>
                <td class="text-center"> <?php echo $fila ->obtener_cod_cotizacion() ?></td>
                <td class="text-center"> <?php echo $fila ->obtener_cod_pedido() ?></td>
                <td class="text-center"> <?php echo $fila ->obtener_fecha_emision() ?></td>
                <td class="text-center"> 
                    <?php 
                    
                    if($fila -> obtener_estado() == "Pendiente"){
                        print '-';
                    }else{ 
                        echo $fila ->obtener_fecha_presupuesto() ;
                    }
                    ?>
                </td>
                <td class="text-center"> <?php echo $fila ->obtener_proveedor()?></td>
                <td class="text-center"> <?php echo $fila ->obtener_estado()?></td>
                <td class="text-center"> <?php echo $fila ->obtener_sucursal()?></td>
                <td><?php 
                        if($fila -> obtener_estado()== "Pendiente" ){?>
                            
                        <form method="post" action="<?php echo ruta_cotizaciones_cargar ?>">
                            <button type="submit" style="background-color:light-gray; padding:5% ; font-size: 14px; border-radius:2px;" class="btn btn-default btn-dark" id="cargar" name="cargar" value="<?php echo $fila->obtener_cod_cotizacion(); ?>" widht= 5%>Cargar</button>
                        </form>
                    
                        <?php } elseif($fila -> obtener_estado()=="Listo" || $fila -> obtener_estado()=="Cargada"){

                            echo $fila -> obtener_total()." $";
                        }
                    ?> </td>
                <td><?php
                    if($fila -> obtener_estado() == "Listo" || $fila -> obtener_estado() == "Cargada"){?>
                    <form method="post" action="<?php echo ruta_cotizaciones_detalle ?>">

                        <button type="submit" style="background-color:light-gray; padding:3% ; font-size: 14px; border-radius:2px;" class="btn btn-default btn-dark" id="ver_detalle" name="ver_detalle" value="<?php echo $fila->obtener_cod_cotizacion(); ?>" widht= 5%>Detalle</button>
                        <input  type="hidden" name="proveedor"  id="proveedor" value="<?php echo $fila -> obtener_proveedor(); ;?>">

                    </form>
                    <?php } elseif ($fila -> obtener_estado() == "Pendiente"){?>
                        <button type="submit" disabled style="background-color:light-gray; padding:3% ; font-size: 14px; border-radius:2px;" class="btn btn-default btn-dark" id="ver_detalle" name="ver_detalle" value="<?php echo $fila->obtener_cod_cotizacion(); ?>" widht= 5%>Detalle</button>
                    <?php } ?>
                </td>
                <td>
                    <form method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>">
                        <button type="submit" style="background-color:rgba(177, 60, 30, 0.9); padding:5% ; font-size: 14px; border-radius:2px;" class="btn btn-default btn-dark" id="eliminar" name="eliminar" value="<?php echo $fila-> obtener_cod_cotizacion(); ?>" widht= 5%>Eliminar</button>
                    </form>
                </td>
        </tr>
    <?php
        }
                                            
        
}    
?>




