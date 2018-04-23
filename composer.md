<p align="center">
    <img src="img/logo-composer.png" width="200px" />
</p>

Composer é uma ferramenta para gerenciamento de dependências do PHP. Através de um arquivo JSON podemos configurar as dependências do nosso projeto, por exemplo, podemos definir uma versão de framework (Zendframework, Laravel, CakePHP, Codeigniter etc) e também dizer que queremos usar o bootstrap 4 ou materialize.

Ao executar este arquivo JSON via terminal, ele cria o projeto com as suas dependências já definidas, sem a necessidade de criar pasta por pasta e até mesmo realizar downloads manualmente de bibliotecas.

## Instalando o composer

É necessário instalar o composer no computador, no próprio site oficial tem o download de acordo com o seu sistema operacional: [Clique aqui](https://getcomposer.org/)

## Criando o arquivo JSON

Na pasta do nosso novo projeto, abra o terminal e digite:

```
composer init
```

Ele vai retornar uma mensagem de boas vindas e temos que preencher algumas informações que ele solicitar.

1. name: Nome do pacote/projeto, por exemplo test/1.0.
2. description: Descrição do pacote/projeto.
3. author: Nome do Autor do pacote/projeto.
4. type: Tipo do projeto.
5. homepage: página inicial do pacote.
6. require: Exigir uma restrição de versão. Deve estar no formato: *foo/bar:1.0.0*
7. require-dev: Requisitos de desenvolvimento, consulte *--require*.

> Inicialmente preencha obrigatoriamente os três primeiros itens, os demais podem apenas dar um enter para prosseguir.

## Exemplo de configuração do composer

```
{
    "name": "Nome do projeto",
    "description": "Breve descrição do que a aplicação faz",
    "authors": [
        {
            "name": "Alex Pereira",
            "email": "alexmpprog@gmail.com"
        }
    ],
    "require": {
        "php": ">=5.2.8",
        "kevinlebrun/slug.php": "1.*"
    }
}
```

Agora, precisamos dizer ao composer que temos que instalar nossos pacotes que estão configurados em **require**. Digite o seguinte comando:

```
composer install
```

Perceba que após terminar a instalação o composer cria uma pasta chamada vendor, essa pasta contém todos os nossos pacotes e arquivos que precisamos utilizar para desenvolver nosso projeto.
No tópico a seguir vamos configurar o autoload para trabalharmos de uma forma melhor no projeto.

## Configuração do autoload

Na raiz do projeto, crie um arquivo chamado **index.php**, dentro desse arquivo inclua o seguinte código:

```PHP
<?php
header('Content-Type: text/html; charset=utf-8');

require 'vendor/autoload.php';
```

> No método header estamos dizendo que obrigatóriamente nossa página deve abrir os textos em UTF-8.

> No require, estamos apontando nosso autoload, ele vai carregar em nossas telas automáticamente todas as nossas classes e interfaces, sem a necessidade de usar os includes em nossos arquivos. Mais informações sobre o autoload [leia aqui](http://br2.php.net/autoload).

## Realizando o teste

Agora basta realizar uma instância do slug e fazer o teste se está funcionando corretamente nossa aplicação, logo abaixo do require adicione o seguinte código:

```PHP
$slugifier = new \Slug\Slugifier();

// Definindo tratamento de caracteres com acentuação
$slugifier->setTransliterate(true); 

$frase = 'Frase com acentuação para teste de criação de slug';

$slug = $slugifier->slugify($frase);

echo '<b>Frase natural: </b>' . $frase . "<br /><br />";
echo '<b>Frase com aplicação de slug: </b>' . $slug . "<br /><br />";
```
<hr>

## Instalando projeto via composer

Podemos baixar um projeto via composer com as configurações prontas para desenvolvimento com frameworks (Zendframework, Laravel, CakePHP, Codeigniter, etc), vejamos um exemplo para o framework Laravel:

```
composer create-project laravel/laravel laravel "5.4.*"
```
> Observe que temos também a opção de definir qual versão queremos, além do nome do projeto.

> Esses comandos costumam ser encontrados geralmente nas próprias documentações do framework, mas podem ser consultadas no site oficial da composer [clique aqui](https://packagist.org/)

<hr>

## Atualizando nossas dependências

Quando já temos um arquivo JSON sendo executado em nosso projeto e precisamos incluir uma nova dependência, precisamos dizer ao composer para ele atualizar nossos arquivos, basta digitar o comando abaixo:

```
composer update
```