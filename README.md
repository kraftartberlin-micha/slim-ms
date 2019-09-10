# slim-ms
A small clean fast and simple PHP-Microservice

## keys
docker, docker-compose, makefile, nginx, nginx reverse proxy(fullpagecache), browsercache, php-fpm, php-cli, composer, phpunit, single containers, 
php7.3.9, cleancode, psr2+4, 100% coverage, phpstan, dependency injection, no dependencies to external libs/packages, 
selfwritten skeleton with small democode, 100% free, not for production or at own risk =P

Only for katas, tests, internal projects or as a little help to start your own shit

# introduction

- startpoint is `index.php` in public
- loading autoloader, factory & router
- router calls correct requesthandler
- requesthandler do stuff with request and return response 

## host
- is different between mac/linux/w7/w8+w10
  - w7: 192.168.99.100 (docker toolbox)
  - linux/mac: localhost
   
## ports
- 8080 for nginx (without cache - surf this port while developing)
- 8081 for nginx reverse-proxy (fullpagecache)

## endpoints
- `/` or `/everything/that/not/matches` with `GET` will return `index` 
- `/product` with `GET` will return all products as json 
- `/product` with `POST` will add or update data and return all products as json
  - for required payload check the unittests :P 
  
## makefile commands

### init

run `make composer` to run install vendor with composer-containerrun `make composer_update` to  update vendor with composer-container

run `make dockerize` for windows7 
- starts toolbox/docker-machine

### run
run `make startup` to run nginx+php-fpm containers.
- after this you can access the service with browser, postman, ...
- docker toolbox: http://192.168.99.100:8080
- docker: localhost:8080

run `make stop` to stop all containers

run `make restart` to stop and start all containers again

### develop

run `make phpunit` to start unit-, integration- and systemtests in a cli-container with xdebug. 
- coverage will be generated.
- the cli-container can be used in IDEs like PHPStorm for debugging, testing and will display coverage too.

run `make phpstan` to start codeanalyzer in src and tests

run `make testing` to start phpunit and phpstan in one command


# next steps
- implement PUT requests 
- add some more statuscodes
- change crappy test-repository to something near reality. maybe i add redis to this, but i dont want to choose too much for you
- add psr-http-messages interface  
- change phpunit to docker container
- refactoring router
- add more unittests (tdd, be evil)
- continue integrationtests
- start systemtest
- improve errorhandling in requesthandler (known issue:throw in catch from setStatus)
- change some namings
