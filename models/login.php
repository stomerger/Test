<?php 

namespace Model;


class Login extends activerecord{


    protected static $columnaDB = ['id','correo','password'];

    public $id;
    public $correo;
    public $password;


    public function __construct( $args = [])
    {
        $this->id = $args['id'] ?? null; 
        $this->correo = $args['correo'] ?? '';  
        $this->password = $args['password'] ?? '';  

    }
    public function validar(){
        
        //codigo para validar formulario
        
        if(!$this->correo) {
            self::$errores[] = "El Email del usuario es obligatorio";
        }
        if(!$this->password) {
            self::$errores[] = "El Password del usuario es obligatorio";
        }
        return self::$errores;
       

    }

    public function comprobarPassword($resultado) {
        $usuario = $resultado->fetch_object();

       if($this -> resultado = password_verify ( $this->password , $usuario ->password ) ){
           
        header('location: /admin');
       }
       else  {
        self::$errores[] = 'El Password es Incorrecto';
        return;
       }
       
    }

    public function autenticar() {
        // El usuario esta autenticado
        session_start();
        $_SESSION['usuario'] = $this->correo;
         $_SESSION['login'] = true;

        // Llenar el arreglo de la sesión
      header('location: /admin');

       
   }

   public function existeUsuario() {
    // Revisar si el usuario existe.
    $query = "SELECT * FROM " . self::$tabla . " WHERE correo = '" . $this->correo . "' LIMIT 1";
    $resultado = self::$db->query($query);

    if(!$resultado->num_rows) {
        self::$errores[] = 'El Usuario No Existe';
        return;
    }

    return $resultado;
}

}