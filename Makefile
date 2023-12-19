setup:
	@make copy-env
	@make build
	@make run
	@make composer-setup
	@make database-migrate
	@echo Setup successful, website running on localhost:8080
build:
	docker-compose build --no-cache --force-rm
stop:
	docker-compose stop
run:
	docker-compose up -d
copy-env:
	copy .env.example .env

composer-setup:
	docker exec hotel-system-app-1 bash -c "composer install"
database-setup:
	echo Starting database creation
	
	docker exec -i hotel-system-database-1 mysql -u root -e "CREATE DATABASE hotel-system-db;"
	docker exec -i hotel-system-database-1 mysql -u root -e "USE hotel-system-db;"
	echo Finished database creation
database-migrate:
	echo Starting database migration

	docker exec hotel-system-app-1 bash -c "yes | php spark migrate:refresh"
	echo Finished database migration
	echo Starting database seeding
	docker exec hotel-system-app-1 bash -c "php spark db:seed EmployeesSeeder"
	docker exec hotel-system-app-1 bash -c "php spark db:seed RoomsSeeder"
	echo Finished database seeding