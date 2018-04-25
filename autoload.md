## Para que serve o Autoload do PHP?

Primeiro é importante identificarmos um problema muito comum no PHP ao programar Orientado a Objetos. Quando estamos criando nossas classes e precisamos instanciar temos que obrigatoriamente utilizar o fomoso **include** para indicarmos qual classe o nosso objeto está sendo instanciado e é exatamente nesse momento que percebemos um grande problema: Suponhamos que tenhamos 10 classes, teremos que utilizar o include 10 vezes?

Com a função **__autoload()** do PHP isso se resolve, com ela indicamos a nossa pasta raiz que vai conter todas as nossas classes e automáticamente ela se encarregará de carregar para nós quando ocorrer uma nova instancia.

Para testar a utilização do autoload vamos criar um projeto básico.

## Estrutura do projeto

1. Dentro desse projeto vai conter um arquivo chamado **index.php** na raiz principal.

2. E uma pasta chamada **class**.

3. Dentro da pasta cria duas classes PHP, chamada **Artigo.php** e **Autor.php**

## Adicionando os códigos para testarmos

1. No arquivo index.php adicione o código abaixo:

```PHP
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
```

2. No arquivo Artigo.php adicione o código abaixo:

```PHP
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
```

3. No arquivo Autor.php adicione o código abaixo:

```PHP
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
```

> Observe que as classes são classes bem simples, onde temos o método getter e setter.

> Observe que eu deixei comentado no index o uso do include e juntamente o autoload.