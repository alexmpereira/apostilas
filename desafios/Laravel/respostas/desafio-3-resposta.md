1. Criando migration e model: **php artisan make:model Produto --migration**
2. Criando as colunas:

```PHP
  Schema::create('produtos', function (Blueprint $table) {
    $table->increments('id');
    $table->string('descricao', 250);
    $table->string('nome', 100);
    $table->integer('quantidade');
    $table->timestamps();
  });
```

3. Configurando o model

```PHP
  use SoftDeletes;

  public $table = 'produtos';

  const CREATED_AT = 'created_at';
  const UPDATED_AT = 'updated_at';

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
      'nome', 'descricao', 'quantidade',
  ];
```

4. Atualizando o banco: **php artisan migrate:refresh**