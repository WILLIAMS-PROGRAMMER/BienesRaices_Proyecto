<?php
namespace Controllers;

use MVC\Router;
use Model\Propiedad;
use Model\Vendedor;
use Model\Blog;
use Model\Admin;
use Intervention\Image\ImageManagerStatic as Image;


class PropiedadController
{
    public static function index(Router $routerr)
    {
        $propiedades = Propiedad::all();
        $vendedores = Vendedor::all();
        $blogs = Blog::all();
        $NewAdmins = Admin::all();

        $message = $_GET['resultado'] ?? null;

       $routerr->render('propiedades/admin',
       ['propiedades'=>$propiedades,
         'message'=>$message,
         'vendedores' => $vendedores,
         'NewAdmins' => $NewAdmins,
         'blogs' => $blogs   ] );
    }

    public static function crear(Router $routerr)
    {
        $propiedad = new Propiedad;
        $vendedores = Vendedor::all();

        $errores = Propiedad::getErrores();

        if($_SERVER['REQUEST_METHOD'] == 'POST')
        {
                //crea una nueva instancia
            $propiedad = new Propiedad($_POST);

            //generar un nombre unico
            $nombreImagen = md5(uniqid( rand(),true   )) .".jpg";

            //setear la imagen
            // realiza un resize a la imagen con intervention
            if($_FILES['imagen']['tmp_name']) {
                $image = Image::make($_FILES['imagen']['tmp_name'])->fit(800,600);
                $propiedad ->setImagen($nombreImagen);
            }

            //validar
            $errores = $propiedad->validar();

            //Revisar que el array de errores este vacia
            if(empty($errores))
            {
                //CREAR CARPETA
                if(!is_dir(CARPETA_IMAGENES)) {
                    mkdir(CARPETA_IMAGENES);
                }

                //guardar la imagen en el servidor
                $image->save(CARPETA_IMAGENES. $nombreImagen);

                //GUARDAR EN LA BASE DE DATOS
                $propiedad->guardar();
            }
        }
        
       $routerr->render('propiedades/crear',
       [ 'propiedad' => $propiedad,
         'vendedores' => $vendedores,
         'errores' => $errores ] );
    }

    public static function actualizar(Router $routerr)
    {
       $id = validarOrredireccionar('/admin');
       $propiedad = Propiedad::find($id);
       $vendedores = Vendedor::all();
       $errores = Propiedad::getErrores();

       if($_SERVER['REQUEST_METHOD'] === 'POST') {
       
        $args = [];
        $args['titulo'] = $_POST['titulo'] ?? null;
        $args['precio'] = $_POST['precio'] ?? null;
        $args['imagen'] = $_POST['imagen'] ?? null;
        $args['descripcion'] = $_POST['descripcion'] ?? null;
        $args['habitaciones'] = $_POST['habitaciones'] ?? null;
        $args['wc'] = $_POST['wc'] ?? null;
        $args['estacionamiento'] = $_POST['estacionamiento'] ?? null;
        $args['vendedores_id'] = $_POST['vendedores_id'] ?? null;

        //LA IMAGEN NO SE SINCRONIZA EN sincronizar si es que no se cambia
        $propiedad->sincronizar($args);

       //validacion
        $errores = $propiedad->validar();

        //Revisar que el array de errores este vacia
        if(empty($errores))
        {
            $nombreImagen = md5(uniqid( rand(),true   )) .".jpg";
            if($_FILES['imagen']['tmp_name']) {
                $image = Image::make($_FILES['imagen']['tmp_name'])->fit(800,600);
                $propiedad ->setImagen($nombreImagen);
                //$image->sharpen(100);
                $image->brightness(10);
                $image->save(CARPETA_IMAGENES.$nombreImagen);
                
            }
            $propiedad->guardar();
        }
       
       }


       $routerr->render('/propiedades/actualizar',[
          'propiedad' => $propiedad,
          'vendedores' => $vendedores,
          'errores' => $errores 
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
                      $propiedad = Propiedad::find($id);
                      $propiedad->eliminar();
                }
            
            }
        }
    }
}

