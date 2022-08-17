FROM node:alpine

COPY package.json /home/
WORKDIR /home
RUN yarn

COPY . /home/
CMD yarn start