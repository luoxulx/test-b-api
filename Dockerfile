FROM docker

COPY . /home/www-data/application
RUN cd /home/www-data/application \
    && mv nginx.conf /etc/nginx/nginx.conf \
    && mv supervisord.conf /etc/supervisord.conf \
    && mv default.conf /etc/nginx/conf.d/default.conf \
    && sed -i "s/www-data/nginx/g" /usr/local/etc/php-fpm.d/www.conf \
    && chown -R nginx:nginx /home/www-data/application \
    && ln -s /home/www-data/application/storage/app/public/ /home/www-data/application/public/storage

USER nginx
WORKDIR /home/www-data/application
RUN php composer.phar install --no-dev && php composer.phar clearcache
USER root

EXPOSE 80

CMD ["/bin/sh", "-c", "/usr/bin/supervisord -c /etc/supervisord.conf"]
