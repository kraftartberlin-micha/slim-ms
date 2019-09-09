# slim-ms
A small clean fast and simple PHP-Microservice with no dependencies

(docker, nginx, php7.3.9, composer, unittest, cleancode, psr2+4, ..)

Only for personal tests or commercial internal projects or as a little help to start your own shit

Its easy to add/develop something like: 
- status-codes
- json-responses
- storages
- template-engines
- middlewares
- security things
- ...

Feel free to fork and change/add/remove what you want

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

run `make composer` to run install vendor with composer-container

run `make composer_update` to  update vendor with composer-container

run `make dockerize` for windows7 
- starts toolbox/docker-machine

run `make startup` to run nginx+php-fpm containers.
- after this you can access the service with browser, postman, ...

run `make stop` to stop all containers

run `make restart` to stop and start all containers again

run `make testing` to run unit-, integration- and systemtests in a cli-container with xdebug. 
- coverage will be generated.
- the cli-container can be used in IDEs like PHPStorm for debugging, testing and will display coverage too.

## comming soon
- refactoring routing (soc, srp, ..) maybe also with a config
- maybe a configloader
- env-check
  - for php.ini too (dont want debuginfos in production)
- maybe remove the service-layer(yagni), idea was to inject a validator and do some stuff with data from repo before we send it to requesthandler 
  - need to find a middleway between a demo and a blank version
- add some code-sniffer/analyser also with a make-cmd
- add proxy/fullpage-caching to nginx
- add customized exceptions and errorhandling in repository, service & handler incl. a lot of tests (tdd is here nice to use)
- add a product-valueobject for the demo, cause its always nice and safe to use data in them
- add a demo-storage(maybe inmemory) for the repository to add crud-functions there
