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

# Controladores

Após a configuração das rotas, podemos criar nossos controladores, conhecidos como controllers. Serão nos controllers que vamos fazer o CRUD e os métodos que trata as oções da nossa view.

Veja abaixo um exemplo de controlador:

```PHP
<?php

namespace App\Http\Controllers;

use App\User;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    /**
     * Show the profile for the given user.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        return view('user.profile', ['user' => User::findOrFail($id)]);
    }
}
```

> Observe que nossa class User extende uma classe Controller, essa classe é um padrão do Laravel que contém, alguns métodos prontos que podemos chamar em nosso controller.

> Veja que no nosso controller temos o método **show**, ele serve para mostrar nossos usuários.

Nossa rota ficaria assim:

```PHP
Route::get('user/{id}', 'UserController@show');
```

Veja que agora declaramos o nosso controller no segundo parâmetro e ainda indiciamos o método que vai ser executado ao acessar o caminho **user/{id}**

## Criando um Controller com o comando Artisan

Suponhamos que vamos criar um controller de fotos, para evitar de entrar na pasta e manuzear o mouse para criar o arquivo .php, vamos digitar os camandos que o próprio Laravel nos fornece. Para criar um controller usamos o make do Artisan indiciando que é um controller e o nome do controlle que queremos:

```PHP
php artisan make:controller PhotoController --resource
```

Se verificar na pasta Controller o nosso arquivo **PhotoController** está lá com as pré configurações prontas para serem utilizadas.

## Criando uma rotacom as açõs já pré definidas do Laravel

O Laravel veio para nos ajudar e tenso esse pensamento, ele criou um método para a rota capaz de definir já alguns métodos, assim, não precisamos ficar criando uma rota para o método create, outra para o update e assim por diante, basta declararmos a rota dessa maneira:

```PHP
Route::resource('photos', 'PhotoController');
```

Pronto, temos os seguintes métodos já pré-definidos na rota:

<img src="http://i.imgur.com/ubcdHA4.png" alt="Laravel 5.4 rotas pré definidas" width="650px">

# Request

Para obter uma resposta HTTP atual via dependência, você deve adicionar a **Illuminate\Http\Request** no seu controller. A instância de solicitação recebida será automaticamente injetada pelo contêiner do serviço.

Se o método do seu controlador também estiver esperando a entrada de um parâmetro que está configurado na rota, você deve listar seus parâmetros rota após suas outras dependências. Vamos na pratica, para entender melhor. Vamos criar uma rota recebendo uma entrada (um parâmetro), que no caso será um id de user:

```PHP
Route::put('user/{id}', 'UserController@update');
```

> Observe que estamos fazendo o método put na rota e no nosso controller deve ter o método update para realizar esta tarefa.

Para realizar uma injeção de dependência vamos adicionar no nosso controller o request do próprio Laravel: **Illuminate\Http\Request**

No nosso controller, onde temos o update, vamos adicionar como parâmetro o request e nosso id que está localizado em nossa rota:

```PHP
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Update the specified user.
     *
     * @param  Request  $request
     * @param  string  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }
}
```

Os métodos request você consegue trabalhar com os inputs, arquivos (pode ser de fotos também), verificar se é um arquivo, trabalhar com cookie, entre outros. Os exemplos serão aplicados diretamente no projeto do curso, com mais detalhes.

# Criando Respostas

Todas as rotas e controladores devem retornar uma resposta para serem enviadas de volta ao navegador do usuário.

Laravel fornece várias maneiras diferentes de retornar as respostas. A resposta mais básica é simplesmente retornar uma string de uma rota ou controlador. A estrutura converterá automaticamente a string em uma resposta HTTP completa:

```PHP
Route::get('/', function () {
    return 'Hello World';
});
```

Além de retornar cadeias de caracteres de suas rotas e controladores, você também pode retornar arrays. A estrutura converterá automaticamente a matriz em uma resposta JSON:

```PHP
Route::get('/', function () {
    return [1, 2, 3];
});
```
## Redirecionamentos

As respostas de redirecionamento são instâncias da classe **Illuminate\Http\RedirectResponse** e contém os cabeçalhos apropriados necessários para redirecionar o usuário para outro URL. Existem várias maneiras de gerar uma instância do RedirectResponse. O método mais simples é usar o ajudante de redirecionamento global:

```PHP
Route::get('dashboard', function () {
    return redirect('home/dashboard');
});
```

## Redirecionando para rotas nomeadas

Quando você chama o **redirect** de redirecionamento sem parâmetros, uma instância do **Illuminate\Routing\Redirector** é retornada, permitindo que você ligue para qualquer método na instância do Redirecionador. Por exemplo, para gerar uma **RedirectResponse** para uma rota nomeada, você pode usar o método de rota:

```PHP
return redirect()->route('login');
```
Se sua rota tiver parâmetros, você pode passá-los como o segundo argumento para o método de rota:

```PHP
return redirect()->route('profile', ['id' => 1]);
```
# Criando Views

As views são nossas páginas HTML, o Laravel deixa a lógica do controller separado das lógicas de apresentação. As visualizações são armazenadas no diretório **resource**

Um exemplo simples, mostrando uma informação vinda do controller ou da nossa rota, seria:

```HTML
<html>
    <body>
        <h1>Hello, {{ $name }}</h1>
    </body>
</html>
```

Agora em uma rota por exemplo, podemos declarar isto facilmente, para que nossa variável $name receba um valor:

```PHP
Route::get('/', function () {
    return view('index', ['name' => 'alex']);
});
```

> Observe que em nossa rota, o primeiro parâmetro do método view é o nome do arquivo blade que está localizado na pasta resource. O segundo parâmetro é o valor que irá receber a variável

## Verificando se a View existe

Para verificarmos se uma view existe, podemos criar um condição if e utilizando o método exists para verificar:

```PHP
use Illuminate\Support\Facades\View;

if (View::exists('emails.customer')) {
    //
}
```
## Passando dados para a View

Como fizemos no primeiro exemplo, podemos paassar vários dados para a view:

```PHP
return view('greetings', ['name' => 'Victoria']);
```
Dessa forma estamos enviando em forma de array, podendo ter vários outros atributos. Podemos usar o método with para enviar dados individuais:

```PHP
return view('greeting')->with('name', 'Victoria');
```
# Introdução ao Blade

O Laravel tem um motor simples e poderoso para o FRONT conhecido como Blade. Ao contrário de outros motores de modelos PHP populares, o Blade não o impede de usar o código PHP simples em suas visualizações. De fato, todas as visualizações são compiladas em código PHP simples e armazenadas em cache até serem modificadas. Os arquivos de exibição usam a extensão de arquivo **.blade.php** e normalmente são armazenados no diretório resource/views.

## Definindo um Layout

Dois dos principais benefícios do uso da Blade são a herança de modelo e as seções. Para começar, vamos criar um layout "mestre". Uma vez que a maioria dos aplicativos da Web mantêm o mesmo layout geral em várias páginas, é conveniente definir esse layout como uma única visualização de Blade:

```PHP
<html>
    <head>
        <title>App Name - @yield('title')</title>
    </head>
    <body>
        @section('sidebar')
            This is the master sidebar.
        @show

        <div class="container">
            @yield('content')
        </div>
    </body>
</html>
```
Como você pode ver, este arquivo contém marcações HTML típicas. No entanto, tome nota das diretivas **@section** e **@yield**. A diretiva @section, como o nome indica, define uma seção de conteúdo, enquanto a diretiva @yield é usada para exibir o conteúdo de uma determinada seção.

## Extendendo o Layout Mestre

Ao definir uma visão secundária, use a diretiva Blade **@extends** para especificar qual layout a visão filha deve "herdar". As visualizações que estendem um layout do Blade podem injetar conteúdo nas seções do layout usando as diretivas do @section. Lembre-se, como visto no exemplo acima, o conteúdo dessas seções será exibido no layout usando @yield:

```HTML
<!-- Stored in resources/views/child.blade.php -->

@extends('layouts.app')

@section('title', 'Page Title')

@section('sidebar')
    @parent

    <p>This is appended to the master sidebar.</p>
@endsection

@section('content')
    <p>This is my body content.</p>
@endsection
```
Neste exemplo, a seção da barra lateral está utilizando a diretiva **@parent** para anexar conteúdo (em vez de sobrescrever) para a barra lateral do layout. A diretiva @parent será substituída pelo conteúdo do layout quando a exibição for renderizada.

## Estruturas de controle

Você pode construir instruções se usando as diretivas **@if**, **@elseif**, **@else** e **@endif**. Essas diretivas funcionam de forma idêntica às suas partes equivalentes de PHP:

```HTML
@if (count($records) === 1)
    I have one record!
@elseif (count($records) > 1)
    I have multiple records!
@else
    I don't have any records!
@endif
```
Além das diretivas condicionais já discutidas, as diretivas @isset e @empty podem ser usadas como atalhos convenientes para suas respectivas funções PHP:

```HTML
@isset($records)
    // $records is defined and is not null...
@endisset

@empty($records)
    // $records is "empty"...
@endempty
```
## Loops

Além das declarações condicionais, a Blade fornece diretrizes simples para trabalhar com as estruturas de loop do PHP. Mais uma vez, cada uma dessas diretivas funciona de forma idêntica às suas partes equivalentes de PHP:

```HTML
@for ($i = 0; $i < 10; $i++)
    The current value is {{ $i }}
@endfor

@foreach ($users as $user)
    <p>This is user {{ $user->id }}</p>
@endforeach

@forelse ($users as $user)
    <li>{{ $user->name }}</li>
@empty
    <p>No users</p>
@endforelse

@while (true)
    <p>I'm looping forever.</p>
@endwhile
```
Ao usar loops, você também pode terminar o loop ou ignorar a iteração atual:

```HTML
@foreach ($users as $user)
    @if ($user->type == 1)
        @continue
    @endif

    <li>{{ $user->name }}</li>

    @if ($user->number == 5)
        @break
    @endif
@endforeach
```

## Comentários no código

O Blade também permite que você defina comentários em suas visualizações. No entanto, ao contrário dos comentários HTML, os comentários da Blade não estão incluídos no HTML retornado pelo seu aplicativo:

```PHP
{{-- This comment will not be present in the rendered HTML --}}
```
## Tag para iniciar uma sequência de códigos PHP puro

Em algumas situações, é útil inserir o código PHP em suas visualizações. Você pode usar a diretiva Blade @php para executar um bloco de PHP simples no seu modelo:

```HTML
@php
    //
@endphp
```

## Incluindo Sub-Views

```HTML
<div>
    @include('shared.errors')

    <form>
        <!-- Form Contents -->
    </form>
</div>
```
# Validações

O Laravel oferece várias abordagens diferentes para validar os dados recebidos do seu aplicativo. Por padrão, a classe de controlador base da Laravel usa uma característica **ValidatesRequests** que fornece um método conveniente para validar solicitação HTTP recebida com uma variedade de poderosas regras de validação.

## Definindo as rotas

Primeiro temos que definir as rotas:

```PHP
Route::get('post/create', 'PostController@create');

Route::post('post', 'PostController@store');
```

> A rota GET exibirá um formulário para o usuário criar uma nova postagem no blog, enquanto a rota POST irá armazenar a nova postagem do blog no banco de dados.

## Criando o Controller

Em seguida, vamos dar uma olhada em um controlador simples que lida com essas rotas. Deixaremos os métodos vazios por enquanto:

```PHP
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PostController extends Controller
{
    /**
     * Show the form to create a new blog post.
     *
     * @return Response
     */
    public function create()
    {
        return view('post.create');
    }

    /**
     * Store a new blog post.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        // Validate and store the blog post...
    }
}
```

Agora, estamos prontos para preencher o nosso método **store** com a lógica para validar a nova postagem do blog. Se você examinar a classe de controlador base **( App\Http\Controllers\Controller )** do seu aplicativo, você verá que a classe usa uma característica **ValidatesRequests**. Essa característica fornece um método de validação conveniente para todos os seus controladores.

Para obter uma melhor compreensão do método de validação, vamos voltar para o método store:

```PHP
public function store(Request $request)
{
    $this->validate($request, [
        'title' => 'required|unique:posts|max:255',
        'body' => 'required',
    ]);

    // The blog post is valid, store in database...
}
```

Como você pode ver, simplesmente passamos a solicitação HTTP recebida e as regras de validação desejadas para o método validado. Novamente, se a validação falhar, a resposta adequada será gerada automaticamente. Se a validação for passada, nosso controlador continuará executando normalmente.

### Parando na primeira falha de validação

Às vezes, você pode querer parar de executar as regras de validação em um atributo após a primeira falha de validação. Para fazer isso, atribua a regra de fiança ao atributo:

```PHP
'title' => 'bail|unique:posts|max:255',
```

### Sobre atributos aninhados

Se sua solicitação HTTP contiver parâmetros "aninhados", você pode especificá-los em suas regras de validação usando a sintaxe "ponto":

```PHP
$this->validate($request, [
    'title' => 'required|unique:posts|max:255',
    'author.name' => 'required',
    'author.description' => 'required',
]);
```

### Exibindo os erros de validação

Então, e se os parâmetros de solicitação recebidos não passarem nas regras de validação fornecidas? Como mencionado anteriormente, o Laravel redirecionará automaticamente o usuário de volta para sua localização anterior. Além disso, todos os erros de validação serão automaticamente ativados para a sessão.

Agora vamos criar nossa view para testar o controller e nossas rotas, lembrando que o usuário será redirecionado para o método de criação do nosso controlador quando a validação falhar, permitindo que exibamos as mensagens de erro na visualização:

```HTML
<!-- /resources/views/post/create.blade.php -->

<h1>Create Post</h1>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<!-- Create Post Form -->
```
# Migrations

As migrações são como controle de versão para o seu banco de dados, permitindo que sua equipe facilmente modifique e compartilhe o esquema do banco de dados do aplicativo. As migrações geralmente são combinadas com o construtor de esquema do Laravel para criar facilmente o esquema de banco de dados do aplicativo. Se você já teve que dizer a um colega de equipe para adicionar manualmente uma coluna ao seu esquema de banco de dados local, você enfrentou o problema que as migrações de banco de dados resolvem.

# Gerando as Migrações

Para criar uma migration usamos o comando do artisan:

```PHP
php artisan make:migration create_users_table
```
A nova migração será colocada no seu **database/migrations**. Cada nome de arquivo de migração contém um identificador de data / hora que permite que Laravel determine a ordem das migrações.

# Subindo Migrações

Para executar todas as migrações, digite:

```PHP
php artisan migrate
```
## Forçando as migrações a subirem para produção

Algumas operações de migração são destrutivas, o que significa que elas podem fazer com que você perca dados. Para protegê-lo de executar esses comandos em seu banco de dados de produção, você será solicitado a confirmar antes de os comandos serem executados. Para forçar os comandos a serem executados sem um prompt, use o sinalizador --force:

```PHP
php artisan migrate --force
```
## Usando o Rollback

Para reverter a última operação de migração, você pode usar o comando rollback. Este comando reverte o último "lote" de migrações, que pode incluir vários arquivos de migração:

```PHP
php artisan migrate:rollback
```

Você pode reverter um número limitado de migrações fornecendo a opção de etapa para o comando rollback. Por exemplo, o seguinte comando irá reverter as últimas cinco migrações:

```PHP
php artisan migrate:rollback --step=5
```

O comando migrate:reset irá reverter todas as migrações do seu aplicativo:

```PHP
php artisan migrate:reset
```

## Rollback e Migrate em um único comando

O comando migrate:refresh reverterá todas as suas migrações e, em seguida, executará o comando migrate. Esse comando efetivamente recria o banco de dados inteiro:

```PHP
php artisan migrate:refresh --seed
```

# Criando Tabelas

Para criar uma nova tabela de banco de dados, use o método **create** na **Schema**. O método **create** aceita dois argumentos. O primeiro é o nome da tabela, enquanto o segundo é um **Closure** que recebe um objeto **Blueprint** que pode ser usado para definir a nova tabela:

```PHP
Schema::create('users', function (Blueprint $table) {
    $table->increments('id');
});
```

## Verificando se existe uma Tabela ou uma Coluna

É possível verificarmos se existe uma tabela ou coluna com um determinado nome:

```PHP
if (Schema::hasTable('users')) {
    //
}

if (Schema::hasColumn('users', 'email')) {
    //
}
```
## Motor de Conexão e Armazenamento

Se você quiser executar uma operação de Schema em uma conexão de banco de dados que não é sua conexão padrão, use o método de conexão:

```PHP
Schema::connection('foo')->create('users', function (Blueprint $table) {
    $table->increments('id');
});
```

Você pode usar a propriedade engine no construtor de esquema para definir o mecanismo de armazenamento da tabela:

```PHP
Schema::create('users', function (Blueprint $table) {
    $table->engine = 'InnoDB';

    $table->increments('id');
});
```

## Método Renaming

Para renomear uma tabela de banco de dados existente, use o método renomear:

```PHP
Schema::rename($from, $to);
```

## Tipos de colunas disponíveis no Laravel

Dentro das nossas tabelas podemos declarar os atributos e os seus tipos que existirá na tabela, [Clique aqui](https://laravel.com/docs/5.4/migrations#creating-columns) e veja a lista dos tipos.

## Modicando Colunas

As vezes precisamos alterar uma das colunas, como por exemplo o tamanho de um atributo nome. O Laravel é incrivel fazendo isso com o doctrine/dbal, basta instalar em nossas dependencias:

```PHP
composer require doctrine/dbal
```

### Alterando um atributo

O método change permite que você modifique alguns tipos de colunas existentes para um novo tipo ou modifique os atributos da coluna. Por exemplo, você pode aumentar o tamanho de uma coluna de string. Para ver o método de mudança em ação, vamos aumentar o tamanho da coluna do nome de 25 para 50:

```PHP
Schema::table('users', function (Blueprint $table) {
    $table->string('name', 50)->change();
});
```

Podemos também deixar o tipo de um atributo null:

```PHP
Schema::table('users', function (Blueprint $table) {
    $table->string('name', 50)->nullable()->change();
});
```

# Eloquent ORM

O **Eloquent ORM** incluído com o Laravel fornece uma implementação **ActiveRecord** simples, para trabalhar com seu banco de dados. 
Cada tabela de banco de dados tem um "Model" correspondente que é usado para interagir com essa tabela. Models permitem consultar dados em suas tabelas, bem como inserir novos registros na tabela. 

Antes de começar, certifique-se de configurar uma conexão de banco de dados em **config/database.php**.

## Definindo Models

Para começar, vamos criar um Eloquent Model. Os Models por padrão fica em **APP**, mas você pode colocá-los em qualquer lugar que possa ser carregado automaticamente de acordo com seu arquivo composer.json. Todos os models Eloquent estendem de **Illuminate\Database\Eloquent\Model**.

A maneira mais fácil de criar uma instância de modelo é usando o **make:model** do Artisan:

```PHP
php artisan make:model User
```

É possível criar uma migração ao criar o model, basta digitar no final **--migration** ou **-**:

```PHP
php artisan make:model User -m
```
## Convenções do Eloquent Model

Agora, vejamos um exemplo de modelo, que usaremos para recuperar e armazenar informações da nossa tabela de banco de dados de users:

```PHP
<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    //
}
```

### Nome de Tabelas

Observe que não dissemos ao Eloquent qual tabela usar para o modelo de User. Por convenção, o nome plural da classe será usado como o nome da tabela, a menos que outro nome esteja explicitamente especificado. Então, neste caso, o Eloquent assumirá os registros das lojas do modelo User na tabela. Você pode especificar uma tabela personalizada definindo uma propriedade de tabela em seu modelo:

```PHP
<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'my_users';
}
```
### Adicionando adicionais

O método **all** retornará todos os resultados na tabela do modelo. Uma vez que cada modelo Eloquent serve como um construtor de consultas, você também pode adicionar restrições às consultas e, em seguida, usar o método **get** para recuperar os resultados:

```PHP
$user = App\User::where('active', 1)
               ->orderBy('name', 'desc')
               ->take(10)
               ->get();
```

> Através do código iremos explorar melhor os métodos e como funciona o CRUD no controller

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

