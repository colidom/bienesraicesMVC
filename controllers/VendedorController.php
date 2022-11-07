<?php

namespace Controllers;

use MVC\Router;
use Model\Vendedor;

class VendedorController {

    public static function crear(Router $router) {
        
        $vendedor = new Vendedor;
        $errores = Vendedor::getErrores();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            // Crea una nueva instancia
            $vendedor = new Vendedor($_POST['vendedor']);

            // Validar
            $errores = $vendedor->validar();

            if (empty($errores)) {
                // Guarda en la base de datos
                $vendedor->guardar();
            }
        }

        $router->render('/vendedores/crear', [
            'vendedor' => $vendedor,
            'errores' => $errores
        ]);
    }

    public static function actualizar(Router $router) {

        // Array con mensajes de errores
        $errores = Vendedor::getErrores();
        $id = validarORedireccionar('/admin');
        // Obtener los datos del vendedor a actualizar
        $vendedor = Vendedor::find($id);

        $router->render('/vendedores/actualizar', [
            'vendedor' => $vendedor,
            'errores' => $errores           
        ]);
    }

    public static function eliminar() {
        echo "Eliminar vendedor";
    }
}
