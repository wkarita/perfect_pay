FROM node:lts

RUN mkdir -p /var/www/html

WORKDIR /var/www/html

EXPOSE 5173
