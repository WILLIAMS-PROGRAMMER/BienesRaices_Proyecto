<?php
namespace Controllers;
use MVC\Router;
use Model\Blog;
use Model\Propiedad;
use Intervention\Image\ImageManagerStatic as Image;
use PHPMailer\PHPMailer\PHPMailer;

class PaginasController
{
    public static function index(Router $routerr)
    {
        $inicio = true;
        $propiedades = Propiedad::all($limite = 4);
        $blogs = Blog::all($limite = 2);

        $routerr->render('/paginas/index',[
           'propiedades' => $propiedades,
           'blogs' => $blogs,
           'inicio' => $inicio
         ]);
    }
    public static function nosotros(Router $routerr)
    {
        $routerr->render('/paginas/nosotros',[ ]);
    }
    public static function propiedades(Router $routerr)
    {
        $propiedades = Propiedad::all();

        $routerr->render('/paginas/propiedades',[
            'propiedades' => $propiedades
            
          ]);
    }
    public static function propiedad(Router $routerr)
    {
        $id = validarOrredireccionar('/propiedades');
        $propiedad = Propiedad::find($id);

        $routerr->render('/paginas/propiedad',[
            'propiedad' => $propiedad
        ]);
    }
    public static function blog(Router $routerr)
    {
        $blogs = Blog::all();

        $routerr->render('/paginas/blog',[
            'blogs' => $blogs
          ]);
    }
    public static function entrada(Router $routerr)
    {
        $id = validarOrredireccionar('/propiedades');
        $blog = Blog::find($id);

        $routerr->render('/paginas/entrada',[
            'blog' => $blog
        ]);
    }
    public static function contacto(Router $routerr)
    {
        $mensaje = null;

        if($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            $respuestas = $_POST['contacto'];
            //Crea una instancia de PHPmailer
            $email = new PHPMailer();

            //Configurar SMTP
            $email->isSMTP();      //Send using SMTP
            $email->Host  = $_ENV['EMAIL_HOST']; 
            $email->SMTPAuth   = true;
            $email->Username   = $_ENV['EMAIL_USER'];
            $email->Password   = $_ENV['EMAIL_PASS'];                               //SMTP password
            $email->SMTPSecure = 'tls';
            $email->Port       = $_ENV['EMAIL_PORT'];

             //Configurar el contenido del email
            $email->setFrom('avendano.balarezo.williams@gmail.com', 'BienesRaicesCompany');
            $email->addAddress('avendano.balarezo.williams@gmail.com', 'BienesRaices.com');  
            //$email->addAddress($respuestas['email'], 'Hola '. $respuestas['nombre'] );  
            $email->Subject = 'You have a new Message';

            //Habilitar HTML
            $email->isHTML(true);
            $email->CharSet = 'UTF-8';

            //Definir el contenido
            $contenido = '<html>';
            $contenido .= '<p>Tienes un nuevo mensaje</p>';
            $contenido .= '<p>Nombre: ' . $respuestas['nombre'] . ' </p>';
           
            $contenido .= '<p>Prefiere ser contactado por: ' . $respuestas['contacto'] . ' </p>';
            //Enviar de forma condicional algunos campos de email o telefono
            if($respuestas['contacto'] == 'telefono')
            {
                $contenido .= '<p>Telefono: ' . $respuestas['telefono'] . ' </p>';
                $contenido .= '<p>Fecha contacto: ' . $respuestas['fecha'] . ' </p>';
                $contenido .= '<p>Hora: ' . $respuestas['hora'] . ' </p>';
            }
            else
            {
                //Es email, agregamos campo de email
                $contenido .= '<p>Email: ' . $respuestas['email'] . ' </p>';
            }

            
            $contenido .= '<p>Mensaje: ' . $respuestas['mensaje'] . ' </p>';
            $contenido .= '<p>Vende o Compra: ' . $respuestas['tipo'] . ' </p>';
            $contenido .= '<p>Precio o presupuesto: ' . $respuestas['precio'] . ' </p>';

            $contenido .= '</html>';

            $email->Body = $contenido;
            $email->AltBody = 'Esto es texto alternativo sin html';

            //Enviar el email
            if($email->send())
            {
                $mensaje=  "Mensaje enviado correctamente";
               
                    // Aquí comienza el nuevo bloque para enviar el correo de confirmación al usuario
                    $confirmacion = new PHPMailer();
                
                    // Configura los mismos parámetros SMTP que usaste para el primer email
                    $confirmacion->isSMTP();
                    $confirmacion->Host = $_ENV['EMAIL_HOST'];
                    $confirmacion->SMTPAuth = true;
                    $confirmacion->Username = $_ENV['EMAIL_USER'];
                    $confirmacion->Password = $_ENV['EMAIL_PASS'];
                    $confirmacion->SMTPSecure = 'tls';
                    $confirmacion->Port = $_ENV['EMAIL_PORT'];
                
                    // Configurar el contenido del email de confirmación
                    $confirmacion->setFrom('avendano.balarezo.williams@gmail.com', 'BienesRaicesCompany');
                    $confirmacion->addAddress($respuestas['email'], 'Hola ' . $respuestas['nombre']);
                    $confirmacion->Subject = 'Tu información fue enviada con éxito';
                
                    // Habilitar HTML para el correo de confirmación
                    $confirmacion->isHTML(true);
                    $confirmacion->CharSet = 'UTF-8';
                
                    // Contenido del correo de confirmación
                    $contenidoConfirmacion = "<html><p>Hola " . $respuestas['nombre'] . ",</p>";
                    $contenidoConfirmacion .= "<p>Tu información fue enviada con éxito y nos pondremos en contacto contigo pronto.</p>";
                    $contenidoConfirmacion .= "<p>Si tienes alguna pregunta, puedes responder a este correo electrónico.</p>";
                    $contenidoConfirmacion .= "<p>Gracias por contactarnos.</p>";
                    $contenidoConfirmacion .= "<p>Saludos,</p>";
                    $contenidoConfirmacion .= "<p>El equipo de BienesRaicesCompany</p></html>";
                
                    // Asignar el contenido al correo de confirmación
                    $confirmacion->Body = $contenidoConfirmacion;
                    $confirmacion->AltBody = 'Tu información fue enviada con éxito y nos pondremos en contacto contigo pronto.';
                
                    // Enviar el correo de confirmación
                    if(!$confirmacion->send()) {
                        $mensaje .= " Pero el correo de confirmación no se pudo enviar.";
                    }
            }
            else
            {
                $mensaje=  "El mensaje no se pudo enviar";
            }
            

        }
        $routerr->render('/paginas/contacto',[ 'mensaje' => $mensaje ]);
    }

}