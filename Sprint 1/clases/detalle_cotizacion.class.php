<?php

class detalle_cotizacion {

	
    private $cod_det_cotizacion;
    private $cod_cotizacion;
    private $nombre;
    private $marca;
    private $cantidad;
    private $precio_unitario;
    
    //Constructor 

    public function __construct($cod_det_cotizacion,$cod_cotizacion,$nombre,$marca,$cantidad,$precio_unitario){
        $this -> cod_det_cotizacion =$cod_det_cotizacion;
        $this -> cod_cotizacion =$cod_cotizacion;
        $this -> nombre =$nombre;
        $this -> marca =$marca;
        $this -> cantidad =$cantidad;
        $this -> precio_unitario =$precio_unitario;
    }
    //Getters
    public function obtener_cod_det_cotizacion() {
        return $this -> cod_det_cotizacion;
    }
    public function obtener_cod_cotizacion() {
        return $this -> cod_cotizacion;
    }

    public function obtener_nombre() {
        return $this -> nombre;
    }
    
    public function obtener_marca() {
        return $this -> marca;
    }
    
    public function obtener_cantidad() {
        return $this -> cantidad;
    }
    public function obtener_precio_unitario() {
        return $this -> precio_unitario;
    }
    
    //Setters
    public function cambiar_nombre($nombre){  
        $this -> nombre=$nombre;
    }
    public function cambiar_cantidad($cantidad){  
        $this -> cantidad=$cantidad;
    }
    public function cambiar_marca($marca){  
        $this -> observaciones=$observaciones;
    }
    public function cambiar_precio_unitario($precio_unitario){  
        $this -> precio_unitario=$precio_unitario;
    }
}



?>