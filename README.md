# Agenda de contatos

### Instalação

```sh
$ git clone https://github.com/BrenoHM/contacts.git
$ cd contacts
$ composer install
$ cp .env.example .env #para configuração do banco de dados
$ php artisan migrate:fresh --seed #criação das tabelas
$ npm install
$ npm run production
```

### Start servidor

```sh
$ php artisan serve #Acesse http://127.0.0.1:8000
```