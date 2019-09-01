## Para que serve os seeds?

Os seeds serve para alimentar um determinado dado no banco de forma automática, ou seja, quando inicializarmos a nossa aplicação esses dados irão popular nosso banco de dados automaticamente.

Dentro da pasta **database** existe uma pasta **seeds**, vamos imaginar que temos uma entidade Produto e queremos alimentar essa entidade assim que nossa aplicação for rodada. Vamos criar um seed chamado **ProdutoTableSeeder**

```PHP
<?php
    use Illuminate\Database\Seeder;
    use App\Produto;

    class ProdutoTableSeeder extends Seeder
    {
        public function run()
        {
            DB::table('produtos')->truncate();

            Produto::create([
                'nome' => 'Nome de teste',
                'descricao' => 'Descricao do produto'
            ]);
        }
    }
```

Agora devemos chamar nosso Seeder no arquivo padrão já existente chamado **DatabaseSeeder**:

```PHP
    $this->call('ProdutoTableSeeder);
```

Antes de executarmos o comando para rodar o seed devemos atualizar o nosso autoload para que essa nossa nova classe seja carregada automaticamente pelo Laravel, no console digite o seguinte comando:

```PHP
composer dump-autoload
```

Em seguida no console execute o seguinte comando:

```PHP
    php artisan db:seed
```

> Pronto, se olharmos em nossa tabela veremos nosso novo dado já cadastrado!

## Ok, mas e se eu quiser vários produtos?

Infelizmente o seed do laravel é implementado os dados manualmente, ou seja, se quisermos mais dados devemos duplicar o código várias vezes com dados diferentes. Para resolver isso vamos instalar uma biblioteca chamada **Faker**, ela serve exatamente para gerar dados fakes em nossa database.

Vamos refatorar nosso código agora usando o Faker.

Primeiro precisamos adicionar a biblioteca em nosso projeto, para isso vamos utilizar o composer, digite no console o seguinte comando:

```
    composer require fzaninotto/faker
```

Após a instalação devemos refatorar nosso seeder de produtos da seguinte forma:

```PHP
<?php
    use Illuminate\Database\Seeder;
    use App\Produto;
    user Faker\Factory as Faker;

    class ProdutoTableSeeder extends Seeder
    {
        public function run()
        {
            DB::table('produtos')->truncate();

            $faker = Faker::create();

            foreach(range(1,30) as $i) {
                Produto::create([
                    'nome' => $faker->word(),
                    'descricao' => $faker->sentence()
                ]);
            }
            
        }
    }
```
> Para saber mais sobre os tipos que podemos declarar do faker veja o repositório oficial: [Clicando aqui](https://github.com/fzaninotto/Faker)