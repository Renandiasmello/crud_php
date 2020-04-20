<?php

/**
 * Controller Pai.
 *
 */

namespace CRUD;

class Controller
{
    protected $session;

    /**
     * Método construtor
     * @access public
     * @return void
     */

    public function __construct()
    {
        Session::inicializar();
    }

    /**
     * Carrega uma View.
     * @access public
     * @param String $nome Nome da view a ser carregada.
     * @param Array $vars Array de dados a serem 'enviados' para a View.
     * @return Void
     */

    protected function loadView($nome, $vars = null)
    {
        if (is_array($vars) && count($vars) > 0) {
            extract($vars, EXTR_PREFIX_SAME, 'data');
        }

        $arquivo = VIEW_PATH . '/' . $nome . '.phtml';

        if (!file_exists($arquivo)) {
            $this->error("Houve um erro. Essa View {$nome} nao existe.");
        }

        require_once($arquivo);
    }

    /**
     * Carrega um modelo.
     * @access public
     * @param String $nome Nome do modelo a ser carregado.
     * @param String $apelido 'Apelido' para o modelo
     * @return Void
     */

    protected function loadModel($nome, $apelido = "")
    {
        $this->$nome = new $nome();
        if ($apelido !== '') {
            $this->$apelido =& $this->$nome;
        }
    }

    /**
     * Dispara um erro.
     * @access protected
     * @param String $msg Mensagem do erro.
     * @return Void
     */

    protected function error($msg)
    {
        throw new \Exception($msg);
    }
}