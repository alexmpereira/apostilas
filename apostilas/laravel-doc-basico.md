### Middleware

Para atribuir middleware a todas as rotas dentro de um grupo, você pode usar o método middleware antes de definir o grupo. Middleware são executados na ordem em que estão listados na matriz:

```PHP
Route::middleware(['first', 'second'])->group(function () {
    Route::get('/', function () {
        // 
    });

    Route::get('user/profile', function () {
        //
    });
});
```

# Autenticação

Por padrão, o Laravel inclui um modelo **App/User** Eloquent no diretório do seu aplicativo. Este modelo pode ser usado com o driver de autenticação Eloquent padrão. Se o seu aplicativo não estiver usando o Eloquent, você pode usar o driver de autenticação **database** que usa o construtor de consultas Laravel.

Ao construir o esquema database para o modelo App\User, verifique se a coluna da senha tem pelo menos 60 caracteres. Manter o comprimento da coluna de cadeia padrão de 255 caracteres seria uma boa escolha.

Além disso, você deve verificar se a tabela de seus users (ou equivalente) contém uma coluna de 100 caracteres de **remember_token** nula. Esta coluna será usada para armazenar um token para usuários que selecionam a opção "lembrar-me" ao fazer login em seu aplicativo.

O Laravel é fornecido com vários controladores de autenticação pré-construídos, que estão localizados no espaço de nome **App\Http\Controllers\Auth**. O **RegisterController** lida com o novo registro de usuário, o **LoginController** lida com a autenticação, o **ForgotPasswordController** lida com links de e-mail para reiniciar senhas e o **ResetPasswordController** contém a lógica para redefinir senhas. Cada um desses controladores usa uma característica para incluir seus métodos necessários. Para muitas aplicações, você não precisará modificar esses controladores.

## Roteamento

Laravel fornece uma maneira rápida de armazenar todas as rotas e visualizações que você precisa para autenticação usando um comando simples:

```PHP
php artisan make:auth
```
Este comando deve ser usado em novos aplicativos e irá instalar uma exibição de layout, registro e login, bem como rotas para todos os pontos finais de autenticação. Um **HomeController** também será gerado para lidar com solicitações de início de sessão no painel do aplicativo.

## Views

Conforme mencionado na seção anterior, o comando  _php artisan make:auth_ criará todas as visualizações que você precisa para autenticação localizadas em **resources/views/auth**.

O comando _make:auth_ também criará um diretório **resources/views/layouts** contendo um layout de base para sua aplicação. Todos esses pontos de vista usam o framework CSS do Bootstrap, mas você pode personalizá-los como desejar.

# TDD

Quando iniciamos um novo projeto o PHPUnit já é construindo na raiz do projeto, o nome do arquivo incluso está como **phpunit.xml**, ele já está configurado para sua aplicação. O framework também é fornecido com métodos auxiliares convenientes que permitem testar expressivamente suas aplicações.

Por padrão, o diretório de **tests** do seu aplicativo contém dois diretórios: **Feature** e **Unit**. Testes unitários são testes que se concentram em uma porção muito pequena e isolada do seu código. Na verdade, a maioria dos testes unitários provavelmente se concentra em um único método. Os testes de recurso podem testar uma porção maior do seu código, incluindo a forma como vários objetos interagem uns com os outros ou mesmo uma solicitação HTTP completa para um ponto final JSON.

Um arquivo **ExampleTest.php** é fornecido nos diretórios de teste **Feature** e **Unit**. Depois de instalar um novo aplicativo Laravel, simplesmente execute phpunit na linha de comando para executar seus testes.

## Ambiente

Ao executar testes via **phpunit**, o Laravel configurará automaticamente o ambiente de configuração para o teste por causa das variáveis ​​de ambiente definidas no arquivo **phpunit.xml**. O Laravel também configura automaticamente a sessão eo cache para o driver array durante o teste, o que significa que nenhuma sessão ou dados de cache serão persistidos durante o teste.

Você é livre para definir outros valores de configuração do ambiente de teste conforme necessário. As variáveis ​​de ambiente de teste podem ser configuradas no arquivo phpunit.xml, mas certifique-se de limpar seu cache de configuração usando o comando **config:clear** do **Artisan** antes de executar seus testes!

## Criando e testando

Para criar um novo caso de teste, use o comando Artisan **make:test** :

```PHP
// Crie um teste no diretório Feature ... 
php artisan make:test UserTest

// Crie um teste no diretório Unit ...
php artisan make:test UserTest --unit
```
Uma vez que o teste foi gerado, você pode definir métodos de teste como você normalmente usaria no PHPUnit. Para executar seus testes, basta executar o comando phpunit do seu terminal:

# Tests HTTP

O Laravel fornece uma API muito fluente para fazer solicitações HTTP para sua aplicação e examinar a saída. Por exemplo, dê uma olhada no teste definido abaixo:

```PHP
<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testBasicTest()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
}
```

O método **get** faz um pedido **GET** no aplicativo, enquanto o método **assertStatus** afirma que a resposta retornada deve ter o código de status HTTP fornecido. Além desta asserção simples, Laravel também contém uma variedade de afirmações para inspecionar os cabeçalhos de resposta, conteúdo, estrutura JSON e muito mais.

