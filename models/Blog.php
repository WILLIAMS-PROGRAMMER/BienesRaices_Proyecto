<?php

namespace Model;

class Blog extends ActiveRecord
{
   
   protected static $tabla = 'blog';
   protected static $columnasDB = ['id','title','fecha','descripcion','imagen'];
    
   public $id;
   public $title;
   public $fecha;
   public $descripcion;
   public $imagen;

   public function __construct($args = [])
   {
       $this->id = $args['id'] ?? '';
       $this->title = $args['title'] ?? '';
       $this->fecha = date('Y/m/d');
       $this->descripcion = $args['descripcion'] ?? '';
       $this->imagen = $args['imagen'] ?? '';
   }


   public function validar()
     {
         if(strlen($this->title) < 5 || strlen($this->title) > 20) {
             self::$errores[] = "Debes añadir un titulo entre 5 y 20 letras";
         }
         if ( strlen($this->descripcion) < 200 || strlen($this->descripcion) > 7000) {
             self::$errores[] = "Debes añadir una descripcion con al menos 200 caracteres, maximo 7000 caracteres";
         }
         //imagenes
          if(!$this->imagen) {
              self::$errores[] = "La imagenn es obligatoria";
          }
 
         return self::$errores;
     }

}

