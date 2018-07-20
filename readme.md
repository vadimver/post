<p align="center"><img src="https://laravel.com/assets/img/components/logo-laravel.svg"></p>
##  Laravel API "POST"

Simulator of sending mail between Ukrainian cities

##  Installation

1.  git clone git@github.com:https://github.com/vadimver/post.git project-folder
2.  composer install && composer update
3.  php -r "copy('.env.example', '.env');
4.  php artisan key:generate
5.  update db connection credentials in the `.env` file
6.  php artisan migrate
7.  php artisan db:seed
8.  php artisan passport:install
9.  copy generated keys and paste to .env file

##  Available options

Not registered users:
 (POST) - api/register                      // register
 (POST) - api/login                         // login
 (POST) - api/packages/show_tracking        // package show by tracking
 (GET)  - api/offices/show/{id}             // show office info

Users (status 3):
 (GET)  - api/user_info                     // personal information
 (GET)  - api/packages/show/{id}            // package show
 (POST) - api/packages/create               // package create

+Managers (status 2):
 (PUT)  - api/update/{id}                   // update user status
 (PUT)  - api/packages/status_update/{id}   // update package status

+Admin (status 1):
 (GET)  - api/users/{id}                    // user information
 (DEL)  - api/users/{id}                    // user delete
 (DEL)  - api/offices/delete/{id}           // office delete
 (POST) - api/offices/create                // office create

## Built With

* [Laravel](https://laravel.com/) - The PHP Framework
