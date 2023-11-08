<?php
namespace Controllers;
use MVC\Router;
use Model\Admin;

class LoginController
{
    
    public static function login(Router $routerr)
    {
        $errores = [];

        if($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            
            $auth = new Admin($_POST);

            $errores = $auth->validar();

            if(empty($errores))
            {
                //verificar el email
                $resultado = $auth->existeUsuario();

                //debuguear($resultado);  //retorna null si no existe
                if(!$resultado)
                {
                    //muestra "el usuario no existe"
                    $errores =Admin::getErrores();
                }else
                {
                     //verificar password
                     $autenticado = $auth->comprobarPassword($resultado);

                     if($autenticado)
                     {
                         //autenticar al usuario
                         $auth->autenticar();
                        
                     }else{
                        //password incorrecto
                        $errores =Admin::getErrores();
                     }   

                }
               
            }

        }
      
        $routerr->render('/auth/login',[
           'errores'=>$errores
          ]);
        

    }

    public static function logout(Router $routerr)
    {
        session_start();

        $_SESSION = [];
        
        header('Location: /');
    }

}