<?php

namespace Controllers;

use Model\Propiedad;
use MVC\Router;
use PHPMailer\PHPMailer\PHPMailer;

class PaginasControllers{
    public static function index(Router $router){
        $propiedades = Propiedad::get(3); 
        $inicio = true;

        $router->render('paginas/index',[
            'propiedades'=>$propiedades,
            'inicio'=>$inicio
        ]);
    }

    public static function nosotros(Router $router){
        $router->render('paginas/nosotros', []);
    }

    public static function propiedades(Router $router){
        $propiedades = Propiedad::all();

        $router->render('paginas/propiedades', [
            'propiedades'=>$propiedades
        ]);
    }

    public static function propiedad(Router $router){

        $id = validarORedireccionar('/propiedades');
     
        $propiedad = Propiedad::find($id);

        $router->render('paginas/propiedad', [
            'propiedad' => $propiedad
        ]);
    }

    public static function blog(Router $router){
        $router->render('paginas/blog', []);
    }

    public static function entrada(Router $router){


        $router->render('paginas/entrada', []);
    }

    public static function contacto(Router $router){

        if($_SERVER['REQUEST_METHOD'] === 'POST'){

            $respuestas = $_POST['contacto'];


            $phpmailer = new PHPMailer();
            $phpmailer->isSMTP();
            $phpmailer->Host = 'smtp-relay.brevo.com';
            $phpmailer->SMTPAuth = true;
            $phpmailer->Port = 587;
            $phpmailer->Username = 'juanp162001@gmail.com';
            $phpmailer->Password = 'zkO1QV0PC83rEFMj';

            //Contenido del email
            $phpmailer->setFrom('contacto@horizonteurbano.com');
            $phpmailer->addAddress($respuestas['email']);
            $phpmailer->Subject = 'Respuesta a tu petición de contacto';

            $phpmailer->isHTML(true);
            $phpmailer->CharSet = 'UTF-8';

            $contenido = '<html> <p>Respuesta a tu petición de contacto</p>' . '<p>Nombre: ' .  $respuestas['nombre'] . '</p>';
            $contenido .= '<p>Email: ' . $respuestas['email'] . '</p>';
            $contenido .= '<p>Mensaje: ' . $respuestas['mensaje'] . '</p>';
            $contenido .= '<p>Vende o Compra: ' . $respuestas['tipo'] . '</p>';
            $contenido .= '<p>Precio o Presupuesto: $' . $respuestas['precio'] . '</p>';
            $contenido .= '</html>';
            $phpmailer->Body = $contenido;
            $phpmailer->AltBody = 'Ola';

            $phpmailer->send();
        }

        $router->render('paginas/contacto', []);
    }
}