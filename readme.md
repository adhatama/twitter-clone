This project is for case study for learning integration test in Laravel. For the tutorial (in Bahasa Indonesia), you can see it in [here](https://medium.com/javanlabs/how-to-integration-test-versi-laravel-8e951e2208ed#.5z6i50m06)

### Installation

- `composer install`
- Setup `.env`, make sure you use different database in `DB_CONNECTION` and `DB_CONNECTION_TEST`
- `php artisan migrate --seed --database=mysql_test` to initialize tables in testing db

### Testing

- Run `vendor/bin/phpunit`

