<?php

namespace Controllers;

use MVC\Router;
use Model\Vendedor;

class VendedorController {

    public static function crear(Router $router) {
        
        $vendedor = new Vendedor;
        $errores = Vendedor::getErrores();

        $router->render('/vendedores/crear', [
            'vendedor' => $vendedor,
            'errores' => $errores
        ]);
    }

    public static function actualizar() {
        echo "Actualizar vendedor";
    }

    public static function eliminar() {
        echo "Eliminar vendedor";
    }
}
