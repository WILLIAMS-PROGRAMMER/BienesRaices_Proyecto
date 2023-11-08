<?php
namespace Controllers;
use MVC\Router;
use Model\Blog;
use Intervention\Image\ImageManagerStatic as Image;


class BlogController
{
    public static function crear(Router $routerr)
    {
        $blog = new Blog;
        $errores = Blog::getErrores();

        if($_SERVER['REQUEST_METHOD'] === 'POST') 
        {
            //crea una nueva instancia
            $blog = new Blog($_POST);
    
            //generar un nombre unico
             $nombreImagen = md5(uniqid( rand(),true   )) .".jpg";
    
             //setear la imagen
            // realiza un resize a la imagen con intervention
            if($_FILES['imagen']['tmp_name']) {
                $image = Image::make($_FILES['imagen']['tmp_name'])->fit(800,600);
                $blog ->setImagen($nombreImagen);
            }
           
            //validar
            $errores = $blog->validar();
    
            //Revisar que el array de errores este vacia
            if(empty($errores))
            {
                //CREAR CARPETA
                if(!is_dir(CARPETA_IMAGENES_BLOG)) {
                    mkdir(CARPETA_IMAGENES_BLOG);
                }
    
                //guardar la imagen en el servidor
                $image->save(CARPETA_IMAGENES_BLOG. $nombreImagen);
    
                //GUARDAR EN LA BASE DE DATOS
                 $blog->guardar();
            }
        }

        
       $routerr->render('blogs/crear',
       [ 'blog' => $blog,
         'errores' => $errores ] );
    }


    public static function actualizar(Router $routerr)
    {
       $id = validarOrredireccionar('/admin');
       $blog = Blog::find($id);
       $errores = Blog::getErrores();

       if($_SERVER['REQUEST_METHOD'] === 'POST') {
       
            $args = [];
            $args['title'] = $_POST['title'] ?? null;
            $args['descripcion'] = $_POST['descripcion'] ?? null;
            $args['imagen'] = $_POST['imagen'] ?? null;

            //LA IMAGEN NO SE SINCRONIZA EN sincronizar si es que no se cambia
            $blog->sincronizar($args);

        //validacion
            $errores = $blog->validar();

            //Revisar que el array de errores este vacia
            if(empty($errores))
            {
                $nombreImagen = md5(uniqid( rand(),true   )) .".jpg";
                if($_FILES['imagen']['tmp_name']) {
                    $image = Image::make($_FILES['imagen']['tmp_name'])->fit(800,600);
                    $blog ->setImagen($nombreImagen);
                    //$image->sharpen(100);
                    $image->brightness(10);
                    $image->save(CARPETA_IMAGENES_BLOG.$nombreImagen);
                    
                }
                $blog->guardar();
            }
       
        }
       
       $routerr->render('/blogs/actualizar',[
          'blog' => $blog,
          'errores' => $errores     ]);
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
                      $blog = Blog::find($id);
                      $blog->eliminar();
                }
            
            }
        }

    }

    
}

