
## Laravel Shop
E-commerce application built with Laravel, Vue.js, Tailwind.css.

## Installation

Make sure you have the environment setup properly. You will need MySQL, PHP8.2, composer account on Stripe to test the payment.

1.  Download the project (or clone using GIT)
2.  Copy .env.example into .env configure database credentials, add the secret and public key, for stripe use.
3.  Navigate to the project's root directory using terminal
4.  Run composer install
5.  Set the encryption key by executing php artisan key:generate --ansi
6.  Run migrations php artisan migrate --seed
7.  Start local server by executing php artisan serve
8.  Open new terminal and navigate to the project root directory
9.  Run npm install
10. Run npm run dev to start vite server for Laravel frontend


