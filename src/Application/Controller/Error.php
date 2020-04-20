<?php

namespace Application\Controller;

use CRUD\Controller;

class Error extends Controller
{
    public function __construct($mensagem = "")
    {
        $data["erro"] = $mensagem;

        $this->loadView('error' . DS . 'erro', $data);
    }
}