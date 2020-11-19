
FROM us.gcr.io/send4-api/php-base-image@sha256:625e509c538fd28d52e9a5cd51b326cded1ef46f6c4943df441690af4eb7d430 as php-ext

WORKDIR /app
COPY . /app

RUN composer install --optimize-autoloader --no-interaction --no-progress
RUN chmod -R 755 /app/bootstrap \
    && chown -R www:www /app/bootstrap \
    && chmod -R 755 /app/storage \
    && chown -R www:www /app/storage

EXPOSE 80
CMD ["/usr/bin/supervisord", "-c", "/etc/supervisor/supervisord.conf"]
