# Prepare webserver
FROM nginx:1.23.3-alpine

COPY ./ /var/www

RUN apk update && apk add --no-cache bash && rm -rf /var/lib/apt/lists/*

COPY ./wait-for-it.sh .
RUN chmod +x wait-for-it.sh
