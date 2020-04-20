<?php

/**
 * Controller do login
 */

namespace Application\Controller;

use CRUD\Controller,
    CRUD\Common,
    CRUD\Session;

class Login extends Controller
{

    public function __construct()
    {
        parent::__construct();

        if (Session::get("logado")) {
            Common::redir('index');
        }

        $this->loadModel('Application\Model\Usuario', 'usuario');
    }

    public function main()
    {
        $this->loadView("login" . DS . "index");
    }

    public function processar()
    {
        $logar = $this->usuario->validaUsuario($_POST["input-login"], $_POST["input-senha"]);

        if ($logar !== TRUE) {
            Session::set("erro-login", $logar);
            Common::redir('login');
        } else {
            Session::set("logado", TRUE);
            Common::redir('index');
        }
    }
}