FROM nginx

RUN apt-get update && apt-get install -y \
    nano \
    sendmail

COPY ./nginx/vhost.conf /etc/nginx/conf.d/default.conf

RUN mkdir -p /etc/letsencrypt/live/localhost

COPY ./letsencrypt/localhost.crt /etc/letsencrypt/live/localhost/localhost.cert

COPY ./letsencrypt/localhost.key /etc/letsencrypt/live/localhost/localhost.key

COPY public /var/www/public

