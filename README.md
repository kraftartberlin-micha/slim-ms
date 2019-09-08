# slim-ms
A small clean fast PHP-Microservice 

(docker, nginx, php7.3.9, composer, unittest, ..)

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

I did this because a lot of guys ask me to see some code from me on github again and again ;) so i spend 4hours for this state, created this account and push it. My english is bad but i like to get feedback always and will answer if i will find some time.

## installation
### systems
mac/linux: install docker, clone repo (today untested, but should work)

windows7: install docker toolbox and run `make dockerize`

windows8/10: idk (give me feedback pls)

### makefile commands

run `make composer` to  install vendor

run `make startup` to run nginx+php-fpm containers. after this you can access the service with browser, postman, ...

run `make stop` to stop all containers

run `make restart` to stop and start all containers again

run `make testing` to run unit-, integration- and systemtests in a cli-container with xdebug. coverage will be generated.

the cli-container can be used in IDEs like PHPStorm for debugging testing and will display coverage too.

## comming soon
- refactoring routing (soc, srp, ..) maybe also with a config
- maybe a configloader
- env-check
  - for php.ini too (dont want debuginfos in production)
- maybe remove the service-layer(yagni), idea was to inject a validator and do some stuff with data from repo before we send it to requesthandler 
  - need to find a middleway between a demo and a blank version
- add some code-sniffer/analyser also with a make-cmd
