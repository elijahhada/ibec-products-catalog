## iBec test assignment solution
### Pre-requisites
* Docker running on the host machine.
* Docker compose running on the host machine.
* Docker version 20.10.17
* docker-compose version 2.6.0
## Installation
### To get started, follow next steps:
* git clone https://github.com/elijahhada/ibec-products-catalog.git into a folder of your choice
* cd to the project's directory.
* sudo docker compose build --no-cache
* sudo docker compose up -d
* do not create .env file, it was already added to git
* composer install
* php artisan key:generate
* sudo docker compose exec app php artisan migrate --seed
* Visit http://localhost:1234 to reach the app.
