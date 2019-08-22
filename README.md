# phprotocol
Gestão de chamados baseado no [Slim-Born do HavenShen](https://github.com/HavenShen/slim-born)


## Installing
Import slimborn_2016-04-19.sql into your Database, creates you .env file based on .env.example. Run:
```sh
composer install
```


## Running
```sh
php -S 0.0.0.0:8888 -t public public/index.php
```


## Testing
```sh
composer test
```