FROM 'node:alpine'

WORKDIR /home/mtf

COPY . /home/mtf

RUN npm i

CMD ['gulp']
