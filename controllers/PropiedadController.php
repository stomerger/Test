<?php 

namespace Controllers;

use Model\Login;
use MVC\Router;
use Model\Registro;


class PropiedadController  {
    
    public static function index(Router $router) {
        $registrarse = Registro::all();

        // Muestra mensaje condicional
        $resultado = $_GET['resultado'] ?? null;

        $router->render('propiedades/index', [
            'propiedades' => $registrarse,
            'resultado' => $resultado
        ]);
    }

    public static function crear(Router $router) {

        $registrarse = new Registro;
        $errores =Registro::getErrores();

        if($_SERVER['REQUEST_METHOD'] === 'POST'){

            $registrarse = new Registro($_POST);
    
            $errores = $registrarse->validar();
    
            /*validar*/
            if(empty($errores)){ 
                
              $registrarse->guardar();
               header('location: /login');
            }
            
        }
        

        $router->render('propiedades/crear', [
            'errores' => $errores,
            'propiedad' => $registrarse
        
        ]);
    }

    public static function actualizar(Router $router) {

        $id = $_GET['id'];
        $id = filter_var($id,FILTER_VALIDATE_INT);
    
        if(!$id){
            header('Location: /admin');
        }
        $registro = Registro::find($id);
    
        $errores = Registro::getErrores();
    
        if($_SERVER ['REQUEST_METHOD'] === 'POST'){
            $args = $_POST ;
       
    
            $registro ->sincronizar($args); 
          
        
            // Validación
            $errores = $registro->validar();
    
            if(empty($errores)) {
                $registro->guardar();
                header('location: /admin');
            
            }   
        }
       

        $router->render('propiedades/actualizar', [
            'propiedad' => $registro,
            'errores' => $errores
        ]);
    }

    public static function eliminar(Router $router) {

       
           
        if($_SERVER ['REQUEST_METHOD'] === 'POST'){
            $id = $_POST ['id'];
            $id = filter_var($id,FILTER_VALIDATE_INT);

            if($id){

                //eliminar

                $registro = Registro::find($id);

                $registro->eliminar();
            }
        }
        

    }  
    
}
