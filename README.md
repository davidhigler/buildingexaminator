# Building Examinator

# Techical information

Drop database:
```shell
php bin/console doctrine:database:drop --force
```

Create database:
```shell
php bin/console doctrine:database:create
```

Create schema:
```shell
php bin/console doctrine:schema:create
```

Load fixtures:
```shell
php bin/console doctrine:fixtures:load
```

Migrate database to latest version:
```shell
php bin/console doctrine:migrations:migrate
```

Clear Symfony cache:
```shell
php bin/console cache:clear
```

Rebuild database (BEWARE, DANGEROUS, TOTAL DATA LOSS):
```shell
php bin/console doctrine:database:drop --force \
  && php bin/console doctrine:database:create \
  && php bin/console doctrine:schema:create \
  && php bin/console doctrine:fixtures:load \
  && php bin/console doctrine:migrations:migrate \
  && php bin/console cache:clear
```