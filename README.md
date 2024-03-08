
## Inventory Demo

A take home project for an undisclosed employment opportunity. 

## How to access

A demo of this site is available [here](#)

There's two users by default with the following user id / password:
* admin@example.com / password
* user@example.com / password

Obviously, the admin have more privileges than the user. 

## Local setup

If you want to deploy in your own environment for testing / improvements, you can follow these steps

### Requirements

* php 8.2
* latest npm package

### Cloning 

* the idea is to clone this git repo, install Laravel, the npm packages and run

.env file is the usual [Laravel environment file](https://github.com/platformsh-templates/laravel/blob/master/.env.example) but with the following changes

```
DB_CONNECTION=sqlite 
#DB_HOST=127.0.0.1
#DB_PORT=3306
#DB_DATABASE=laravel
#DB_USERNAME=root
#DB_PASSWORD=
```

* run the following commands to get all the necessary package

```
git clone https://github.com/erwinkarim/inventory-demo
cd inventory-demo
composer install
php artisan db:migrate
php artisan db:seed
npm install
```

* run these commands in seperate terminals to run the dev server

```
php artisan server
npm run serve
```