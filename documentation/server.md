# Setup
This will be a developer local setup on a Windows machine with a WSL2 Ubuntu 24.04 VM on it.

## WSL2 Ubuntu 24.04

Install required Linux packages
```shell
sudo apt update
sudo apt -y install \
    software-properties-common \
    ca-certificates \
    lsb-release \
    apt-transport-https
sudo add-apt-repository ppa:ondrej/php -y
sudo apt update
sudo apt -y upgrade
sudo apt -y install \
    nginx \
    mariadb-server \
    mariadb-client \
    php8.4 \
    php8.4-cli \
    php8.4-mbstring \
    php8.4-common \
    php8.4-curl \
    php8.4-fpm \
    php8.4-intl \
    php8.4-mysql \
    php8.4-redis \
    php8.4-xml \
    php8.4-xdebug \
    php8.4-sqlite3 \
    php8.4-ssh2 \
    php8.4-zip \
    nodejs \
    npm
```

## Enable services

Enable required services to start on startup.
And restart all of them to load everything.
```shell
sudo systemctl enable php8.4-fpm
sudo systemctl start php8.4-fpm
sudo systemctl enable nginx
sudo systemctl start nginx
sudo systemctl enable mariadb
sudo systemctl start mariadb
```

## PHP FPM config

Copy config for PHP FPM and restart
```shell
sudo cp examples/php/buildingexaminator.conf /etc/php/8.4/fpm/pool.d/buildingexaminator.conf
sudo systemctl restart php8.4-fpm
sudo systemctl status php8.4-fpm
```

## Nginx config

Copy config for Nginx and restart
```shell
sudo cp examples/nginx/buildingexaminator.conf /etc/nginx/sites-available/buildingexaminator.conf
sudo ln -s /etc/nginx/sites-available/buildingexaminator.conf /etc/nginx/sites-enabled/
sudo systemctl restart nginx
sudo systemctl status nginx
```

## MariaDB config

MariaDB config (ONLY LOCALLY FOR DEVELOPERS)
```shell
sudo mysql_secure_installation
root
Y
n
Y
Y
Y
Y
```

Open MySQL prompt with root user
```shell
mysql -u root -p
```

Create DB and necessary user
```shell
CREATE DATABASE buildingexaminator;
CREATE USER 'buildingexaminator'@localhost IDENTIFIED BY 'buildingexaminator';
GRANT ALL PRIVILEGES ON buildingexaminator.* TO 'buildingexaminator'@localhost;
FLUSH PRIVILEGES;
exit;
```

## AppArmor

AppArmor configuration
```shell
sudo cp examples/apparmor/php-fpm /etc/apparmor.d/php-fpm
sudo systemctl restart apparmor
sudo systemctl status apparmor
```

## User rights

If checkout is under a Linux user home dir
```shell
sudo usermod -a -G <user> www-data
sudo systemctl restart nginx
```

## xDebug config

Configure the xDebug PHP extension 
```shell
sudo nano /etc/php/8.4/fpm/conf.d/20-xdebug.ini
```
```shell
zend_extension=xdebug.so
xdebug.mode=debug
xdebug.client_host=<PC Name>
xdebug.client_port=9003
xdebug.idekey=PHPSTORM
xdebug.start_with_request=trigger
```
