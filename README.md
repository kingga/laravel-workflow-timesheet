# Laravel Workflow Timesheet
This is a package for Laravel which extends the base library `kingga/workflow-timesheet`. This package can be used to store the parsed file into the database and then converted back into an object from the database.

## Installation
1. Run the command `composer require kingga/laravel-workflow-timesheet`
2. Add the `Kingga\LaravelWorkflowTimesheet\WorkflowTimesheetServiceProvider` service provider to the `config/app.php` file.
3. Run the command `php artisan migrate`

## Usage
### Storing
```php
use Kingga\WorkflowTimesheet\Parser;
use Kingga\LaravelWorkflowTimesheet\WorkflowWeek;

$parser = new Parser;
$week = $parser->parse(storage_path('timesheets/Time-Sheet.csv'));

// NOTE: The user must be logged in as this is assigned per user.
WorkflowWeek::create($week);
```

### Retrieving
```php
use Kingga\LaravelWorkflowTimesheet\WorkflowWeek;

dd(WorkflowWeek::first()->toObject());
```
