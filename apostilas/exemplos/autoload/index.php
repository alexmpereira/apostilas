<?php

//Toda vez que precisar instânciar uma classe vamos precisar usar o include.
//include_once("class/Artigo.php");
//include_once("class/Autor.php");

//Para resolver isto, vamos utilizar o método autoload do php
function __autoload($classe){
    include_once("class/".$classe.".php");
}

$artigo = new Artigo();
$artigo->setTitulo("Testando Autoload");
echo $artigo->getTitulo();

$nome = new Autor();
$nome->setNome("Alex Pereira");
echo '<br>'.$nome->getNome();