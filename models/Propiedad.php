<?php

namespace Model;

class Propiedad extends ActiveRecord
{
   
   protected static $tabla = 'propiedades';
   protected static $columnasDB = ['id','titulo','precio','imagen','descripcion','habitaciones','wc','estacionamiento','creado','vendedores_id'];
    
   public $id;
   public $titulo;
   public $precio;
   public $imagen;
   public $descripcion;
   public $habitaciones;
   public $wc;
   public $estacionamiento;
   public $creado;
   public $vendedores_id;

   public function __construct($args = [])
   {
       $this->id = $args['id'] ?? '';
       $this->titulo = $args['titulo'] ?? '';
       $this->precio = $args['precio'] ?? '';
       $this->imagen = $args['imagen'] ?? '';
       $this->descripcion = $args['descripcion'] ?? '';
       $this->habitaciones = $args['habitaciones'] ?? '';
       $this->wc = $args['wc'] ?? '';
       $this->estacionamiento = $args['estacionamiento'] ?? '';
       $this->creado = date('Y/m/d');
       $this->vendedores_id = $args['vendedores_id'] ?? '';
   }


   public function validar()
     {
         if(strlen($this->titulo) < 5 || strlen($this->titulo) > 20) {
             self::$errores[] = "Debes añadir un titulo entre 5 y 20 letras";
         }
         if(!$this->precio) {
             self::$errores[] = "Debes añadir un precio";
         }
         if ( strlen($this->descripcion) < 200 || strlen($this->descripcion) > 7000) {
             self::$errores[] = "Debes añadir una descripcion con al menos 200 caracteres, maximo 7000 caracteres";
         }
         if(!$this->habitaciones) {
             self::$errores[] = "Debes añadir cantidada de habitaciones";
         }
         if(!$this->wc) {
             self::$errores[] = "Debes añadir cantidada de baños";
         }
         if(!$this->estacionamiento) {
             self::$errores[] = "Debes añadir cantidad de estacionamientos";
         }
         if(!$this->vendedores_id) {
             self::$errores[] = "Debes seleccionar un vendedor";
         }
 
         //imagenes
          if(!$this->imagen) {
              self::$errores[] = "La imagenn es obligatoria";
          }
 
         return self::$errores;
     }

}

