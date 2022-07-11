

# Getting started

## Server Requirements

The Laravel framework has a few system requirements. You should ensure that your web server has the following minimum PHP version and extensions:

    PHP >= 8.0
    Fileinfo PHP Extension
    JSON PHP Extension
    Mbstring PHP Extension
    OpenSSL PHP Extension
    PDO PHP Extension
    Tokenizer PHP Extension


## Installation
First, you need to clone the Git repository using the below command in your local system.

```bash
  git clone https://github.com/chirag0110/messaging_system.git
```

After cloning the Repository, Switch to the repo folder.

`cd messaging_system`

# Composer

Laravel utilizes [Composer](https://getcomposer.org/) to manage its dependencies. So, before using Laravel, make sure you have Composer installed on your machine.

After installing composer, Please run the below commands to install all the dependencies into the project.

`composer install`

# Environment Configuration

If `.env` file is not generated, Please copy and paste `.env.example` file rename it to `.env` file.

`cp .env.example .env`

Please make the required configuration changes in the .env file.

Generate a new application key

`php artisan key:generate`

Install frontend dependencies using npm

`npm install && npm run dev`

# Database

After changing the database configuration in the `.env` file. You need to run the below commands to create all the database tables.

`php artisan migrate`

# Start server

Run below command to start the local server.

`php artisan serve`

# Server Access

Now, you can access your local server at [http://localhost:8000/](http://localhost:8000/)

# Database seeding

Run below command to add some dummy users. this can help to test this app.

`php artisan db:seed`


# License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).