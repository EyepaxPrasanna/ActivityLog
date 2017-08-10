
<p align="center"><h1 align="center">ActivityLog - An activity tracker for Laravel</h1><h5 align="center">This library can be used to log the activities or requests to track later.</h5></p>

<p align="center">
<a href="http://eyepax.com">Eyepax IT Consulting (Pvt) Ltd</a>
</p>

## Quick start

Install with composer.

```bash
composer require "eyepax/activity_log:dev-master"

php artisan vendor:publish

php artisan migrate
```

Now, a table will should have been created named "trn_activity_log". This is where all the activities are logged. Also, a config file named "activity_log.php" will also be created, inside config/ folder. You can add activities as key value pair, to identify the activity by ID later. Because, in the table, activity ID is what stored.

## Using the ActivityLog

This is designed to use with ease, with configurable fields.
