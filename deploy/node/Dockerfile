FROM node:20-alpine

WORKDIR /app

COPY ./frontend/package*.json ./

RUN npm install

COPY ./frontend .

RUN chown -R node:node /app

USER node

EXPOSE 5173

CMD ["npm", "run", "dev"]