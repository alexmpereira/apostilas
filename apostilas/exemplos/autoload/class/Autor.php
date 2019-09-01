<?php

class Autor 
{
    private $nome;

    function setNome ($nome)
    {
        $this->nome = $nome;
    }

    function getNome ()
    {
        return $this->nome;
    }
}