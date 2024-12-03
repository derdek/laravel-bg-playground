FROM dunglas/frankenphp:php8.3-alpine

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN mkdir -p /var/log/frankenphp && chown -R www-data:www-data /var/log/frankenphp

COPY ./docker-configs/frankenphp/frankenphp.conf /etc/frankenphp/frankenphp.conf

COPY . /var/www/html

RUN composer install

RUN chown -R www-data:www-data /var/www/html

CMD ["frankenphp", "-c", "/etc/frankenphp/frankenphp.conf"]