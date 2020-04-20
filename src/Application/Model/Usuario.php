<?php

namespace Application\Model;

use CRUD\Model,
    CRUD\Common;

class Usuario extends Model
{
    private $_tabela = "usuario";

    public function validaUsuario($login, $senha)
    {
        if (Common::validarEmBranco($login) || Common::validarEmBranco($senha)) {
            return "Preencha corretamente os dados.";
        }

        $where = array(
            ':login' => $login,
            ':senha' => md5($senha)
        );

        $retorno = $this->db->select("SELECT id FROM {$this->_tabela} WHERE login = :login AND senha = :senha", $where);

        return $retorno ? TRUE : "Login ou Senha inválidos!";
    }
}