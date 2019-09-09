# slim-ms
A small clean fast and simple PHP-Microservice with no dependencies

(docker, nginx, php7.3.9, composer, unittest, cleancode, psr2+4, 100% coverage, ..)

Only for katas, tests, internal projects or as a little help to start your own shit

## introduction

### flow
- startpoint is index.php in public
- loading autoloader and factory
- calls requesthandler to handle request

### architecture
- factory to create & inject classes
- router to call correct requesthandler
- requesthandler do stuff with request and return response like demo
  - using a service with a repository to deliver data (see comming son, maybe this layer will droped)

### makefile commands

run `make composer` to run install vendor with composer-containerrun `make composer_update` to  update vendor with composer-container

run `make dockerize` for windows7 
- starts toolbox/docker-machine

run `make startup` to run nginx+php-fpm containers.
- after this you can access the service with browser, postman, ...
- docker toolbox: http://192.168.99.100:8080
- docker: localhost:8080

run `make stop` to stop all containers

run `make restart` to stop and start all containers again

run `make testing` to run unit-, integration- and systemtests in a cli-container with xdebug. 
- coverage will be generated.
- the cli-container can be used in IDEs like PHPStorm for debugging, testing and will display coverage too.

### working demo-endpoints
- `/` or `everything that not matches` with `GET` responses `index` 
- `product` with `GET` responses all products as json 
- `product` with `POST` add or update data and responses all products as json
  - for payload check unittests 

## next steps
- refactoring routing 
- add some code-sniffer/analyser also with a make-cmd
- add proxy/fullpage-caching to nginx for special pages
- implement PUT requests
- change crappy test-repository to something near reality. maybe i add redis to this, but i dont want to choose too much for you
- add psr-http-messages interface  
- change valueobject-creation to static
