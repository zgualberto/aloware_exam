## APP Setup

1. Setup MYSQL, NGINX, PHP, NodeJS
    * Node JS version 14.16.1
    * MYSQL 8
    * PHP 7.4
    * NGINX 1.8.0 (Ubuntu)
1. Go to root directory and run the ff:
    * `composer install`
    * `php artisan migrate`
    * `cd client && npm install`
1. Create `.env.local` on root folder and also on `client` folder check `.env.example` for reference
1. Setup DATABASE Configuration
1. To run Unit test
    * `php artisan test`
1. to run API - `php artisan serve`
1. to run Frontend - `cd client && npm run serve`

If you have more questions kindly email me @ ziegfrid.gualberto@gmail.com
