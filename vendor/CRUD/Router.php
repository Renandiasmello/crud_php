<?php

/**
 * Router. Executa a ação conforme a roda passada
 *
 */

namespace CRUD;

use CRUD\Request;

class Router
{
    /**
     * Método responsável por obter o nome do controller e do método e executá-los.
     * @access public
     * @return void
     */

    public static function run(Request $request)
    {
        $controlador = $request->getControlador();
        $metodo = $request->getMetodo();
        $args = (array)$request->getArgs();
        $controlador = 'Application\Controller\\' . ucfirst($controlador);
        $controlador = new $controlador();

        if (!is_callable(array($controlador, $metodo))) {
            self::error("Método - O metodo {$metodo} não foi encontrado");
            return;
        }

        call_user_func_array(array($controlador, $metodo), $args);

    }

    protected static function error($msg)
    {
        throw new \Exception($msg);
    }
}