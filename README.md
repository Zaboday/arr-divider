Test Task
==============

1. Create Service to Divide Array.
2. Create REST access to service with simple authorisation.
3. Create Console Command with access to service.

**Stack**
- PHP 7.1 + MySql. 
- Framework: Symfony 4.2

**Install**
    
Run environment:

    docker-compose build

Go to docker container:

    docker exec -it name_of_php_container /bin/sh

Install symfony libraries:

    composer install
    
**Tests**

To run tests locally go to php container and:
    
    php bin/phpunit