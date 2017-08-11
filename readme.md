
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

Now, a table should have been created named "trn_activity_log". This is where all the activities are logged. Also, a config file named "activity_log.php" will also be created inside config/ folder. You can add activities as key value pair, to identify the activity by ID later. Because, in the table, we store only the activity ID.

Then, add the <i>ActivityLogServiceProvider</i> class in the <i>providers</i> section in config/app.php file.

```php
Eyepax\ActivityLogServiceProvider::class
```

Then, add the <i>ActivityLog</i> Facade in the <i>aliases</i> section in config/app.php file.

```php
'ActivityLog' => Eyepax\Facades\ActivityLog::class
```

## Using the ActivityLog

This is designed to use with ease, with configurable fields. The below table explains on the fields.

<table>
<thead>
<tr>
<th>#</th>
<th>Field</th>
<th>Description</th>
<th>Required/Optional</th>
<th>Default value</th>
</tr>
</thead>
<tbody>
<tr>
<td>1</td>
<td>performed_user_id</td>
<td>If there are any type of user who performed, then that specific type user ID (Ex: Member/Company)</td>
<td>Optional</td>
<td>0</td>
</tr>
<tr>
<td>2</td>
<td>performed_user_type</td>
<td>If there are any type of user who performed, then type ID (Ex: Member/Company)</td>
<td>Required</td>
<td></td>
</tr>
<tr>
<td>3</td>
<td>performed_user_account_id</td>
<td>Users table ID, who performed the action</td>
<td>Required</td>
<td></td>
</tr>
<tr>
<td>4</td>
<td>action_user_account_id</td>
<td>Users table ID, who receives the action</td>
<td>Optional</td>
<td>0</td>
</tr>
<tr>
<td>5</td>
<td>action_user_id</td>
<td>If there are any type of user who receives the effect from action, then that specific type user ID (Ex: Member/Company)</td>
<td>Optional</td>
<td>0</td>
</tr>
<tr>
<td>6</td>
<td>action_user_type</td>
<td>If there are any type of user who receives the effect from action, then type ID (Ex: Member/Company)</td>
<td>Optional</td>
<td>0</td>
</tr>
<tr>
<td>7</td>
<td>action_id</td>
<td>Activity ID (Can check activity_log.php config file)</td>
<td>Required</td>
<td></td>
</tr>
<tr>
<td>8</td>
<td>platform_type</td>
<td>If the application has different sections, then the specific platform type (Ex: Portal A, Portal B)</td>
<td>Optional</td>
<td>null</td>
</tr>
<tr>
<td>9</td>
<td>action_data</td>
<td>JSON encoded array of input data</td>
<td>Required</td>
<td></td>
</tr>
<tr>
<td>10</td>
<td>action_admin_user_id</td>
<td>If admin performs the activity, then admin user's ID</td>
<td>Optional</td>
<td>null</td>
</tr>
<tr>
<td>11</td>
<td>api_type</td>
<td>Whether it is admin or front end (1 - Admin, 2 - Front end)</td>
<td>Optional</td>
<td>1</td>
</tr>
</tbody>
</table>

Add this in the top of the file, where you use ActivityLog.

<b>use Eyepax\ActivityLog;</b>

Then, just add the below code, where you want to log the activity. You can add the relevant fields from the above table.

- To add a single log entry,

```php
ActivityLog::log(['action_data' => [
    'data' => Input::all()
]]);
```

- To add multiple log entries,

```php
ActivityLog::logMultiples([
    ['action_data' => ['data' => Input::all()]], 
    ['action_data' => ['data' => Input::all()]]
]);
```

- To get list of logs,

```php
ActivityLog::getLogs($params, $page, $itemsPerPage);
```

<b>$params</b> - Array of filters. Field keys in the above table can be set here. Additionally, These keys can be set.
<ol>
<li>"after": Datetime filed, which will give logs after the given time.</li>
<li>"before": Datetime filed, which will give logs before the given time.</li>
</ol>

<b>$page</b> - Starts from 1. (Default: 1)

<b>$itemsPerPage</b> - Default is 20.

- To get details of a log entry,

```php
ActivityLog::getLogDetails($logId);
```