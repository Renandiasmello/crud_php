<?php

/**
 * Classe responsável por obter os segmentos da URL informada
 *
 */

namespace CRUD;

class Request
{
    private $_controlador = "index";
    private $_metodo = "main";
    private $_args = array();

    /**
     * Método construtor
     * @access public
     * @return void
     */

    public function __construct()
    {
        if (!isset($_GET["url"])) return false;

        $segmentos = explode('/', $_GET["url"]);

        $this->_controlador = ($c = array_shift($segmentos)) ? $c : 'index';

        $this->_metodo = ($m = array_shift($segmentos)) ? $m : 'main';

        $this->_args = (isset($segmentos[0])) ? $segmentos : array();
    }

    /**
     * Retorna o nome do controller
     * @access public
     * @return String
     */

    public function getControlador()
    {
        return $this->_controlador;
    }

    /**
     * Retorna o nome do método
     * @access public
     * @return String
     */

    public function getMetodo()
    {
        return $this->_metodo;
    }

    /**
     * Retorna os argumentos
     * @access public
     * @return Array
     */

    public function getArgs()
    {
        return $this->_args;
    }
}