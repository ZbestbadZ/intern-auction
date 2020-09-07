dir=${CURDIR}

# default is test enviroment
env=test

# test
project=-p auction-$(env)-laravel
service=auction-$(env)-laravel:latest
container=auction-$(env)-laravel
supervisord=auction-$(env)-supervisord

build:
	@docker-compose -f docker-compose-$(env).yml build

build-nginx:
	@docker-compose -f docker-compose-$(env).yml build auction-test-nginx

exec:
	@docker-compose -f docker-compose-$(env).yml $(project) exec -T $(container) $$cmd

start:
	docker-compose -f docker-compose-$(env).yml $(project) up -d

stop:
	docker-compose -f docker-compose-$(env).yml $(project) down

composer-install:
	make exec cmd="composer install"

migrate:
	make exec cmd="php artisan migrate --force"

npm-dev:
	make exec cmd="npm run dev"

npm-install:
	make exec cmd="npm install"
