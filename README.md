# travel-compensation
Symfony CLI application to create a CSV report of monthly travel compensation by employee.

## Pre-requisites
* Docker
* Local PHP 8.2 installation

## Installation
```sh
   docker compose up -d
   composer install
   bin/console doctrine:database:create
   bin/console doctrine:migration:migrate
   bin/console doctrine:fixtures:load -n
```
## Run
```sh
   bin/console app:create-compensation-report
```
