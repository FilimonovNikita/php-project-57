
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