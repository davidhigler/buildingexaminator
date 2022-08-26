```
zypper in nginx mariadb php8 php8-cli php8-ctype php8-curl php8-dom php8-fileinfo php8-fpm php8-iconv php8-intl php8-mysql php8-openssl php8-pdo php8-phar php8-redis php8-sqlite php8-sysvsem php8-tokenizer php8-xdebug php8-xmlreader php8-xmlwriter php8-zip php8-zlib
```

```
S  | Name           | Summary                                                | Type
---+----------------+--------------------------------------------------------+--------
i+ | php8           | Interpreter for the PHP scripting language version 8   | package
i  | php8-cli       | Interpreter for the PHP scripting language version 8   | package
i  | php8-ctype     | Character class extension for PHP                      | package
i+ | php8-curl      | PHP libcurl integration                                | package
i  | php8-dom       | Document Object Model extension for PHP                | package
i+ | php8-fileinfo  | File identification extension for PHP                  | package
i+ | php8-fpm       | FastCGI Process Manager PHP Module                     | package
i  | php8-iconv     | Character set conversion functions for PHP             | package
i+ | php8-intl      | ICU integration for PHP                                | package
i+ | php8-mysql     | MySQL database client for PHP                          | package
i  | php8-openssl   | OpenSSL integration for PHP                            | package
i  | php8-pdo       | PHP Data Objects extension for PHP                     | package
i+ | php8-phar      | PHP Archive extension for PHP                          | package
i+ | php8-redis     | API for communicating with Redis servers               | package
i  | php8-sqlite    | SQLite database client for PHP                         | package
i+ | php8-sysvsem   | SysV Semaphore support for PHP                         | package
i  | php8-tokenizer | Extension module to access Zend Engine's PHP tokenizer | package
i+ | php8-xdebug    | Extended PHP debugger                                  | package
i  | php8-xmlreader | Streaming XML reader extension for PHP                 | package
i  | php8-xmlwriter | Streaming-based XML writer extension for PHP           | package
i+ | php8-zip       | ZIP archive support for PHP                            | package
i  | php8-zlib      | Zlib compression support for PHP                       | package
```

```
/etc/php8/fpm/php-fpm.d/buildingexaminator.conf
```

```
/etc/nginx/vhosts.d/buildingexaminator.conf
```

```
/etc/apparmor.d/php-fpm
```