## Utilizando Views no Laravel

Dentro da pasta de **resource** existe uma pasta chamada _view_, é nessa pasta que são criada as views da aplicação.

Dentro da função de rotas, podemos passar os valores para a view, por exemplo:

```PHP
Route::get('create/new', function(){
  return view('clients_form');
})
```

> Dessa forma se acessarmos na URL create/new vamos ser direcionado para o arquivo clients_form que fica nas views.

## Blade

O Laravel conta com um template engine chamado Blade (uma alusão ao Razor do ASP.net MVC). Ele tem como objetivo simplificar nossa experiência ao criar layouts simples ou mais complexos.

Com ele evitamos utilizar o PHP dentro do HTML, veja um exemplo do HTML em com PHP:

```HTML
<!DOCTYPE html>
<html>
  <head>
    <meta charset='UTF-8'>
    <title>Curso</title>
  </head>
  <body>
    <h1>Lista de Clientes</h1>
    <ul>
    <?php foreach ($clientes as $cliente): ?>
      <li><?php echo $cliente->nome; ?></li>
      <?php if($cliente->idade > 18): ?>
        <li><?php echo $cliente->conteudo; ?></li>
      <?php endif; ?>
    <?php endforeach; ?>
    </ul>
  </body>
</html>
```

Agora vamos ver o mesmo HTML com a sintaxe blade:

```HTML
<!DOCTYPE html>
<html>
  <head>
    <meta charset='UTF-8'>
    <title>Curso</title>
  </head>
  <body>
    <h1>Lista de Clientes</h1>
    <ul>
    @foreach ($clientes as $cliente)
      <li>{{ $cliente->nome }}</li>
      @if ($cliente->idade > 18)
        <li>{{ $cliente->conteudo; }}</li>
      @endif
    @endforeach
    </ul>
  </body>
</html>
```
> Temos uma sintaxe muito mais expressiva que facilita o entendimento do arquivo 

## Sintaxe Básica

Documentação do blade: https://laravel.com/docs/5.8/blade

## Passando dados para View

Para passarmos valores da função para as views, como segundo parâmetro do método _view_ basta declarmos os valores que o front deve receber:

```PHP
Route::get('create/new', function(){

  $client = 'Burnes';
  $group = 'Alfa';

  return view('clients_form', compact('client', 'group')); //usamos o compact para passar mais de um valor
})
```

# Estruturas de controle

Você pode construir instruções usando as diretivas **@if**, **@elseif**, **@else** e **@endif**. Essas diretivas funcionam de forma idêntica às suas partes equivalentes de PHP:

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

# Loops

Além das declarações condicionais, a Blade fornece diretrizes simples para trabalhar com as estruturas de loop do PHP. Mais uma vez, cada uma dessas diretivas funciona de forma idêntica às suas partes equivalentes de PHP:

```HTML
  @for ($i = 0; $i < 10; $i++)
      The current value is {{ $i }}
  @endfor

  @foreach ($users as $user)
      <p>This is user {{ $user->id }}</p>
  @endforeach

  @while (true)
      <p>I'm looping forever.</p>
  @endwhile
```