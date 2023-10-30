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
After MariaDB install
```shell
su
mysql -u root -p
```
```sql
GRANT ALL PRIVILEGES on *.* to 'root'@'localhost' IDENTIFIED BY 'root';
```
```sql
CREATE USER IF NOT EXISTS buildingexaminator@localhost IDENTIFIED BY 'buildingexaminator';
GRANT ALL PRIVILEGES ON buildingexaminator.* TO 'buildingexaminator'@'localhost' IDENTIFIED BY 'buildingexaminator';
FLUSH PRIVILEGES;
CREATE DATABASE buildingexaminator;
```
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
git clone git@github.com:davidhigler/buildingexaminator.git www
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
  && php bin/console doctrine:fixtures:load --no-interaction \
  && php bin/console doctrine:migrations:migrate --no-interaction \
  && php bin/console cache:clear
```
```shell
PHP_IDE_CONFIG="serverName=localhost" php bin/console doctrine:database:drop --force && php bin/console doctrine:database:create && php bin/console doctrine:schema:create && php bin/console doctrine:fixtures:load --no-interaction && php bin/console doctrine:migrations:migrate --no-interaction && php bin/console cache:clear
```

### Translations
```
php bin/console translation:extract --config=app nl
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

#### Database
To dump on VPS
```
mysqldump --user=root --password=<password> --add-drop-table buildingexaminator > ~/www/data/database/buildingexaminator.sql
```
and get it to local
```
scp buildingexaminator@5.157.83.198:~/www/data/database/buildingexaminator.sql ~/dobro/buildingexaminator/data/database/buildingexaminator.sql
mysql --user=buildingexaminator --password=buildingexaminator --database=test
source ~/dobro/buildingexaminator/data/database/buildingexaminator.sql;
```

#### SSL cert
SCP the needed check file to the VPS
```
scp ZnY941Yap2WijAIiVhc-kTg6Lx-g869xMmw9T3uIxVk buildingexaminator@5.157.83.198:~/www/public/.well-known/acme-challenge/ZnY941Yap2WijAIiVhc-kTg6Lx-g869xMmw9T3uIxVk
```
Changing the certificates
```
nano /etc/ssl/private/buildingexaminator.nl.crt
nano /etc/ssl/private/buildingexaminator.nl.key
```