<h1 align="center">
Desafio Objective
</h1>

<p align="center">Este projeto foi desenvolvido exclusivamente para teste de conhecimento técnico</p>

<p align="center">
  <a href="https://github.com/leandrogoncalves/nestjs_smartranking_api/graphs/contributors">
    <img src="https://img.shields.io/github/contributors/leandrogoncalves/nestjs_smartranking_api?color=%237159c1&logoColor=%237159c1&style=flat" alt="Contributors">
  </a>
  <a href="https://opensource.org/licenses/MIT">
    <img src="https://img.shields.io/github/license/leandrogoncalves/nestjs_smartranking_api?color=%237159c1&logo=mit" alt="License">
  </a>
</p>

<hr>

## Participantes

| [<img src="https://avatars.githubusercontent.com/u/52003225?s=400&u=d6d93340972dbe78059bb8cbd0144f61e6645cf3&v=4" width="75px;"/>](https://github.com/sergiohss) |
| :----------------------------------------------------------------------------------------------------------------------------------------------------------------------: |

| [Sérgio Henrique](https://github.com/sergiohss)


## Dependências

- Docker: 27.0.3
- Docker-compose: 2.28.1
- PHP : 8.3
- Laravel : 11.20

# Tutorial de para inicialização do projeto

### Passo a passo
Clone Repositório
```sh
git clone https://github.com/sergiohss/objective.git
```

Copie o Arquivo .env 
```sh
cp .env.example .env
```

Suba os containers do projeto
```sh
docker-compose up -d
```

Acessar o container
```sh
docker-compose exec app bash
```

Instalar as dependências do projeto
```sh
composer install
```

Gerar a key do projeto Laravel
```sh
php artisan key:generate
```

Rodar as migrations para criação das tabelas no DB
```sh
php artisan migrate
```

Rodar as sedeers para criação de contas fake
```sh
php artisan db:seed
```

## Documentação

- Acesse http://localhost:9191/api/documentation


## Testes

Acessar o container
```sh
docker-compose exec app bash
```

Acessar o comando 
```sh
php artisan test
```



Acessar o projeto
[http://localhost:8989](http://localhost:9191)

