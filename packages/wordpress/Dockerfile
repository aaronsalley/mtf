FROM wordpress

RUN echo 'file_uploads = On \n\
  memory_limit = 1064M \n\
  upload_max_filesize = 1064M \n\
  post_max_size = 1064M \n\
  max_execution_time = 600' > /usr/local/etc/php/conf.d/uploads.ini &&\ 
  curl -fsSL https://deb.nodesource.com/setup_current.x | bash - &&\
  apt-get install -y nodejs &&\
  corepack enable &&\
  corepack prepare yarn@stable --activate

# # docker run --rm --interactive --tty \
# #   --volume $PWD:/app \
# #   composer install

WORKDIR /usr/src/wordpress
COPY plugin/ ./wp-content/plugins/mtfmusicals/

COPY theme/ ./wp-content/themes/mtfmusicals/
COPY package.json ./wp-content/themes/mtfmusicals/
RUN cd ./wp-content/themes/mtfmusicals/ && yarn &&\
yarn sass

WORKDIR /var/www/html

EXPOSE 80 8080

ENTRYPOINT ["docker-entrypoint.sh"]
CMD ["apache2-foreground"]