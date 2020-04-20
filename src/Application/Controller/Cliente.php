<?php

/**
 * Controller do cadastro de Clientes
 */

namespace Application\Controller;

use CRUD\Controller,
    CRUD\Common,
    CRUD\Session;

class Cliente extends Controller
{

    public function __construct()
    {
        parent::__construct();

        if (!Session::get("logado")) {
            Session::destroy();
            Common::redir('login');
        }

        $this->loadModel('Application\Model\Cliente', 'cliente');
    }

    public function main()
    {
        $dados["urlAction"] = SITE_URL . "" . DS . "cliente" . DS . "cadastrar";
        $dados["pageDesc"] = "Cadastro de cliente";
        $dados["submitDesc"] = "Cadastrar cliente";

        $this->loadView("cliente" . DS . "index", $dados);
    }

    public function cadastrar()
    {
        $cliente = array(
            'nome' => $_POST["input-nome"],
            'telefone' => $_POST["input-telefone"],
            'email' => $_POST["input-email"]
        );


        $id = $this->cliente->cadastrar($cliente);

        if ($id) {
            ## Cria as sessões que detalham o sucesso do cadastro
            Session::set("cadastro", TRUE);
            Session::set("cadastro-class", "alert-success");
            Session::set("cadastro-msg", "Cadastro realizado com sucesso!");

            ## Redir para a página de edição de cliente
            Common::redir('cliente' . DS . 'exibir' . DS . '' . $id);
        } else {
            ## Cria as sessões que detalham o erro do cadastro
            Session::set("cadastro", TRUE);
            Session::set("cadastro-class", "alert-error");
            Session::set("cadastro-msg", "Não foi possível realizar esse cadastro!");

            ## Redir para a página de cliente
            Common::redir('cliente');
        }
    }

    public function exibir($id = 0)
    {

        $dados["cliente"] = $this->cliente->getByid($id);

        if ($dados["cliente"]) {
            $dados["urlAction"] = SITE_URL . "" . DS . "cliente" . DS . "atualizar" . DS . "" . $id;

            $dados["pageDesc"] = 'Visualização de "' . $dados["cliente"]["nome"] . '"';
            $dados["submitDesc"] = "Salvar modificações";

            $this->loadView("cliente" . DS . "index", $dados);
        } else {
            Common::redir('index');
        }
    }


    public function atualizar($id = 0)
    {
        $cliente = array(
            'nome' => $_POST["input-nome"],
            'telefone' => $_POST["input-telefone"],
            'email' => $_POST["input-email"]
        );

        $resultado = $this->cliente->atualizar($cliente, $id);

        if ($resultado) {
            Session::set("cadastro", TRUE);
            Session::set("cadastro-class", "alert-success");
            Session::set("cadastro-msg", "Dados atualizados com sucesso!");

            Common::redir('cliente' . DS . 'exibir' . DS . '' . $id);
        } else {

            Session::set("cadastro", TRUE);
            Session::set("cadastro-class", "alert-error");
            Session::set("cadastro-msg", "Não foi possível atualizar os dados!");

            ## Redir para a página de cliente
            Common::redir('cliente' . DS . 'exibir' . DS . '' . $id);
        }
    }

    public function remover($id)
    {
        if ($this->cliente->remove($id)) {
            Session::set("remove-ok", TRUE);
        }

        Common::redir('index');
    }


    public function novo()
    {
        $this->main();
    }
}