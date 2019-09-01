# PSR

As PSR (_PHP Standards Recommendation_), são recomendações de padrão para desenvolvimento em PHP.

Muitos dizem que o PHP não existe padrão de desenvolvimento comparado com o Java por exemplo, mas existe e são as PSRs construidas e mantidas pelo grupo [PHP-FIG](https://www.php-fig.org/).

Apartir do momento que começamos a utilizar uma PSR, começa ser obrigatório o uso de padrões em nomes de funções, nomes de classes, nomes de variáveis, entre outros que são muito utilizados em projetos orientados a objetos.

As PSRs são interfaces:

> "Uma interface serve para informar um conjunto de métodos e atributos que DEVEM ser implementados em uma classe, isso vai garantir que ela tenha o que é necessário para que funcione ao ser usada com outros objetos (classes)"

As PSRs são númeradas e cada uma determina um padrão a ser seguido, vejamos alguns desses padrões:

## PSR-1

1. Os arquivos devem começar com ``` <?php ``` ou ``` <?= ```;
2. Os arquivos devem conter UTF-8 para arquivos PHP;
3. Um arquivo PHP deve conter apenas classes, functions, constants, etc;
4. As **classes** e os **namespaces** devem seguir o padrão **autoloading** da _PSR-4_ (mais abaixo a explicação);
5. Nomes de classes DEVEM ser declaradas em StudlyCaps;
6. As constantes de classe DEVEM ser declaradas em maiúsculas;
7. Os nomes dos métodos DEVEM ser declarados no camelCase.

<hr>

## PSR-2

1. Seguir os padrões da PSR-1;
3. Em cada linha deve conter no máximo 80 caracteres ou menos;
4. Após as declarações de **namespaces** ou **use** deve haver uma linha em branco;

<hr>

## PSR-3

Em resumo a PSR-3 é sugerida uma especificaçao para as interfaces de Logs dentro de uma aplicação.

<hr>

## PSR-4

Na PSR-4 é sugerida uma implementação de autoload, com posições de chaves, identações etc.

<hr>

## PSR-7

Atualmente a PSR-7 é muito usada para especificar como você deve organizar o código quando ha um request, response, upload. São utilizadas por exemplo em criações de API, com os métodos GET, POST, PUT e DELETE.

## Resumo

Acima citei os mais utilizados atualmente, porém existem muitos outros que facilitam o desenolvimento em projetos com pequenas e grandes equipes, pois as PSRs servem para mantermos um único padrão de desenvolvimento PHP. Para ver todas as PSRs que estão sendo usadas acesse o site oficial da [PHP-FIG](https://www.php-fig.org/psr/).