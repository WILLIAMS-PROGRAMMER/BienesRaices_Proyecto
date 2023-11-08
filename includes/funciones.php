<?php

define('TEMPLATES_URL',__DIR__.'/templlates');
define('FUNCIONES_URL',__DIR__.'funciones.php');
define('CARPETA_IMAGENES', $_SERVER['DOCUMENT_ROOT'] . '/imagenes/');
define('CARPETA_IMAGENES_BLOG' , $_SERVER['DOCUMENT_ROOT'] . '/imagenesblog/');

function incluirTemplate( string $nombre, bool $inicio = false) {
    include TEMPLATES_URL. "/$nombre.php";
}

function estaAutenticado() {
    session_start();

    if(! $_SESSION['login'] ) {
        header('Location: /');
    }
   
}

function debuguear($variable)
{
    echo "<pre>";
    var_dump($variable);
    echo "</pre>";
    exit;
}

// Escapa/sanitizar el HTML
function s($html):string {
    $s = htmlspecialchars($html);
    return $s;
}

//validar tipo de Contenido
function validarTipoContenido($tipo)
{
    $tipos =['vendedor','propiedad','blog'];
    return in_array($tipo,$tipos);
}

//Muestra los mensajes
function mostrarNotificacion($codigo)
{
    $mensaje = '';
    switch($codigo)
    {
        case 1: $mensaje = 'Creado Correctamente';
        break;
        case 2: $mensaje = 'Actualizado Correctamente';
        break;
        case 3: $mensaje = 'Eliminado Correctamente';
        break;
        default:
        $mensaje = false;
        break;
    }
    return $mensaje;

}

function validarOrredireccionar(string $url)
{
    $id = $_GET['id'];
    $id = filter_var($id,FILTER_VALIDATE_INT);  //validar que el id sea un numero

    if(!$id) {
        header("Location: $url");
    }
    return $id;
}