# Building Examinator

This is an API that serves as backend for possible multiple frontends.

It provides management of a complete housing portfolio and recording / administrating of building surveys.

# Requirements
- PHP 8.0 of hoger
  - pdo_mysql
  - redis
- MySql server 8.0 of hoger
- Redis server 6.2 of hoger

# Usage

## Configuration

### MySql
For the config of the MySql server look in the .env file in the root of the project
```shell
DATABASE_URL="mysql://<username>:<password>@<host>:<port>/<database>?serverVersion=8.0"
```

### Redis
For config of caching in redis look in the file config/packages/cache.yaml
```shell
default_redis_provider: redis://<host>:<port>
```

## Technical information

### Git clone
```shell
git ...
```

### Composer
```shell
php bin/composer self-update
php bin/composer install
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
```shell
php bin/console doctrine:database:drop --force && php bin/console doctrine:database:create && php bin/console doctrine:schema:create && php bin/console doctrine:fixtures:load && php bin/console doctrine:migrations:migrate && php bin/console cache:clear
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

#### Rate limiter
The configuration of the rate-limiter in done in:
```shell
config/packages/rate_limiter.yaml
```
And for specific routes adhering to specific rate limits look at:
```shell
src/EventSubscriber/RateLimiterEventSubscriber.php
```