# Aperture United SL test interview

Possible solution for the Laravel coding interview problem:
- Create an artisan command that perform a request on the log database to calculate country visits per day
- Pick the result on a controller and display it on a view

## Requirements
- Laravel 9
- PHPUnit

## Installation
To make it run pull: commands, controllers, models, factories, seeders and migrations.
Then run the following commands on a raw installation:

```bash
php artisan migrate --seed
php artisan stats:country
```

## Performances tests
I tried to test the solution in order to get the best performances on stats:country command and on the controller. Query builder seems to have a slight advantage (vs Eloquent model approach) querying on large number of database records.

Tests have been made with 20 000 db records on a dockerize local machine but should be performed on real life database and environment.

The cache database table might have a better structure in order to be more flexible with other kind of application's caching but does the job for the current problem.
