<?php
namespace Controllers;
use MVC\Router;
use Model\Admin;

class NewAdminController
{
    public static function crear(Router $routerr)
    {
        $Admin = new Admin;
        $errores = Admin::getErrores();

        if($_SERVER['REQUEST_METHOD'] === 'POST') 
        {
            //crea una nueva instancia
            $Admin = new Admin($_POST);
    
            //validar
            $errores = $Admin->validar();
    
            //Revisar que el array de errores este vacia
            if(empty($errores))
            {
                //GUARDAR EN LA BASE DE DATOS
                 $Admin->guardar();
            }
        }

        
       $routerr->render('NewAdmin/crear',
       [ 'Admin' => $Admin,
         'errores' => $errores ] );
    }

    //Aqui faltaba agregar actualizar,eliminar
}