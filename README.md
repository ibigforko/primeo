# Primeo Backend
This is API Server for Primeo

## Requirements
This section is optional if there isn't any special dependencies. Else a bulletlist will suffice, e g:

- PHP 8.1 | 8.2

## Installation
A quick guide on how to install MIB project. 
For example:

1. Clone Project
2. cd primeo
3. cp .env.example .env
4. docker-compose build primeo.backend
5. docker-compose up -d
6. docker-compose exec primeo.backend composer install
7. docker-compose exec primeo.backend php artisan key:generate
8. docker-compose exec primeo.backend php artisan migrate
9. docker-compose exec primeo.backend php artisan scribe:generate --no-extraction
10. sh clean.sh
11. docker-compose exec primeo.backend php artisan test

## Others
Link for Documentation: http://localhost/docs
Login: test@test.com
Password: secret