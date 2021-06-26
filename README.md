# Make personal CV Dyanamic with laravel framework
Dyanamic CV builder for anyone
Installation

Clone the repository

git clone https://github.com/sudan94/spersonal.git

Install all the dependencies using composer

composer install

Copy the example env file and make the required configuration changes in the .env file

cp .env.example .env

Generate a new application key

php artisan key:generate

Run the database migrations (Set the database connection in .env before migrating)

php artisan migrate

Start the local development server

php artisan serve
You can now access the server at http://localhost:8000

For registration 
http://localhost:8000/register 

Note: Only one time registration is possible
can register other user after login for the first time
can vhange the code in  RegisterController.php

    public function __construct()
    {
        // only allows first time  registration
        $user = User::all();
        if (count($user) >= 1) {
            $this->middleware('auth');
        }
    }
