FROM node

WORKDIR /var/www/html/wp-content/themes/mtf

COPY ./package.json /var/www/html/wp-content/themes/mtf/package.json
RUN npm install --silent

COPY . /var/www/html/wp-content/themes/mtf

CMD ["npm", "start"]

EXPOSE 4001
