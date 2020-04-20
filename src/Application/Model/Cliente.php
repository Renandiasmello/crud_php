<?php

namespace Application\Model;

use CRUD\Model;

class Cliente extends Model
{
    private $_tabela = "cliente";

    public function getAll()
    {
        return $this->db->select("SELECT * FROM {$this->_tabela} ORDER BY nome");
    }

    public function getByid($id)
    {
        $id = (int)$id;

        return $this->db->select("SELECT * FROM {$this->_tabela} WHERE id = :id", array(':id' => $id), FALSE);
    }

    public function remove($id)
    {
        $id = (int)$id;

        return $this->db->delete($this->_tabela, "id = '$id'");
    }

    public function cadastrar($cliente = array())
    {
        return $this->db->insert($this->_tabela, $cliente);
    }

    public function atualizar($cliente, $id)
    {
        $where = "id = " . (int)$id;

        return $this->db->update($this->_tabela, $cliente, $where);
    }
}