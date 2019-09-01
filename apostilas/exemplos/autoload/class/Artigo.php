<?php 

class Artigo 
{
    private $titulo;

    function setTitulo ($titulo)
    {
        $this->titulo = $titulo;
    }

    function getTitulo ()
    {
        return $this->titulo;
    }
}