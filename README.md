# Projeto de estrutura de dados não lineares

## Breve explicação

Este projeto inclui uma implementação simples de árvore rubro-negra, localizada em app/Services/RedBlackTree.php.

Optou-se por desenvolver a árvore manualmente, em vez de utilizar uma biblioteca pronta visto que não foi encontrada uma biblioteca compatível.

Além disso, o projeto oferece uma implementação em array para fins de comparação.

## workflow

A requisição é recebida em routes/api.php e, em seguida, encaminhada para o método correspondente no controlador, localizado em app/Http/Controllers/ProdutoController.php.

O método do controlador aciona uma função na respectiva classe de serviço (app/Services), que é responsável por decidir se deve chamar um método da árvore rubro-negra ou uma função do array, conforme necessário.

## Requisitos

- Git;
- PHP 8.2 ou superior;
- SQLite;
- Composer PHP;
- Insomnia ou Postman;

## Como rodar o projeto

Clone o repositório:
```
git clone https://github.com/Welen1911/red_black_tree_laravel.git
```

Dentro da pasta do proejto, instale as dependências:
```
composer install
```

Copie o .env.example para .env
```
cp .env.example ./.env
```

Gere a chave de segurança:
```
php artisan key:generate
```

Criar banco de dados e rodar migrations:
```
php artisan migrate
```

Popular o banco:
```
php artisan db:seed --class=ProdutoSeeder
```

Após esse comando, aguardar ele finalizar (vai demorar uns 15 segundos).

Após os comandos acima, o projeto estará pronto para rodar com o comando:
```
php artisan serve
```

## Obs

Na raiz do projeto tem um arquivo com o nome 'Api_test.json', se trata de um arquivo Insomnia/Postman para realizar os testes da API.