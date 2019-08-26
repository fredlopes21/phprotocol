# phprotocol
[![CircleCI](https://circleci.com/gh/lucascudo/phprotocol.svg?style=svg)](https://circleci.com/gh/lucascudo/phprotocol)


Gestão de chamados baseado no [Slim-Born do HavenShen](https://github.com/HavenShen/slim-born)


## Installing
Import slimborn_2016-04-19.sql into your Database, creates your .env file based on .env.example and run:
```sh
composer install
```


## Testing
```sh
composer test
```


## Running
```sh
php -S 0.0.0.0:8888 -t public/
```
