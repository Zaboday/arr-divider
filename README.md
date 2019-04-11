Test Task
==============

1. Create Service to Divide Array.
2. Create REST access to service with simple authorization.
3. Create Console Command with access to service.
4. Store user results to DB.

**Stack**
- PHP 7.1 + MySql. 
- Framework: Symfony 4.2

Installation
-------------------
    
Run environment:

    docker-compose build
    docker-compose up -d

Find Nginx container local IP:

    docker inspect name_of_nginx_container | grep IPAddress

Put it to /etc/hosts:
    
    172.26.0.4      symfony.localhost

Go to PHP container:

    docker exec -it name_of_php_container /bin/sh

Install symfony libraries and migrations:

    composer install
    doctrine:migrations:migrate

Try http://symfony.localhost
    
**Tests**

To run tests go to php container and:
    
    bin/phpunit
    
Code placement
-------------------
`App\Security\TokenAuthenticator` - Simple Authenticator, used in `ApiController`. Waiting X-AUTH-TOKEN header with `User.apiToken` string.

`App\Controller\Api\ApiAuthController` - authorization endpoint (admin@admin.com/adminpass).

`App\Controller\Api\ApiController` - API method for Service access.

`App\Service\ArrayDivider\ArrayDividerService` - divider service (explanation in comments).

`App\Command\ArrayDivideCommand` - Console command. Usage `app:array-divide -h` in console.

`src/Tests` - UnitTests for Service.

`postman_collection.json` - Postman collection for API requests.

`App\Entity\UserResult` - Entity for store request and result.