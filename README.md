## Table of contents
* [General info](#general-info)
* [Technologies](#technologies)
* [Setup](#setup)
* [Endpoints](#endpoints)

## General info
This project is simple CRUD api made for boldare company
	
## Technologies
Project is created with:
* PHP
* Symfony
* Docker Compose
* Doctrine
* Psalm Php-cs-fixer
	
## Setup
To run this project, start with command 

```
$ docker-compose up
```
Then start it with 
```
$ php -S localhost:8000
```
Or if you have symfony binarie
```
$ symfony serve -d
```
And in the end run in the command line:
```
$ php bin/console make:migration
$ php bin/console doctrine:migrations:migrate
```
To upload to the database schemas.

## Endpoints

| Enpoint            | Method | Description                                                                      |   |
|--------------------|--------|----------------------------------------------------------------------------------|---|
| /api/workers       | GET    | Creates new worker from data in body                                             |   |
| /api/workers/uuid  | GET    | Returns worker by given UUID                                                     |   |
| /api/workers       | GET    | Returns a list of workers                                                        |   |
| /api/workers       | POST   | Create new worker from data in body                                              |   |
| /api/salary        | POST   | Returns JSON with average salary general and average salary for each worker type |   |
