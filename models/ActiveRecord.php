<?php

namespace Model;

class ActiveRecord
{
     //base de datos
     protected static $db;
     protected static $columnasDB = [];
     protected static $tabla = '';

     //Errores
     protected static $errores = [];

 
 
     //definir la conexion a la base de datos
     public static function setDB($database)
     {
         //self es para atributos estaticos
         self::$db = $database;
     }
 
    
 
     public function guardar()
     {
         if($this->id)
         {
             $this->actualizar();
         }
         else 
         {
             $this->crear();
         }
     }
 
     public function crear()
     {
         //sanitizar datos
         $atributos = $this->sanitizarDatos();
         
 
          //Insertar en la base de datos
          $query = "INSERT INTO ".static::$tabla." (";
          $query .= join(', ', array_keys($atributos));
          $query .= " ) VALUES ( '";
          $query .= join("', '", array_values($atributos));
          $query .= "'  ) ";
        
         //debuguear($query);
         $resultado = self::$db->query($query);
         //debuguear($resultado);
         //MENSAJE DE EXITO
         if($resultado) {
             //redireccionar al usuario
             header('Location:/admin?resultado=1');
         }
     }
 
     public function actualizar()
     {
         //sanitizar datos
         $atributos = $this->sanitizarDatos();
 
         $valores = [];
         foreach($atributos as $key => $value)
         {
             $valores[] = "{$key}= '{$value}'";
         }
         $query = " UPDATE ". static::$tabla . " SET ";
         $query .= join(', ', $valores );
         $query .=  "WHERE id = '" . self::$db->escape_string($this->id) . "' ";
         
         $resultado = self::$db->query($query);
 
         if($resultado) {
             //redireccionar al usuario
             header('Location:/admin?resultado=2');
           }
     }
 
     public function eliminar()
     {
          //eliminar la propiedad
          $query = " DELETE FROM " . static::$tabla ." WHERE id = " . self::$db->escape_string($this->id);
          $resultado = self::$db->query($query);
          if($resultado) {
             $this->borrarImagen();
             header('location: /admin?resultado=3');
         }
     }
 
 
 
     //identificar y unir los atributos de la base de datos
     public function atributos()
     {
         $atributos = [];
         foreach(static::$columnasDB as $columna)
         {
             if($columna === 'id') continue;
             $atributos[$columna] = $this->$columna;
         }
         return $atributos;
     }


     public function sanitizarDatos()
     {
         $atributos = $this->atributos(); //  SON CAMPOS
         $sanitizado = [];
 
         foreach($atributos as $key => $value)
         {
            if($key == 'password'){
                $sanitizado[$key] = password_hash($value, PASSWORD_DEFAULT);
            }else{
             $sanitizado[$key] = self::$db->escape_string($value); 
            }
         }
 
         return $sanitizado;
     }


     //subida de archivos
     public function setImagen($imagen)
     {
         //ELIMINA LA IMAGEN PREVIA
         if($this->id)
         {
            $this->borrarImagen();
         }
         //asignar al atributo imagen, el nombre de la imagen
         if($imagen)
         {
             $this->imagen = $imagen;
         }
     }
 
     public function borrarImagen()
     {
         $existeArchivo = file_exists(CARPETA_IMAGENES . $this->imagen);
         if($existeArchivo)
         {
             unlink(CARPETA_IMAGENES . $this->imagen);
         }
     }
 
     public static function getErrores()
     {
         return static::$errores;
     }
 
     public function validar()
     {
         return static::$errores;
     }
 
     
 
     //lista todas las propiedades
     public static function all( $limite = 1000 )
     {
         $query = " SELECT * FROM ". static::$tabla ." LIMIT $limite ";

         $result = self::consultarSQL($query);
         
         return $result;  
     }
 
     //busca una propiedad por su id
     public static function find($id)
     {
        //consultar para obtener datos de la propiedad
        $query = "SELECT * FROM  ".static::$tabla." WHERE id = $id";
        $result = self::consultarSQL($query);
        return array_shift($result);
     }

     
 
     public static function consultarSQL($query)
     {
         $resultado = self::$db->query($query);
 
         $array = [];
         while ($registro = $resultado->fetch_assoc())
         {
             $array[] = static::crearObjeto($registro);
         }
 
         $resultado->free();
 
         return $array;
 
     }
 
     protected static function crearObjeto($registro)
     {
         $objeto = new static;
 
         foreach($registro as $key => $value)
         {
             if(property_exists($objeto,$key))
             {
                 $objeto->$key = $value;
             }
         }
 
         return $objeto;
     }
 
     //sincroniza el objeto en memoria con los cambios realizados poe el usuario
     public function sincronizar( $args =[] )
     {
         foreach($args as $key => $value)
         {
             //si yo no ingreso un valor , no se considera en la sincronizacion, es por eso que la imagen se mantiene si no la cambio
             if(property_exists($this, $key) && !is_null($value))
             {
                 $this->$key = $value;
             }
         }
     }


}