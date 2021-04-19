## APP Setup

1. Setup MYSQL, NGINX, PHP, NodeJS, Composer
    * Node JS version 14.16.1
    * MYSQL 8
    * PHP 7.4
    * NGINX 1.8.0 (Ubuntu)
    * Composer 2
1. Go to root directory and run the ff:
    * `composer install`
    * `php artisan migrate`
    * `cd client && npm install`
1. Create `.env.local` on root folder and also on `client` folder check `.env.example` for reference
1. Setup DATABASE Configuration on `.env.local` located on root folder
1. To run Unit test
    * `php artisan test`
1. to run API - `php artisan serve`
1. to run Frontend - `cd client && npm run serve`
1. Make sure to have the right permissions specially on the API when running it via `php artisan serve` or NGINX

If you have more questions kindly email me @ ziegfrid.gualberto@gmail.com
