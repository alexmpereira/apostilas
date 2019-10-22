# Autenticação e Autorização

## Autenticação e autorização?

Os dois processos fazem parte da segurança da aplicação.

-  Autenticação: podemos falar basicamente que é o login na nossa aplicação. Trata-se da etapa de verificação se um determinado usuário possui credenciais (geralmente, combinação de login e senha) válidas para acessar uma determinada aplicação. É aqui que verificamos se as credenciais do usuário são válidas;

- Autorização: é um processo posterior à autenticação. É o momento onde a aplicação deve verificar se o usuário atualmente autenticado tem permissão para acessar um determinado recurso. Por exemplo: um usuário que seja mais básico e não pode acessar a área de cadastros de sua aplicação, pois ele não possui nível suficiente para acessar tal funcionalidade. É aqui que verificamos se as credenciais do usuário que já foi validado dão permissão para acessar uma funcionalidade.

## Habilitando o sistema de autenticação padrão do Laravel:

```PHP
  php artisan make:auth
```