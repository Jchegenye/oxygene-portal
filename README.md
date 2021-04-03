<p align="center">
    <img src="https://raw.githubusercontent.com/Jchegenye/oxygene-portal/master/cover.png" alt="Nuxt & Laravel Application">
</p>

> This implements Nuxt app as a first-party client and Laravel Passport as the backend API. It supports Passport-password grant out of the box which allows your other first-party clients, such as a mobile application, to obtain an access token using an e-mail address and password.

## Installation

Clone the repository

    git clone https://github.com/Jchegenye/oxygene-portal.git

Switch to the laravel folder first

    cd oxygene-portal/laravel

Install all the dependencies using composer

    composer install

Copy the example env file and make the required configuration changes in the .env file

    cp .env.example .env

Generate a new application key

    php artisan key:generate

Run the database migrations (**Set the database connection in .env before migrating**)

    php artisan migrate

Install passport

    php artisan passport:install

Start the local development server

    php artisan serve

You can now access the server at http://localhost:8000

Switch to the nuxt folder next

    cd ../nuxt/

Install all the dependencies using npm

    npm install

Copy the example env file and populate it with values from laravel

    cp .env.example .env

You can get `PASSPORT_PASSWORD_GRANT_ID` and `PASSPORT_PASSWORD_GRANT_SECRET` with `php artisan passport:client --password`.

serve with hot reload at localhost:3000

    npm run dev
