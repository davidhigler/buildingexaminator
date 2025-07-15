On WSL2 Ubuntu 24.04
```
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
    php8.4-common \
    php8.4-curl \
    php8.4-xml \
    php8.4-fpm \
    php8.4-intl \
    php8.4-mysql \
    php8.4-redis \
    php8.4-xdebug \
    php8.4-sqlite3 \
    php8.4-ssh2 \
    php8.4-zip
sudo systemctl enable php8.4-fpm
sudo systemctl start php8.4-fpm
sudo systemctl enable nginx
sudo systemctl start nginx
sudo systemctl enable mariadb
sudo systemctl start mariadb
```

Copy config for PHP FPM and restart
```
sudo cp examples/php/buildingexaminator.conf /etc/php/8.4/fpm/pool.d/buildingexaminator.conf
sudo systemctl restart php8.4-fpm
sudo systemctl status php8.4-fpm
```

Copy config for Nginx and restart
```
sudo cp examples/nginx/buildingexaminator.conf /etc/nginx/sites-available/buildingexaminator.conf
sudo ln -s /etc/nginx/sites-available/buildingexaminator.conf /etc/nginx/sites-enabled/
sudo systemctl restart nginx
sudo systemctl status nginx
```

MariaDB config (ONLY LOCALLY FOR DEV)
```
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
```
mysql -u root -p
```
Create DB and necessary user
```
CREATE DATABASE buildingexaminator;
CREATE USER 'buildingexaminator'@localhost IDENTIFIED BY 'buildingexaminator';
GRANT ALL PRIVILEGES ON buildingexaminator.* TO 'buildingexaminator'@localhost;
FLUSH PRIVILEGES;
exit;
```

AppArmor configuration
```
sudo cp examples/apparmor/php-fpm /etc/apparmor.d/php-fpm
sudo systemctl restart apparmor
sudo systemctl status apparmor
```

[buurt-wijk-en-gemeente-2021-voor-postcode-huisnummer](https://www.cbs.nl/nl-nl/maatwerk/2021/36/buurt-wijk-en-gemeente-2021-voor-postcode-huisnummer)
