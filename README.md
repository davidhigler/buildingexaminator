# Building Examinator

This is an API that serves as backend for possible multiple frontends.

It provides management of a complete housing portfolio and recording / administrating of building surveys. 

## Technical information

### Git clone
```shell
git ...
```

### Composer
```shell
php bin/composer self-update
php bin/composer update
```

### Database:

#### Drop database:
```shell
php bin/console doctrine:database:drop --force
```

#### Create database:
```shell
php bin/console doctrine:database:create
```

#### Create schema:
```shell
php bin/console doctrine:schema:create
```

#### Load fixtures:
```shell
php bin/console doctrine:fixtures:load
```

#### Migrate database to latest version:
```shell
php bin/console doctrine:migrations:migrate
```

### Cache

#### Clear Symfony cache:
```shell
php bin/console cache:clear
```

### Complete rebuild

#### Rebuild database (BEWARE, DANGEROUS, TOTAL DATA LOSS):
```shell
php bin/console doctrine:database:drop --force \
  && php bin/console doctrine:database:create \
  && php bin/console doctrine:schema:create \
  && php bin/console doctrine:fixtures:load \
  && php bin/console doctrine:migrations:migrate \
  && php bin/console cache:clear
```

### Open Api

#### Generate OpenApi Yaml file
documentation/postman/buildingexaminator/v1/openapi.yaml

Library "zircote/swagger-php" is used for this.
[Swagger-PHP v3.x](https://zircote.github.io/swagger-php/Getting-started.html)
```shell
php bin/openapi
```

### Development information

#### Running things under Xampp

```shell
/c/xampp/php/php.exe bin/composer install
/c/xampp/php/php.exe bin/console doctrine:database:create
/c/xampp/php/php.exe bin/console doctrine:schema:create
/c/xampp/php/php.exe bin/console doctrine:fixtures:load
/c/xampp/php/php.exe bin/console cache:clear

/c/xampp/php/php.exe bin/composer require symfony/rate-limiter
```
