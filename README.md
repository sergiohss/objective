
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


Acessar o projeto
[http://localhost:8989](http://localhost:9191)

