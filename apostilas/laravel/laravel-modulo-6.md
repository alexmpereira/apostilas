# Introdução

O principal objetivo do controller é fazer a comunicação entre os dados que vem do Model para a View e também dados que são enviados via request para serem persistidos no Model. Um controller é composto por uma ou mais actions (ações), uma ação é representada através de um método público responsável pela lógica daquele recurso.

# Primeiro Controller

Para criar um controller digite:
```PHP
php artisan make:controller ClientController --resource
```

> O parâmetro **--resource** serve para criar os métodos padrões de um controller Laravel

# Controllers e Rotas

Na maioria dos sistemas é comum precisarmos desenvolver cadastros que contenham as 4 operações básicas. Esses cadastros geralmente são chamados de CRUD, devido a inicial das operações em inglês (Create, Read, Update e Delete). O Laravel facilita a criação desse tipo de cadastro através dos controladores e rotas chamados Resource.

1. Index – Exibe a lista de recursos
2. Show – Exibe um recurso específico
3. Create – Exibe o formulário para a criação de um novo recurso
4. Store – Faz a criação do recurso
5. Edit – Exibe o formulário de edição do recurso com os dados atualmente cadastrados
6. Update – Faz a atualização dos dados do recurso
7. Destroy – Apaga o recurso

O Laravel também possui um tipo de rota específico que contém todas as rotas necessárias para acessar os recursos de um Resource Controller. Essas rotas já são definidas para procurar pelas actions descritas acima no controlador indicado, além disso os verbos criados nela seguem as especificações do padrão RESTful.

- Para ligarmos a rota ha um controller basta substituirmos a função do segundo parâmetro onde cria as rotas pelo nome do Controller, por exemplo:

```PHP
  Route::resource('clients','ClientController')
```

> Quando usa o recurso **resource** ele liga todos os métodos HTTPs de acordo com os métodos criados automáticamente dentro do controller.

Para ligar uma rota especifico para um método do controller basta fazer da seguinte forma:

```PHP
  Route::post('clients/dividas', 'ClientController@verificaDividas')
```

Para listar todas as rotas da nossa aplicação, digite:

```PHP
php artisan route:list
```