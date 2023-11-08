<?php

namespace Model;

class Vendedor extends ActiveRecord
{
   
    protected static $tabla = 'vendedores';
    protected static $columnasDB = ['id','nombre','apellido','telefono'];
    
    public $id;
    public $nombre;
    public $apellido;
    public $telefono;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? '';
        $this->nombre = $args['nombre'] ?? '';
        $this->apellido = $args['apellido'] ?? '';
        $this->telefono = $args['telefono'] ?? '';
    }

    public function validar()
    {
        if(strlen($this->nombre) < 2 || strlen($this->nombre) > 20) {
            self::$errores[] = "Debes añadir un nombre entre 5 y 20 letras";
        }
        if(strlen($this->apellido) < 2 || strlen($this->apellido) > 20) {
            self::$errores[] = "Debes añadir un apellido entre 5 y 20 letras";
        }
        if(!$this->telefono) {
            self::$errores[] = "Debes añadir un telefono";
        }
        if(!preg_match('/[0-9]{10}/', $this->telefono))
        {
            self::$errores[]= "Digite un numero valido";
        }

        return self::$errores;
    }
  
}

