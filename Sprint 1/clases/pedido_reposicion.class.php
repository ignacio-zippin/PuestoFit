<?php

class pedido_reposicion {

    private $cod_pedido;
    private $fecha;
    private $sucursal;
    private $estado;
    
   
    //Constructor 

    public function __construct($cod_pedido,$fecha,$sucursal,$estado){
        
        $this -> cod_pedido =$cod_pedido;
        $this -> fecha =$fecha;
        $this -> sucursal = $sucursal;
        $this -> estado =$estado;

       
    }
    //Getters
    public function obtener_cod_pedido() {
        return $this -> cod_pedido;
    }

    public function obtener_fecha() {
        return $this -> fecha;
    }

    public function obtener_sucursal() {
        return $this -> sucursal;
    }
    
    public function obtener_estado() {
        return $this -> estado;
    }
    
    //Setters
    public function cambiar_estado($estado){  
        $this -> estado=$estado;
    }
   
    
}
