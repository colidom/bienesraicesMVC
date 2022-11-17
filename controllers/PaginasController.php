<?php

namespace Controllers;

use MVC\Router;
use Model\Propiedad;
use PHPMailer\PHPMailer\PHPMailer;

class PaginasController
{
    public static function index(Router $router)
    {

        $propiedades = Propiedad::get(3);
        $inicio = true;

        $router->render('paginas/index', [
            'propiedades' => $propiedades,
            'inicio' => $inicio
        ]);
    }

    public static function nosotros(Router $router)
    {

        $router->render('paginas/nosotros');
    }

    public static function propiedades(Router $router)
    {

        $propiedades = Propiedad::all();

        $router->render('paginas/propiedades', [
            'propiedades' => $propiedades
        ]);
    }

    public static function propiedad(Router $router)
    {

        $id = validarORedireccionar('/propiedades');
        $propiedad = Propiedad::find($id);

        $router->render('paginas/propiedad', [
            'propiedad' => $propiedad
        ]);
    }

    public static function blog(Router $router)
    {

        $router->render('paginas/blog');
    }

    public static function entrada(Router $router)
    {
        $router->render('paginas/entrada');
    }

    public static function contacto(Router $router)
    {
        $mensaje = null;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $mensaje = null;
            $respuestas = $_POST['contacto'];

            // Crear una instancia de PHPMailer
            $mail = new PHPMailer();

            // Configurar SMTP
            $mail->isSMTP();
            $mail->Host = 'smtp.mailtrap.io';
            $mail->SMTPAuth = true;
            $mail->Username = '06ed95c3a9b8b4';
            $mail->Password = 'faeb551dc75a24';
            $mail->SMTPSecure = 'tls';
            $mail->Port = 2525;

            // Configurar el contenido del email
            $mail->setFrom('admin@bienesraices.com');
            $mail->addAddress('admin@bienesraices.com', 'BienesRaices.com');
            $mail->Subject = 'Tienes un nuevo mensaje';
            // Habilitar HTML
            $mail->isHtml(true);
            $mail->CharSet = 'UTF-8';

            // Definir el contenido
            $contenido = '<html>';
            $contenido .= "<p><strong>Has Recibido un email:</strong></p>";
            $contenido .= "<p>Nombre: " . $respuestas['nombre'] . "</p>";
            $contenido .= "<p>Mensaje: " . $respuestas['mensaje'] . "</p>";
            $contenido .= "<p>Vende o Compra: " . $respuestas['opciones'] . "</p>";
            $contenido .= "<p>Presupuesto o Precio: $" . $respuestas['presupuesto'] . "</p>";

            // Enviar de forma condicional algunos campos de email o telefono
            if ($respuestas['contacto'] === 'telefono') {
                $contenido .= "<p>Eligió ser Contactado por Teléfono:</p>";
                $contenido .= "<p>Su teléfono es: " .  $respuestas['telefono'] . " </p>";
                $contenido .= "<p>En la Fecha y hora: " . $respuestas['fecha'] . " - " . $respuestas['hora']  . " Horas</p>";
            } else {
                $contenido .= "<p>Eligio ser Contactado por Email:</p>";
                $contenido .= "<p>Su Email  es: " .  $respuestas['email'] . " </p>";
            }

            $contenido .= '</html>';
            $mail->Body = $contenido;
            $mail->AltBody = 'Esto es un texto alternativo sin HTML';

            // Enviar el mensaje
            if (!$mail->send()) {
                $mensaje = 'Hubo un Error... intente de nuevo';
            } else {
                $mensaje = 'Email enviado Correctamente';
            }
        }

        $router->render('paginas/contacto', [
            'mensaje' => $mensaje
        ]);
    }
}
