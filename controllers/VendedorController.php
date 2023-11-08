<?php
namespace Controllers;
use MVC\Router;
use Model\Propiedad;
use Model\Vendedor;


class VendedorController
{
    public static function crear(Router $routerr)
    {
       $vendedor = new Vendedor();
       $errores = Vendedor::getErrores();

       if($_SERVER['REQUEST_METHOD'] === 'POST') 
       {
           //crea una nueva instancia
           $vendedor = new Vendedor($_POST);
   
           //validar
           $errores = $vendedor->validar();
   
           if(empty($errores))
           {
               $vendedor->guardar();
           }    
       }

       $routerr->render('vendedores/crear',[
        'errores' => $errores,
        'vendedor' => $vendedor
       ]);
    }
    public static function actualizar(Router $routerr)
    {
        $id = validarOrredireccionar('/admin');
        $vendedor = Vendedor::find($id);
        $errores = Vendedor::getErrores();

        if($_SERVER['REQUEST_METHOD'] === 'POST') 
        {
            $args = [];
            $args['nombre'] = $_POST['nombre'] ?? null;
            $args['apellido'] = $_POST['apellido'] ?? null;
            $args['telefono'] = $_POST['telefono'] ?? null;
           
            //LA IMAGEN NO SE SINCRONIZA EN sincronizar si es que no se cambia
            $vendedor->sincronizar($args);
           
           //validacion
            $errores = $vendedor->validar();
    
            //Revisar que el array de errores este vacia
            if(empty($errores))
            {     
              //debuguear($vendedor);
              $vendedor->guardar(); 
            }
        }


        $routerr->render('vendedores/actualizar',[
            'errores' => $errores,
            'vendedor' => $vendedor
           ]);
    }
    public static function eliminar(Router $routerr)
    {
        if($_SERVER['REQUEST_METHOD'] === 'POST')
        {
            //validar id
            $id = $_POST['idd'];
            //comprobar que sea un numero
            $id = filter_var($id,FILTER_VALIDATE_INT);

            if($id) {

                $tipo = $_POST['tipo'];

                if(validarTipoContenido($tipo))
                {
                      //obtener los datos de la propiedad
                      $vendedor = Vendedor::find($id);
                      $vendedor->eliminar();
                }
            
            }
        }
    }
}