# About Leave Mangement

## how to run a project on local environment
- Create your database using MySQL client.
- git clone https://github.com/abhijeet15/laravel-leave-app.git
- cd laravel-leave-app
- composer install
- npm install
- cp .env.example .env
- php artisan key:generate
- Add your local database setting to the .env file.
- php artisan migrate --seed
- php artisan serve

Login as super admin: admin@admin.com, password: 123456
