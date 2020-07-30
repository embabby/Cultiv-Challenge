# Cultiv PHP API Challenge Soultion 



## Requirements
This project built using **laravel 7.0**, so your php version must be >= **7.0**


## Using laravel passport for api authentication


## Installation
1. Clone the source code. `git clone https://github.com/embabby/Cultiv-Challenge.git`
2. Go to inside the project. `cd Cultiv-Challenge`
3. Run `composer install` to install all the dependencies.
4. Copy configrations file. `cp .env.example .env`
5. Create a new database.
6. Open .env file and set database configrations
```php
      DB_DATABASE= YOUR_DATABASE_NAME_HERE
      DB_USERNAME= YOUR_USERNAME_HERE
      DB_PASSWORD= YOUR_PASSWORD_HERE
```
7. Migrate and Seed the tables `php artisan migrate --seed`
8. Run `php artisan passport:install` to install all passport dependencies.
9. Run the project! `php artisan serve`
10. for login as an admin use this account (generated through the seeding process) 'admin@test.com' for email and '12345678' for password

11. when u access any api DO NOT forget the prefix `user OR admin`
12. also DO NOT forget to put the generated token in the Headers section with key 'Authorization' and value `Bearer (generated token)`


## Tests

```php
vendor/bin/phpunit
```

