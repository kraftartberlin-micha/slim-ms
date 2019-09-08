# slim-ms
small clean php-microservice 

easy to fill with storages, template-engines, middlewares, ..

with docker, nginx, php7.3.9, composer, unittest, ..

## installation
run `make composer` to  install vendor

run `make startup` to run nginx+php-fpm containers. after this you can access the service with browser, postman, ...

run `make stop` to stop all containers

run `make testing` to run unit-, integration- and systemtests in a cli-container with xdebug. coverage will be generated.

the cli-container can be used in IDEs like PHPStorm for debugging testing and will display coverage too.