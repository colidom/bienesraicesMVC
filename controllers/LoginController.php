<?php

namespace Controllers;
use MVC\Router;
use ModelAdmin;

class LoginController {
    public static function login(Router $router) {

        $errores = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        }


        $router->render('auth/login', [
            'errores' => $errores
        ]);
    }

    public static function logout() {
        echo "Desde logout";
    }
}
