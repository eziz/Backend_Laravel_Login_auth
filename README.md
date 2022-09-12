cp .env.example .env
php artisan key:generate
php artisan config:clear
php artisan migrate
php artisan cache:clear
php artisan passport:install
php artisan passport:install --force
php artisan serve
php artisan migrate:fresh --seed
composer install