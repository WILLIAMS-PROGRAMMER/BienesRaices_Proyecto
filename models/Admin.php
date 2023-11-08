<?php

namespace Model;

class Admin extends ActiveRecord
{
    protected static $tabla = 'usuarios';
    protected static $columnasDB = ['id','email','password','rango'];
    
    public $id;
    public $email;
    public $password;
    public $rango;
  
    
    
    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? '';
        $this->email = $args['email'] ?? '';
        $this->password = $args['password'] ?? '';
        $this->rango = $args['rango'] ?? '';
    }

    
   public function validar()
   {   
        if(!$this->email) {
            self::$errores[] = "Debes colocar un email";
        }
        if(!$this->password) {
            self::$errores[] = "Debes colocar un password";
        }

       return self::$errores;
   }

   public function existeUsuario()
   {
       //revisar si un usuario existe o no
       $query = "SELECT * FROM " . self::$tabla . " WHERE email = '" . $this->email . "' LIMIT 1";
       
       $resultado = self::$db->query($query);

       if(!$resultado->num_rows)
       {
        self::$errores[] = 'El usuario no existe';
        return;
       }
       
       return $resultado;
   }

   public function comprobarPassword($resultado)
   {
        $usuario = $resultado->fetch_object();
    
        $autenticado = password_verify( $this->password , $usuario->password );
        
        if(!$autenticado)
            self::$errores[] = 'El password es invalido';
        
        else 
            $_SESSION['rango'] = $usuario->rango;   
        

        return $autenticado;
   }

   public function autenticar()
   {
        session_start();
        //llenar el arreglo de sesion

        $_SESSION['usuario'] = $this->email;
        
        $_SESSION['login'] = true;

        header('Location: /admin');   
   }
   



}