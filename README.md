# Laravel Elasticbeanstalk

Small sample project to get Laravel up and running on [AWS Elastic Beanstalk](
https://aws.amazon.com/elasticbeanstalk/) as a Multi Docker deployment. 
This is a Laravel application with Postgres as a database and Redis.


## Local Development
```
cd _INFRA/dev
docker-compose up
```
This will build the PHP 7.4 container, then start the docker compose file with all its containers. You can log into
the laravel container and work there. Which is recommended as working with your native PHP interpreter is not best practice
nowadays. So
```
docker exec -it  briefing-tool-backend_laravel_1 bash
```
And your good to go with your knows Laravel commands:  `composer install`, `php artisan ...` or `./vendor/bin/phpunit`.
