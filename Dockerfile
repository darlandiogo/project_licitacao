FROM php:alpine

RUN apk update && apk add --update nodejs npm

RUN apk update && apk add curl && \
  curl -sS https://getcomposer.org/installer | php \
  && chmod +x composer.phar && mv composer.phar /usr/local/bin/composer

RUN docker-php-ext-install pdo_mysql

COPY . .

#docker run --rm -v $(pwd):/app composer install 
#docker-compose exec app php artisan key:generate

RUN composer install

RUN npm install
