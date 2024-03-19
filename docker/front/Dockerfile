FROM node:18.13.0

RUN mkdir /usr/src/app && mkdir /usr/src/app/front
 
WORKDIR /usr/src/app/front

RUN npm cache clean && npm install -g @angular/cli@16.2.12

COPY . .