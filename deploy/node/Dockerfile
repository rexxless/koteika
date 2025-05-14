FROM node:20

WORKDIR /var/www

COPY ./project/package*.json ./

RUN npm install

COPY ./project .

EXPOSE 3000

CMD ["npm", "run", "dev"]