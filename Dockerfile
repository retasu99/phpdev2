FROM php:8.0-apache 

# MySQLクライアントライブラリのインストール
RUN apt-get update && \
    apt-get install -y libonig-dev && \
    apt-get install -y default-libmysqlclient-dev && \
    docker-php-ext-install pdo_mysql

# MySQL 8.0のデフォルト認証方式を設定
RUN { \
    echo '[mysqld]'; \
    echo 'default_authentication_plugin=mysql_native_password'; \
    } > /etc/mysql/conf.d/mysql_default_auth.cnf