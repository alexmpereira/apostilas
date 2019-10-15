# o problema da impedância dos dados

Frameworks ORM tentam reduzir o tamanho do trabalho que temos ao nos conectar principalmente com bases de dados relacionais. Com estes frameworks, o programador reduz a programação de acesso ao banco de dados, obtendo produtividade significativa no desenvolvimento do sistema. Esse efeito é atingido porque os frameworks ORM auxiliam no processo de mitigação da impedância.

Quando desenvolvemos um programa que segue o padrão de orientação a objetos, o foco é criar estruturas que possibilitem a representação do mundo real dentro das linhas de código de um projeto de software. Mas, falamos de banco de dados geralmente as aplicações utilizando o paradigma relacional onde o foco é entre as relações das entidades e consistência das informações. Sendo assim, o modelo orientado a objetos não é compatível naturalmente com o modelo relacional, exigindo um esforço de conversão do modelo orientado a objetos para o modelo relacional e vice-versa. Isso chamamos de impedância objeto-relacional.

Alguns problemas característicos da impedância são:
- Diferença entre tipos;
- Há uma grande diferença com relação à integridade de dados entre o modelo relacional e o modelo orientado a objetos;
- O modelo orientado a objetos lida com classes, interfaces, herança e por aí vai. O modelo relacional não oferece esse tipo de estrutura.

Sendo assim, é necessário fazer a conversão do modelo relacional para o modelo orientado a objetos quando nossa aplicação lê informações de um banco de dados e vice-versa quando nossas aplicações enviam informações para um banco de dados. E é justamente nessa conversão que os frameworks ORM oferecem uma valiosa ajuda.

# Eloquent

O Eloquent um poderoso ORM que implementa o modelo Active Record. Atualmente ele suporta MySQL, SQLite, Postgres e SQL Server e permite que nossa aplicação se comunique com esses bancos sem a necessidade de utilizar queries SQL.

O Eloquent possui diversos recursos que facilitam a comunicação com banco de dados no Laravel. A principal vantagem dele é a facilidade, não são necessárias diversas configurações como começar a trabalhar com a ferramenta. Até mesmo o mapeamento das tabelas do banco de dados para entidade é feito automaticamente.

O Eloquent segue algumas convenções para mapear as tabelas do nosso banco de dados para entidades:
- O model se refere a tabela transformando o nome do model no plural, em snake_case. Por exemplo, um model chamado CustomerAccount irá buscar informações na tabela customer_accounts.
- A tabela tem como chave primária um campo id.
- Ele utiliza duas colunas do tipo timestamp com nome created_at e updated_at para guardar a data de inclusão e alteração do registro.

# Migrations

As migrations são arquivos que criamos dentro do nosso projeto que são responsáveis por criar a estrutura de tabelas do banco de dados. Podemos gerar migrations para criar ou alterar a estrutura das tabelas.

As migrations permitem que ao instalar o sistema para um novo cliente ou até mesmo na máquina de um novo desenvolvedor seja possível chegar a estrutura atual do banco de dados sem a necessidade de exportar a estrutura do banco de dados de um local existente.

Outra grande vantagem é quando trabalhamos em equipe. Vamos supor que tenha feito uma alteração na tabela X, ou que tenha criado uma nova tabela, seria necessário avisar e mandar o script SQL para todos os membros. Com as migrations, basta ele executar um comando e terá a estrutura igual do seu banco.

Comando para criar uma migration:

```PHP
php artisan make:migration create_clients_table
```

> É uma conversão do Laravel escrevermos o nome da migration dessa forma **create_clients_table**

Dentro da classe que é criada podemos declarar novas colunas informando os tipos, podemos consultar todos os tipos possiveis na própria documentação: https://laravel.com/docs/5.8/migrations#creating-columns

#### Executando as migrations

```PHP
php artisan migrate
```

O comando acima será responsável por executar as classes que estiverem localizadas no pacote **migration/database/migrations/**, e caso não seja identificado nenhum erro será criada as tabelas na base de dados que a aplicação estiver conectada _(configuradas no .env)_.

# Trabalhando com Models

O nome dos Models devem ser por padrão declarado em modo singular para que a entidade seja lida corretamente para a migration.

Para criar uma nova model, digite o comando:

```PHP
php artisan make:model Client
```

#### Bonus

Para criar o model e a migration no mesmo comando via terminal, digite:

```PHP
php artisan make:model Client -m
```

#### Trabalhando com o tinker

Podemos realizar consultas no banco de dados dinâmicamente, sem precisar ficar abrindo outros programas para verificar a tabela. O laravel vem configurado o Tinker uma ferramenta poderosa para facilidade.

Para executar o tinker, dentro do terminal digite:

```PHP
php artisan tinker
```

Quando estiver executando o tinker, podemos criar instãncias e através dessas instâncias podemos trabalhar com banco de dados.

```PHP
  $burnes = new App\Client //criando instância do model Client
  $burnes->name = "Burnes" //setando valores
  $burnes->email = "burnes@alfa.com.br"
  $burnes->age = 19

  $burnes->save() //gravando usuário burnes no banco
```

Além de gravar podemos realizar consultas:

```PHP
  $burnesDB = App\Client::find(1)//realiza a consulta do usuário no banco

  $burnesDB->name = "Burnesss" //seta um novo valor
  $burnesDB->save() //realiza a atualização no banco de dados
```

Buscar todos os clientes da tabela

```PHP
  $dB = App\Client::get() //busca todos os clientes
```

Remover dados do banco

```PHP
  $data = App\Client::find(1)
  $data->delete()
```
