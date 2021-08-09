# firsttimesymfony

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