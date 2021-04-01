FROM debian:jessie

RUN printf "deb http://archive.debian.org/debian/ jessie main\ndeb-src http://archive.debian.org/debian/ jessie main\ndeb http://security.debian.org jessie/updates main\ndeb-src http://security.debian.org jessie/updates main" > /etc/apt/sources.list
RUN apt-get update && apt-get install -y --force-yes \
 nginx

ADD nginx.conf /etc/nginx/
ADD yiiapp.conf /etc/nginx/sites-available/

RUN ln -s /etc/nginx/sites-available/yiiapp.conf /etc/nginx/sites-enabled/yiiapp
RUN rm /etc/nginx/sites-enabled/default

RUN echo "upstream php-upstream { server php:9000; }" > /etc/nginx/conf.d/upstream.conf

CMD ["nginx"]

EXPOSE 80
EXPOSE 443
