FROM node:alpine

COPY package.json /home/
WORKDIR /home
RUN yarn

COPY . /home/
CMD yarn build \
    && yarn start

EXPOSE 3000