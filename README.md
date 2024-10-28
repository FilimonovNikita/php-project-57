[![Actions Status](https://github.com/FilimonovNikita/php-project-57/actions/workflows/hexlet-check.yml/badge.svg)](https://github.com/FilimonovNikita/php-project-57/actions)
[![PHP CI](https://github.com/FilimonovNikita/php-project-57/actions/workflows/phpci.yml/badge.svg)](https://github.com/FilimonovNikita/php-project-57/actions/workflows/phpci.yml)
[![Maintainability](https://api.codeclimate.com/v1/badges/074f42913487f2c89e42/maintainability.svg)](https://codeclimate.com/github/FilimonovNikita/php-project-57/maintainability)
[![Test Coverage](https://api.codeclimate.com/v1/badges/074f42913487f2c89e42/test_coverage.svg)](https://codeclimate.com/github/FilimonovNikita/php-project-57/test_coverage)



### About the project
Task Manager is a task management system that allows you to set tasks, assign executors and change their statuses.

### Requirements
* PHP >= 8.2
* Composer >= 2.2.6
* PostgreSQL >= 14.13
* GNU Make >= 4.3

### Setup
```
$ git clone https://github.com/FilimonovNikita/php-project-57.git
$ cd php-project-57
$ make setup
```

### Run
Use environment variables to connect to the database.

```
$ php artisan migrate:fresh --seed
$ make start
Open http://localhost:8000/ in your browser.
```

### Prodaction
https://php-project-57-ctmn.onrender.com