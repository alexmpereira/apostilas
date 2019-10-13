# Instalando Laravel via composer

- Pelo próprio composer, vamos instalar o Laravel, digitando o seguinte comando:

```PHP
composer global require "laravel/installer"
```

- E para criar um projeto de teste, digite apenas o comando abaixo:

```PHP
laravel new blog
```

- Podemos especificar a versão que queremos do Laravel

```PHP
composer create-project laravel/laravel blog "5.6.*"
```

## Rodando o projeto inicial

Acesse através do terminal o projeto criado e digite o comando abaixo:

```PHP
php artisan serve
```
