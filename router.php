<?php

namespace MVC;

class Router {

    public $rutasGET = [];
    public $rutasPOST = [];

    public function get($url, $fn) {
        $this->rutasGET[$url] = $fn;
    }

    public function comprobarRutas() {
        $urlActual = $_SERVER['PATH_INFO'] ?? '/';
        $metodo = $_SERVER['REQUEST_METHOD'];

        if ($metodo === 'GET') {
            $fn = $this->rutasGET[$urlActual] ?? null;
        }

        if ($fn) {
            // La función existe
            call_user_func($fn, $this);
        } else {
            echo "Error 404: Página no encontrada";
        }
    }

    // Muestra una vista
    public function render($view, $datos = []) {

        foreach ($datos as $key => $value) {
            // Sobre $ significa variable de variable
            $$key = $value;
        }

        ob_start(); // Iniciar almacenamiento en memoria de la vista

        include __DIR__ . "/views/$view.php"; // Limpia el buffer
        $contenido = ob_get_clean();
        include __DIR__ . "/views/layout.php";

    }
}
