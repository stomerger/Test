<?php

namespace Model;

class Registro extends activerecord{

    protected static $columnaDB = ['id','nombre','apellido_m','apellido_p','correo','password','telefono'];

    public $id;
    public $nombre;
    public $apellido_m;
    public $apellido_p;
    public $correo;
    public $password;
    public $telefono;

    public function __construct( $args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->nombre = $args['nombre'] ?? '';  
        $this->apellido_m = $args['apellido_m'] ?? '';  
        $this->apellido_p = $args['apellido_p'] ?? '';  
        $this->correo = $args['correo'] ?? '';  
        $this->password = $args['password'] ?? '';  
        $this->telefono = $args['telefono'] ?? '';  
    }
    public function validar(){
        
        //codigo para validar formulario

     
        if (!$this->nombre){

            self::$errores[]= "ingrese un nombre";
    
          }
          
          if (!$this->apellido_m){
  
              self::$errores[]= "Ingrese el apellido materno";
      
          }
          if (!$this->apellido_p){
  
              self::$errores[]= "ingrese el apellido paterno";
      
          }
          if (!$this->correo){
  
              self::$errores[]= "Ingrese correo";
      
          }
          if (!$this->password){
  
              self::$errores[]= "Ingrese Contraseña";
      
          }
          if (!$this->telefono){
  
              self::$errores[]= "Ingrese telefono";
      
          }

        return self::$errores;
    }
    
}