<?php

namespace Model;

class activerecord{

    protected static $db;
    protected static $tabla = 'usuario';
    protected static $columnaDB = [];
    //errores
    protected static $errores = [];

    public static function setDB($database) {
        self::$db =$database;
    }
    public function validar(){
        
        //codigo para validar formulario
        static::$errores=[];
        return self::$errores;
       
    }
    public static function getErrores(){
        return static::$errores;
       
    }

    public static function all (){
        $query = "SELECT * FROM ". static::$tabla;
        
      $resultado =  self::consultarsql($query);

        return $resultado;
        
    }
    public static function consultarsql ($query) {

        //consultar la db
        $resultado = self::$db->query($query);

        //iterar resultado

        $array = [];
        while($registro = $resultado -> fetch_assoc () ){

            $array[] = static::crearObjeto($registro);

        }
        
        //liberar memoria 

        $resultado -> free();


        //retornar

        return $array;
    } 
    protected static function crearObjeto ($registro){
        $objeto = new static;

        foreach ($registro as $key => $value ){
            
            if(property_exists( $objeto, $key )){
                $objeto -> $key = $value;
            }
        }
        return $objeto;
    }
    //limitar el numero de registro

    public static function get ($cantidad){
        $query = "SELECT * FROM ". static::$tabla . " LIMIT " . $cantidad;
        
      $resultado =  self::consultarsql($query);

        return $resultado;
        
    }
    //buscar una propiedad por su id

    public static function find($id) {

        $query = "SELECT * FROM " . static::$tabla . " WHERE id = ${id}";

        $resultado = self::consultarsql($query);
      
       return array_shift($resultado);
    }
    
    public function sanitizarEntradas(){
        $atributos = $this-> atributos();
        $sanitizando =[];
        //recorremos el arreglo como un arreglo asocioativo
        foreach($atributos as $key => $value){

            $sanitizando[$key] = self::$db->escape_string ($value);
        }
        return $sanitizando;
        
    }

       //formatear lo cual identifica y une los atributes de la db
       public function atributos(){
        $atributos =[];

        foreach (static::$columnaDB as $columna ){
            //ignoramos el id 
            if ($columna === 'id')continue;
            $atributos [$columna] = $this->$columna;
        }
        return $atributos;

    }

    public function guardar() {
        //revisa si hay un objeto en memoria
        if(!is_null($this -> id )){
            $this -> actualizar();
        }else {
            $this-> crear();
        }
    }

    public function crear(){
        //sanatizar entradas
        $atributos = $this-> sanitizarEntradas();
        $atributos['password'] = password_hash($atributos['password'], PASSWORD_DEFAULT);

        $query = " INSERT INTO ". static::$tabla . " ( ";
        $query .= join (', ', array_keys($atributos));
        $query .= " ) VALUES ('";
        $query .= join("', '", array_values($atributos));
        $query .= "') ";

       $resultado = self::$db->query($query);
        if ($resultado) {
            //redirecionar el usario

            header('Location:/admin?resultado=1');
        }
    }
    public function actualizar (){
        //sanatizar
        $atributos = $this-> sanitizarEntradas();
        $atributos['password'] = password_hash($atributos['password'], PASSWORD_DEFAULT);

        $valores= [];
        foreach ($atributos as $key => $value){
            //llenar el arreglo
            $valores[] = "{$key} = '{$value}'";
        }
        $query = "UPDATE ". static::$tabla  ." SET ";
        $query .=  join(', ', $valores );
        $query .= " WHERE id = '" .self::$db->escape_string($this->id) . "' ";
        $query .= " LIMIT 1 "; 

        $resultado = self::$db->query($query);

    
     
        if($resultado) {
            // Redireccionar al usuario.
            header('Location: /admin?resultado=2');
        }
    }

    //eliminar un registro

    public function eliminar(){
     
        $query = "DELETE FROM ". static::$tabla . " WHERE id = " . self::$db->escape_string($this->id). " LIMIT 1";
        $resultado = self::$db->query($query);

        if($resultado) {
            // Redireccionar al usuario.
            header('Location: /admin?resultado=3');
        }
    }

        //sincronizar el objeto en memoria con los cambios realizados por el usario
    public function sincronizar($args=[]){

        foreach($args as $key => $value) {
            if(property_exists($this, $key) && !is_null($value)) {
              $this->$key = $value;
            }
        }
    }

      
}