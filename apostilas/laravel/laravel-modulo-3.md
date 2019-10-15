# Rotas

Quando estamos trabalhando com códigos PHP simples estamos acostumados a utilizar o nome do arquivo no nosso disco rígido diretamente no endereço do navegador.

Embora seja funcional essa forma de trabalho em projetos simples, quando utilizamos um framework MVC, o endereço que vamos requisitar para o browser não é o mesmo da estrutura de diretórios. Ao invés disso usamos rotas que indicam o que deve acontecer quando cada endereço é requisitado ao servidor.

A ideia por trás das rotas é direcionar o usuário para o recurso esperado por ele, sem expor estrutura de pastas da sua aplicação. Além da segurança dos nossos scripts não precisarem ser expostos para o público, temos a flexibilidade que precisamos para definir livremente os diretórios, arquivos e classes do nosso sistema e criar endereços livremente para acessar os recursos.

Dentro das pacote **/routes** contem 4 arquivos de configurações de rotas, as principais são a **api.php** onde declaramos nossas rotas para as apis e o arquivo **web.php** onde fazemos nossas rotas para páginas comuns de sites.

Os verbos que podemos trabalhar em nossas requisições são as seguintes:

```PHP
Route::get();     // Requisita ao servidor um recurso
Route::post();    // Envia dados para um recurso
Route::put();     // Atualiza os dados de um recurso
Route::delete();  // Deleta um recurso no servidor

// Não é um método do HTTP
Route::any();     // Aceita qualquer tipo de requisição (GET, POST, PUT, DELETE)
```

No arquivo **api.php** podemos realizar um teste, criando uma rota chamada page e incluindo um return dentro:

```PHP
Route::get('page', function(){
	return 'Hello World';
});
```

> O primeiro parâmetro é o nome da nossa rota, se digitarmos no navegador **api/page**, ele irá acessar este método que criamos!

> O segundo parâmetro fizemos uma função que retorna um Hello World, podemos colocar no lugar da função o nome do nosso controller e o método, mais pra frente vamos ver isso, por enquanto, vamos só retornar uma string.

# Proteção CSRF

Qualquer formulário HTML que aponte para as rotas POST, PUT ou DELETE que são definidas no arquivo de rotas da Web deve incluir um campo token CSRF. Caso contrário, o pedido será rejeitado. Veja um exemplo prático que deve ser incluso no HTML:

```PHP
<form method="POST" action="/profile">
    {{ csrf_field() }}
    ...
</form>
```

# Parâmetros para as rotas

Muitas vezes vamos precisar criar rotas que precisaremos pegar identificação _(conhecido como id, no banco de dados)_ de um usuário, produto etc... 
Para isso é necessário passarmos na rota um parâmetro, por exemplo:

```PHP
Route::get('page/{id}', function ($id) {
    return 'User '.$id;
});
```

# Restrição com Expressão Regular nas rotas

Podemos precisar restringir alguns caracteres nas nossas rotas, podemos usar expressões regulares para isto, com o método **where** podemos ter essa liberdade para criar nossas regras de caracteres dentro das rotas.

```PHP
Route::get('user/{id}', function ($id) {
    //
})->where('id', '[0-9]+');
```
> Nesse exemplo o id é aceito somente números.

# Grupos de Rotas

Os grupos de rotas permitem que você compartilhe atributos para diferentes rotas.
Os atributos compartilhados são especificados em um formato de matriz como o primeiro parâmetro para o método Route::group

```PHP
Route::prefix('users')->group(function(){
  Route::get('{id}', function ($id) {
    //
  });
  Route::put('{id}', function ($id) {
    //
  });
});
```