<?php
namespace Controllers;
use MVC\Router;
use Model\Admin;

class ListarAdminsController
{
    public static function listaAdmins(Router $routerr)
    {
        $Admins = Admin::all();
      
       $routerr->render('paginas/ListarAdmins',
       [ 'Admins' => $Admins  ] );
    }
}
