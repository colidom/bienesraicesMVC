<?php

namespace Controllers;

use Model\Admin;
use MVC\Router;
use ModelAdmin;

class LoginController {
    public static function login(Router $router) {

        $errores = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            
            $auth = new Admin($_POST);
            $errores = $auth->validar();

        if(empty($errores)) {
            // Verificar si el usuario existe o no(mensaje de error)
            $resultado = $auth->existeUsuario();

            if(!$resultado) {
                $errores = Admin::getErrores();
            } else {
                // Verificar el password
                $autenticado = $auth->comprobarPassword($resultado);

                if ($autenticado) {
                    // Autenticar el usuario
                    $auth->autenticar();
                } else {
                    // Password incorrecto(mensaje de error)
                    $errores = Admin::getErrores();
                }
            }
        }
    }
        $router->render('auth/login', [
            'errores' => $errores
        ]);
    }

    public static function logout() {
        
        if(!isset($_SESSION)) {
            session_start();
        }

        $_SESSION = [];
        header('Location: /');
    }
}
