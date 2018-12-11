# About Leave Mangement

## how to run a project on local environment
- Create your database using MySQL client.
- Add your local database setting to the .env file.
- In the Terminal / Command Line, navigate to this directory and run the following commands:
	* composer install
	* php artisan migrate --seed
	  this will create user with email: admin@mailerlite.com, password: 123456
	* php artisan serve
## Running test:
- Create your testing database using MySQL client
- Add your local database details to the .env.testing file.
- In the Terminal / Command Line, navigate to this directory and run the following commands:
	* php artisan migrate --env=testing
	* vendor/bin/phpunit --coverage-html ./reports

