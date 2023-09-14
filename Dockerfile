FROM php:8.2-apache

WORKDIR /var/www/html

COPY . .

EXPOSE 80

RUN docker-php-ext-install pdo pdo_mysql

CMD ["apache2-foreground"]
