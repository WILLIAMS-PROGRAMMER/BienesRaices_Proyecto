<?php

namespace MVC;

class Router
{
    public $rutasGET = [];
    public $rutasPOST = [];

    public function get($url, $fn)
    {
        $this->rutasGET[$url] = $fn;
    }

    public function post($url, $fn)
    {
        $this->rutasPOST[$url] = $fn;
    }



    public function comprobarRutas()
    {
        session_start();
        $auth = $_SESSION['login'] ?? null;
        $rango = $_SESSION['rango'] ?? null;

        //Arreglo de rutas protegidas
        $rutas_protegidas = ['/admin','/propiedades/crear','/propiedades/actualizar','/vendedores/crear','/vendedores/actualizar','/blogs/crear','/blogs/actualizar'];
        $rutas_protegidas_adminSupremo = ['/NewAdmin/crear','/ListarAdmins'];

        $urlActual = $_SERVER['PATH_INFO'] ?? '/';
        $metodo = $_SERVER['REQUEST_METHOD'];

       if($metodo == 'GET')
       {
           $fn= $this->rutasGET[$urlActual] ?? null;
       }else{
           $fn= $this->rutasPOST[$urlActual] ?? null;
       }

       //proteger las rutas
       if(in_array($urlActual,$rutas_protegidas) && !$auth )
       {
           header('Location: /');
       }
       if(in_array($urlActual,$rutas_protegidas_adminSupremo) && $rango != 1 )
       {
           header('Location: /');
       }
       


       if($fn)
       {
            //la url existe y hay una funcion asociada
          call_user_func($fn,$this);
       } else
       {
          //echo "Pagina 404";
          echo "<h2>Pagina 404</h2>";
       }
    }

    //Muestra una vista
    public function render($view, $datos = [] )
    {
        foreach($datos as $key => $value)
        {       
            $$key = $value;
            //debuguear( $$key);
        }
  
        ob_start();  // Almacenmaineto en memoria durante un momento...
        include __DIR__ . "/views/$view.php";
        $contenido = ob_get_clean();  // Limpia el buffer
        //debuguear( $contenido);
        include __DIR__ . "/views/layout.php";
    }

   
}