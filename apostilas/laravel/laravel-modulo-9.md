# Middlewares

## Introdução

A partir do laravel 5.0 foi incluido as middleware.
Os middlewares são trechos de códigos que são executados antes de uma requisição atingir o núcleo da nossa aplicação **(Controllers por exemplo)**.

Elas são consideradas como camadas em nossa aplicação, para a solicitação chegar na aplicação precisa passar pela camada de middleware:

<img src="./img/camadas.png" />

Os middlewares podem ser aplicados a uma série de situações, por exemplo:
- Autenticação de usuários, 
- Proteção contra CSRF (Cross-Site Request Forgery),
- Encriptação de cookies

Todos esses middlewares já são aplicados em nosso sistema e eles estão listados em **app/http/Kernel.php**

A classe Kernel possui três propriedades: $middleware, $middlewareGroups e $routeMiddleware. Eles são usados do seguinte modo:

- $middlewaree – Os middlewares cadastrados nessa propriedade são executados em todas as requisições;
- $routeMiddleware – Os middlewares cadastrados nessa propriedade precisam ser indicados na rota ou no controlador para ser aplicado;
- $middlewareGroups – Permite criar grupos de middlewares que podem ser aplicados a rotas ou controladores.

## Comando para criar middlewares:
```PHP
  php artisan make:middleware CheckTasks
```

