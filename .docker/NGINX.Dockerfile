FROM nginx:1.19.1-alpine

# nginx配置文件
COPY .docker/nginx/conf.d /etc/nginx/conf.d
COPY .docker/nginx/nginx.conf /etc/nginx/nginx.conf
