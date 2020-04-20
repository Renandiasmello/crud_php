<?php

/**
* Classe para trabalhar com banco de dados usando PDO.
*
*/

namespace CRUD;

use \PDO;

class Database extends PDO
{
    /**
    * Inicializa a conexão com o banco de dados
    * @access public
    * @return void
    */

    public function __construct($DB_TYPE, $DB_HOST, $DB_NAME, $DB_USER, $DB_PASS)
    {
        parent::__construct($DB_TYPE.':host='.$DB_HOST.';dbname='.$DB_NAME.';charset=utf8', $DB_USER, $DB_PASS);
    }

    
    public function select($sql, $array = array(), $all = TRUE, $fetchMode = PDO::FETCH_ASSOC)
    {
        $sth = $this->prepare($sql);

        foreach ($array as $key => $value)
        {
            $tipo = ( is_int($value) ) ? PDO::PARAM_INT : PDO::PARAM_STR;
            $sth->bindValue("$key", $value, $tipo);
        }
        $sth->execute();

        if( $all )
        {
            return $sth->fetchAll($fetchMode);
        }
        else
        {
            return $sth->fetch($fetchMode);
        }
    }

    public function insert($table, $data)
    {
        ksort($data);

        $camposNomes = implode('`, `', array_keys($data));
        $camposValores = ':' . implode(', :', array_keys($data));

        $sth = $this->prepare("INSERT INTO $table (`$camposNomes`) VALUES ($camposValores)");

        foreach ($data as $key => $value)
        {
            $tipo = ( is_int($value) ) ? PDO::PARAM_INT : PDO::PARAM_STR;
            $sth->bindValue(":$key", $value, $tipo);
        }

        $sth->execute();

        return $this->lastInsertId();
    }

    public function update($table, $data, $where)
    {

        ksort($data);

        $novosDados = NULL;

        foreach($data as $key=> $value)
        {
            $novosDados .= "`$key`=:$key,";
        }

        $novosDados = rtrim($novosDados, ',');

        $sth = $this->prepare("UPDATE $table SET $novosDados WHERE $where");

        foreach ($data as $key => $value)
        {
            $tipo = ( is_int($value) ) ? PDO::PARAM_INT : PDO::PARAM_STR;
            $sth->bindValue(":$key", $value, $tipo);
        }

        return $sth->execute();
    }

    public function delete($table, $where, $limit = 1)
    {
        return $this->exec("DELETE FROM $table WHERE $where LIMIT $limit");
    }
}