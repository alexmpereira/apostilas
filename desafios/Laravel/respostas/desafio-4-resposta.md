1. Criando o grupo de rotas

```PHP
Route::prefix('produtos')->group(function(){
  Route::get('{id}', function ($id) {
    //
  });
  Route::put('{id}', function ($id) {
    //
  });
});
```