<?php 

namespace Controllers;

use MVC\Router;
use Model\login;

class LoginController {
    public static function login( Router $router) {

    $login = new Login();

    $errores = Login::getErrores();

    if ($_SERVER ['REQUEST_METHOD'] === 'POST'){
       
        $login = new Login($_POST);
      
        $errores = $login->validar();

        if (empty ($errores)){

            $resultado =$login -> existeUsuario();
            if ($resultado){
                $login -> comprobarPassword($resultado);

              if($login->resultado) {

                    $login->autenticar();
                 } else {

                     $errores =Login::getErrores();
                 } 


            }else{
                $errores =Login::getErrores();
            }
        }
    }

        $router->render('auth/login', [
            'errores' => $errores
        ]); 
    }

    public static function logout() {
        session_start();
        $_SESSION = [];
        header('Location: /login');
    }
}