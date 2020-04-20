<?php

/**
 * Controller do Index
 */

namespace Application\Controller;

use CRUD\Controller,
    CRUD\Common,
    CRUD\Session;

class Index extends Controller
{

    public function __construct()
    {
        parent::__construct();

        if (!Session::get("logado")) {
            Session::destroy();
            Common::redir('login');
        }

        $this->loadModel('Application\Model\Cliente', 'sistema');
    }

    public function main()
    {
        $dados["clientes"] = $this->sistema->getAll();
        $this->loadView("index" . DS . "index", $dados);
    }


    public function logout()
    {
        Session::destroy();
        Common::redir('index');
    }
}