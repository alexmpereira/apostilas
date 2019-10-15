# Validações de dados via Request

O Laravel é extremamente poderoso para validação de dados, ele possui uma série de regras prontas que podemos usar para validar as informações de entrada da nossa aplicação. Além disso, é possível facilmente criar novas regras usando expressões regulares ou até mesmo suas próprias classes de validação envolvendo regras de negocio. Na documentação é possível consultar todas as regras disponíveis em: https://laravel.com/docs/5.5/validation#available-validation-rules

Veja um exemplo como podemos tratar em nossa função store os valores que é recebido de um formulário
```PHP
public function store(Request $request)
{
  $request->validate([
    'name' => ['required', 'max:100', 'min:3'],
  ]);
}
```

# Usando a classe Validator

```PHP
use Validator;

public function update(Request $request, $id)
{
  Validator::make(
    $request->all(),
    [
      'name' => ['required', 'max:100', 'min:3'],
      'email' => ['required', 'email', 'unique:clients'],
      'email' => ['required', 'integer'],
      'email' => ['mimes:jpeg,bmp,png'],
    ]
  )->validate();
}
```

