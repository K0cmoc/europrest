###dependencies:###

- docker

###installation:###

1) add `127.0.0.1 europrest.local` to your hosts file


2) rename docker-compose.override.yml.sample into docker-compose.override.yml

this file contains services configuration for ports
so you can run your application in browser on address 
`http://localhost:8000`
also you can add `db` and `db_test` config to use databases in your SQL-client

rename config/env.php.sample into env.php
this file contains db and param properties for application configuration
 
3) docker-compose build

4) `docker-compose up -d`
   `docker-compose exec php bash`
   `composer install`
   `php yii migrate`
   use `europrest_dump.sql` in the progect directory to fill the database with data

to run application documentation use 
`http://localhost:8000/api/documentation`

to authorize use `Rest` block, execute login action, copy the result and paste it in the `autorize` popup

to run tests, run in docker container next command  
```tests/bin/yii migrate --interactive=0 && vendor/bin/codecept run```
